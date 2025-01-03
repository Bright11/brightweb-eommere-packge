@extends('brightweb::frontend.include.header')
@section("title")
<title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
@endsection

@section('content')
<style>
    .successpayment{
        max-width: 90%;
        margin: 50px auto;
    }
    body{
        background-color: white;
    }
</style>
<section class="successpayment">
    <h1>Your order was canceled</h1>
</section>
@endsection
