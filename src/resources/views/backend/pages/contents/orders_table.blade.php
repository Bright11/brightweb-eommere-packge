<table id="myTable" class="display" style="width: 100%">
    <thead>
      <tr>
        <th>Name</th>
        <th>Image</th>
        <th>Qty</th>
        <th>Price bught</th>
        <th>Selling price</th>
        <th>Status</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @forelse($order as $item)
      <tr>
        <td>{!! Str::limit($item->product->name, 20, ' ...') !!}</td>
        @if($item->product->image_pc)
        <td><img width="80" height="80" src="{{ asset('product/'.$item->product->image_pc) }}"alt="{{$item->product->name}}" alt="{{ $item->name }}">
</td>
        @else
        <td><img width="80" height="80" src="{{$item->product->image_url}}" alt="{{ $item->name }}"></td>
        @endif
        <td>{{ $item->quantity }}</td>
        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }} {{$item->product->buying_price}}</td>
        <td>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{$item->product->selling_price}}</td>
        <td>{{ $item->status }}</td>
        <td><a href="{{ route("addproduct",$item->id) }}">Delete</a></td>
      </tr>
      @empty

      @endforelse
    
    </tbody>
  </table>
  <div class="pagination-wrapper">
    {{-- {{ $order->links()}} --}}
</div>
