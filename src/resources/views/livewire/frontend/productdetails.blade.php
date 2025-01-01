@section('title')
<title>{{ $pro_details->name ?? 'Bright C Web Develloper' }}</title>
@section('meta_tags')
<meta name="description" content="{{ Str::limit($pro_details->description, 150, ' ...') }}">
<meta name="keywords" content="{{$pro_details->category->name }}{{ $pro_details->name }}{{ $pro_details->keywords }}">
{{-- <meta name="author" content="{{ $pro_details->author }}"> --}}
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="3 month">
{{-- <meta name="language" content="English"> --}}
{{-- <meta name="web_author" content="{{ $pro_details->author }}"> --}}
{{-- <meta name="copyright" content="Bright C Web Developer"> --}}

<meta property="og:title" content="{{ $pro_details->name ?? 'Bright C Web Develloper' }}">
<meta property="og:description" content="{{ Str::limit($pro_details->description, 150, ' ...') }}">
@if ($pro_details->image_pc)
<meta property="og:image" content="{{ asset('product/'.$pro_details->image_pc) }}">
@else
<meta property="og:image" content="{{ $pro_details->image_url }}">
    
@endif
<meta property="og:url" content="{{ URL::current() }}">
{{-- <meta property="og:site_name" content="{{ config('app.name') }}"> --}}
<meta property="og:type" content="website">
<meta property="og:locale" content="en_US">
<meta name="twitter:card" content="summary">
{{-- <meta name="twitter:site" content="@{{ config('app.name') }}">
<meta name="twitter:creator" content="@{{ config('app.name') }}"> --}}
<meta name="twitter:title" content="{{ $pro_details->name ?? 'Bright C Web Develloper' }}">
<meta name="twitter:description" content="{{ Str::limit($pro_details->description, 150, ' ...') }}">
@if ($pro_details->image_pc)
<meta name="twitter:image" content="{{ asset('product/'.$pro_details->image_pc) }}">
@else
<meta name="twitter:image" content="{{ $pro_details->image_url }}">
    
@endif
{{-- index follow--}}
<meta name="robots" content="index, follow">
{{-- <meta name="revisit-after" content="3 month"> --}}
{{-- <meta name="language" content="English"> --}}
{{-- <meta name="web_author" content="{{ $pro_details->author }}"> --}}
{{-- <meta name="copyright" content="Bright C Web Developer"> --}}




    
@endsection
@endsection
<section class="product_detils_section">
    <div class="product_details_page">
<!-- category -->
@if (config('brightwebconfig.frontend_category_settings.show_sidebar_category')==true)
<ul class="category_sidebar_settings category_sidebar_details">

@forelse ($datacategory as $item)
<li><a href="{{route("allcategory",$item['slug'])}}">{{$item->name}}</a></li>
@empty
    
