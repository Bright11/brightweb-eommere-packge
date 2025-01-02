@extends('brightweb::frontend.include.header')

@section('content')
<style>
    body{
        background-color: white;
    }
    .successpayment {
        max-width: 90%;
        margin: 50px auto;
    }
    .card{
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .card-body p{
        color: gray;
    }
    li{
        list-style: none;
    }
</style>
<section class="successpayment">
    <div class="checkout_items">
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>Payment Successful</h2>
                </div>
                <div class="card-body">
                    <p>Thank you for your donation, {{ $name }}!</p>
                    <p>Your transaction was successful.</p>
                    <p>{{ $mailinfor }}</p>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Transaction ID:</strong> {{ $transactionId }}</li>
                        <li class="list-group-item"><strong>Email:</strong> {{ $email }}</li>
                        <li class="list-group-item"><strong>Amount:</strong> {{ $amount }} {{ $currency }}</li>
                        <li class="list-group-item"><strong>Payment ID:</strong> {{ $transactionId }}</li>
                        <li class="list-group-item"><strong>Payment Channel:</strong> {{ $channel }}</li>
                        <li class="list-group-item"><strong>Bank:</strong> {{ $bank ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Card Type:</strong> {{ $cardType ?? 'N/A' }}</li>
                        <li class="list-group-item"><strong>Card Number:</strong> {{ $cardNumber ? '**** **** **** ' . $cardNumber : 'N/A' }}</li>
                    </ul>
                    <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Home</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
