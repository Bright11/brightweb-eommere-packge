@extends('brightweb::frontend.include.header')
   
   @section('content')
        <!-- top slider and category -->
    @livewire('brightweb::frontend.productdetails', ['slug' => $product->slug])
   @endsection
 
   
   