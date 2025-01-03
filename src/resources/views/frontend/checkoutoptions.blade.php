@extends('brightweb::frontend.include.header')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush
@section("title")
<title>{{ $metaseo->site_title ?? 'Bright C Web Develloper' }}</title>
@endsection
@section('content')
@livewire("brightweb::checkout.checkoutoption")
@endsection