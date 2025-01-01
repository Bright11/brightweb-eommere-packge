@extends('brightweb::frontend.include.header')
@push('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
@livewire("brightweb::checkout.checkoutoption")
@endsection