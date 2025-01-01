<table id="myTable" class="display" style="width: 100%">
    <thead>
      <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Qty</th>
        <th>Price bught</th>
        <th>Selling price</th>
        <th>Update</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @forelse($product as $item)
      <tr>
        <td>{!! Str::limit($item->name, 20, ' ...') !!}</td>
        @if($item->image_pc)
        <td><img width="80" height="80" src="{{ asset("product/$item->image_pc") }}" alt="{{ $item->name }}"></td>
        @else
        <td><img width="80" height="80" src="{{$item->image_url}}" alt="{{ $item->name }}"></td>
        @endif
       @if($item->qty == 0)
        <td style="color: red">Out of stock</td>
       @else
       <td>{{ $item->qty }}</td>
       @endif
        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }} {{ $item->buying_price }}</td>
        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }} {{$item->selling_price}}</td>
        <td><a href="{{ route("addproduct",$item->id) }}">Update</a></td>
        <td><a href="{{ route("deleteproduct",$item->id) }}">Delete</a></td>
      </tr>
      @empty

      @endforelse
     
   
   
    
    
    </tbody>
  </table>
  <div class="pagination-wrapper">
    {{ $product->links()}}
</div>
