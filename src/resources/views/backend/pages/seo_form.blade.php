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
      
         <div class="container_forms">
          <div class="admin_container_main">
            <form action="" class="product_form" enctype="multipart/form-data" method="POST">
                @csrf
                
                    <h3>SEO Details</h3>
                    <div class="input_div">
                    <label for="">Site Title</label>
                  
                    <input type="text" name="site_title" value="{{ old('site_title', $site_setting->site_title ?? '') }}" placeholder="Site Title">
                    </div>
                    <div class="input_div">
                    <label for="">Site Logo</label>
                    <input type="file" name="site_logo" >
                    </div>
                    <div class="input_div">
                    <label for="">Mate Description</label>
            <textarea cols="30" rows="10" name="meta_description">{{ old('meta_description', $site_setting->meta_description ?? '') }}</textarea>
                    </div>
                    <div class="input_div">
            <label for="">Mate Keywords</label>
            <textarea cols="30" rows="10" name="meta_keywords">{{ old('meta_keywords', $site_setting->meta_keywords ?? '') }}</textarea>
                    </div>
                    <div class="input_div">
            <label for="">Mate Twitter Title</label>
            <input type="text" name="twitter_title" value="{{ old('twitter_title', $site_setting->twitter_title ?? '') }}" placeholder="Twitter Title">
                    </div>
                    <div class="input_div">
            <label for="">Mate Twitter Decription</label>
            <textarea cols="30" rows="10" name="twitter_description">{{ old('twitter_description', $site_setting->twitter_description ?? '') }}</textarea>
                    </div>
                    <div class="input_div">
            <label for="">Mate Twitter Image</label>
            <input type="file" name="twitter_image"  placeholder="Twitter Image URL">
                    </div>
            {{-- <div class="update_admin_img">
                <img src="{{ asset("product/$site_setting->twitter_image") }}" alt="" width="50px" height="50px">
            </div> --}}
            <div class="input_div">
            <label for="">Mate Graph Title</label>
            <input type="text" name="og_title" value="{{ old('og_title', $site_setting->og_title ?? '') }}" placeholder="Open Graph Title">
            </div>
            <div class="input_div">
            <label for="">Mate Graph Description</label>
            <textarea name="og_description">{{ old('og_description', $site_setting->og_description ?? '') }}</textarea>
            </div>
            <div class="input_div">
            <label for="">Mate Graph Image</label>
            <input type="file" name="og_image" placeholder="Open Graph Image URL">
            </div>
            {{-- <div class="input_div">
                <label for="">Site logo</label>
                <input type="file" name="site_logo"  placeholder="Twitter Image URL"> --}}
                        </div>
            {{-- <img src="{{ asset("product/$site_setting->og_image") }}" alt="" width="50px" height="50px"> --}}
           
           
            <div class="submit_div">
                <button type="submit" class="submit_btn">Save</button>
            </div>
           
            
            
            </form>
       
            {{-- end of form --}}
          </div>
        </div>
         
        </div>
      </div>
    </div>
  </section>

@endsection

    

