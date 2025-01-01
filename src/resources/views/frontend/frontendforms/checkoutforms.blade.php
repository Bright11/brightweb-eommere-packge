
<div class="paymentforms_container">
    @if (config('brightwebconfig.mypayment_options.enable_paypal')==true)

    <form action="{{ route('paypal.createPaypalOrder') }}" class="paymentform" method="POST">
        @csrf
        <button>
            Pay With PayPal
        </button>
    </form>
    @endif
    @if (config('brightwebconfig.mypayment_options.enable_paystack')==true)
    <form action="{{ route("paywithpaystack") }}" class="paymentform" method="POST">
        @csrf
        <button>
            Pay With PayStack
        </button>
    </form>
    @endif
    @if (config('brightwebconfig.mypayment_options.enable_pay_on_delivery')==true)
    <form action="{{ route("payondelivery") }}" class="paymentform">
        @csrf
        <button>
            Pay on Delievery
        </button>
    </form>
    @endif
</div>
