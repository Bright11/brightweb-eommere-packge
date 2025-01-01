@extends('brightweb::frontend.include.header')

@section('content')
<style>
    .successpayment{
        max-width: 90%;
        margin: 50px auto;
    }
</style>
<section class="successpayment">
    <div class="checkout_items">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <h2>Payment Failed</h2>
                </div>
                <div class="card-body">
                    <p>Unfortunately, your payment could not be processed.</p>
                    @isset($message)
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endisset
                    <p>Please try again or contact support if the issue persists.</p>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
