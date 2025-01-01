<?php

use Brightweb\Ecommerce\Http\Controllers\mail\MaileController;
use Brightweb\Ecommerce\Http\Controllers\payondelivery\PayondeliveryController;
use Brightweb\Ecommerce\Http\Controllers\paypal\PayPalController;
use Brightweb\Ecommerce\Http\Controllers\paystack\PaystackController;
use Illuminate\Support\Facades\Route;


Route::middleware(['web',"user"])->group(function () {

    // Ensure these middlewares are applied in your routes or controller
 
    
 // routes/web.php
 Route::post('/createPaypalOrder', [PayPalController::class,'createPaypalOrder'])->name('paypal.createPaypalOrder');
 
 Route::get('/paypal-success', [PayPalController::class,'successPaypal'])->name('paypal.successPaypal');
 Route::get('/paypal-cancel', [PayPalController::class,'cancel'])->name('paypal.cancel');
//  Route::get('/paypal/payalpayment', [PayPalController::class,'payalpayment'])->name('paypal.payalpayment');

Route::get("Paystack-success",[PaystackController::class,"paystacksuccess"])->name('paystck.paystacksuccess');

Route::post("/paywithpaystack",[PaystackController::class,'paywithpaystack'])->name("paywithpaystack");

Route::get("Paystack-cancelorder",[PaystackController::class,"cancelorder"])->name('paystck.cancelorder');

Route::get("testmail",[MaileController::class,"testmail"])->name('testmail');

Route::get("payondelivery",[PayondeliveryController::class,"payondelivery"])->name('payondelivery');

});