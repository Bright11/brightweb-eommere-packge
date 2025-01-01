<ul class="admin_ul">
 <li><i class="fa fa-suitcase"></i><a href="/" target="_blank" >Visit Site</a></li>
    <li><i class="fa fa-bars" ></i><a href="{{route("userdashboard")}}">Dashiboard</a></li>
    @if(Auth::user())
    @if(!$checkshipping)
 <li><i class="fa fa-car"></i><a href="{{route("addshipping")}}">Add Shipping</a></li>
 @else
 <li><i class="fa fa-car"></i><a href="{{route("addshipping")}}">Update Shipping</a></li>
  @endif
    @endif
    <li><i class="fa fa-car"></i><a href="{{route("userviewshipping")}}">View Shipping</a></li>
    <li><i class="fa fa-cart-arrow-down" ></i><a href="{{ route('myorders') }}">My Orders</a></li>
    <li><i class="fa fa-cart-arrow-down" ></i><a href="{{ route('usercompletedorders') }}">Delievered Orders</a></li>
    <li><i class="fa fa-heart"></i><a href="{{ route("mywishlist") }}">My wishlist</a></li>
@if($message)
    <li><i class="fa fa-vcard-o"></i><a href="{{ route('myorders') }}">Messages</a></li>
    @endif
    
    <li><i class="fa fa-sign-out" ></i><a href="{{ route("logout") }}">Logout</a></li>
  </ul>