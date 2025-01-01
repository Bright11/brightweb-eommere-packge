@extends('brightweb::userprofile.userincludes.header')

@section('content')
           <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Price</th>
                <th>InvoiceId</th>
                <th>Qty</th>
                <th>Total price</th>
                <th>Status</th>
              
            </tr>
        </thead>
        <tbody>
            @forelse ($product as $item)
            <tr>
                <td>{{ Str::limit($item->product->name,18,'..') }}</td>
               {{-- src="{{ asset("product/{$product['image_pc']}") }}"  --}}
                <td>
                    @if($item->product->image_pc)
                    <img src="{{ asset('product/'.$item->product->image_pc) }}"alt="{{$item->product->name}}" width="80px" height="80px"/>
                   
                    @elseif($item->product->image_url)
                    <img width="80px" height="80px" src="{{$item->product->image_url}}" alt="{{$item->product->name}}"/>
                    @else
                    @endif
                </td>
                <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $item->product->selling_price }}</td>
                <td>{{ $item->payment->payment_id }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $item->total_price }}</td>
                <td>{{ $item->status }}</td>
                
                
            </tr>
            @empty
                
            @endforelse
           
          
           
        </tbody>
        
    </table>
           
@endsection

 