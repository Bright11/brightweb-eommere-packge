
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
            <div class="admin_container_main">
              @if (session()->has('message'))
              <div style="color: red">{{ session('message') }}</div>
          @endif
          @if ($errors->has('name'))
          @error('name') <span class="error" style="color: red">{{ $message }}</span> @enderror
      @endif
              <form class="product_form" method="POST" enctype="multipart/form-data" >
                @csrf
                <div class="input_div">
                  <input type="file" name="bgimage"  />
                </div>
                <div class="submit_div">
                  <button type="submit" class="submit_btn">Save</button>
                </div>
              </form>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Delete</th>
                </tr>
              </thead>
              <tbody>
              @if ($bg)
              <th scope="row">
                <img width="80px" height="80px" src="{{asset("seo/$bg->bgimage") }}" alt="">
              </th>
              <td><a href="{{route("deletesitebgimage")}}" >Delete</a></td>
            </tr>
              @endif
              
              
               
                
              </tbody>
            </table>
          </div>
      </div>
    </div>
  </section>

@endsection


