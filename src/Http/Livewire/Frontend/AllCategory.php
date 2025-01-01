<?php

namespace Brightweb\Ecommerce\Http\Livewire\Frontend;

use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\Category;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Allcategory extends Component
{
    public $category_slug;
    public $category;
    public $getproductbycategory;

    public function mount($slug){
        $this->category_slug=$slug;
        $this->category=Category::where("slug",$slug)->first();
        $this->getproductbycategory=Product::where("category_id",$this->category->id)->get();
    }

    // add to cart
    public function addToCart($id)
    {
        if(!Auth::user()){
            return redirect()->route("login");
        }
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
    public function render()
    {
        // $this->category=$slug;
        // return $this->category;

        return view('brightweb::livewire.frontend.allcategory');
    }
}
