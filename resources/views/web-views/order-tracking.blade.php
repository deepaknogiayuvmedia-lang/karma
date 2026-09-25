@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('Track Order Result'))

@push('css_or_js')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-brand: {{ $web_config['primary_color'] ?? '#fe9b2c' }};
        --primary-brand-light: {{ $web_config['primary_color'] ?? '#fe9b2c' }}15;
    }

    .track-res-container {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        color: #1f2937;
    }

    /* Top Card Header */
    .order-header-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        padding: 24px 28px;
        margin-bottom: 24px;
    }

    .order-id-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 6px;
    }

    .order-date-text {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .status-badge-pending { background: #fef3c7; color: #d97706; }
    .status-badge-confirmed { background: #e0f2fe; color: #0284c7; }
    .status-badge-processing { background: #e0e7ff; color: #4338ca; }
    .status-badge-out_for_delivery { background: #fef3c7; color: #b45309; }
    .status-badge-delivered { background: #d1fae5; color: #059669; }
    .status-badge-canceled, .status-badge-failed { background: #fee2e2; color: #dc2626; }
    .status-badge-returned { background: #ffedd5; color: #c2410c; }

    .payment-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
    }
    .payment-paid { background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0; }
    .payment-unpaid { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }

    /* Action Buttons */
    .btn-action-outline {
        border: 1px solid #d1d5db;
        background: #ffffff;
        color: #374151;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 8px 16px;
        border-radius: 10px;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
    }
    .btn-action-outline:hover {
        background: #f9fafb;
        border-color: #9ca3af;
        color: #111827;
    }

    .btn-action-primary {
        background: var(--primary-brand);
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.875rem;
        padding: 9px 18px;
        border-radius: 10px;
        border: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .btn-action-primary:hover {
        filter: brightness(0.92);
    }

    /* Progress Tracker Card */
    .tracker-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        padding: 32px 24px;
        margin-bottom: 24px;
    }

    .progress-tracker-wrap {
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    /* Line connecting steps */
    .progress-line-bg {
        position: absolute;
        top: 22px;
        left: 8%;
        right: 8%;
        height: 4px;
        background: #e5e7eb;
        z-index: 1;
        border-radius: 4px;
    }
    .progress-line-fill {
        position: absolute;
        top: 22px;
        left: 8%;
        height: 4px;
        background: var(--primary-brand);
        z-index: 2;
        border-radius: 4px;
        transition: width 0.5s ease;
    }
    .progress-line-fill.cancel-line {
        background: #ef4444;
    }

    .tracker-step {
        position: relative;
        z-index: 3;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .step-icon-box {
        width: 46px;
        height: 46px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid #e5e7eb;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        margin-bottom: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .tracker-step.completed .step-icon-box {
        background: #10b981;
        border-color: #10b981;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .tracker-step.active .step-icon-box {
        background: var(--primary-brand);
        border-color: #ffffff;
        color: #ffffff;
        box-shadow: 0 0 0 4px var(--primary-brand-light), 0 4px 12px rgba(0, 0, 0, 0.15);
        animation: pulse-ring 2s infinite;
    }

    @keyframes pulse-ring {
        0% { box-shadow: 0 0 0 0px var(--primary-brand-light), 0 4px 12px rgba(0, 0, 0, 0.15); }
        70% { box-shadow: 0 0 0 10px rgba(0, 0, 0, 0), 0 4px 12px rgba(0, 0, 0, 0.15); }
        100% { box-shadow: 0 0 0 0px rgba(0, 0, 0, 0), 0 4px 12px rgba(0, 0, 0, 0.15); }
    }

    /* Cancel Flow Step Colors */
    .tracker-step.cancel-active .step-icon-box {
        background: #ef4444;
        border-color: #ffffff;
        color: #ffffff;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.2);
    }

    .tracker-step.cancel-completed .step-icon-box {
        background: #f87171;
        border-color: #f87171;
        color: #ffffff;
    }

    .step-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #4b566b;
        margin-bottom: 2px;
    }
    .tracker-step.active .step-title,
    .tracker-step.completed .step-title {
        color: #111827;
        font-weight: 700;
    }
    .tracker-step.cancel-active .step-title {
        color: #ef4444;
        font-weight: 700;
    }

    .step-subtext {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    /* Delhivery Tracking Box */
    .delhivery-box {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 24px;
        margin-bottom: 24px;
    }

    .delhivery-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding-bottom: 16px;
        border-bottom: 1px solid #e5e7eb;
        margin-bottom: 20px;
    }

    .delhivery-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #111827;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .delhivery-awb {
        background: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 4px 10px;
        font-family: monospace;
        font-size: 0.875rem;
        color: #374151;
        font-weight: 600;
    }

    .copy-btn {
        background: none;
        border: none;
        color: #6b7280;
        cursor: pointer;
        padding: 2px 6px;
        border-radius: 4px;
        transition: color 0.2s;
    }
    .copy-btn:hover {
        color: var(--primary-brand);
    }

    /* Courier Scan Vertical Timeline */
    .scan-timeline {
        position: relative;
        padding-left: 24px;
    }
    .scan-timeline::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e5e7eb;
    }

    .scan-node {
        position: relative;
        margin-bottom: 20px;
    }
    .scan-node:last-child {
        margin-bottom: 0;
    }

    .scan-dot-icon {
        position: absolute;
        left: -24px;
        top: 2px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid #9ca3af;
        z-index: 2;
    }

    .scan-node:first-child .scan-dot-icon {
        border-color: var(--primary-brand);
        background: var(--primary-brand);
        box-shadow: 0 0 0 3px var(--primary-brand-light);
    }

    .scan-content {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        padding: 14px 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
    }

    .scan-desc {
        font-weight: 600;
        font-size: 0.9375rem;
        color: #1f2937;
    }
    .scan-loc {
        font-size: 0.8125rem;
        color: #6b7280;
        margin-top: 2px;
    }
    .scan-time {
        font-size: 0.8125rem;
        color: #6b7280;
        font-weight: 500;
        background: #f3f4f6;
        padding: 4px 10px;
        border-radius: 6px;
    }

    /* Content Cards */
    .content-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .card-head {
        padding: 18px 24px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-head-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-body-custom {
        padding: 24px;
    }

    /* Product Item row */
    .prod-item-row {
        display: flex;
        align-items: center;
        gap: 16px;
        padding-bottom: 16px;
        margin-bottom: 16px;
        border-bottom: 1px solid #f3f4f6;
    }
    .prod-item-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
        margin-bottom: 0;
    }

    .prod-img-wrap {
        width: 76px;
        height: 76px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        flex-shrink: 0;
        background: #f9fafb;
    }
    .prod-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .prod-info-box {
        flex: 1;
        min-width: 0;
    }

    .prod-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: #111827;
        text-decoration: none !important;
        margin-bottom: 4px;
        display: block;
        line-height: 1.4;
    }
    .prod-name:hover {
        color: var(--primary-brand);
    }

    .prod-meta {
        font-size: 0.8125rem;
        color: #6b7280;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .prod-price-box {
        text-align: right;
        flex-shrink: 0;
    }
    .prod-price-total {
        font-size: 1rem;
        font-weight: 700;
        color: #111827;
    }
    .prod-price-qty {
        font-size: 0.8125rem;
        color: #6b7280;
    }

    /* Summary Table Styling */
    .summary-table {
        width: 100%;
        margin-bottom: 0;
    }
    .summary-table td {
        padding: 8px 0;
        font-size: 0.9rem;
        color: #4b566b;
    }
    .summary-table td:last-child {
        text-align: right;
        font-weight: 600;
        color: #1f2937;
    }
    .summary-table tr.grand-total-row td {
        padding-top: 14px;
        border-top: 2px dashed #e5e7eb;
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
    }
    .summary-table tr.grand-total-row td:last-child {
        color: var(--primary-brand);
        font-size: 1.25rem;
    }

    /* Info Block */
    .info-block-label {
        font-size: 0.8125rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #9ca3af;
        margin-bottom: 6px;
    }
    .info-block-val {
        font-size: 0.9375rem;
        color: #1f2937;
        font-weight: 500;
        line-height: 1.5;
    }

    @media (max-width: 767.98px) {
        .order-header-card { padding: 18px; }
        .order-header-actions { margin-top: 16px; width: 100%; display: flex; gap: 8px; }
        .order-header-actions a, .order-header-actions button { flex: 1; justify-content: center; }
        .tracker-card { padding: 24px 12px; }
        .step-title { font-size: 0.75rem; }
        .step-icon-box { width: 38px; height: 38px; font-size: 0.95rem; }
        .prod-item-row { flex-wrap: wrap; }
        .prod-price-box { text-align: left; margin-top: 4px; width: 100%; }
        .progress-line-bg, .progress-line-fill { top: 18px; }
    }
</style>
@endpush

@section('content')

@php
    $order_details_list = \App\Model\OrderDetail::where('order_id', $orderDetails->id)->get();

    $sub_total = 0;
    $total_tax = 0;
    $total_discount_on_product = 0;

    $is_cancel_flow = in_array($orderDetails->order_status, ['canceled', 'returned', 'failed']);

    if ($is_cancel_flow) {
        $statuses = ['pending', 'confirmed', 'processing', 'canceled', 'refund'];
        $labels = ['Ordered', 'Confirmed', 'Processing', 'Cancelled', 'Refund'];

        if ($orderDetails->order_status == 'returned') {
            $statuses = ['pending', 'confirmed', 'processing', 'returned', 'refund'];
            $labels = ['Ordered', 'Confirmed', 'Processing', 'Returned', 'Refund'];
        } elseif ($orderDetails->order_status == 'failed') {
            $statuses = ['pending', 'confirmed', 'processing', 'failed', 'refund'];
            $labels = ['Ordered', 'Confirmed', 'Processing', 'Failed', 'Refund'];
        }

        $current_status_index = array_search($orderDetails->order_status, $statuses);
        if ($current_status_index === false) {
            $current_status_index = 3;
        }
    } else {
        $statuses = ['pending', 'confirmed', 'processing', 'out_for_delivery', 'delivered'];
        $labels = ['Order Placed', 'Confirmed', 'Processing', 'Out for Delivery', 'Delivered'];

        $current_status_index = array_search($orderDetails->order_status, $statuses);
        if ($current_status_index === false) {
            $current_status_index = 0;
        }
    }

    $step_icons = [
        'pending' => 'fa-shopping-bag',
        'confirmed' => 'fa-check-circle',
        'processing' => 'fa-cogs',
        'out_for_delivery' => 'fa-truck',
        'delivered' => 'fa-home',
        'canceled' => 'fa-times-circle',
        'returned' => 'fa-undo',
        'failed' => 'fa-exclamation-triangle',
        'refund' => 'fa-hand-holding-usd'
    ];

    $progress_percentage = count($statuses) > 1 ? ($current_status_index / (count($statuses) - 1)) * 100 : 0;

    $show_delhivery = false;
    $show_tracking_error = false;
    $shipment = null;
    $scans = [];
    $tracking_error_msg = '';

    if (isset($tracking_info) && isset($tracking_info['status']) && $tracking_info['status'] == 'success' && isset($tracking_info['data']['ShipmentData'][0]['Shipment'])) {
        $show_delhivery = true;
        $shipment = $tracking_info['data']['ShipmentData'][0]['Shipment'];
        $scans = isset($shipment['Scans']) ? array_reverse($shipment['Scans']) : [];
    } elseif (isset($tracking_info) && isset($tracking_info['status']) && $tracking_info['status'] == 'error') {
        $show_tracking_error = true;
        $tracking_error_msg = $tracking_info['message'] ?? 'Unable to retrieve third-party courier data.';
    }

    $shipping_address_obj = null;
    if ($orderDetails->shippingAddress) {
        $shipping_address_obj = $orderDetails->shippingAddress;
    } elseif (!empty($orderDetails->shipping_address_data)) {
        $shipping_address_obj = is_string($orderDetails->shipping_address_data) ? json_decode($orderDetails->shipping_address_data) : $orderDetails->shipping_address_data;
    }
@endphp

<div class="container py-4 py-md-5 track-res-container" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">

    <!-- Order Header Card -->
    <div class="order-header-card">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="d-flex align-items-center gap-3 flex-wrap mb-1">
                    <h1 class="order-id-title mb-0">{{\App\CPU\translate('Order')}} #{{ $orderDetails->id }}</h1>
                    <span class="status-badge status-badge-{{ $orderDetails->order_status }}">
                        <i class="fa {{ $step_icons[$orderDetails->order_status] ?? 'fa-info-circle' }}"></i>
                        {{ str_replace('_', ' ', $orderDetails->order_status) }}
                    </span>
                    @if($orderDetails->payment_status == 'paid')
                        <span class="payment-badge payment-paid">
                            <i class="fa fa-check-circle"></i> {{\App\CPU\translate('Paid')}}
                        </span>
                    @else
                        <span class="payment-badge payment-unpaid">
                            <i class="fa fa-clock-o"></i> {{\App\CPU\translate('Unpaid')}}
                        </span>
                    @endif
                </div>
                <div class="order-date-text">
                    <i class="fa fa-calendar mr-1"></i>
                    {{\App\CPU\translate('Placed on')}}: {{ date('d M, Y - h:i A', strtotime($orderDetails->created_at)) }}
                    @if($orderDetails->expected_delivery_date)
                        <span class="mx-2">•</span>
                        <i class="fa fa-truck mr-1 text-primary"></i>
                        {{\App\CPU\translate('Expected Delivery')}}: <strong>{{ date('d M, Y', strtotime($orderDetails->expected_delivery_date)) }}</strong>
                    @endif
                </div>
            </div>

            <div class="order-header-actions d-flex gap-2">
                <a href="{{ route('track-order.index') }}" class="btn-action-outline">
                    <i class="fa fa-search"></i>
                    {{\App\CPU\translate('Track Another Order')}}
                </a>
                @if(auth('customer')->check())
                    <a href="{{ route('generate-invoice', [$orderDetails->id]) }}" class="btn-action-primary" target="_blank">
                        <i class="fa fa-file-text-o"></i>
                        {{\App\CPU\translate('Invoice')}}
                    </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Progress Tracker Card -->
    <div class="tracker-card">
        <div class="progress-tracker-wrap">
            <div class="progress-line-bg"></div>
            <div class="progress-line-fill {{ $is_cancel_flow ? 'cancel-line' : '' }}" style="width: {{ $progress_percentage }}%;"></div>

            @foreach($statuses as $index => $status)
                @php
                    $stepClass = '';
                    if ($is_cancel_flow) {
                        if ($index < $current_status_index) {
                            $stepClass = 'cancel-completed';
                        } elseif ($index == $current_status_index) {
                            $stepClass = 'cancel-active';
                        }
                    } else {
                        if ($index < $current_status_index) {
                            $stepClass = 'completed';
                        } elseif ($index == $current_status_index) {
                            $stepClass = 'active';
                        }
                    }
                    $label = $labels[$index] ?? str_replace('_', ' ', $status);
                    $icon = $step_icons[$status] ?? 'fa-circle';
                @endphp

                <div class="tracker-step {{ $stepClass }}">
                    <div class="step-icon-box">
                        @if($index < $current_status_index)
                            <i class="fa fa-check"></i>
                        @else
                            <i class="fa {{ $icon }}"></i>
                        @endif
                    </div>
                    <div class="step-title">{{ $label }}</div>
                    <div class="step-subtext">Step 0{{ $index + 1 }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Third Party Tracking (Delhivery) -->
    @if($show_delhivery)
        <div class="delhivery-box">
            <div class="delhivery-header">
                <div class="delhivery-title">
                    <i class="fa fa-truck text-primary" style="font-size: 1.3rem;"></i>
                    {{\App\CPU\translate('Delhivery Live Courier Status')}}
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">{{\App\CPU\translate('AWB Tracking ID')}}:</span>
                    <span class="delhivery-awb" id="awbCode">{{ $orderDetails->third_party_delivery_tracking_id }}</span>
                    <button class="copy-btn" onclick="copyAWB()" title="Copy AWB">
                        <i class="fa fa-clone"></i>
                    </button>
                    <span class="badge badge-info px-3 py-2 ml-2" style="font-size: 0.85rem; font-weight: 600;">
                        {{ $shipment['Status']['Status'] ?? 'In Transit' }}
                    </span>
                </div>
            </div>

            @if(count($scans) > 0)
                <div class="scan-timeline">
                    @foreach($scans as $scan)
                        @php
                            $instructions = $scan['ScanDetail']['Instructions'] ?? ($scan['ScanDetail']['Status'] ?? '');
                            $location = $scan['ScanDetail']['ScannedLocation'] ?? '';
                            $dateTime = isset($scan['ScanDetail']['ScanDateTime']) ? date('d M Y, h:i A', strtotime($scan['ScanDetail']['ScanDateTime'])) : '';
                        @endphp
                        <div class="scan-node">
                            <div class="scan-dot-icon"></div>
                            <div class="scan-content">
                                <div>
                                    <div class="scan-desc">{{ $instructions }}</div>
                                    @if($location)
                                        <div class="scan-loc"><i class="fa fa-map-marker text-danger mr-1"></i> {{ $location }}</div>
                                    @endif
                                </div>
                                @if($dateTime)
                                    <div class="scan-time"><i class="fa fa-clock-o mr-1"></i> {{ $dateTime }}</div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    @if($show_tracking_error)
        <div class="alert alert-warning border-0 shadow-sm rounded-12 p-3 mb-4 d-flex align-items-center gap-3">
            <i class="fa fa-exclamation-triangle font-size-xl text-warning"></i>
            <div>
                <strong>{{\App\CPU\translate('Courier Tracking Note')}}:</strong> {{ $tracking_error_msg }}
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Main Details (Left 8 Cols) -->
        <div class="col-lg-8">
            <!-- Ordered Items Card -->
            <div class="content-card">
                <div class="card-head">
                    <h3 class="card-head-title">
                        <i class="fa fa-shopping-basket text-primary"></i>
                        {{\App\CPU\translate('Order Items')}} ({{ count($order_details_list) }})
                    </h3>
                </div>
                <div class="card-body-custom">
                    @foreach($order_details_list as $product)
                        @php
                            $slug = '';
                            $name = '';
                            $thumbnail = '';

                            $details = \App\Model\Product::find($product->product_id);

                            if ($details) {
                                $slug = $details->slug ?? '';
                                $name = $details->name ?? '';
                                $thumbnail = $details->thumbnail ?? '';
                            } elseif (!empty($product->product_details)) {
                                $json = json_decode($product->product_details, true);
                                $slug = $json['slug'] ?? '';
                                $name = $json['name'] ?? '';
                                $thumbnail = $json['thumbnail'] ?? '';
                            }

                            $img_path = \App\CPU\ProductManager::product_image_path('thumbnail') . '/' . $thumbnail;
                            $placeholder = asset('assets/front-end/img/image-place-holder.png');
                            $product_url = route('product', $slug);

                            $item_subtotal = $product->price * $product->qty;
                            $sub_total += $item_subtotal;
                            $total_tax += $product->tax;
                            $total_discount_on_product += $product->discount;
                            $variations = !empty($product->variation) ? json_decode($product->variation, true) : null;
                        @endphp

                        <div class="prod-item-row">
                            <div class="prod-img-wrap">
                                <a href="{{ $product_url }}">
                                    <img src="{{ $img_path }}" onerror="this.src='{{ $placeholder }}'" alt="{{ $name }}">
                                </a>
                            </div>

                            <div class="prod-info-box">
                                <a href="{{ $product_url }}" class="prod-name">{{ $name }}</a>

                                <div class="prod-meta">
                                    <span>{{\App\CPU\translate('Unit Price')}}: <strong>{{ \App\CPU\Helpers::currency_converter($product->price) }}</strong></span>

                                    @if(is_array($variations))
                                        @foreach($variations as $key => $variation)
                                            <span>{{ ucfirst($key) }}: <strong>{{ $variation }}</strong></span>
                                        @endforeach
                                    @endif

                                    @if($product->tax > 0)
                                        <span>{{\App\CPU\translate('Tax')}}: {{ \App\CPU\Helpers::currency_converter($product->tax) }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="prod-price-box">
                                <div class="prod-price-total">{{ \App\CPU\Helpers::currency_converter($item_subtotal) }}</div>
                                <div class="prod-price-qty">{{\App\CPU\translate('Qty')}}: {{ $product->qty }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Delivery & Payment Information Card -->
            <div class="content-card">
                <div class="card-head">
                    <h3 class="card-head-title">
                        <i class="fa fa-map-marker text-primary"></i>
                        {{\App\CPU\translate('Delivery & Shipping Details')}}
                    </h3>
                </div>
                <div class="card-body-custom">
                    <div class="row g-4">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-block-label">{{\App\CPU\translate('Shipping Address')}}</div>
                            <div class="info-block-val">
                                @if($shipping_address_obj)
                                    <strong>{{ $shipping_address_obj->contact_person_name ?? '' }}</strong><br>
                                    {{ $shipping_address_obj->address ?? '' }}<br>
                                    {{ $shipping_address_obj->city ?? '' }}, {{ $shipping_address_obj->zip ?? '' }}<br>
                                    @if(isset($shipping_address_obj->phone))
                                        <i class="fa fa-phone text-muted mr-1"></i> {{ $shipping_address_obj->phone }}
                                    @endif
                                @else
                                    <span class="text-muted">{{\App\CPU\translate('No shipping address available')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-block-label">{{\App\CPU\translate('Payment Method')}}</div>
                            <div class="info-block-val mb-3">
                                <span class="text-capitalize font-weight-bold">
                                    {{ str_replace('_', ' ', $orderDetails->payment_method ?? 'N/A') }}
                                </span>
                            </div>

                            @if($orderDetails->delivery_service_name)
                                <div class="info-block-label">{{\App\CPU\translate('Courier Service')}}</div>
                                <div class="info-block-val">
                                    {{ $orderDetails->delivery_service_name }}
                                </div>
                            @endif

                            @if($orderDetails->order_note)
                                <div class="info-block-label mt-3">{{\App\CPU\translate('Order Note')}}</div>
                                <div class="info-block-val text-muted small bg-light p-2 rounded">
                                    {{ $orderDetails->order_note }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Summary (Right 4 Cols) -->
        <div class="col-lg-4">
            @php
                $shipping_cost = $orderDetails->shipping_cost ?? 0;

                $extra_discount = 0;
                if ($orderDetails->extra_discount_type == 'percent') {
                    $extra_discount = ($sub_total / 100) * $orderDetails->extra_discount;
                } else {
                    $extra_discount = $orderDetails->extra_discount ?? 0;
                }

                $coupon_discount = $orderDetails->discount_amount ?? 0;

                $grand_total = $sub_total + $total_tax + $shipping_cost - $total_discount_on_product - $coupon_discount - $extra_discount;
            @endphp

            <div class="content-card">
                <div class="card-head">
                    <h3 class="card-head-title">
                        <i class="fa fa-calculator text-primary"></i>
                        {{\App\CPU\translate('Order Summary')}}
                    </h3>
                </div>
                <div class="card-body-custom">
                    <table class="summary-table">
                        <tr>
                            <td>{{\App\CPU\translate('Subtotal')}}</td>
                            <td>{{ \App\CPU\Helpers::currency_converter($sub_total) }}</td>
                        </tr>
                        <tr>
                            <td>{{\App\CPU\translate('Tax Fee')}}</td>
                            <td>{{ \App\CPU\Helpers::currency_converter($total_tax) }}</td>
                        </tr>
                        <tr>
                            <td>{{\App\CPU\translate('Shipping Fee')}}</td>
                            <td>{{ \App\CPU\Helpers::currency_converter($shipping_cost) }}</td>
                        </tr>
                        @if($total_discount_on_product > 0)
                            <tr>
                                <td>{{\App\CPU\translate('Product Discount')}}</td>
                                <td class="text-success">- {{ \App\CPU\Helpers::currency_converter($total_discount_on_product) }}</td>
                            </tr>
                        @endif
                        @if($coupon_discount > 0)
                            <tr>
                                <td>{{\App\CPU\translate('Coupon Discount')}}</td>
                                <td class="text-success">- {{ \App\CPU\Helpers::currency_converter($coupon_discount) }}</td>
                            </tr>
                        @endif
                        @if($extra_discount > 0)
                            <tr>
                                <td>{{\App\CPU\translate('Extra Discount')}}</td>
                                <td class="text-success">- {{ \App\CPU\Helpers::currency_converter($extra_discount) }}</td>
                            </tr>
                        @endif
                        <tr class="grand-total-row">
                            <td>{{\App\CPU\translate('Grand Total')}}</td>
                            <td>{{ \App\CPU\Helpers::currency_converter($grand_total) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Help & Support Box -->
            <div class="content-card bg-light border-0">
                <div class="card-body-custom text-center py-4">
                    <div class="mb-2">
                        <i class="fa fa-headphones text-primary" style="font-size: 2.2rem;"></i>
                    </div>
                    <h5 class="font-weight-bold mb-1">{{\App\CPU\translate('Need help with your order?')}}</h5>
                    <p class="text-muted small mb-3">{{\App\CPU\translate('If you have any questions or concerns regarding your shipment, feel free to contact our support team.')}}</p>
                    <a href="{{ route('contacts') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4">
                        <i class="fa fa-envelope-o mr-1"></i> {{\App\CPU\translate('Contact Support')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    function copyAWB() {
        var awbText = document.getElementById('awbCode').innerText;
        navigator.clipboard.writeText(awbText).then(function() {
            if (typeof toastr !== 'undefined') {
                toastr.success('{{\App\CPU\translate("AWB Code copied to clipboard!")}}');
            } else {
                alert('AWB Code copied to clipboard!');
            }
        });
    }
</script>
@endpush
