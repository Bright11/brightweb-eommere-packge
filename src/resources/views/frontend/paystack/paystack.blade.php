@extends('brightweb::frontend.include.header')
@section("title")
<title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
@endsection

@section('content')
<style>
     body{
        background-color: white;
    }
    .successpayment{
        max-width: 90%;
        margin: 50px auto;
    }
</style>
<section class="successpayment">
    <div class="checkout_items">
     @error('error')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <table id="example" class="display cart-table" style="width:max-content;">
            <thead>
                <tr>
                    <th>Item name</th>
                    <th>Item image</th>
                    <th>Item price</th>
                    <th>Quantity</th>
                    <th>Total price</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cartitems as $item)

                <tr data-id="{{ $item->id }}">
                    <td>{!! Str::limit($item->products->name, 18, ' ...') !!}</td>
                    <td><img width="100" height="100" src="{{ asset('product/' . $item->products->image) }}" alt="{{ $item->products->name }}"></td>
                    <td>{{ config('dashboardsettings.currency.US') }}{{ $item->products->price }}</td>

                    <td >
                        <div  class="cartqty_update">
                            <button type="button" id="minus">-</button>
                        <input class="quantity" type="number" id="number-input" value="{{ $item->quantity }}">
                        <button  type="button" id="plus">+</button>
                        </div>
                   </td>
                    <td>{{ config('dashboardsettings.currency.US') }}{{ $item->total_price }}</td>
                    <td>
                        <button class="update-cart">Update</button>
                    </td>
                    <td><a href=""><i class="fa-solid fa-trash"></i></a></td>
                </tr>
                @empty

                @endforelse


            </tbody>

        </table>
    </div>
    <form action="{{ route("paywithpaystack") }}" method="POST" class="cupon_form">
        @csrf
        @if ($errors->has('promo_code'))
        <span class="text-danger">{{ $errors->first('promo_code') }}</span>
    @endif
    @if ($errors->has('code'))
    <span class="text-danger">{{ $errors->first('code') }}</span>
@endif
    @if(session()->has('message'))
<div class="alert alert-success" style="text-align: center;">
    {{ session()->get('message') }}
</div>
@endif

        <label for="">Apply a Cupon</label>
        <input type="text" placeholder="Enter your cupon code" name="code">
        {{-- <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount"> --}}
        <button type="submit">Checkout</button>
    </form>
</section>
@endsection
