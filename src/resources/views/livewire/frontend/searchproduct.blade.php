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

    {{-- The whole world belongs to you. --}}
    <div class="product_container">
        @forelse ($productResults as $item)
        <div class="product_item_holder">
         <a  href="{{ route("productDetails",$item->slug) }}">
             <div class="proimage">
                @if ($item->image_url)
                <img src="{{ $item->image_url }}" alt="{!! Str::limit($item['name'], 15, ' ...') !!}">
                @elseif ($item->image_pc)
                <img src="{{asset("product/$item->image_pc")}}" alt="{!! Str::limit($item->name, 15, ' ...') !!}">
                @endif
             </div>
             <div class="product_name_div">
                 <h1>{!! Str::limit($item['name'], 15, ' ...') !!}"</h1>
                 <p>{!! Str::limit($item['description'], 20, ' ...') !!}"</p>
                 <div class="product_price">
                     
                     <p><strike>{{ $item['discount'] }}%OFF</strike></p>
                     </div>
                     </div>
                     <div class="product_buttons">
                        <div class="addtocartdiv"> <a href="" wire:click.prevent="addtocartfromsearch({{ $item->id }})">Add to Cart
                         <i class="fa fa-shopping-cart"></i>
                        </a></div>
                           <div> <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $item['selling_price'] }}</p></div>
                         </div>
     
                         <div class="pro_icons_position">
                          
                            <div><a href=""><i class="fa fa-heart"></i></a></div>
                            <div><a href="{{ route("productDetails",$item->slug) }}"><i class="fa fa-eye"></i></a></div>
                         </div>
     
                         <div class="pro_discount">
                             <p><strike>{{ $item['discount'] }}%OFF</strike></p>
                         </div>
         </a>
         
     </div>
        @empty
            <h1>No product was found</h1>
        @endforelse
     
       
     </div>
     </section>
