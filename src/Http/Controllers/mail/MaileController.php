<?php

namespace Brightweb\Ecommerce\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use Brightweb\Ecommerce\Mail\OrderEmail;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class MaileController extends Controller
{
    //
    public function testmail(){
       // return 11111111111111111;
        $orderdata=Order::where("user_id",Auth::user()->id)->get();
        $payment=Payment::where("user_id",Auth::user()->id)->first();
        try{
           $sendingmail= Mail::to([Auth::user()->email,"chikanwazuo@GMail.com"])->send(new OrderEmail($orderdata,$payment));
           return "success";

        }catch(\Exception $e){
            return 'Sorry! Please try again latter';
    }
   
   


}
            
}
