<?php
// #eceff1
return[
    'slider_display_option'=>[
        // Be aware you must chose one or turn both off by setting them to false
        // when you chose show_background_image, please add the image you want to use from your admin dashboard
        // design the image to suit your need
        "show_slider"=>true,# To disabled, set it to false
        "show_background_image"=>false,# To enabled, set it to true
    ],
    'currency' => [
        "site_Currency"=>'$',
],

"frontend_category_settings"=>[
    "show_top_categories"=>true,# sto show the top category, set it to true
    "show_sidebar_category"=>true, # to show the sidebar category, set it to true
],
// Frontend navigation settings
    'frontend_navigation_settings'=>[
       "navigation_bg_color"=>"black",
         "navigation_text_color"=>"white",
    ],

    // frontend site setting
    "frontend_site_settings"=>[
       "site_bg_color"=>"#ffffff",
       "site_primary_color"=>"blue",
       "site_button_color"=>"white",
         "site_text_color"=>"gray",

    ],

    // admin site setting
    "admin_site_settings"=>[
        "site_bg_color"=>"#ffffff",
        "site_primary_color"=>"blue",
        "site_button_color"=>"white",
        "gradient1"=>"rgb(131,58,180)",
        "gradient2"=>"linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%)",
        "counter_color"=>"white",

    ],

    // payment settings
    'mypayment_options' => [
        'enable_stripe'=>false,# strip not yet implemented
        'enable_razorpay'=>false,# razorpay not yet implemented'
        'enable_paypal'=>true, #To disable paypal, set it to false
        'enable_paystack'=>true, #to disable paystack, set it to false
        "enable_pay_on_delivery"=>true, #To disable pay on delivery, set it to false
        // "enable_banktransfer"=>true, #To disable bank transfer, set it to false
        
    ],
    

// payment settings
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'api_url' => env('PAYPAL_API_URL', 'https://api.sandbox.paypal.com'),
    ],

    


];