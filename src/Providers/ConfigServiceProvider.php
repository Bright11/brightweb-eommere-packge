<?php

namespace Brightweb\Ecommerce\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Brightweb\Ecommerce\Models\Shipping;
use Brightweb\Ecommerce\Models\Order;
use Brightweb\Ecommerce\Models\Shipping_information;
use Illuminate\Support\Facades\View;

use Brightweb\Ecommerce\Models\Referral_usage;
use Brightweb\Ecommerce\Models\Payment;
class ConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->loadHelpers();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       View::composer("*", function($view){
        if(Auth::user())
        {
            $checkshipping=Shipping::where("user_id",Auth::user()->id)->first();
            $view->with('checkshipping',$checkshipping);
        }
       });
        //
        View::composer("*", function($view){
            if(Auth::user())
            {
                $userorder=Payment::where("user_id",Auth::user()->id)->count();
                $view->with('userorder',$userorder);
            }
           });
            //
            View::composer("*", function($view){
                if(Auth::user())
                {
                    $paid_amount=Payment::where("user_id",Auth::user()->id)->sum("paid_amount");
                    $view->with('paid_amount',$paid_amount);
                }
               });

               View::composer("*", function($view){
                if(Auth::user())
                {
                    $message=Shipping_information::where("user_id",Auth::user()->id)->where("is_read", false)->count();
                    $view->with('message',$message);
                }
               });
                //
                View::composer("*", function($view){
                    if(Auth::user())
                    {
                        $referralnumber=Referral_usage::where("referrer_id",Auth::user()->id)->count();
                        $view->with('referralnumber',$referralnumber);
                    }
                   });
       
        $this->publishes([
            __DIR__.'/../config/applicationsettings.php' => config_path("brightwebconfig.php"),
            __DIR__.'/../public/logo' => public_path("brightweblogo"),
        ], 'brightwebconfig');

       // $this->loadHelpers();
        
    }

    protected function loadHelpers()
    {
        // if (file_exists($file = __DIR__ . '/../Helpers/helper.php')) {
        //     require $file;
        // }
        $helperFile = __DIR__ . '/../Helpers/MyHelper.php';
        Log::info('Loading helper file from: ' . $helperFile);

        if (file_exists($helperFile)) {
            require_once $helperFile;
            Log::info('Helper file loaded successfully.');
        } else {
            Log::error('Helper file not found: ' . $helperFile);
        }
    }
}
