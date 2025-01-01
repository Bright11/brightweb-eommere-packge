<?php

namespace Brightweb\Ecommerce\Http\Livewire\Navbar;

use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On; 



class Navbar extends Component
{
    public $countcart;
    public $getcart;
    public $totalamount;
    public $countwhistlist;
    public $quantities;
   
    // protected $listeners=['countcart'=>'mount'];
    #[On('countcart')] 
     #[On('countwishlist')] 
     public function mount()
     {
         if (Auth::check()) {
             $userId = Auth::id();
     
             // Retrieve all necessary cart data with fewer queries
             $this->getcart = Cart::where("user_id", $userId)
                 ->with("products")
                 ->get();
     
             $this->countcart = $this->getcart->count();
             $this->totalamount = $this->getcart->sum("total_price");
     
             foreach ($this->getcart as $item) {
                $this->quantities[$item->id] = $item->quantity; // or whatever field represents qty
            }
             // Count wishlist items
             $this->countwhistlist = Wishlist::where("user_id", $userId)->count();
         } else {
             // Set default values for guests
             $this->countcart = 0;
             $this->totalamount = 0;
             $this->countwhistlist = 0;
         }
     }
     
    public function render()
    {
        // 
        return view('brightweb::livewire.navbar.navbar',['countcart'=>$this->countcart,"getcart"=>$this->getcart,"totalamount"=>$this->totalamount,"countwhistlist"=>$this->countwhistlist]);
    }

    // remove from car
    public function removecart($id){
        if(!Auth::user()){
            return redirect()->route("login");
        }
        Cart::where("user_id",Auth::user()->id)->where("id",$id)->delete();
        $this->mount();
    }
    // update cart
    public function updatecart($id)
    {
        if(!Auth::user()){
            return redirect()->route("login");
        }
        // Loop through all quantities in the Livewire component
        foreach ($this->quantities as $cartId => $quantity) {
            // Find the cart item for the current user and cart ID
            if (!is_numeric($quantity) || $quantity <= 0) {
                session()->flash('error', "Invalid number");
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
