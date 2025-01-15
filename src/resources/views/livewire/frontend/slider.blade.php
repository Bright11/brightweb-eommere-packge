
<section class="bannar_section">

        {{-- <div class="bannar_container" style="background-image: url({{ route('brightweb.frontend.image', ['filename' => 'images/bg_image.avif']) }});"> --}}
            <div class="bannar_container" style="background-image: url();">
<!-- category -->
{{--  <img src="{{ route('brightweb.frontend.image', ['filename' => 'logo/logo.jpeg']) }}" alt="Logo"> --}}
@if (config('brightwebconfig.frontend_category_settings.show_sidebar_category')==true)
<ul class="category_sidebar category_sidebar_settings">

@forelse ($datacategory as $item)
<li><a href="{{route("allcategory",$item['slug'])}}">{{$item->name}}</a></li>
@empty
    
@endforelse

</ul>
@endif


<!-- the end -->
@if (config('brightwebconfig.slider_display_option.show_slider')==true)

        <div class="owl-carousel mytopslider" >

        @forelse($sliderproduct as $slider)
        <div class="product_item_holder">
                <a href="{{ route("productDetails",$slider['slug']) }}">
                    <div class="proimage">
                        {{-- <img src="images/pr5.png" alt=""> --}}
                        @if($slider['image_url'])
                 <img src="{{ $slider['image_url'] }}" alt="item">
                 @elseif ($slider['image_pc'])
                 <img src="product/{{ $slider['image_pc'] }}" alt="item">
                 @endif
                    </div>
                    <div class="product_name_div">
                    <h1>{!! Str::limit($slider['name'], 15, ' ...') !!}</h1>
                    <p>{!! Str::limit($slider['description'], 18, ' ...') !!}</p>
                        <div class="product_price">

                        
                            </div>
                            </div>
                            <div class="product_buttons">
                               <div class=""> 
                                <p><strike>{{ $slider['discount'] }}%OFF</strike></p>
                               </div>
                               <div> <p>{{ config('brightwebconfig.currency.site_Currency',$default_currency ) }}{{ $slider['selling_price'] }}</p></div>
                                </div>

                                <div class="pro_icons_position">

                                   <div><a href=""><i class="fa fa-heart"></i></a></div>
                                   <div><a href=""><i class="fa fa-eye"></i></a></div>
                                </div>

                                <div class="pro_discount">
                                <p><strike>{{ $slider['discount'] }}%OFF</strike></p>
                                </div>
                </a>

            </div>
           @empty

           @endforelse


          </div>
          @endif

          @if (config('brightwebconfig.slider_display_option.show_background_image')==true)
          @if ($bgimage)
          <div class="bgimage" >
            <img src="{{asset("seo/$bgimage->bgimage")}}" alt="Bg image">
          </div>
          @endif
          
          @endif
          
    </div>
    </div>
</section>
