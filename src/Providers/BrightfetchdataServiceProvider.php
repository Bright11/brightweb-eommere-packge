<?php

namespace Brightweb\Ecommerce\Providers;

use Brightweb\Ecommerce\Models\BackgroundImage;
use Brightweb\Ecommerce\Models\Category;
use Brightweb\Ecommerce\Models\Product;
use Brightweb\Ecommerce\Models\SiteSEO;
use Brightweb\Ecommerce\Models\Social_link;
use Brightweb\Ecommerce\Models\User;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BrightfetchdataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
       View::composer('*', function ($view) {
        //  $products = Product::orderBy('title', 'asc')->get();
            $view->with('datacategory', Category::orderBy('name', 'asc')->get());
        });

        // get number of products in the database
        View::composer('*', function ($view) {
            // $view->with('datacategory', Category::orderBy('name', 'asc')->get());
             $view->with('number_of_product', Product::count());
        });
        // calulate product bought
        // in the database
        View::composer('*', function ($view) {
           
             $view->with('total_amount_bought', Product::sum('buying_price'));
        }); 

        View::composer('*', function ($view) {
           
            $view->with('total_amount_seling', Product::sum('selling_price'));
       }); 

    //    profit
       View::composer('*', function ($view) {

        $view->with('total_profit', Product::sum('selling_price') - Product::sum('buying_price'));
   });
//    number of users
   View::composer('*', function ($view) {

    $view->with('number_of_users', User::count());
});

View::composer('*', function ($view) {

    $view->with('metaseo', SiteSEO::first() ?? (object) [
        'site_title' => 'Default Site Title',
        'meta_description' => 'Default Meta Description',
        'meta_keywords' => 'default, keywords',
        'twitter_title' => 'Default Twitter Title',
        'twitter_description' => 'Default Twitter Description',
        'og_title' => 'Default Open Graph Title',
        'og_description' => 'Default Open Graph Description',
        'site_logo' => null,
        'twitter_image' => null,
        'og_image' => null,
    ]);
    // social medis
    $view->with('social_links', Social_link::first() ?? (object) [
        'facebook' => null,
        'twitter' => null,
        'linkedin' => null,
        'instagram' => null,
        'youtube' => null,
        'phone_number' => null,
        'box_address' => null,
    ]);
});

View::composer('*', function ($view) {

    $view->with('default_currency', "₵");
});

View::composer('*', function ($view) {
    //  $products = Product::orderBy('title', 'asc')->get();
        $view->with('bgimage', BackgroundImage::first());
    });

    }
    
}
