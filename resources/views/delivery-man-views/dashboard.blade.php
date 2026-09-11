@extends('delivery-man-views.layouts.app')

@section('title', \App\CPU\translate('dashboard'))

@section('content')
<div class="mb-4">
    <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
        <img width="20" src="{{asset('assets/back-end/img/dashboard.png')}}" alt="">
        {{\App\CPU\translate('dashboard')}}
    </h2>
</div>

<!-- Stats Cards -->
<div class="row g-2 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                <i class="fas fa-clock"></i>
            </div>
            <h2 class="business-analytics__title">{{ $pendingOrders }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('Pending Orders')}}</h5>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <i class="fas fa-truck"></i>
            </div>
            <h2 class="business-analytics__title">{{ $outForDelivery }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('Out For Delivery')}}</h5>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="business-analytics__title">{{ $deliveredToday }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('Delivered Today')}}</h5>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="business-analytics">
            <div class="business-analytics__icon" style="background: linear-gradient(135deg, #f5af19 0%, #f12711 100%);">
                <i class="fas fa-box"></i>
            </div>
            <h2 class="business-analytics__title">{{ $totalDelivered }}</h2>
            <h5 class="business-analytics__subtitle">{{\App\CPU\translate('Total Delivered')}}</h5>
        </div>
    </div>
</div>

<!-- Wallet & Recent Orders -->
<div class="row g-2">
    <!-- Wallet -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="tio-wallet"></i> {{\App\CPU\translate('wallet')}}</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="text-muted">{{\App\CPU\translate('current_balance')}}</label>
                    <h3 class="text-success">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($currentBalance)) }}</h3>
                </div>
                <div class="mb-3">
                    <label class="text-muted">{{\App\CPU\translate('cash_in_hand')}}</label>
                    <h4>{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($cashInHand)) }}</h4>
                </div>
                <a href="{{route('delivery-man.earning')}}" class="btn btn--primary btn-block">
                    {{\App\CPU\translate('view_earning_details')}}
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="tio-shopping-cart"></i> {{\App\CPU\translate('recent_orders')}}</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{\App\CPU\translate('order_id')}}</th>
                                <th>{{\App\CPU\translate('customer')}}</th>
                                <th>{{\App\CPU\translate('amount')}}</th>
                                <th>{{\App\CPU\translate('status')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td>#{{ $order['id'] }}</td>
                                <td>{{ $order['billing_address']['name'] ?? 'N/A' }}</td>
                                <td>{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}</td>
                                <td>
                                    @if($order['order_status'] == 'pending')
                                        <span class="badge badge-warning">{{ ucfirst($order['order_status']) }}</span>
                                    @elseif($order['order_status'] == 'confirmed')
                                        <span class="badge badge-info">{{ ucfirst($order['order_status']) }}</span>
                                    @elseif($order['order_status'] == 'processing')
                                        <span class="badge badge-primary">{{ ucfirst($order['order_status']) }}</span>
                                    @elseif($order['order_status'] == 'out_for_delivery')
                                        <span class="badge badge-secondary">{{ ucfirst(str_replace('_', ' ', $order['order_status'])) }}</span>
                                    @elseif($order['order_status'] == 'delivered')
                                        <span class="badge badge-success">{{ ucfirst($order['order_status']) }}</span>
                                    @elseif($order['order_status'] == 'canceled')
                                        <span class="badge badge-danger">{{ ucfirst($order['order_status']) }}</span>
                                    @else
                                        <span class="badge badge-dark">{{ ucfirst($order['order_status']) }}</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="">
                                    <p class="mb-0">{{\App\CPU\translate('no_data_to_show')}}</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
