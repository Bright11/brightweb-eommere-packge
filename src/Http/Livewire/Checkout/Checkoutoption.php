<?php

namespace Brightweb\Ecommerce\Http\Livewire\Checkout;

use Livewire\Component;

use Brightweb\Ecommerce\Models\Coupon;

use Brightweb\Ecommerce\Models\Cart;
use Illuminate\Support\Facades\Auth;

use Brightweb\Ecommerce\Models\CouponBalanc;

class Checkoutoption extends Component
{
    public $coupon;
    public $getcart;
    public $getFromCouponTotal;

    public $userItemTotal;
    public $userAfterCoupon;
    public $countcart;
    public $qtyinput;

    public function applycoupon()
    {
       
        $checkcoupon=Coupon::where("code", $this->coupon)->first();
        if(!$checkcoupon){
            session()->flash('message', 'No coupon with this code found.');
            return;
        }
        if($checkcoupon->expires_at->isPast()){
            session()->flash('message', 'This coupon code has expired.');
            return;
        }
        if($checkcoupon->one_time_use){
           $checkusage=CouponBalanc::where("user_id",Auth::user()->id)->where("coupon",$checkcoupon->code)->where("is_used","used")->first();
           if($checkusage){
            session()->flash('message', 'This coupon code has been used by you.');
            return;
           }
        }
        // appling coupon code
        $checkcart=Cart::where("user_id",Auth::user()->id)->first();
        if(!$checkcart){
            session()->flash('message', "You don't have any item, try shoping with us");
            return;
        }
        $carttotal=Cart::where("user_id",Auth::user()->id)->sum("total_price");
        $discount=($checkcoupon->discount_percentage / 100) * $carttotal;

        $finalTotal=$carttotal-$discount;

        $mycoupon=new CouponBalanc;
        $mycoupon->coupon=$checkcoupon->code;
        $mycoupon->user_id=Auth::user()->id;
        $mycoupon->total_before_coupon=$carttotal;
        $mycoupon->total_after_coupon=$finalTotal;
        $mycoupon->discount_percentage=$checkcoupon->discount_percentage;
        $mycoupon->save();
        $this->mount();

    }
    public function mount()
    {
        $this->getcart=Cart::where("user_id",Auth::user()->id)->get();
        $this->getFromCouponTotal=CouponBalanc::where("user_id",Auth::user()->id)->where("is_used","pending")->first();

        $this->countcart=Cart::where("user_id", Auth::user()->id)->count();
        foreach ($this->getcart as $item) {
            $this->qtyinput[$item->id] = $item->quantity; // or whatever field represents qty
        }

        if($this->getFromCouponTotal){
            $this->userItemTotal=$this->getFromCouponTotal->total_before_coupon;
            $this->userAfterCoupon=$this->getFromCouponTotal->total_after_coupon;
        }else{
            $this->userItemTotal=Cart::where("user_id",Auth::user()->id)->sum("total_price");
            $this->userAfterCoupon=0;

        }
    }
    public function render()
    {
        return view('brightweb::livewire.checkout.checkoutoption',['userItemTotal'=> $this->userItemTotal,"userAfterCoupon"=>$this->userAfterCoupon,"getcart"=>$this->getcart]);
    }
    public function removecart($id){
        Cart::where("user_id",Auth::user()->id)->where("id",$id)->delete();
        $this->mount();
    }
    public function updatecart($id)
    {
        // Loop through all quantities in the Livewire component
        foreach ($this->qtyinput as $cartId => $quantity) {
            // Find the cart item for the current user and cart ID
            if (!is_numeric($quantity) || $quantity <= 0) {
                session()->flash('error', "Invalid quantity, for Quantity must be a positive number.");
                break; // Stop the loop
            }
            $cartItem = Cart::where("user_id", Auth::user()->id)
                ->where("id", $cartId)
                ->first();
    
            if ($cartItem) {
                // Update the quantity
                $cartItem->quantity = $quantity;
    
                // Optionally, update the total price based on the product price
                $product = $cartItem->products; // Assuming `products` is the relationship
                if ($product) {
                    $cartItem->total_price = $product->selling_price * $quantity;
                }
    
                // Save the changes to the database
                $cartItem->save();
            }
        }
    
        // Re-initialize the cart data
        $this->mount();
    }
   
}

// https://www.youtube.com/watch?v=iqrgggs0Qk0