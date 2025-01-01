<?php

namespace Brightweb\Ecommerce\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Brightweb\Ecommerce\Models\Payment;
use Brightweb\Ecommerce\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Wishlist;

class UsersPageController extends Controller
{
    //
    public function userdashboard()
    {
       
        return view("brightweb::userprofile.userdashboard");
    }

    public function addshipping(Request $req)
    {
      
        if($req->isMethod("post")){
           $validate= $req->validate([
                'name'=>"required",
                'email'=>"required|email",
                "street_address"=>"required",
                "land_mark"=>"required",
                "city"=>"required",
                "state"=>"required",
                "country"=>"required",
                "pincode"=>"required",
                "phone"=>"required",
            ]);
            $attributes=[
                'name'=>$req->name,
                'email'=>$req->email,
                "street_address"=>$req->street_address,
                "land_mark"=>$req->land_mark,
                "city"=>$req->city,
                "state"=>$req->state,
                "country"=>$req->country,
                "pincode"=>$req->pincode,
                "phone"=>$req->phone,
               
            ];
            $attributes['user_id']=Auth::user()->id;
            $newOrEdit = Shipping::updateOrCreate(['user_id' =>Auth::user()->id], $attributes);
            return redirect()->route("userviewshipping")->with("message","Shipping received");
        }
        $myshipping=Shipping::where("user_id",Auth::user()->id)->first();
        return view("brightweb::userprofile.shipping_address",compact("myshipping"));
       
    }

    public function userviewshipping()
    {
        $myshipping=Shipping::where("user_id",Auth::user()->id)->first();
        if($myshipping){
            return view("brightweb::userprofile.myshipping_info",compact("myshipping"));
        }else{
            return redirect()->route("addshipping");
        }
       // return view("brightweb::userprofule.myshipping_info",compact("myshipping"));
    }

    public function myorders()
    {
        $orders=Payment::where("user_id",Auth::user()->id)->where('order_status', '!=', 'completed')->get();
        return view("brightweb::userprofile.myOrders",compact("orders"));
    }

    public function usercompletedorders()
    {
        $orders=Payment::where("user_id",Auth::user()->id)->where('order_status', '=', 'completed')->get();
        return view("brightweb::userprofile.usercompletedorders",compact("orders"));
    }

    public function myproduct($paymentid)
    {
       // $product=Order::with('product')->where('paymentid', $paymentid)->get();
       $product = Order::with('product')
    ->where('paymentid', $paymentid)
    ->where('status', '=', 'completed')->where("user_id",Auth::user()->id)
    ->get();
        return view("brightweb::userprofile.myproducts",['product'=>$product]);
    }
   public function receivedorders($paymentid){
    $orders=Order::where('paymentid', $paymentid)->where("user_id",Auth::user()->id)
    ->get();
    $payment=Payment::where("user_id",Auth::user()->id)->where('id', '=', $paymentid)->first();
    foreach($orders as $order){
        $order->is_received="yes";
        $order->save();
    }
    $payment->is_received="yes";
    $payment->save();
    return redirect()->back()->with("message", "Order received");
   }

   public function mywishlist(){
    $mywishlist=Wishlist::where("user_id", Auth::user()->id)->get();
    
    return view("brightweb::userprofile.mywishlist",compact("mywishlist"));
   }

   public function deletewishlist($id){
    $wishlist=Wishlist::where("id",$id)->where("user_id", Auth::user()->id)->first();
    $wishlist->delete();
    return redirect()->back()->with("message", "Wishlist deleted");
   }
}
