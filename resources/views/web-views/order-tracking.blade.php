@extends('layouts.front-end.app')

@section('title', 'Track Order')

@push('css_or_js')
<style>
    .order-tracking-steps {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
        position: relative;
    }
    .order-tracking-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 5%;
        right: 5%;
        height: 3px;
        background-color: #e3e9ef;
        z-index: 0;
    }
    .step {
        position: relative;
        z-index: 1;
        text-align: center;
        width: 20%;
    }
    .step-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e3e9ef;
        color: #4b566b;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 10px;
        font-weight: bold;
        transition: all 0.3s ease;
        border: 2px solid #fff;
    }
    .step.active .step-icon {
        background-color: var(--primary-color, #fe9b2c);
        color: #fff;
        box-shadow: 0 0 0 5px rgba(254, 155, 44, 0.2);
    }
    .step.completed .step-icon {
        background-color: #10b981;
        color: #fff;
    }
    .step-label {
        font-size: 13px;
        font-weight: 500;
        color: #4b566b;
    }
    .step.active .step-label {
        color: var(--primary-color, #fe9b2c);
        font-weight: 700;
    }

    /* Cancel/Return flow styles */
    .step.cancel-active .step-icon {
        background-color: #ef4444;
        color: #fff;
        box-shadow: 0 0 0 5px rgba(239, 68, 68, 0.2);
    }
    .step.cancel-active .step-label {
        color: #ef4444;
        font-weight: 700;
    }
    .step.cancel-completed .step-icon {
        background-color: #f87171;
        color: #fff;
    }

    .delhivery-card {
        background: #f8fafc;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        border-left: 5px solid #fe9b2c;
    }
    .scan-item {
        position: relative;
        padding-left: 25px;
        padding-bottom: 20px;
        border-left: 1px dashed #cbd5e1;
    }
    .scan-item:last-child {
        border-left: none;
        padding-bottom: 0;
    }
    .scan-dot {
        position: absolute;
        left: -6px;
        top: 0;
        width: 11px;
        height: 11px;
        border-radius: 50%;
        background: #fe9b2c;
    }
</style>
@endpush

@section('content')

@php
    $order = \App\Model\OrderDetail::where('order_id', $orderDetails->id)->get();

    $sub_total = 0;
    $total_tax = 0;
    $total_discount_on_product = 0;

    // Check if order is in cancel/return/failed flow
    $is_cancel_flow = in_array($orderDetails->order_status, ['canceled', 'returned', 'failed']);

    if ($is_cancel_flow) {
        // Cancel flow: 5 steps
        $statuses = ['pending', 'confirmed', 'processing', 'canceled', 'refund'];
        $labels = ['Ordered', 'Confirmed', 'Processing', 'Cancelled', 'Refund'];

        if ($orderDetails->order_status == 'returned') {
            $statuses = ['pending', 'confirmed', 'processing', 'returned', 'refund'];
            $labels = ['Ordered', 'Confirmed', 'Processing', 'Returned', 'Refund'];
        } elseif ($orderDetails->order_status == 'failed') {
            $statuses = ['pending', 'confirmed', 'processing', 'failed', 'refund'];
            $labels = ['Ordered', 'Confirmed', 'Processing', 'Failed', 'Refund'];
        }

        // For cancel flow, mark up to the cancel/return step as current
        $current_status_index = array_search($orderDetails->order_status, $statuses);
        if ($current_status_index === false) {
            $current_status_index = 3;
        }
    } else {
        // Normal delivery flow: 5 steps
        $statuses = ['pending', 'confirmed', 'processing', 'out_for_delivery', 'delivered'];
        $labels = ['Ordered', 'Confirmed', 'Processing', 'Out for Delivery', 'Delivered'];

        $current_status_index = array_search($orderDetails->order_status, $statuses);
        if ($current_status_index === false) {
            $current_status_index = 0;
        }
    }

    $show_delhivery = false;
    $show_tracking_error = false;
    $shipment = null;
    $scans = [];
    $tracking_error_msg = '';
 
    if (isset($tracking_info) && $tracking_info['status'] == 'success' && isset($tracking_info['data']['ShipmentData'][0]['Shipment'])) {
        $show_delhivery = true;
        $shipment = $tracking_info['data']['ShipmentData'][0]['Shipment'];
        $scans = isset($shipment['Scans']) ? array_reverse($shipment['Scans']) : [];
    } elseif (isset($tracking_info) && $tracking_info['status'] == 'error') {
        $show_tracking_error = true;
        $tracking_error_msg = $tracking_info['message'];
    }
@endphp

<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <h3 class="mb-4">Order ID: #{{ $orderDetails->id }}</h3>

            <!-- Tracking Steps -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body py-5">
                    <div class="order-tracking-steps">
                        @php
                            foreach($statuses as $index => $status) {
                                $stepClass = '';
                                if ($is_cancel_flow) {
                                    // Cancel flow styling
                                    if ($index < $current_status_index) {
                                        $stepClass = 'cancel-completed';
                                    } elseif ($index == $current_status_index) {
                                        $stepClass = 'cancel-active';
                                    }
                                } else {
                                    // Normal delivery flow
                                    if ($index < $current_status_index) {
                                        $stepClass = 'completed';
                                    } elseif ($index == $current_status_index) {
                                        $stepClass = 'active';
                                    }
                                }

                                $label = $labels[$index] ?? str_replace('_', ' ', $status);

                                echo '<div class="step ' . $stepClass . '">';
                                echo '<div class="step-icon">';
                                if ($is_cancel_flow && $index == $current_status_index && in_array($status, ['canceled', 'returned', 'failed'])) {
                                    echo '<i class="fa fa-times"></i>';
                                } elseif ($index < $current_status_index) {
                                    echo '<i class="fa fa-check"></i>';
                                } else {
                                    echo ($index + 1);
                                }
                                echo '</div>';
                                echo '<div class="step-label">' . $label . '</div>';
                                echo '</div>';
                            }
                        @endphp
                    </div>
                </div>
            </div>

            @if($show_delhivery)
                <div class="delhivery-card shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0 text-primary">Delhivery Shipment Tracking</h5>
                        <span class="badge badge-info px-3 py-2" style="font-size: 14px;">{{ $shipment['Status']['Status'] }}</span>
                    </div>
                    <p class="mb-3"><strong>Waybill:</strong> {{ $orderDetails->third_party_delivery_tracking_id }}</p>

                    @if(count($scans) > 0)
                        <div class="mt-4">
                            <h6 class="mb-3">Tracking History</h6>
                            @php
                                foreach($scans as $scan) {
                                    $instructions = $scan['ScanDetail']['Instructions'] ?? ($scan['ScanDetail']['Status'] ?? '');
                                    $location = $scan['ScanDetail']['ScannedLocation'] ?? '';
                                    $dateTime = isset($scan['ScanDetail']['ScanDateTime']) ? date('d M Y, h:i A', strtotime($scan['ScanDetail']['ScanDateTime'])) : '';

                                    echo '<div class="scan-item">';
                                    echo '<div class="scan-dot"></div>';
                                    echo '<div class="d-flex justify-content-between">';
                                    echo '<div>';
                                    echo '<div class="font-weight-bold">' . e($instructions) . '</div>';
                                    echo '<div class="text-muted small">' . e($location) . '</div>';
                                    echo '</div>';
                                    echo '<div class="text-right small text-muted">' . $dateTime . '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                            @endphp
                        </div>
                    @endif
                </div>
            @endif

            @if($show_tracking_error)
                <div class="alert alert-warning">
                    Tracking information is currently unavailable: {{ $tracking_error_msg }}
                </div>
            @endif

        </div>
    </div>

    @php
        foreach ($order as $product) {
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
            $placeholder = asset('public/assets/front-end/img/image-place-holder.png');
            $product_url = route('product', $slug);

            echo '<div class="d-flex justify-content-between border-bottom mb-3 pb-3">';

            echo '<div>';
            echo '<a href="' . $product_url . '">';
            echo '<img src="' . $img_path . '" onerror="this.src=\'' . $placeholder . '\'" width="80">';
            echo '</a>';
            echo '</div>';

            echo '<div>';
            echo '<h5>' . e($name) . '</h5>';

            if (!empty($product->variation)) {
                $variations = json_decode($product->variation, true);
                if (is_array($variations)) {
                    foreach ($variations as $key => $variation) {
                        echo '<div>' . e($key) . ' : ' . e($variation) . '</div>';
                    }
                }
            }

            echo '<div>' . \App\CPU\Helpers::currency_converter($product->price) . '</div>';
            echo '</div>';

            echo '<div>Qty: ' . $product->qty . '</div>';
            echo '<div>Tax: ' . \App\CPU\Helpers::currency_converter($product->tax) . '</div>';
            echo '<div>Subtotal: ' . \App\CPU\Helpers::currency_converter($product->price * $product->qty) . '</div>';

            echo '</div>';

            $sub_total += $product->price * $product->qty;
            $total_tax += $product->tax;
            $total_discount_on_product += $product->discount;
        }
    @endphp

    @php
        $shipping = $orderDetails->shipping_cost ?? 0;

        $extra_discount = 0;
        if ($orderDetails->extra_discount_type == 'percent') {
            $extra_discount = ($sub_total / 100) * $orderDetails->extra_discount;
        } else {
            $extra_discount = $orderDetails->extra_discount ?? 0;
        }

        $coupon_discount = $orderDetails->discount_amount ?? 0;

        $total = $sub_total + $total_tax + $shipping
            - $total_discount_on_product
            - $coupon_discount
            - $extra_discount;
    @endphp

    <hr>

    <div class="d-flex align-items-end flex-column">
        <div>
            <p>Subtotal: {{ \App\CPU\Helpers::currency_converter($sub_total) }}</p>
            <p>Tax: {{ \App\CPU\Helpers::currency_converter($total_tax) }}</p>
            <p>Shipping: {{ \App\CPU\Helpers::currency_converter($shipping) }}</p>
            <p>Discount: - {{ \App\CPU\Helpers::currency_converter($total_discount_on_product) }}</p>
            <p>Coupon: - {{ \App\CPU\Helpers::currency_converter($coupon_discount) }}</p>
            <p>Extra Discount: - {{ \App\CPU\Helpers::currency_converter($extra_discount) }}</p>

            <h4>Total: {{ \App\CPU\Helpers::currency_converter($total) }}</h4>
        </div>  
    </div>

</div>

@endsection