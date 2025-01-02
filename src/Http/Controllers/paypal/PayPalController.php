<?php

namespace Brightweb\Ecommerce\Http\Controllers\paypal;

use App\Http\Controllers\Controller;
use Brightweb\Ecommerce\Mail\OrderEmail;
use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\CouponBalanc;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Payment;
use Brightweb\Ecommerce\Models\Paymentvalidation;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Shipping;
use Brightweb\Ecommerce\Myserviceclass\Paypalclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PayPalController extends Controller
{
    protected $Paypalclass;

    public function __construct(Paypalclass $Paypalclass)
    {
        $this->Paypalclass= $Paypalclass;
    }

  

    public function createPaypalOrder(Request $req)
    {
    //    creating paypal order
    // checking if user cart exist
    $checkusercart=Cart::where("user_id", Auth::user()->id)->count();
    if(!$checkusercart){
        return redirect()->back()->with("message","Please you don't have any item in the cart!");
    }
    // check shipping
    $checkshipping=Shipping::where("user_id", Auth::user()->id)->first();
    if(!$checkshipping){
        return redirect()->route("addshipping")->with("message","Please you need to add shipping address!");
    }
    // check if the user was having checkout validation
    $checkvalidation=Paymentvalidation::where('user_id',Auth::user()->id)->first();
    if($checkvalidation){
        Paymentvalidation::where('user_id',Auth::user()->id)->delete();
    }
    // checking if user applied for a discount
    $discountAmount=CouponBalanc::where("user_id",Auth::user()->id)->where("is_used","pending")->first();

    if($discountAmount){
        $amount=$discountAmount->total_after_coupon;
    }else{
        // calculating total amount
        $amount=Cart::where("user_id", Auth::user()->id)->sum("total_price"); 
    }
    $paymentToken='txn_'.uniqid() . '_' .time() . '_' . Str::random(10);

    $saveToken=new Paymentvalidation;
    $saveToken->paymenttoken=$paymentToken;
    $saveToken->user_id=Auth::user()->id;
    $saveToken->save();

    $order=$this->Paypalclass->createPaypalOrder($amount);
    return redirect($order['links'][1]['href']);

    }

    // creating success page
    public function successPaypal(Request $request)
    {
        // checking if payment validation was successful
        $checkvalidate=Paymentvalidation::where("user_id",Auth::user()->id)->first();
        if(!$checkvalidate){
           abort(403,'Unauthorized access');
        }
        $getcartTotal=Cart::where("user_id",Auth::user()->id)->sum("total_price");

        $orderId=$request->query('token');
        $payerId=$request->query('PayerID');

        $order=$this->Paypalclass->captureOrder($orderId, $payerId);
        if (isset($order['status']) && $order['status'] === 'COMPLETED') {
            $payerName = $order['payer']['name']['given_name']; // Adjust according to PayPal API response
            $paymentId = $order['id']; // Adjust according to PayPal API response
            $amount = $order['purchase_units'][0]['payments']['captures'][0]['amount']['value']; // Adjust according to PayPal API response
            $currency = $order['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code']; // Retrieve currency code
            $paymentStatus = $order['status']; // Adjust according to PayPal API response

            // Add these lines to capture payment method details
            $paymentMethod = $order['payment_source']['type'] ?? null;
            $cardNumber = $order['payment_source']['card']['last4'] ?? null;
            $bankName = $order['payment_source']['bank']['name'] ?? null;
            $cardType = $order['payment_source']['card']['type'] ?? null; // New line for card type
        $payment=new Payment;
        $payment->user_id=Auth::id();
        $payment->payer_name=$payerName;
        $payment->payment_id=$paymentId;
        $payment->paid_amount=$amount;
        $payment->payment_type="Paypal";
        $payment->currency=$currency;
        $payment->payment_status=$paymentStatus;

        $payment->payment_channel = $paymentMethod;
        $payment->bank = $bankName ?? "No bank";
        $payment->card_type = $cardType ?? "No Credit Card";
        $payment->card_no = $cardNumber;

        $discountAmount=CouponBalanc::where("user_id",Auth::user()->id)->where("is_used","pending")->first();
        if($discountAmount){
            $payment->discount_amount=$discountAmount->total_after_coupon;
            $payment->discount_percentage=$discountAmount->discount_percentage;
            $payment->couponcode=$discountAmount->coupon;
            $payment->original_price=$getcartTotal;

        }else{
            $payment->discount_amount=0;
            $payment->discount_percentage=0;
            $payment->couponcode=null;
            $payment->original_price=$getcartTotal;
        }
        $payment->save();
        $getusercart=Cart::where("user_id",Auth::user()->id)->get();
        $shippinginfo=Shipping::where("user_id",Auth::user()->id)->first();
        // DB::beginTransaction();
        // try{
            foreach ($getusercart as $cartItem) {

                $order=new Order;
                $order->paymentid=$payment->id;
                $order->product_id=$cartItem->product_id;
                $order->quantity=$cartItem->quantity;
                $order->user_id=Auth::user()->id;
                $order->shipping_id=$shippinginfo->id;
                $order->total_price=$cartItem->total_price;
                $order->save();
            }
            foreach($getusercart as $cartitem){
                $product=Product::find($cartitem->product_id);
                if($product){
                    $product->qty=$cartitem->quantity;
                    $product->update();
                }
            }
            Cart::where("user_id",Auth::user()->id)->delete();
            DB::commit();
           $updateusercoupon=CouponBalanc::where("user_id",Auth::user()->id)->where("is_used","pending")->first();
           if($updateusercoupon){
               $updateusercoupon->is_used="used";
               $updateusercoupon->save();
           }

        // }catch(\Exception $e){
        //     DB::rollBack();
        //     return redirect()->route("checkout.checkoutoptions")->with("message","Failed to complete order. Please try again.");
        // }
        Paymentvalidation::where('user_id',Auth::user()->id)->delete();

        // sending an emaill
        $orderdata=Order::where('user_id', Auth::user()->id)
        ->where('is_emailed', false)
        ->get();
        $payment=Payment::where("user_id",Auth::user()->id) ->where('is_emailed', false)->first();
        
            try{
                $sendingmail= Mail::to([Auth::user()->email,config('mail.from.address')])->send(new OrderEmail($orderdata,$payment));
                $mailinfor="We have sent you an email with the order details";
     
             }catch(\Exception $e){
                $mailinfor='Sorry! we could not send you an email, your transaction was successful, please check your dashboard for the order details';
         }
        
       
            foreach ($orderdata as $order) {
                $order->is_emailed = true;
                $order->save();
            }
            $payment->is_emailed = true;
            $payment->save();
        return view("brightweb::frontend.paypal.paypalsuccess",compact('payerName', 'paymentId', 'amount', 'paymentStatus', 'currency', 'cardType',"mailinfor"));

    }
}


}
