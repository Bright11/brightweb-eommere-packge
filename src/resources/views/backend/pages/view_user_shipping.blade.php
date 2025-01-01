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
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Street Address</th>
                        <th>Land Mark</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Country</th>
                        <th>Pincode</th>
                        <th>Phone</th>
                    </tr>
                    
                    
                </thead>
                <tbody>
                  
                    <tr>
                        <td>{{ $shipping->name }}</td>
                        <td>{{ $shipping->email }}</td>
                        <td>{{ $shipping->street_address }}</td>
                        <td>{{ $shipping->land_mark }}</td>
                        <td>{{ $shipping->city }}</td>
                        <td>{{ $shipping->state }}</td>
                        <td>{{ $shipping->country }}</td>
                        <td>{{ $shipping->pincode }}</td>
                        <td>{{ $shipping->phone }}</td>
                    </tr>
                  
                    
                  
                   
                </tbody>
                
            </table>
        
        </div>
      </div>
    </div>
  </section>

@endsection

    