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
        @include('brightweb::backend.pages.contents.product_table')
        
        </div>
      </div>
    </div>
  </section>

@endsection

    