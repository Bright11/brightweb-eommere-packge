@extends('brightweb::userprofile.userincludes.header')

@section('content')
           <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Pymt Id</th>
                <th>Paid</th>
                <th class="hide_on_bobile">Pymt Type</th>
                <th class="hide_on_bobile">Currency</th>
                <th class="hide_on_bobile">Discount</th>
                <th class="hide_on_bobile">Total Price</th>
                <th>Status</th>
                <th>View Products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $item)
            <tr>
                <td>{{ $item->payment_id }}</td>
                <td>{{ $item->paid_amount }}</td>
                <td class="hide_on_bobile">{{ $item->payment_type }}</td>
                <td class="hide_on_bobile">{{ $item->currency }}</td>
                <td class="hide_on_bobile">{{ $item->discount_percentage??0 }}</td>
                <td class="hide_on_bobile">{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $item->original_price }}</td>
                <td>{{ $item->order_status }}</td>
                <td><a href="{{route("myproduct",$item->id)}}">View Product</a></td>
               @if ($item->is_received=="false")
               <td><a href="{{ route("receivedorders",$item->id) }}"><i class="fa fa-check" style="font-size:24px;color:aquamarine;"></i>Confirme</a></td>
               <td><a href="">Report</a></td>
                   @else
                   <td><a href="#"><i class="fa fa-check" style="font-size:24px;color:aquamarine;"></i></a></td>
                   <td><a href="#">Confiremed</a></td>
               @endif
               
                
            </tr>
            @empty
                
            @endforelse
           
          
           
        </tbody>
        
    </table>
           
@endsection

 