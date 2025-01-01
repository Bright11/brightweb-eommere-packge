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
            <table id="myTable" class="display" style="width: 100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Pymt Id</th>
                        <th>Paid</th>
                        <th class="hide_on_bobile">Type</th>
                        <th class="hide_on_bobile">Discount</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Products</th>
                        <th>Update status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $item)
                    <tr>
                        <td>{{ $item->payer_name }}</td>
                        <td>{{ $item->payment_id }}</td>
                        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $item->currency }} {{ $item->paid_amount }}</td>
                        <td class="hide_on_bobile">{{ $item->payment_type }}</td>
                        <td class="hide_on_bobile">{{ $item->discount_percentage??0 }}</td>
                        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $item->original_price }}</td>
                        <td>{{ $item->order_status }}</td>
                        <td><a href="{{route("usersorders",$item->id)}}">View</a></td>
                        @if ($item->order_status=="completed")
                       @if ($item->is_received=="yes")
                       <td><i class="fa fa-check" style="font-size:24px;color:aquamarine;"></i></td>
                         @else
                         <td><i class="fa fa-check" style="font-size:24px;color:red;"></i></td>
                       @endif
                          @else
                          <td><a href="{{ route("proccessing_order",$item->id) }}">Update</a></td>
                        @endif
                        <td><a href="{{ route("viewusershipping",$item->user_id) }}">Shipping</a></td>
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

    