@extends('brightweb::userprofile.userincludes.header')


@section('content')
    <div class="admin_container_main" style="margin-top:30px;">
              <form action="" class="product_form" method="post">
              @csrf
                <div class="input_div"><input readonly name="name" value="{{ $myshipping->name??Auth::user()->name }}" type="text" placeholder="Full name" /></div>
                <div class="input_div"><input readonly name="email" value="{{ $myshipping->email??Auth::user()->email }}" type="text" placeholder="Email@dmain.com"/></div>
                <div class="input_div"><input name="street_address" value="{{ $myshipping->street_address??null }}" type="text" placeholder="Street Address"/></div>
                <div class="input_div"><input name="land_mark" value="{{ $myshipping->land_mark??null }}" type="text" placeholder="Land Mark"/></div>
                <div class="input_div"><input name="city" value="{{ $myshipping->city ??null}}" type="text" placeholder="City"/></div>
                <div class="input_div"><input name="state" value="{{ $myshipping->state ??null}}" type="text" placeholder="State"/></div>
                <div class="input_div"><input name="country" value="{{ $myshipping->country??null }}" type="text" placeholder="Country"/></div>
                <div class="input_div"><input name="pincode" value="{{ $myshipping->pincode ??null}}" type="text" placeholder="Pincode"/></div>
                <div class="input_div"><input name="phone" value="{{ $myshipping->phone ??null}}" type="text" placeholder="Phone"/></div>
                {{-- <div class="input_div">
                  <textarea name=""></textarea>
                </div>
                <div class="input_div">
                  <textarea name=""></textarea>
                </div> --}}
                <div class="submit_div">
                  <button type="submit" class="submit_btn">Save</button>
                </div>
              </form>
            </div>
   
@endsection

 