<?php

namespace Brightweb\Ecommerce\Http\Controllers\paystack;

use App\Http\Controllers\Controller;
use Brightweb\Ecommerce\Mail\OrderEmail;
use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\CouponBalanc;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Payment;
use Brightweb\Ecommerce\Models\Paymentvalidation;
use Brightweb\Ecommerce\Models\Shipping;
use Brightweb\Ecommerce\Myserviceclass\Paystackclass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PaystackController extends Controller
{
    //
    protected $paystackserviceclass;
    public function __construct(Paystackclass $paystackserviceclass)
    {
        $this->paystackserviceclass=$paystackserviceclass;
    }

    public function paywithpaystack(Request $req)
    {

        $checkusercart=Cart::where("user_id", Auth::user()->id)->count();
        if(!$checkusercart){
            return redirect()->back()->with("message","Please you don't have any item in the cart!");
        }
        
        // check if the user was having checkout validation
        $checkvalidation=Paymentvalidation::where('user_id',Auth::user()->id)->first();
        if($checkvalidation){
            Paymentvalidation::where('user_id',Auth::user()->id)->delete();
        }
        // check if shipping address was added
        $checkshipping=Shipping::where("user_id", Auth::user()->id)->count();
        if(!$checkshipping){
            return redirect()->route('addshipping');
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

        $user=Auth::user();
        $data=$this->paystackserviceclass->initializeTransaction($user,$amount);
        if (isset($data[0]['data']['authorization_url'])) {
           
            return redirect()->away($data[0]['data']['authorization_url']);
        } else {
           
          //  Log::error('Paystack initialization failed', ['response' => $data]);
            return back()->withErrors(['error' => 'Unable to initiate transaction. Please try again.']);
        }
    }


    public function paystacksuccess(Request $request)
    {
        
        $transactionRef = $request->query('reference');

        if (!$transactionRef) {
            return view('payment.failed', ['message' => 'Transaction reference not found.']);
        }

        $transactionDetails = $this->paystackserviceclass->handleSuccessPay($transactionRef,$request);
        if (is_array($transactionDetails)) {
        // if ($transactionDetails) {
        // sending an order email
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


            return view('brightweb::frontend.paystack.paystacksuccess', $transactionDetails, ['mailinfor'=>$mailinfor]);

        } else {
            
            return view('brightweb::frontend.paystack.failed', ['message' => 'Transaction verification failed.']);
        }
    }

    public function cancelorder()
    {
        return view('brightweb::frontend.paypal.cancel');
    }
}
