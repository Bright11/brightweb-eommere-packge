<?php

use Brightweb\Ecommerce\Http\Controllers\frontend\FrontendController;
use Brightweb\Ecommerce\Http\Controllers\user\UsersPageController;
use Illuminate\Support\Facades\Route;



Route::middleware(['web',"user"])->group(function () {

    Route::get('/checkoutoptions',[FrontendController::class,'checkoutoptions'])->name('checkout.checkoutoptions');
    Route::get("/userdashboard",[UsersPageController::class,"userdashboard"])->name("userdashboard");

    Route::match(['post','get'],'/addshipping/{id?}',[UsersPageController::class,"addshipping"])->name("addshipping");

    Route::get("/userviewshipping",[UsersPageController::class,"userviewshipping"])->name("userviewshipping");

    Route::get("/myorders",[UsersPageController::class,"myorders"])->name("myorders");

    Route::get("/myproduct/{paymentid}",[UsersPageController::class,"myproduct"])->name("myproduct");
    Route::get("/usercompletedorders",[UsersPageController::class,"usercompletedorders"])->name("usercompletedorders");

    Route::get("/receivedorders/{paymentid}", [UsersPageController::class, "receivedorders"])->name("receivedorders");
    
    Route::get("/mywishlist",[UsersPageController::class,"mywishlist"])->name("mywishlist");
    Route::get("/deletewishlist/{id}", [UsersPageController::class, "deletewishlist"])->name("deletewishlist");

});
Route::middleware(['web'])->group(function (){
    Route::get('/',[FrontendController::class,'index'])->name('index');

    Route::get('/productDetails/{slug}',[FrontendController::class,'productDetails'])->name('productDetails');


   Route::get('/allcategory/{slug}',[FrontendController::class,'allcategory'])->name('allcategory');

   Route::post('/searchproduct',[FrontendController::class,'searchproduct'])->name('searchproduct');

   Route::get('/aboutus',[FrontendController::class,'aboutus'])->name('aboutus');
   
});

