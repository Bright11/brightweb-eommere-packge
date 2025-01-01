<?php

use Brightweb\Ecommerce\Http\Controllers\admin\AdminpagesController;
use Brightweb\Ecommerce\Http\Controllers\login\LoginController;
use Brightweb\Ecommerce\Livewire\Backend\Product;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;



Route::middleware(["web",'admin'])->group(function () {
Route::get('/viewproduct',[AdminpagesController::class,'viewproduct'])->name("viewproduct");

Route::get('/dashboard',[AdminpagesController::class,'dashboard'])->name("dashboard");
Route::get('/addcategory',[AdminpagesController::class,'addcategory'])->name("addcategory");

Route::match(['post', 'get'], '/addproduct/{id?}', [AdminpagesController::class, 'addproduct'])->name('addproduct');
// Route::get('/addproduct',Product::class );
Route::match(['post', 'get'], '/add_seo', [AdminpagesController::class, 'add_seo'])->name('add_seo');

Route::get('/viewsiteseo',[AdminpagesController::class,'viewsiteseo'])->name("viewsiteseo");

Route::get('/addcoupon',[AdminpagesController::class,'addcoupon'])->name("addcoupon");

Route::get('/usersorders/{id}',[AdminpagesController::class,'usersorders'])->name("usersorders");

Route::get('/checkorders',[AdminpagesController::class,'checkorders'])->name("checkorders");

Route::match(['get','post'],'/proccessing_order/{paymentis}',[AdminpagesController::class,'proccessing_order'])->name('proccessing_order');
// 

 Route::get('/deleteproduct/{id}', [AdminpagesController::class,'deleteproduct'])->name("deleteproduct");

 Route::get('/viewusers', [AdminpagesController::class,'viewusers'])->name("viewusers");

  Route::get('/suspenduser/{id}', [AdminpagesController::class,'suspenduser'])->name("suspenduser");

  Route::get('/checkreferral', [AdminpagesController::class,'checkreferral'])->name("checkreferral");

  Route::match(['post', 'get'], '/addsocial_links', [AdminpagesController::class, 'addsocial_links'])->name('addsocial_links');
  
  Route::match(['post', 'get'], '/addaboutus', [AdminpagesController::class, 'addaboutus'])->name('addaboutus');
 
  Route::get("/deleteaboutus/{id}",[AdminpagesController::class,'deleteaboutus'])->name("deleteaboutus");

  Route::get("/viewusershipping/{id}",[AdminpagesController::class,'viewusershipping'])->name("viewusershipping");
  
});

Route::middleware(['web'])->group(function () {
// login routes
Route::get('/login',[LoginController::class,'login'])->name("login");
Route::get("/logout",[LoginController::class,'logout'])->name("logout");

});