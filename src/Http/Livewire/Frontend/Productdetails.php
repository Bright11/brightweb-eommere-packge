<?php

namespace Brightweb\Ecommerce\Http\Livewire\Frontend;

use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Referral_usage;
use Brightweb\Ecommerce\Models\User;
use Brightweb\Ecommerce\Models\Wishlist;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Productdetails extends Component
{
    public $pro_details;
    public $relatedpro;
    public $referral;
    public $slug;

    public $productid;
    public $protocart;

    // to addtocat from slider
  

    public function mount($slug, Request $request)
    {
       
       // dd("see"); 
        $this->slug = $slug;  // Store the incoming slug for future use in the component's methods.
        $this->pro_details = Product::where('slug', $this->slug)->firstOrFail();
        $this->relatedpro = Product::where('category_id', $this->pro_details->category_id)->inRandomOrder()->take(4)->get();
        $this->referral = auth()->check() ? auth()->user()->referral_code : null; // Get the logged-in user's ID if available
        // Check if the user_id query parameter exists
 if ($request->has('referral')) {
    $sharedcode = $request->query('referral');
   
    // Perform any necessary actions with the sharedByUserId
    // For example, log the sharing event

    // get user ip
    $ip = request()->ip();
    $get_referreed_id = User::where("referral_code", $sharedcode)
    ->where("ip_address", "!=", $ip)
    ->first();
   if($get_referreed_id){
//    check if user has used this code before
$usage_check=Referral_usage::where("userip",$ip)->first();
if(!$usage_check){

    $newreferral=new Referral_usage;
    $newreferral->userip=$ip;
    $newreferral->referral_code=$sharedcode;
    $newreferral->referrer_id=$get_referreed_id->id;
    $newreferral->save();
}
   }
    // Log the IP address and user agent for future reference
    // log::info("User with ID $sharedByUserId accessed item $slug from IP address $ip using user agent: ". request()->userAgent());


    // log::info("Item $slug was shared by user $sharedcode.");
}
    }
    public function addtocartfromdetailspage($id)
    {
        if(!Auth::user())return redirect()->route("login");
        $this->productid=$id;
        $addtocart=Cart::where("product_id",$id)->where("user_id",Auth::user()->id)->first();

        $checkwishlist=Wishlist::where("product_id",$id)->where("user_id",Auth::user()->id)->first();

        $checkpro=Product::where("id",$id)->first();
       if($addtocart){
        $addtocart->quantity +=1;
        $addtocart->total_price=$checkpro->selling_price* $addtocart->quantity;
        $addtocart->save();
       }else{

        if($checkpro){
        $cart=new Cart();
        $cart->user_id=Auth::user()->id;
        $cart->product_id=$id;
        $cart->quantity=1;
        $cart->total_price=$checkpro->selling_price;
        $cart->save();
        }
       }
       if($checkwishlist){
        $checkwishlist->delete();
       }

      $this->dispatch("countcart");

    }
    // add to whislist
    public function addtowishlist($id)
    {
        if(!Auth::user())return redirect()->route("login");
        $this->productid=$id;
        $checkwishlist=Wishlist::where("product_id", $id)->where("user_id", Auth::user()->id)->first();

        $checkpro=Product::where("id", $id)->first();
        if(!$checkpro){
            return redirect()->back()->with("error", "Product not found");
        }
        if($checkwishlist){
           // $checkwishlist->delete();
        }else{
            $wishlist=new Wishlist();
            $wishlist->user_id=Auth::user()->id;
            $wishlist->product_id=$id;
            $wishlist->save();
        }
        $this->dispatch("countwishlist");
    }
    public function render()
    {
         //dd("see");
         $referral = auth()->check() ? auth()->user()->referral_code : null; // Get the logged-in user's ID if available

        return view('brightweb::livewire.frontend.productdetails',['pro_details'=>$this->pro_details,'relatedpro'=>$this->relatedpro,'referral'=>$referral]);
    }
}
