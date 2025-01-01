<?php

namespace Brightweb\Ecommerce\Http\Controllers\payondelivery;

use App\Http\Controllers\Controller;

use Brightweb\Ecommerce\Mail\OrderEmail;
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
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PayondeliveryController extends Controller
{
    //
    public function payondelivery(Request $request)
    {
        

        // checking if payment validation was successful
    //    check cartitem
        $checkusercart=Cart::where("user_id", Auth::user()->id)->count();
        if(!$checkusercart){
            return redirect()->back()->with("message","Please you don't have any item in the cart!");
        }
        $getcartTotal=Cart::where("user_id",Auth::user()->id)->sum("total_price");
        $checkshipping=Shipping::where("user_id", Auth::user()->id)->first();
    if(!$checkshipping){
        return redirect()->route("addshipping")->with("message","Please you need to add shipping address!");
    }
        $paymentToken=intval(crc32(Str::random(10)));
       
        $payment=new Payment;
        $payment->user_id=Auth::id();
        $payment->payer_name=Auth::user()->name;
        $payment->payment_id=$paymentToken;
       
        $payment->payment_type="On Delivery";
        $payment->currency="Default";
        $payment->payment_status="pending";

        $payment->payment_channel = "Pay on Delivery";
        $payment->bank = "No Bank";
        $payment->card_type = "No Credit Card";
        $payment->card_no = "No Card Number";

        $discountAmount=CouponBalanc::where("user_id",Auth::user()->id)->where("is_used","pending")->first();
        if($discountAmount){
            $payment->discount_amount=$discountAmount->total_after_coupon;
            $payment->discount_percentage=$discountAmount->discount_percentage;
            $payment->couponcode=$discountAmount->coupon;
            $payment->original_price=$getcartTotal;
            $payment->paid_amount=$discountAmount->total_after_coupon;

        }else{
            $payment->discount_amount=0;
            $payment->discount_percentage=0;
            $payment->couponcode=null;
            $payment->original_price=$getcartTotal;
            $payment->paid_amount=$getcartTotal;
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
                    $product->qty= $product->qty-$cartitem->quantity;
                    $product->update();
                }
            }
            Cart::where("user_id",Auth::user()->id)->delete();
            // DB::commit();
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
           $sendingmail= Mail::to([Auth::user()->email,"chikanwazuo@GMail.com"])->send(new OrderEmail($orderdata,$payment));
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
            $getpayment=Payment::where("user_id",Auth::user()->id) ->where("id", $paymentid=$payment->id)->first();
            $payerName=$getpayment->payer_name;
            $paymentId=$getpayment->payment_id;
            $amount=$getpayment->paid_amount;
            $paymentStatus=$getpayment->payment_status;
            $currency=$getpayment->currency;
            $cardType=$getpayment->card_type;
        return view("brightweb::frontend.paypal.paypalsuccess",compact('payerName', 'paymentId', 'amount', 'paymentStatus', 'currency', 'cardType',"mailinfor"));

    }
}

