<?php

namespace Brightweb\Ecommerce\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Brightweb\Ecommerce\Models\Aboutus;
use Illuminate\Http\Request;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\Category;
use Brightweb\Ecommerce\Models\Product_variation;
use Brightweb\Ecommerce\Models\Product_gallery;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Payment;
use Brightweb\Ecommerce\Models\Shipping_information;
use Brightweb\Ecommerce\Models\SiteSEO;
use Brightweb\Ecommerce\Models\User;
use Brightweb\Ecommerce\Models\Referral_usage;
use Brightweb\Ecommerce\Models\Shipping;
use Brightweb\Ecommerce\Models\Social_link;
use Illuminate\Support\Facades\Auth;

class AdminpagesController extends Controller
{
    //

    public function dashboard()
    {
        return view("brightweb::backend.pages.dashboard");
    }

    public function addproduct(Request $req, $id=null)
    {
      
        if($req->isMethod("post")){
            
         
            // $req->validate([
            //     'name' => 'required|string|max:255|unique:products,name,' . $req->itemId,
            //     'description' => 'required|string',
            //     'keywords' => 'required|string',
            //     'buying_price' => 'required|numeric|min:0',
            //     'selling_price' => 'required|numeric|min:0',
            //     'discount' => 'nullable|numeric|min:0|max:100',
            //     'qty' => 'required|integer|min:0',
            //     'category_id' => 'required|exists:categories,id',
            //     'image_pc' => 'nullable|image|jpg,jpeg,png|max:1024', // Adjust max size as needed
            // ]);
            $attributes = [
                'name' => $req->name,
                'description'=>$req->description,
                'keywords'=>$req->keywords,
                'buying_price'=>$req->buying_price,
                'selling_price'=>$req->selling_price,
               'discount' => $req->discount ?? 0,
                'qty'=>$req->qty,
                'category_id'=>$req->category_id,
            ]; 
            if ($req->hasFile('image_pc')) {
                $image = $req->file('image_pc');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('product'),$imageName);
                $attributes['image_pc']=$imageName;
                $attributes['source']='pc';
                
            }else if($req->image_url){
                $attributes['image_url']=$req->image_url;
                $attributes['source']='url';
            }else{
               if($id){

               }else{
                return redirect()->back()->with("message","An image is required");
               }
            }
            $newOrEdit = Product::updateOrCreate(['id' => $id], $attributes);
            if ($req->has('variations')) {
            foreach ($req->variations as $variation) {
               // $newOrEdit->variations()->create($variation);
               Product_variation::updateOrCreate(
                ['id' => $variation['id']],  // Use the ID to find the variation
                [
                    'product_id' => $newOrEdit->id,
                    'variation_type' => $variation['variation_type'],
                    'variation_value' => $variation['variation_value']
                ]
            );
            }
        }
        // image gallery

        if ($req->has('product_gallery')) {
            $productGallery = $req->input('product_gallery');
            
            foreach ($productGallery as $key => $item) {
                if ($req->hasFile("product_gallery.{$key}.image_from_pc")) {
                    // Handle the image uploaded from the PC
                    $file = $req->file("product_gallery.{$key}.image_from_pc");
                    $imageName = time().'.'.$file->extension();
                    $file->move(public_path('product_gallery'),$imageName);
                  //  $image->storeAs('images', $imageName, 'public');
                    // $attributes['image_from_pc']=$imageName;

                    // $filePath = $file->store('uploads/product_gallery', 'public');
    
                    // Save file information into the database
                    Product_gallery::updateOrCreate(
                        ['id' => $item['id'] ?? null], // Use the ID if it exists
                        [
                            'product_id' => $newOrEdit->id,
                            'image_from_pc' => $imageName,
                            'source' => 'pc'
                        ]
                    );
                    
    
                    // Move to the next item in the product_gallery array
                    continue;
                } elseif (isset($item['image_from_url']) && !empty($item['image_from_url'])) {
                    // Handle the image from the URL
                    $imageUrl = $item['image_from_url'];
    
                    // Save URL information into the database
                    Product_gallery::updateOrCreate(
                        ['id' => $item['id'] ?? null], // Use the ID if it exists
                    [
                        'product_id' => $newOrEdit->id,
                        'image_from_url' => $imageUrl,
                        'source' => 'url'
                    ]
                    );
    
                    // Move to the next item in the product_gallery array
                   
                }
            }
        // the end
            
           
        }
        return redirect()->route("viewproduct")->with("message","Successful");
    }
        $getcategory = Category::all();
        $product=Product::find($id);
        return view('brightweb::backend.pages.add_product',compact("getcategory","product"));
    }

    public function addcategory()
    {
        return view("brightweb::backend.pages.addcategory");
    }

    public function viewproduct(){
        $product=Product::paginate(6);
        return view('brightweb::backend.pages.viewproduct',compact("product"));
    }

    // seo
    public function add_seo(Request $req)
    {
        // Retrieve the first record or create a new instance
        $site_setting = SiteSEO::firstOrNew([]);
    
        if ($req->isMethod('post')) {
            $req->validate([
                'site_logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'meta_description' => 'required|string',
                'meta_keywords' => 'required|string',
                // 'meta_robots'=>'required|string',
                'twitter_title' => 'required|string',
                'twitter_description' => 'required|string',
                'twitter_image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'og_title' => 'required|string',
                'og_description' => 'required|string',
                'og_image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'site_title' => 'required|string',
            ]);
    
            // Saving twitter image
            if ($req->hasFile('twitter_image')) {
              //  $twitter_image = $req->file('twitter_image')->store('sitesettings', 'public');
              $image = $req->file('twitter_image');
              $imageName = time().'.'.$image->extension();
              $image->move(public_path('seo'),$imageName);
                $site_setting->twitter_image = $imageName;
            }
    
            // Saving og image
            if ($req->hasFile('og_image')) {
              //  $og_image = $req->file('og_image')->store('sitesettings', 'public');
                $image = $req->file('og_image');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('seo'),$imageName);
                 
                $site_setting->og_image = $imageName;
            }

            if ($req->hasFile('site_logo')) {
                //$site_logo = $req->file('site_logo')->store('sitesettings', 'public');
                $image = $req->file('site_logo');
                $imageName = time().'.'.$image->extension();
                $image->move(public_path('seo'),$imageName);
                 
                $site_setting->site_logo = $imageName;
              
            }
    
            // Update the site settings
           // $site_setting->site_logo = $req->site_logo;
            $site_setting->meta_description = $req->meta_description;
            $site_setting->meta_keywords = $req->meta_keywords;
            // $site_setting->meta_robots = $req->meta_robots;
            $site_setting->twitter_title = $req->twitter_title;
            $site_setting->twitter_description = $req->twitter_description;
            $site_setting->og_title = $req->og_title;
            $site_setting->og_description = $req->og_description;
            $site_setting->site_title = $req->site_title;
    
            // Save the site setting (either create a new one or update the existing one)
            $site_setting->save();
    
            return redirect()->back()->with("message", "SEO setting completed");
        }
    
        return view("brightweb::backend.pages.seo_form", compact("site_setting"));
    }
    public function viewsiteseo()
    {
        $seo=SiteSEO::first();

        return view("brightweb::backend.pages.viewseo",compact("seo"));
    }


    public function addcoupon()
    {
        return view("brightweb::backend.pages.addcoupon");
    }

    public function checkorders()
    {
        $orders=Payment::all();
        return view("brightweb::backend.pages.viewProccessingOrder",compact("orders"));
    }
    public function usersorders($paymentid)
    {
        $order=Order::with('product')->where('paymentid', $paymentid)
        ->get();
        return view("brightweb::backend.pages.viewuserorders",['order'=>$order]);
    }

    public function proccessing_order(Request $req,$paymentId){
        $paymentchecker=Payment::where("id",$paymentId)->first();

       if(!$paymentchecker){
        return redirect()->back()->with("message","Invalid payment ID");
       }
       if ($req->isMethod('post')) {
        $order=Order::where('paymentid', $paymentId)->get();
        foreach($order as $orderitem){
            $orderitem->status=$req->status;
            $orderitem->update();
        }
        $paymentchecker->order_status=$req->status;
        $paymentchecker->update();
        if($req->message){
            $checkmessage=Shipping_information::where("user_id",$paymentchecker->user_id)->first();
            if($checkmessage){
                $checkmessage->message=$req->message;
                $checkmessage->is_read=false;
                $checkmessage->update();
            }else{
            $message=new Shipping_information;
            $message->paymentid=$paymentchecker->id;
            $message->user_id=$paymentchecker->user_id;
            $message->message=$req->message;
            $message->is_read=false;
            $message->save();
            }
        }
        return redirect()->route('checkorders')->with("message","Order Proccessing");
    }
        return view("brightweb::backend.pages.shipping_proccessing",compact("paymentchecker"));
    }

    public function deleteproduct($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with("message",'product deleted');
    }

    public function viewusers()
    {
        $user=User::all();
        return view("brightweb::backend.pages.viewusers",compact("user"));
    }

    public function suspenduser($id)
    {
        $user=User::find($id);
        if($user->status=="active"){
            $user->status="suspended";
            $message="suspended";
        }else{
            $user->status="active";
            $message="activated";
        }
        $user->update();
        return redirect()->back()->with("message","User $message");
    }

    public function checkreferral(){
        $referrals=Referral_usage::all();
        return view("brightweb::backend.pages.referrals",compact("referrals"));
    }

    public function addsocial_links(Request $req){
    
        $social=Social_link::firstOrNew([]);
        if($req->isMethod("post")){
            // if(!$social){
            //     $social=new Social_links;
            // }

            $social->facebook=$req->facebook;
            $social->twitter=$req->twitter;
            $social->instagram=$req->instagram;
            $social->linkedin=$req->linkedin;
            $social->youtube=$req->youtube;
            $social->phone_number=$req->phone_number;
            $social->box_address=$req->box_address;
            
            $social->save();
            return redirect()->back()->with("message", "Social links updated");
        }
        return view("brightweb::backend.pages.add_social_links", compact("social"));
    }

    public function addaboutus(Request $req){
        if($req->isMethod("post")){
            $aboutus=new Aboutus;
            $aboutus->title=$req->title;
         
            $aboutus->description=$req->description;
            $aboutus->save();
            return redirect()->back()->with("message", "About us updated");
        }
        $aboutus=Aboutus::all();
        return view("brightweb::backend.pages.addaoutus", compact("aboutus"));
    }

    public function deleteaboutus($id){
        Aboutus::find($id)->delete();
        return redirect()->back()->with("message", "About us deleted");
    }

    public function viewusershipping($id){
        $shipping=Shipping::where("user_id",$id)->first();
        return view("brightweb::backend.pages.view_user_shipping",compact("shipping"));
    }
}
