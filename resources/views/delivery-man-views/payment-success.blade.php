@extends('delivery-man-views.layouts.app')

@section('title', 'Payment Success')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-lg-6">
        <div class="card text-center" style="border:3px solid #00c9a7;">
            <div class="card-body py-5">
                <div class="mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle"
                         style="width:100px; height:100px; background:linear-gradient(135deg, #00c9a7, #38ef7d);">
                        <i class="tio-checkmark-circle" style="font-size:56px; color:white;"></i>
                    </div>
                </div>
                <h2 class="font-weight-bold text-success mb-2">Payment Successful!</h2>
                <p class="text-muted mb-3">Order #{{ $order['id'] }} payment has been received.</p>

                <div class="d-inline-block p-3 mb-4" style="background:#f0fff4; border-radius:10px;">
                    <small class="text-muted d-block" style="font-size:11px;">AMOUNT RECEIVED</small>
                    <h3 class="mb-0 text-success" style="font-weight:700;">
                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}
                    </h3>
                </div>

                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ route('delivery-man.order-details', $order['id']) }}" class="btn btn--primary">
                        <i class="tio-eye mr-1"></i> View Order
                    </a>
                    <a href="{{ route('delivery-man.orders') }}" class="btn btn-outline-secondary">
                        <i class="tio-shopping-cart mr-1"></i> All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
