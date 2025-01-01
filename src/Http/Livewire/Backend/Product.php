<?php

namespace Brightweb\Ecommerce\Http\Livewire\Backend;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Brightweb\Ecommerce\Models\Product as DataItem;
use Brightweb\Ecommerce\Models\Category;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
class Product extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $keywords;
    public $buying_price;
    public $selling_price;
    public $discount;
    public $image_url;
    public $image_pc;
    public $qty;
    public $category_id;

    public $itemId;

    public $getproducts;
    public $getcategory;

    public $variations = [];
  
  //  public $variations;
    
    public function render()
    {
        return view('brightweb::livewire.backend.product');
    }

    // public function saveproduct(Request $req)
    // {
    //      // Debugging output

    

    //     // $this->validate([
    //     //     'name' => 'required|string|max:255|unique:products,name',
    //     //     'description' => 'required|string',
    //     //     'keywords' => 'required|string',
    //     //     'buying_price' => 'required|numeric|min:0',
    //     //     'selling_price' => 'required|numeric|min:0',
    //     //     'discount' => 'nullable|numeric|min:0|max:100',
    //     //     'qty' => 'required|integer|min:0',
    //     //     'category_id' => 'required|exists:categories,id',
    //     //     'image_pc' => 'nullable|image|max:1024', // Adjust max size as needed
    //     // ]);

    //     $attributes = [
    //         'name' => $this->name,
    //         'description' => $this->description,
    //         'keywords' => $this->keywords,
    //         'buying_price' => $this->buying_price,
    //         'selling_price' => $this->selling_price,
    //         'discount' => $this->discount,
    //         'qty' => $this->qty,
    //         'category_id' => $this->category_id,
    //     ];

        
    // if ($this->image_url) {
    //     $attributes['image_url'] = $this->image_url;
    // } elseif ($this->image_pc) {
    //     // Store the image in the 'public/product' directory
    //     $imagename = $this->image_pc->store("product", "public");
    //     $attributes['image_pc'] = $imagename;
    // } else {
    //     // Flash a session message if no image is provided
    //     Session::flash('message', 'An image is required.');
    //     return;
    // }

    // if ($req->variations) {
    //     foreach($req->variations as $variation){
            
    //     }
    // } else {
    //     dd("no");
    //     Session::flash('message', 'No.');
    // }
    //     DataItem::updateOrCreate(['id' => $this->itemId], $attributes);
    //     $this->clearinput();
 
    // }

    public function clearinput()
    {
        $this->reset([
            'name',
            'description',
            'keywords',
            'buying_price',
            'selling_price',
            'discount',
            'qty',
            'image_url',
            'image_pc',
            'category_id',
        ]);
    }

    public function mount()
    {
        $this->getproducts = DataItem::all();
        $this->getcategory = Category::all();
    }
}
