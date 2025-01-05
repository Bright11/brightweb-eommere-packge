
<section class="product_section">
  @if ($countcart)
    
 
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Item Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Total price</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @forelse($getcart as $item)
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
              <form action="" class="qty_btn_div">
                {{-- <button type="button" id="minus">-</button> --}}
            
                                                     <input 
                                                      {{-- id="qtyinput" --}}
                                                   type="number" 
                                                    wire:model="qtyinput.{{ $item->id }}" 
                                                    name="qty_{{ $item->id }}" 
                                                    min="1">                             
               {{-- <button type="button" id="plus">+</button> --}}
              </form>
            </td>
            <td>{{$item->total_price}}</td>
            <td><button wire:click="updatecart({{ $item->id }})" class="checkout_btn">Update</button></td>
            <td><button  wire:click="removecart({{ $item->id }})" class="checkout_delete_btn"><i class="fa fa-trash-o"></i></button></td>
          </tr>
          @empty

          @endforelse
         
        
        </tbody>
      </table>
      
      <form class="couponform" wire:submit.prevent="applycoupon">
        @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
        @if (session()->has('message'))
        <div class="alert alert-danger">
        <div>{{ session('message') }}</div>
        </div>
    @endif
      
<div class="coupon_inputdiv">
  <input wire:model="coupon" typt="number" placeholder="Enter your cuponcode"/>
<button class="applybtn">Apply</button>
</div>

<div class="item_checkout_total">
       
  @if($userAfterCoupon)
  <p>Item Total <strike>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{$userItemTotal}}</strike> </p>
  <p>Amount to pay {{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{$userAfterCoupon}}</p>
  @else
  <p>Item Total {{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{$userItemTotal}}</p>
  @endif
</div>
      </form>
      @include('brightweb::frontend.frontendforms.checkoutforms')
      @else
      <div class="empty_cart_div" style="text-align: center;">
        <h1>Your cart is empty</h1>
        <a style="text-decoration: none" href="{{ route("index") }}">Continue Shopping</a>
      </div>
      @endif
</section>

