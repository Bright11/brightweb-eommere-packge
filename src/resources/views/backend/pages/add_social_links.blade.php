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
                    <h3>Social Media</h3>
                    <div class="input_div">
                    <label for="">Facebook</label>
                    <input type="text" name="facebook" value="{{ old('facebook', $social->facebook ?? '') }}" placeholder="Facebook">
                    </div>
                    <div class="input_div">
            <label for="">Twitter Link</label>
            <input type="text" name="twitter" value="{{ old('twitter', $social->twitter ?? '') }}" placeholder="Twitter">
                    </div>
                  
            <div class="input_div">
            <label for="">Lnstagram link</label>
            <input type="text" name="instagram" value="{{ old('instagram', $social->instagram ?? '') }}" placeholder="Lnstagram link">
            </div>
            <div class="input_div">
                <label for="">Linkedin link</label>
                <input type="text" name="linkedin" value="{{ old('linkedin', $social->linkedin ?? '') }}" placeholder="Linkedin Link">
                </div>
                <div class="input_div">
                        <label for="">Youtube link</label>
                        <input type="text" name="youtube" value="{{ old('youtube', $social->youtube ?? '') }}" placeholder="Youtube">
                        </div>
                        <div class="input_div">
                                <label for="">Phone number</label>
                                <input type="text" name="phone_number" value="{{ old('phone_number', $social->phone_number ?? '') }}" placeholder="phone_number">
                                </div>
                                <div class="input_div">
                                        <label for="">Box address</label>
                                        <input type="text" name="box_address" value="{{ old('box_address', $social->box_address ?? '') }}" placeholder="P.O.Box address">
                                        </div>
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

    

