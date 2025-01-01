@extends('brightweb::userprofile.userincludes.header')

@section('content')
{{-- @if ($wishlist) --}}
    
 
<table id="example" class="display" style="width:100%">
    <thead>
      <tr>
        <th scope="col">Item Name</th>
        <th scope="col">Image</th>
        <th scope="col">Price</th>
    
        <th scope="col">Ation</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      @forelse($mywishlist as $item)
      <tr>
       
        <th scope="row">{!! Str::limit($item->products->name, 15,'...') !!}</th>
        <td>
          @if($item->products->image_pc)
          <img width="80px" height="80px" src="product/{{$item->products->image_pc}}" alt="{{$item->products->name}}"/>
          @elseif(($item->products->image_url))
          <img width="80px" height="80px" src="{{$item->products->image_url}}" alt="{{$item->products->name}}"/>
          @endif
        </td>
        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{$item->products->selling_price}}</td>
        <td>
            <a  href="{{ route("productDetails",$item->products->slug) }}">Buy Now</a>
        </td> 

      
          
        <td> <a  href="{{ route("deletewishlist",$item->id) }}">Delete</a></td>
      </tr>
      @empty

      @endforelse
     
    
    </tbody>
  </table>
           
@endsection

 