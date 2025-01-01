<?php
namespace Brightweb\Ecommerce\Myserviceclass;

use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\CouponBalanc;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Payment;
use Brightweb\Ecommerce\Models\Paymentvalidation;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Paystackclass
{
    public function __construct()
    {
        //
    }

    public function initializeTransaction($user, $amount)
    {
        $amountInPesewas = $amount * 100;

        $userToken = Paymentvalidation::where('user_id', Auth::id())->first();

        if (!$userToken) {
            abort(404);
            return false;
        }

        $uniqueRef = $userToken->paymenttoken;
        $successUrl = route('paystck.paystacksuccess');
        $cancelUrl = route('paystck.cancelorder');

         // Log the request details
         Log::info('Initializing Paystack transaction', [
            'email' => $user->email,
            'amount' => $amountInPesewas,
            'reference' => $uniqueRef,
            'callback_url' => $successUrl,
            'cancel_url' => $cancelUrl,
        ]);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ])->post("https://api.paystack.co/transaction/initialize", [
            'email' => $user->email,
            'amount' => $amountInPesewas,
            'reference' => $uniqueRef,
            'callback_url' => $successUrl,
            'channels' => ['card', 'bank', 'ussd', 'mobile_money'],
            'metadata' => [
                
                'custom_fields' => [
                    [
                        'display_name' => 'Name',
                        'variable_name' => 'name',
                        'value' => $user->name
                    ]
                ]
            ]
        ]);

        // Log the response details
        Log::info('Paystack initialization response', [
            'response' => $response->json()
        ]);

        return [
            $response->json(),
            'reference' => $uniqueRef
        ];
    }

    public function verifyTransaction($transactionRef)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('PAYSTACK_SECRET_KEY'),
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache'
        ])->get("https://api.paystack.co/transaction/verify/$transactionRef");

        return $response->json();
    }

    public function handleSuccessPay($transactionRef, Request $request)
    {
        $userpaymentToken = Paymentvalidation::where('user_id', Auth::user()->id)->first();
        
        if (!$userpaymentToken) {
            abort(404);
            return false;
        }


        $data = $this->verifyTransaction($transactionRef);
        Log::info('Paystack transaction verification response', [
            'response' => $data
        ]);
//     if ($data['status'] && $data['data']['status'] === 'success')
        if ($data['status'] && $data['data']['status'] === 'success') {
         
            $name = $data['data']['metadata']['custom_fields'][0]['value'];
            $email = $data['data']['customer']['email'];
            $currency = $data['data']['currency'];
            $channel = $data['data']['channel'];
            $paymentDetails = $data['data']['authorization'];
            $cardNumber = $paymentDetails['last4'] ?? null;
            $bank = $paymentDetails['bank'] ?? null;
            $cardType = $paymentDetails['card_type'] ?? null;

            $checktransaction = Payment::where('payment_id', $data['data']['id'])->first();

            if (!$checktransaction) {
                DB::beginTransaction();

                try {
                    $payment = new Payment;
                    $payment->user_id = Auth::id();
                    $payment->payer_name = $name;
                    $payment->payment_id = $data['data']['id'];
                    $payment->paid_amount = $data['data']['amount'] / 100;
                    $payment->payment_type = 'Paystack';
                    $payment->currency = strtoupper($currency);
                    $payment->payment_status = 'COMPLETED';
                    $payment->payment_channel = $channel;
                    $payment->bank = $bank ?? 'No bank';
                    $payment->card_type = $cardType ?? 'No Credit Card';
                    $payment->card_no = $cardNumber;

                    $discountAmount = CouponBalanc::where('user_id', Auth::id())->where('is_used', 'pending')->first();
                    $getcartTotal = Cart::where('user_id', Auth::id())->sum('total_price');

                    if ($discountAmount) {
                        $payment->discount_amount = $discountAmount->total_after_coupon;
                        $payment->discount_percentage = $discountAmount->discount_percentage;
                        $payment->couponcode = $discountAmount->coupon;
                        $payment->original_price = $getcartTotal;
                    } else {
                        $payment->discount_amount = 0;
                        $payment->discount_percentage = 0;
                        $payment->couponcode = null;
                        $payment->original_price = $getcartTotal;
                    }

                    $payment->save();

                    $cartItems = Cart::where('user_id', Auth::id())->get();
                    $shipping = Shipping::where('user_id', Auth::id())->first();

                    foreach ($cartItems as $cartItem) {
                        $order = new Order;
                        $order->paymentid = $payment->id;
                        $order->product_id = $cartItem->product_id;
                        $order->quantity = $cartItem->quantity;
                        $order->user_id = Auth::id();
                        $order->shipping_id = $shipping->id;
                        $order->total_price = $cartItem->total_price;
                        $order->save();
                    }

                    $checkcart = Cart::where('user_id', Auth::id())->get();

                    foreach ($checkcart as $cartItem) {
                        $product = Product::find($cartItem->product_id);
                        
                        if ($product) {
                            $product->qty -= $cartItem->quantity;
                            $product->update();
                        }
                    }

                    Cart::where('user_id', Auth::id())->delete();

                    $updateusercoupon = CouponBalanc::where('user_id', Auth::id())->where('is_used', 'pending')->first();

                    if ($updateusercoupon) {
                        $updateusercoupon->is_used = 'used';
                        $updateusercoupon->save();
                    }

                    DB::commit();

                    Paymentvalidation::where('user_id', Auth::id())->delete();

                    return [
                        'transactionId' => $data['data']['id'],
                        'name' => $name,
                        'email' => $email,
                        'amount' => $data['data']['amount'] / 100,
                        'currency' => strtoupper($currency),
                        'channel' => $channel,
                        'bank' => $bank,
                        'cardType' => $cardType,
                        'cardNumber' => $cardNumber
                    ];
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('checkout.checkoutoptions')->with('message', "Failed to complete order. Please try again. $e");
                }
            }
        } elseif ($data['data']['status'] === 'failed' || $data['data']['status'] === 'abandoned'){
            return redirect()->route("paystck.cancelorder");
        }
        else{
            // cancel order
           return redirect()->route("paystck.cancelorder");
        }

        return false;
    }
}
