@extends('delivery-man-views.layouts.app')

@section('title', 'Pay with Razorpay - Order #' . $order['id'])

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-lg-6">
        <div class="card text-center">
            <div class="card-body py-4">
                <h5 class="font-weight-bold mb-3">Pay with Razorpay</h5>
                <div class="mb-3">
                    <small class="text-muted">Order #{{ $order['id'] }}</small>
                    <h2 class="font-weight-bold" style="color:#072654;">
                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}
                    </h2>
                </div>

                <form action="{{ route('payment-razor') }}" method="POST" id="razorpayForm">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                    <input type="hidden" name="amount" value="{{ $amount }}">
                    <script src="https://checkout.razorpay.com/v1/checkout.js"
                            data-key="{{ $config['razor_key'] ?? '' }}"
                            data-amount="{{ $amount }}"
                            data-currency="{{ strtoupper(config('app.currency_code', 'inr')) }}"
                            data-order_id=""
                            data-buttontext="Pay {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}"
                            data-name="{{ \App\Model\BusinessSetting::where('type', 'company_name')->first()->value ?? 'Store' }}"
                            data-description="Order #{{ $order['id'] }}"
                            data-image="{{ asset(config('app.public_storage_path') . '/company/' . (\App\Model\BusinessSetting::where('type', 'company_web_logo')->first()->value ?? '')) }}"
                            data-prefill.name="{{ $order->customer->f_name ?? 'Customer' }}"
                            data-prefill.email="{{ $order->customer->email ?? '' }}"
                            data-prefill.contact="{{ $order->shippingAddress->phone ?? '' }}"
                            data-theme.color="#072654">
                    </script>
                    <input type="hidden" name="payment_method" value="razor_pay">
                </form>

                <button type="button" class="btn btn-lg btn-block font-weight-bold mt-3"
                        style="background:#072654; color:white; padding:14px;"
                        onclick="document.querySelector('#razorpayForm .razorpay-payment-button').click()">
                    <i class="tio-credit-card mr-1"></i> Pay Now
                </button>

                <a href="{{ route('delivery-man.collect-payment', $order['id']) }}"
                   class="btn btn-outline-secondary btn-block mt-2">
                    <i class="tio-arrow-left mr-1"></i> Back
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
