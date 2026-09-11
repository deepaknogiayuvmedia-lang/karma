@extends('delivery-man-views.layouts.app')

@section('title', 'Collect Payment - Order #' . $order['id'])

@section('content')

<div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h2 class="h4 mb-0 d-flex align-items-center gap-2">
        <i class="tio-money" style="color:#00c9a7;"></i>
        Collect Payment
    </h2>
    <a href="{{ route('delivery-man.order-details', $order['id']) }}" class="btn btn-outline-secondary btn-sm">
        <i class="tio-arrow-left mr-1"></i> Back
    </a>
</div>

<div class="row g-3 justify-content-center">

    {{-- Amount to Collect --}}
    <div class="col-lg-6">
        <div class="card text-center" style="border:2px solid #00c9a7;">
            <div class="card-body py-4">
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                         style="width:70px; height:70px; background:linear-gradient(135deg, #00c9a7, #38ef7d);">
                        <i class="tio-money" style="font-size:32px; color:white;"></i>
                    </div>
                </div>
                <h5 class="text-muted mb-1">Order #{{ $order['id'] }}</h5>
                <h2 class="mb-0" style="font-size:36px; font-weight:700; color:#00c9a7;">
                    {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}
                </h2>
                <p class="text-muted mt-2 mb-0">Collect this amount from customer</p>
            </div>
        </div>
    </div>

    {{-- Customer Info --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h6 class="font-weight-bold mb-3"><i class="tio-user mr-1"></i> Customer Details</h6>
                @if($order->customer)
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img class="rounded-circle" width="48" height="48" style="object-fit:cover;"
                         src="{{ asset(config('app.public_storage_path') . '/profile/' . ($order->customer->image ?? 'def.png')) }}"
                         onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'" alt="">
                    <div>
                        <div class="font-weight-bold">{{ $order->customer->f_name }} {{ $order->customer->l_name }}</div>
                        <small class="text-muted">{{ $order->customer->email }}</small>
                    </div>
                </div>
                @endif
                @if($order->shippingAddress)
                <div class="mb-2">
                    <small class="text-muted d-block">Phone</small>
                    <a href="tel:{{ $order->shippingAddress->phone }}">{{ $order->shippingAddress->phone }}</a>
                </div>
                <div>
                    <small class="text-muted d-block">Address</small>
                    <span>{{ $order->shippingAddress->address }}, {{ $order->shippingAddress->city }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Payment Gateway Options --}}
@if($digitalPayment['status'] ?? false)
<div class="row g-3 mt-2 justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2 py-3">
                <i class="tio-credit-card text--primary"></i>
                <h5 class="card-title mb-0">Choose Payment Method</h5>
            </div>
            <div class="card-body">
                <p class="text-muted mb-3">Ask customer to choose a payment method or scan QR code below.</p>

                <div class="row g-3">

                    {{-- Stripe --}}
                    @if($stripe['status'] ?? false)
                    <div class="col-sm-6 col-lg-4">
                        <form action="{{ route('delivery-man.collect-payment.stripe', $order['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 p-3" style="border:2px solid #635bff; border-radius:12px; transition:all .2s;"
                                    onmouseover="this.style.background='#635bff'; this.style.color='white';"
                                    onmouseout="this.style.background=''; this.style.color='';">
                                <img width="80" src="{{ asset('assets/front-end/img/stripe.png') }}" alt="Stripe">
                                <div class="mt-2 font-weight-bold" style="font-size:13px;">Pay with Card</div>
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- Razorpay --}}
                    @if($razorpay['status'] ?? false)
                    <div class="col-sm-6 col-lg-4">
                        <form action="{{ route('delivery-man.collect-payment.razorpay', $order['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 p-3" style="border:2px solid #072654; border-radius:12px; transition:all .2s;"
                                    onmouseover="this.style.background='#072654'; this.style.color='white';"
                                    onmouseout="this.style.background=''; this.style.color='';">
                                <img width="80" src="{{ asset('assets/front-end/img/razor.png') }}" alt="Razorpay">
                                <div class="mt-2 font-weight-bold" style="font-size:13px;">Pay with Razorpay</div>
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- SSLCommerz --}}
                    @if($sslcommerz['status'] ?? false)
                    <div class="col-sm-6 col-lg-4">
                        <form action="{{ route('delivery-man.collect-payment.sslcommerz', $order['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 p-3" style="border:2px solid #1a4b8e; border-radius:12px; transition:all .2s;"
                                    onmouseover="this.style.background='#1a4b8e'; this.style.color='white';"
                                    onmouseout="this.style.background=''; this.style.color='';">
                                <img width="80" src="{{ asset('assets/front-end/img/sslcomz.png') }}" alt="SSLCommerz">
                                <div class="mt-2 font-weight-bold" style="font-size:13px;">SSLCommerz</div>
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- bKash --}}
                    @if($bkash['status'] ?? false)
                    <div class="col-sm-6 col-lg-4">
                        <form action="{{ route('delivery-man.collect-payment.bkash', $order['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 p-3" style="border:2px solid #e2136e; border-radius:12px; transition:all .2s;"
                                    onmouseover="this.style.background='#e2136e'; this.style.color='white';"
                                    onmouseout="this.style.background=''; this.style.color='';">
                                <img width="80" src="{{ asset('assets/front-end/img/bkash.png') }}" alt="bKash"
                                     onerror="this.outerHTML='<span style=&quot;font-size:24px; font-weight:700; color:#e2136e;&quot;>bKash</span>'">
                                <div class="mt-2 font-weight-bold" style="font-size:13px;">Pay with bKash</div>
                            </button>
                        </form>
                    </div>
                    @endif

                    {{-- PayPal --}}
                    @if($paypal['status'] ?? false)
                    <div class="col-sm-6 col-lg-4">
                        <form action="{{ route('delivery-man.collect-payment.stripe', $order['id']) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn w-100 p-3" style="border:2px solid #003087; border-radius:12px; transition:all .2s;"
                                    onmouseover="this.style.background='#003087'; this.style.color='white';"
                                    onmouseout="this.style.background=''; this.style.color='';">
                                <img width="80" src="{{ asset('assets/front-end/img/paypal.png') }}" alt="PayPal">
                                <div class="mt-2 font-weight-bold" style="font-size:13px;">Pay with PayPal</div>
                            </button>
                        </form>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
