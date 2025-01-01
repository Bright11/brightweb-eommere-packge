@extends('brightweb::frontend.include.header')

 @section('content')
        <!-- top slider and category -->
   
    {{-- @livewire('brightweb::frontend.slider') --}}

    <!-- product section -->
<!--  -->
@livewire('brightweb::frontend.allcategory',["slug"=>$category->slug])
   
 @endsection

 