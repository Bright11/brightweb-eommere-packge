@section("title")
<title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
@endsection

@section("meta_tags")
<meta name="description" content="{{ $metaseo->meta_description ?? 'Default description' }}">
<meta name="keywords" content="{{ $metaseo->meta_keywords ?? 'default, keywords' }}">
<meta name="robots" content="index, follow">
<!-- Twitter Cards -->
<meta name="twitter:title" content="{{ $metaseo->twitter_title ?? 'Default Twitter Title' }}">
<meta name="twitter:description" content="{{ $metaseo->twitter_description ?? 'Default Twitter Description' }}">
@if(!empty($metaseo->twitter_image))
    <meta name="twitter:image" content="{{ asset('seo/' . $metaseo->twitter_image) }}">
@endif

<!-- Open Graph -->
<meta property="og:title" content="{{ $metaseo->og_title ?? 'Default Open Graph Title' }}">
<meta property="og:description" content="{{ $metaseo->og_description ?? 'Default Open Graph Description' }}">
@if(!empty($metaseo->og_image))
    <meta property="og:image" content="{{ asset('seo/' . $metaseo->og_image) }}">
@endif
    
@endsection
<section class="product_section">
    @forelse ($cartItems['data'] as $category)
    @if (count($category['limited_product']) > 0)
    <div class="pro_category_links">
     <div> <a href="#">{{ $category['name'] }}</a></div>
     
    <div> <a href="{{route("allcategory",$category['slug'])}}">View all</a></div>
 
 </div>
 <div class="product_container">
 @forelse ($category['limited_product'] as $product)
 
     <div class="product_item_holder">
         <a href="{{ route("productDetails",$product['slug']) }}">
             <div class="proimage">
                 {{-- <img src="images/pr5.png" alt=""> --}}
                 @if($product['image_url'])
                 <img src="{{ $product['image_url'] }}" alt="{!! Str::limit($product['name'], 15, ' ...') !!}">
                 @elseif ($product['image_pc'])
               
                 <img src="{{ asset("product/{$product['image_pc']}") }}" 
                 alt="{!! Str::limit($product['name'], 15, ' ...') !!}">            
                
                 @endif
                
             </div>
             <div class="product_name_div">
                 <h1>{!! Str::limit($product['name'], 15, ' ...') !!}</h1>
                 <p>{!! Str::limit($product['description'], 18, ' ...') !!}</p>
                 <div class="product_price">
                     
                    <p><strike>{{ $product['discount'] }}%OFF</strike></p>
                     </div>
                     </div>
                     <div class="product_buttons">
                        @if($product['qty'] == 0)
                        <div class="addtocartdiv"> <a href="#">Out of stock
                        </a></div>
                          @else
                        <div class="addtocartdiv"> <a href="" wire:click.prevent='addToCart({{ $product['id'] }})'>Add to Cart
                         <i class="fa fa-shopping-cart"></i>
                        </a></div>
                         @endif
                           <div> <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $product['selling_price'] }}</p></div>
                         </div>
 
                         <div class="pro_icons_position">
                          
                            <div><a href=""><i class="fa fa-heart"></i></a></div>
                            <div><a href=""><i class="fa fa-eye"></i></a></div>
                         </div>
 
                         <div class="pro_discount">
                            <p><strike>{{ $product['discount'] }}%OFF</strike></p>
                         </div>
         </a>
         
     </div>
   
 
 @empty
     
 @endforelse
 </div>
 @endif
    @empty
        
    @endforelse
  {{-- Pagination Navigation --}}
  <div class="paginate" style="margin-top: 20px; text-align: center;">
    {{-- Show Previous Button --}}
    @if ($cartItems['current_page'] > 1)
        <button 
            wire:click="loadCategories({{ $cartItems['current_page'] - 1 }})" 
            style="padding: 10px 20px; margin-right: 5px; border: none; border-radius: 4px; cursor: pointer;">
            Previous
        </button>
    @endif

    {{-- Show Next Button --}}
    @if ($cartItems['current_page'] < $cartItems['last_page'])
        <button 
            wire:click="loadCategories({{ $cartItems['current_page'] + 1 }})" 
            style="padding: 10px 20px; margin-left: 5px; border: none; border-radius: 4px; cursor: pointer;">
            Next
        </button>
    @endif
</div>


  {{-- the end of pagination --}}
 </section>
 <!--  -->
 