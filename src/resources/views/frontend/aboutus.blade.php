@extends('brightweb::frontend.include.header')
@section("title")
<title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
@endsection

@section("meta_tags")
<meta name="description" content="{{ $metaseo->meta_description ?? 'Default description' }}">
<meta name="keywords" content="{{ $metaseo->meta_keywords ?? 'default, keywords' }}">
<meta name="robots" content="index, follow">
<!-- Twitter Cards -->
<meta name="twitter:title" content="{{ $metaseo->twitter_title ?? 'Default Twitter Title' }}">
<meta name="twitter:description" content="{{ $metaseo->twitter_description ?? 'Default Twitter Description' }}">
@if(!empty($metaseo->twitter_image))
    <meta name="twitter:image" content="{{ asset('seo/' . $metaseo->twitter_image) }}">
@endif

<!-- Open Graph -->
<meta property="og:title" content="{{ $metaseo->og_title ?? 'Default Open Graph Title' }}">
<meta property="og:description" content="{{ $metaseo->og_description ?? 'Default Open Graph Description' }}">
@if(!empty($metaseo->og_image))
    <meta property="og:image" content="{{ asset('seo/' . $metaseo->og_image) }}">
@endif
    
@endsection
 @section('content')
      
 <div class="adboutuspage">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <h2>About Us</h2>
         </div>
       </div>
      
             <div class="aboutus-left-content">
              @forelse ($aboutus as $item)
              <h3>{{ $item->title }}</h3>
              <p>{{ $item->description }}</p>
              @empty
                  
              @endforelse
              
             </div>
           </div>
         </div>
       
   
 @endsection

 