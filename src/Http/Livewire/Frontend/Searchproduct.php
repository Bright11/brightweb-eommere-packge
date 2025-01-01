<?php

namespace Brightweb\Ecommerce\Http\Livewire\Frontend;

use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\Category;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Wishlist;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Searchproduct extends Component
{
    public $searchproduct;
    public $productResults;
    public $productid;

    public function mount(Request $request)
    {
        $this->searchproduct = $request->input('data');

        $this->productResults = Product::query()
    ->where('name', 'like', '%' . $this->searchproduct . '%') // Partial match on product name
    ->orWhere('keywords', 'like', '%' . $this->searchproduct . '%') // Match keywords
    ->orWhereHas('category', function ($query) {
        $query->where('name', 'like', '%' . $this->searchproduct . '%'); // Match category name
    })
    ->with('category') // Include related category data
    ->take(12) // Limit the results to 12
    ->get();

    }

    public function addtocartfromsearch($id)
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

    public function render()
    {
        return view('brightweb::livewire.frontend.searchproduct');
    }
}
