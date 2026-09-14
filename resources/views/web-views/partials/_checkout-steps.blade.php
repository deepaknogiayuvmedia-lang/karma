<div class="bh-checkout-steps my-4">
    <a class="bh-checkout-step {{ $step >= 1 ? 'active' : '' }}" href="{{ route('checkout-details') }}">
        <span class="bh-checkout-step-num">1</span>
        <span>{{ \App\CPU\translate('Address & Shipping') }}</span>
    </a>
    <a class="bh-checkout-step {{ $step >= 2 ? 'active' : '' }}" href="{{ route('checkout-payment') }}">
        <span class="bh-checkout-step-num">2</span>
        <span>{{ \App\CPU\translate('Payment Method') }}</span>
    </a>
    <a class="bh-checkout-step {{ $step >= 3 ? 'active' : '' }}" href="javascript:">
        <span class="bh-checkout-step-num">3</span>
        <span>{{ \App\CPU\translate('Order Confirmation') }}</span>
    </a>
</div>
