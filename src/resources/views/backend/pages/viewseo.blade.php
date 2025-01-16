
@extends('brightweb::backend.layouts.header')
   

@section('content')
<section class="admin_section">
    <div class="admin_container">
    
      <!-- top ba -->
     @include("brightweb::backend.layouts.topbar")
      <div class="page_admin_container">
        <div class="admin_sidebar">
          @include("brightweb::backend.layouts.sidebar")
        </div>
        <div class="admin_content">
            @if($seo)
            <h1>{{ $seo->site_title }}</h1>
            <p>{{ $seo->meta_description }}</p>
            <p>{{ $seo->meta_keywords }}</p>
            <h1>{{ $seo->twitter_title }}</h1>
            <p>{{ $seo->twitter_description }}</p>
            <img width="80px" height="80px" src="{{ asset("seo/$seo->twitter_image") }}" alt="">
            <h1>{{ $seo->og_title }}</h1>
            <p>{{ $seo->og_description }}</p>
            <img width="80px" height="80px" src="{{ asset("seo/$seo->og_image") }}" alt="">
            <img width="80px" height="80px" src="{{ asset("seo/$seo->site_logo") }}" alt="">
            @endif
      </div>
    </div>
  </section>

@endsection