@endforelse
</ul>
@endif
<!-- the end -->
       <!-- detalsi items-->

        <div class="details_content">
            <div class="details_image_content">
                @if ($pro_details->image_pc)
                <img id="main_details_image" src="{{asset("product/$pro_details->image_pc")}}" alt="{!! Str::limit($pro_details->name, 15, ' ...') !!}">
                
                @else
                <img id="main_details_image" src="{{ $pro_details->image_url }}" alt="item imge">
                @endif
              
                <div class="product_rating_star">
                    <span>★</span>
                    <span>★</span>
                    <span>★</span>
                    <span>★</span>
                    <span>★</span>
                    <span>(50+)</span>
                </div>
               <div class="pro_gallery_container">
                @if ($pro_details->productgallery->count() > 0)

                <div class="product_gallery">
                        @forelse ($pro_details->productgallery as $item)
                        <div class="product_gallery_item">
                            @if ($item->image_from_pc)
                            <img src="{{ asset('product_gallery/' . $item->image_from_pc) }}" alt="{{ Str::limit($item->name, 18, '...') }}">
                            @endif
                            @if ($item->image_from_url)
                            <img src="{{$item->image_from_url}}" alt="">
                            @endif
                           
                        </div>
                        @empty
                            
                        @endforelse
                   
                   
                    
                </div>
             
                <button class="pro_gallery_btn btn_next">
                    <i class="fa fa-toggle-left" ></i>
                </button>
                <button class="pro_gallery_btn btn_prev">
                    <i class="fa fa-toggle-right" ></i>
                </button>
                @endif
               </div>
            </div>
            <div class="details_info_content">
               <div class="product_details_name">
                <h1>{{$pro_details->name}}</h1>
               </div>
               <div class="details_price">
                <p><strike>{{ $pro_details['discount'] }}%OFF</strike></p>
                <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $pro_details->selling_price }}</p>
               </div>
               <div class="product_description">
                <p>{{ $pro_details->description }}</p>
               </div>
              
            
               <div class="details_cart">
                
                <div class="add_to_cart_details_div">
                    @if($pro_details->qty == 0)
                    <div class="addtocartdiv"> <a href="#">Out of stock
                    </a></div>
                      @else
                    <a href="" wire:click.prevent='addtocartfromdetailspage({{ $pro_details['id'] }})'>Add to cart <i class="fa fa-shopping-cart"></i></a>
                    @endif
                </div>
                <div class="add_to_cart_details_div">
                    <a href="" wire:click.prevent="addtowishlist({{ $pro_details['id'] }})">Add to wishlist <i class="fa fa-heart"></i></a>
                </div>
               </div>

            </div>
        </div>
    </div>
    
    @if ($pro_details->variations)
    <section class="variationsection">
        <h1>Product Vairation</h1>
        <div class="vairation">
           
            @forelse ($pro_details->variations as $item)
            <div class="vairation_type">
                <h1>{{ $item->variation_type }}: </h1>
                <h1>{{ $item->variation_value }}</h1>
            </div>
            @empty
                
            @endforelse
           
        
           </div>
    </section>
    @endif

       <!-- the end of details -->

       {{-- social media --}}

       @include("brightweb::frontend.frontendforms.sharing_links")

<!-- Give us a review -->
<div class="review_container">
<button>Give us a review</button>
<div class="rate_product">
   <span onclick="rating(1)" class="star">★</span>
   <span onclick="rating(2)" class="star">★</span>
   <span onclick="rating(3)" class="star">★</span>
   <span onclick="rating(4)" class="star">★</span>
   <span onclick="rating(5)" class="star">★</span>
</div>
<!-- <h1 class="rating-value"></h1> -->
<form action="" class="rating_form">
    <input type="text" class="rating-value" name="rating" value="">
    <textarea name="" cols="50" rows="5" id=""></textarea>
    <button>Submit</button>
</form>
</div>



{{-- related products --}}

<div class="product_container">
@forelse ($relatedpro as $item)
<div class="product_item_holder">
<a  href="{{ route("productDetails",$item['slug']) }}">
    <div class="proimage">
        @if ($item->image_pc)
        <img src="{{ asset("product/$item->image_pc")}}" alt="{{ Str::limit($item->name, 18,'...') }}">
        @else
        <img src="{{ $item->image_url }}" alt="{{ Str::limit($item->name, 18,'...') }}">
        @endif
      
    </div>
    <div class="product_name_div">
        <h1>{{ Str::limit($item->name,18, '...') }}</h1>
        <p>{{ Str::limit($item->description,18,'...') }}</p>
        <div class="product_price">
            <p><strike>{{ $item['discount'] }}%OFF</strike></p>
            </div>
            </div>
            <div class="product_buttons">
                @if($item['qty'] == 0)
                <div class="addtocartdiv"> <a href="#">Out of stock
                </a></div>
                  @else
               <div class="addtocartdiv"> <a href="" wire:click.prevent='addtocartfromdetailspage({{ $pro_details['id'] }})'>Add to Cart
                <i class="fa fa-shopping-cart"></i>
               </a></div>
               @endif
                  <div> <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $pro_details->selling_price }}</p></div>
                </div>

                <div class="pro_icons_position">
                 
                   <div><a href=""><i class="fa fa-heart"></i></a></div>
                   <div><a href=""><i class="fa fa-eye"></i></a></div>
                </div>

                <div class="pro_discount">
                    <p>20%OFF</p>
                </div>
</a>

</div>
@empty
   
@endforelse



</div>
</section>