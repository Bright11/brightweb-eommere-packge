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
                    <h3><A:link>About us</A:link></h3>
                    <div class="input_div">
                    <label for="">Title</label>
                    <input type="text" name="title"  placeholder="Title">
                    </div>
                    <div class="input_div">
            <label for="">Description</label>
            <textarea name="description" cols="30" rows="10"></textarea>
                    </div>
            <div class="submit_div">
                <button type="submit" class="submit_btn">Save</button>
            </div>
            </form>
            {{-- end of form --}}
           <div class="aboutusadmincontent">
            @forelse ($aboutus as $item)
            <div class="aboutusheader">
                <h1>{{ $item->title }}</h1>
                <a href="{{ route("deleteaboutus",$item->id) }}">Delete</a>
               </div>
                <p>{{ $item->description }}</p>
            @empty
                
            @endforelse
           
           </div>
          </div>
        </div>
         
        </div>
      </div>
    </div>
  </section>

@endsection

    
