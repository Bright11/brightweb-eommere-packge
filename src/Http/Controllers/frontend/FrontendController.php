<?php

namespace Brightweb\Ecommerce\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Brightweb\Ecommerce\Models\Aboutus;
use Brightweb\Ecommerce\Models\Category;
use Brightweb\Ecommerce\Models\Payment;
use Brightweb\Ecommerce\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $dateThreshold7days = now()->subDays(1); // Carbon::now() shorthand
        $dateThreshold9days = now()->subDays(9); // 7 + 2 = 9 days
        
        Payment::where('updated_at', '<', $dateThreshold7days)
               ->where('is_received', 'yes')
               ->delete();
        
        Payment::where('updated_at', '<', $dateThreshold9days)
               ->where('order_status', 'completed')
               ->delete();
        return view("brightweb::frontend.index");
    }

    public function checkoutoptions()
    {
        return view("brightweb::frontend.checkoutoptions");
    }

    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();
        // $relatedpro = Product::where('category_id', $pro_details->category_id)->inRandomOrder()->take(4)->get();
        // $referral = auth()->check() ? auth()->user()->referral_code : null; // Get the logged-in user's ID if available

        return view("brightweb::frontend.details",compact("product"));
    }

    public function allcategory($slug)
    {
         $category=Category::where("slug",$slug)->first();
      
       // return $category;
        return view("brightweb::frontend.allcategory",compact("category"));
    }

    public function aboutus()
    {
        $aboutus=Aboutus::all();
        return view("brightweb::frontend.aboutus",compact("aboutus"));
    }

    public function searchproduct()
    {
        // $products = Product::where('title', 'like', '%' . $data . '%')->get();
        return view("brightweb::frontend.searchproduct");
    }
}
