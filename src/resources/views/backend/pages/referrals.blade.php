
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
            
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Coupon Code</th>
                  <th scope="col">Num users</th>
                  <th scope="col">Percentage</th>
                  <th scope="col">Use onces</th>
                  <th scope="col">Expiring</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
              @forelse($referrals as $r)
                <tr>
                  {{-- <th scope="row">{{$r->referrer->id}}</th> --}}
                  
                </tr>
                @empty
                @endforelse
              
               
                
              </tbody>
            </table>
          </div>
      </div>
    </div>
    
  </section>

@endsection


