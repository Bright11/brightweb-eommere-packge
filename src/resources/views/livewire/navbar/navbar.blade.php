    <!-- navigation -->
    <nav class="topnavbar">
        <ul class="ul_top_nav">
            <li class="logo_li"><a href="#">
                {{-- <img src="{{ asset("brightweblogo/logo.jpeg") }}" alt="Logo"> --}}
              
                @if($metaseo->site_logo)
                <img src="{{ asset("seo/$metaseo->site_logo") }}" alt="logo">
                @else
                <img src="{{ asset("brightweblogo/logo.jpeg") }}" alt="Logo"> 

            </a>
        </li>
            <ul class="ul_top_nav_link" id="ul_top_nav_link">
                    <li><a href="/">Home</a></li>
                    @if (config('brightwebconfig.frontend_category_settings.show_top_categories')==true)
                    <li class="category_dropdown_li">
                        <a href="#">Category</a>
                       <div class="drop_down_category_di">
                        <ul class="category_dropdown_ul">
                            <li><a href="">Contact</a></li>
                            @forelse ($datacategory as $item)
                            <li><a href="{{route("allcategory",$item['slug'])}}">{{$item->name}}</a></li>
                            @empty
                                
                            @endforelse
                          
                        </ul>
                       </div>
                    </li>
                    @endif
                   
                    <li><a href="{{ route("aboutus") }}">About Us</a></li>
                    <li><a href="">Contact</a></li>
                    {{-- <li><a href="">Gallery</a></li> --}}
                    {{-- <li><a href="">Blog</a></li> --}}
                    @if(Auth::user())
                  @if (Auth::user()->role == 'admin')
                  <li><a href="{{ route("dashboard") }}">Dashboard</a></li>
                  @else
                  <li><a href="{{ route("userdashboard") }}">My profile</a></li>
                      
                  @endif
                    <li><a href="{{ route("logout") }}">Logout</a></li>
                    @else
                    <li><a href="{{ route("login") }}">Login</a></li>
                    <li><a href="{{ route("login") }}">Register</a></li>
                    @endif

                    
                </ul>
            </li>
           <li >
            <div id="google_translate_element"></div>
           </li>
           <li class="hurburgar" onclick="toggleNav()"><button class="open_nav_btn"><i class="fa fa-bars" style="font-size:36px"></i></button></li>
        </ul>
        <!-- searchbar and catcount -->
        <ul class="search_cart">
            @if (config('brightwebconfig.frontend_category_settings.show_sidebar_category')==true)
            <button class="category_humburgar" onclick="hidecategory()">
              <p id="category_icon_nav"> <i class="fa fa-bars" style="font-size:36px"></i></p>
                <!-- <i class="fa fa-times"></i> -->
              <h4 class="navcatgory_name">Categories</h4>
            </button>
            @else
            <button class="category_humburgar">
            <h6>{{ $metaseo->site_title }}</h6>
           </button>
            @endif
           <ul class="open_earch_mobile" onclick="openSearch()"> <button class="mobile_open_icon">
           
            <i class="fa fa-search"></i>
        </button></ul>
            <ul class="search_bar">
                <form action="{{ route("searchproduct") }}" method="POST" class="search_form">
                    @csrf
                    <input type="text" name="data" placeholder="Search...">
                    <button><i class="fa fa-search"></i></button>
                </form>
            </ul>
            <ul class="count_cart">
                <li class="cart_count">
                    <a href="{{ route("mywishlist") }}"><i class="fa fa-heart"></i>({{$countwhistlist}})</a>
                </li>
                <li class="cart_count cart_drop_container">
                    <a href="#"><i class="fa fa-shopping-cart"></i>({{ $countcart }})</a>
                    <!-- cart dropdown -->
                    <ul class="cart_dropdown">
                        <div class="cart_drop_content">
                            @if (Auth::user())
                                
                          
                            @forelse ($getcart as $item)
                            <div class="drop_cart_items" style="margin-bottom: 20px;">
                                <div class="cart_image">
                                    {{-- <img src="{{ route('brightweb.frontend.image', ['filename' => 'images/a1.png']) }}" alt="item"> --}}
                                     @if($item->products->image_url)
                                        <img src="{{ $item->products->image_url }}" alt="{{ $item->products->name }}"/>
                                    @elseif($item->products->image_pc)
                                        <img src="{{ asset("product/{$item->products->image_pc}") }}" alt="{{ $item->products->name }}"/>
                                    @endif

                                </div>
                               
                                <div class="cart_drop_info">
                                    <h1>{!! Str::limit($item->products->name, 15, ' ...') !!}</h1>
                                
                                    <div class="price_qty">
                                        <form action="" class="update_qty_form">
                                            <input 
                                                    type="number" 
                                                    wire:model="quantities.{{ $item->id }}" 
                                                    name="qty_{{ $item->id }}" 
                                                    min="1">
                                           
                                           
                                            <p>${{$item->total_price}}</p>
                                        </form>
                                    </div>
                                   <div class="cart_total_price">
                                      <p>${{$item->products->selling_price}}</p>
                                   </div>
                                    <div class="cart_remove_or_update">
                                        <button wire:click="removecart({{ $item->id }})">Remove</button>
                                        <button wire:click="updatecart({{ $item->id }})">Update</button>
                                    </div>
                                </div>
                            </div>
                                @empty
                                    
                                @endforelse
                                @endif
                            <div class="drop_checkout">
                               @if(Auth::user())
                               @if ($countcart)
                               <div class="cart_drop_total">
                                <h1>Total</h1>
                                <p>${{$totalamount}}</p>
                        
                        </div>
                        <div class="drop_checkout_btn">
                            <a href="{{ route("checkout.checkoutoptions") }}">Checkout</a>
                        </div>
                               @endif
                              
                    
                        @else
                        <div class="drop_checkout_btn">
                            <a href="{{ route("login") }}">Login</a>
                        </div>
                        @endif
                      
                            </div>
                            @if (session()->has('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        </ul>
                    
                    <!-- the end of it's dropdown -->

                </li>
                <!-- <li class="cat_count">
                    <a href="#"><i class="fa fa-list"></i>$(10)</a>
                </li> -->
             
            </ul>
        </ul>
        <!--  -->
    </nav>
