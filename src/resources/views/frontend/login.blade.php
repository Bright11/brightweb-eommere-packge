@extends('brightweb::frontend.include.header')

@section("title")
<title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
@endsection
@section('content')
    

   
    <!-- top slider and category -->
@livewire('brightweb::login.login')
    <!-- product section -->


@endsection