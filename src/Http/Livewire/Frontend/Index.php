<?php

namespace Brightweb\Ecommerce\Http\Livewire\Frontend;

use Brightweb\Ecommerce\Models\Cart;
use Brightweb\Ecommerce\Models\Category;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public $cartItems = []; 
    public $currentPage = 1; // Default value for initialization


    public $productid;




    public function loadCategories($page = 1)
    {
        // Set the current page dynamically
        $this->currentPage = $page;

        // Paginate categories
        $categories = Category::paginate(6, ['*'], 'page', $this->currentPage);

        // Convert categories to array
        $this->cartItems = $categories->toArray();

        // Loop through each category to get random products
        foreach ($this->cartItems['data'] as &$category) {
            $category['limited_product'] = Category::find($category['id'])
                ->products()
                ->inRandomOrder()
                ->take(4)
                ->get()
                ->toArray(); // Store products as an array
        }
    }

    public function mount()
    {
        // Fetch paginated categories
        // $categories = Category::paginate(4);
       
      
       // $this->cartItems = Category::with('products')->paginate(4);
       $this->loadCategories($this->currentPage);

    }
   

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
        return view('brightweb::livewire.frontend.index', [
            'cartItems' => $this->cartItems,
        ]);
    }
}
