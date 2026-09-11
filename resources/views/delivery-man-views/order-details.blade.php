@extends('delivery-man-views.layouts.app')

@section('title', \App\CPU\translate('order_details') . ' #' . $order['id'])

@push('css_or_js')
    @if($order['payment_method'] == 'cash_on_delivery' && $order['payment_status'] == 'unpaid')
        <?php $stripe = \App\CPU\Helpers::get_business_settings('stripe'); ?>
        @if($stripe['status'] ?? false)
        <script src="https://js.stripe.com/v3/"></script>
        @endif
        <?php $razorpay = \App\CPU\Helpers::get_business_settings('razor_pay'); ?>
        @if($razorpay['status'] ?? false)
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        @endif
    @endif
@endpush

@section('content')

    {{-- Page Header --}}
    <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('delivery-man.orders') }}"
                class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
                <i class="tio-arrow-left"></i> {{ \App\CPU\translate('back') }}
            </a>
            <div>
                <h2 class="h4 mb-0">{{ \App\CPU\translate('order') }} #{{ $order['id'] }}</h2>
                <small class="text-muted">
                    <i class="tio-calendar-month"></i>
                    {{ $order['created_at']->format('d M Y, h:i A') }}
                </small>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2">
            <?php
                $statusColors = ['pending' => 'warning', 'confirmed' => 'info', 'processing' => 'primary', 'out_for_delivery' => 'secondary', 'delivered' => 'success', 'canceled' => 'danger', 'returned' => 'dark'];
                $sc = $statusColors[$order['order_status']] ?? 'dark';
            ?>
            <span class="badge badge-soft-{{ $sc }} fz-14 text-capitalize px-3 py-2">
                {{ ucwords(str_replace('_', ' ', $order['order_status'])) }}
            </span>
            @if ($order['payment_method'] == 'cash_on_delivery')
                <span class="badge badge-soft-warning fz-12 px-3 py-2">COD</span>
            @else
                <span class="badge badge-soft-success fz-12 px-3 py-2">
                    <i class="tio-checkmark-circle"></i> {{ \App\CPU\translate('paid') }}
                </span>
            @endif
        </div>
    </div>

    {{-- Order Timeline Progress --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <?php $steps = ['pending', 'confirmed', 'processing', 'out_for_delivery', 'delivered']; $currentStep = array_search($order['order_status'], $steps); if ($currentStep === false) $currentStep = -1; ?>
            <div class="d-flex align-items-center justify-content-between position-relative" style="padding: 0 10px;">
                {{-- Progress Line --}}
                <div class="position-absolute"
                    style="top:17px; left:10%; right:10%; height:3px; background:#e7eaf3; z-index:0;"></div>
                <?php $progressWidth = $currentStep >= 0 ? ($currentStep / (count($steps)-1)) * 100 : 0; ?>
                <div class="position-absolute"
                    style="top:17px; left:10%; width:{{ $progressWidth * 0.8 }}%; height:3px; background:linear-gradient(90deg,#377dff,#38cab3); z-index:1; transition: width .5s;">
                </div>

                @foreach ($steps as $idx => $step)
                    <?php $done = $currentStep >= $idx; ?>
                    <div class="d-flex flex-column align-items-center" style="z-index:2; flex:1;">
                        <div class="rounded-circle d-flex align-items-center justify-content-center font-weight-bold"
                            style="width:36px; height:36px; border:3px solid {{ $done ? '#377dff' : '#e7eaf3' }};
                            background:{{ $done ? '#377dff' : '#fff' }}; color:{{ $done ? '#fff' : '#aaa' }}; font-size:13px;">
                            @if ($done)
                                <i class="tio-checkmark-circle-outlined" style="font-size:16px;"></i>
                            @else
                                {{ $idx + 1 }}
                            @endif
                        </div>
                        <small class="mt-1 text-center {{ $done ? 'font-weight-bold text--primary' : 'text-muted' }}"
                            style="font-size:10px; max-width:70px; line-height:1.2;">
                            {{ ucwords(str_replace('_', ' ', $step)) }}
                        </small>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row g-3">

        {{-- LEFT COLUMN --}}
        <div class="col-lg-8">

            {{-- Order Items --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2 py-3">
                    <i class="tio-package text--primary"></i>
                    <h5 class="card-title mb-0">{{ \App\CPU\translate('order_items') }}</h5>
                    <span class="badge badge-soft-primary ml-auto">
                        {{ $order->details->count() }} {{ \App\CPU\translate('items') }}
                    </span>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-borderless mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="pl-4">#</th>
                                <th>{{ \App\CPU\translate('product') }}</th>
                                <th class="text-center">{{ \App\CPU\translate('qty') }}</th>
                                <th class="text-center">{{ \App\CPU\translate('unit_price') }}</th>
                                <th class="text-right pr-4">{{ \App\CPU\translate('total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $idx => $item)
                                <tr>
                                    <td class="pl-4 text-muted">{{ $idx + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <?php $thumb = $item->product ? ($item->product->thumbnail ?? null) : null; ?>
                                            <img src="{{ $thumb ? asset('storage/product/thumbnail/' . $thumb) : asset('assets/back-end/img/400x400/img2.jpg') }}"
                                                class="rounded" width="46" height="46" style="object-fit:cover;"
                                                onerror="this.src='{{ asset('assets/back-end/img/400x400/img2.jpg') }}'"
                                                alt="">
                                            <div>
                                                <div class="font-weight-bold text-dark" style="font-size:14px;">
                                                    {{ $item->product->name ?? 'Product' }}
                                                </div>
                                                @if ($item->variant)
                                                    <small class="text-muted">{{ $item->variant }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-soft-secondary px-3">×{{ $item->qty }}</span>
                                    </td>
                                    <td class="text-center text-muted">
                                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($item->price)) }}
                                    </td>
                                    <td class="text-right pr-4 font-weight-bold">
                                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($item->price * $item->qty)) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2 py-3">
                    <i class="tio-money text--primary"></i>
                    <h5 class="card-title mb-0">{{ \App\CPU\translate('order_summary') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-muted">{{ \App\CPU\translate('subtotal') }}</td>
                                    <td class="text-right">
                                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'] - ($order['shipping_cost'] ?? 0))) }}
                                    </td>
                                </tr>
                                @if (($order['shipping_cost'] ?? 0) > 0)
                                    <tr>
                                        <td class="text-muted">{{ \App\CPU\translate('shipping') }}</td>
                                        <td class="text-right">
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['shipping_cost'])) }}
                                        </td>
                                    </tr>
                                @endif
                                @if (($order['discount_amount'] ?? 0) > 0)
                                    <tr>
                                        <td class="text-success">{{ \App\CPU\translate('discount') }}</td>
                                        <td class="text-right text-success">
                                            -{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['discount_amount'])) }}
                                        </td>
                                    </tr>
                                @endif
                                <tr class="border-top">
                                    <td class="font-weight-bold">{{ \App\CPU\translate('total') }}</td>
                                    <td class="text-right font-weight-bold text--primary" style="font-size:16px;">
                                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}
                                    </td>
                                </tr>
                                @if (($order['deliveryman_charge'] ?? 0) > 0)
                                    <tr>
                                        <td class="text-success font-weight-bold">
                                            <i class="tio-wallet"></i> {{ \App\CPU\translate('my_earning') }}
                                        </td>
                                        <td class="text-right text-success font-weight-bold">
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['deliveryman_charge'])) }}
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Info --}}
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2 py-3">
                    <i class="tio-info text--primary"></i>
                    <h5 class="card-title mb-0">{{ \App\CPU\translate('order_info') }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-muted" width="140">{{ \App\CPU\translate('order_id') }}</td>
                                    <td class="font-weight-bold">#{{ $order['id'] }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{ \App\CPU\translate('order_date') }}</td>
                                    <td>{{ $order['created_at']->format('d M Y, h:i A') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{ \App\CPU\translate('payment_method') }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $order['payment_method'])) }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">{{ \App\CPU\translate('payment_status') }}</td>
                                    <td>
                                        <span
                                            class="badge badge-soft-{{ $order['payment_status'] == 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order['payment_status']) }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td class="text-muted" width="160">{{ \App\CPU\translate('delivery_charge') }}</td>
                                    <td class="font-weight-bold text-success">
                                        {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['deliveryman_charge'] ?? 0)) }}
                                    </td>
                                </tr>
                                @if ($order['expected_delivery_date'])
                                    <tr>
                                        <td class="text-muted">{{ \App\CPU\translate('expected_delivery') }}</td>
                                        <td>{{ $order['expected_delivery_date'] }}</td>
                                    </tr>
                                @endif
                                @if ($order['order_note'])
                                    <tr>
                                        <td class="text-muted">{{ \App\CPU\translate('note') }}</td>
                                        <td class="text-info">{{ $order['order_note'] }}</td>
                                    </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">

            {{-- Customer Info --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2 py-3">
                    <i class="tio-user text--primary"></i>
                    <h5 class="card-title mb-0">{{ \App\CPU\translate('customer_info') }}</h5>
                </div>
                <div class="card-body">
                    @if ($order->customer)
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <img class="rounded-circle"
                                src="{{ asset(config('app.public_storage_path') . '/profile/' . ($order->customer->image ?? 'def.png')) }}"
                                onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                width="52" height="52" style="object-fit:cover;" alt="">
                            <div>
                                <div class="font-weight-bold text-dark">
                                    {{ $order->customer->f_name }} {{ $order->customer->l_name }}
                                </div>
                                <small class="text-muted">
                                    {{ \App\Model\Order::where('customer_id', $order->customer_id)->count() }}
                                    {{ \App\CPU\translate('orders') }}
                                </small>
                            </div>
                        </div>
                        <div class="d-flex flex-column gap-2">
                            @if ($order->customer->phone)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="btn btn-xs btn-soft-secondary"
                                        style="padding:4px 8px; pointer-events:none;">
                                        <i class="tio-phone"></i>
                                    </span>
                                    <a href="tel:{{ $order->customer->phone }}" class="text-dark">
                                        {{ $order->customer->phone }}
                                    </a>
                                </div>
                            @endif
                            @if ($order->customer->email)
                                <div class="d-flex align-items-center gap-2">
                                    <span class="btn btn-xs btn-soft-secondary"
                                        style="padding:4px 8px; pointer-events:none;">
                                        <i class="tio-email"></i>
                                    </span>
                                    <span class="text-muted" style="font-size:13px; word-break:break-all;">
                                        {{ $order->customer->email }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @elseif($order->billingAddress)
                        <div class="font-weight-bold text-dark mb-2">
                            {{ $order->billingAddress->contact_person_name ?? 'N/A' }}
                        </div>
                        @if ($order->billingAddress->phone)
                            <div class="d-flex align-items-center gap-2">
                                <i class="tio-phone text-muted"></i>
                                <a href="tel:{{ $order->billingAddress->phone }}">
                                    {{ $order->billingAddress->phone }}
                                </a>
                            </div>
                        @endif
                    @else
                        <p class="text-muted mb-0">{{ \App\CPU\translate('no_customer_found') }}</p>
                    @endif
                </div>
            </div>

            {{-- Shipping Address --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2 py-3">
                    <i class="tio-location text--primary"></i>
                    <h5 class="card-title mb-0">{{ \App\CPU\translate('shipping_address') }}</h5>
                </div>
                <div class="card-body">
                    @if ($order->shippingAddress)
                        <div class="d-flex flex-column gap-2">
                            @if ($order->shippingAddress->contact_person_name)
                                <div class="font-weight-bold text-dark">
                                    {{ $order->shippingAddress->contact_person_name }}
                                </div>
                            @endif
                            @if ($order->shippingAddress->phone)
                                <div class="d-flex align-items-center gap-2">
                                    <i class="tio-phone text-muted"></i>
                                    <a href="tel:{{ $order->shippingAddress->phone }}">
                                        {{ $order->shippingAddress->phone }}
                                    </a>
                                </div>
                            @endif
                            @if ($order->shippingAddress->address)
                                <div class="d-flex align-items-start gap-2 mt-1">
                                    <i class="tio-location text--primary mt-1"></i>
                                    <div>
                                        <div>{{ $order->shippingAddress->address }}</div>
                                        @if ($order->shippingAddress->city)
                                            <div class="text-muted">
                                                {{ $order->shippingAddress->city }}
                                                {{ $order->shippingAddress->state ? ', ' . $order->shippingAddress->state : '' }}
                                            </div>
                                        @endif
                                        @if ($order->shippingAddress->country)
                                            <div class="text-muted">
                                                {{ $order->shippingAddress->country }}
                                                {{ $order->shippingAddress->zip ? ' – ' . $order->shippingAddress->zip : '' }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-muted mb-0">{{ \App\CPU\translate('no_shipping_address_found') }}</p>
                    @endif
                </div>
            </div>

            {{-- Update Status Card --}}
            @if (!in_array($order['order_status'], ['delivered', 'canceled', 'returned']))
                <div class="card">
                    <div class="card-header d-flex align-items-center gap-2 py-3">
                        <i class="tio-refresh text--primary"></i>
                        <h5 class="card-title mb-0">{{ \App\CPU\translate('update_status') }}</h5>
                    </div>
                    <div class="card-body">
                        <form id="statusForm" action="{{ route('delivery-man.order.update-status') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                            <input type="hidden" name="status" id="hiddenStatus" value="">
                            <input type="hidden" name="otp" id="hiddenOtp" value="">
                            <input type="hidden" name="payment_status" id="hiddenPaymentStatus" value="">
                            <input type="hidden" name="cause" id="hiddenCause" value="">
                        </form>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-1">{{ \App\CPU\translate('select_status') }}</label>
                            <select class="form-control" id="detailStatusSelect">
                                <option value="">-- {{ \App\CPU\translate('select_status') }} --</option>
                                <option value="out_for_delivery"
                                    {{ $order['order_status'] == 'out_for_delivery' ? 'selected' : '' }}>
                                    {{ \App\CPU\translate('out_for_delivery') }}
                                </option>
                                <option value="delivered">{{ \App\CPU\translate('delivered') }}</option>
                                <option value="canceled">{{ \App\CPU\translate('canceled') }}</option>
                                <option value="returned">{{ \App\CPU\translate('returned') }}</option>
                            </select>
                        </div>

                        {{-- OTP Verification Box --}}
                        <div id="otpDeliveryContainer" style="display:none;" class="p-3 border rounded bg-light mt-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="font-weight-bold text-dark mb-0">
                                    <i class="tio-lock text-primary"></i> Customer Delivery OTP
                                </label>
                                <button type="button" class="btn btn-xs btn-outline-primary" id="btnSendOtp">
                                    <i class="tio-email"></i> <span id="btnSendOtpText">Send OTP Email</span>
                                </button>
                            </div>
                            <div id="otpAlertMsg" class="alert alert-info py-2 px-3 fz-12 mb-3">
                                OTP is being sent to customer email...
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-sm">Enter 4-Digit OTP <span class="text-danger">*</span></label>
                                <input type="text" id="inlineOtpInput" class="form-control text-center font-weight-bold"
                                    maxlength="4" pattern="[0-9]{4}" autocomplete="off" placeholder="e.g. 1234"
                                    style="font-size:22px; letter-spacing:8px;">
                                <small class="text-danger d-none" id="inlineOtpError">Please enter a valid 4-digit OTP</small>
                            </div>

                            @if ($order['payment_method'] == 'cash_on_delivery')
                                @if($order['payment_status'] == 'unpaid')
                                <div id="paymentStatusMsg" class="mb-2" style="display:none;"></div>
                                @endif
                            @endif

                                <div class="form-group mb-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <label class="font-weight-bold text-sm mb-0">
                                            <i class="tio-money text-success"></i> Payment Status (COD Order)
                                        </label>
                                        @if($order['payment_method'] == 'cash_on_delivery' && $order['payment_status'] == 'unpaid')
                                        <button type="button" class="btn btn-sm font-weight-bold" data-toggle="modal" data-target="#paymentModal"
                                                style="border:2px solid #38cab3; color:#38cab3; padding:5px 14px; border-radius:6px; font-size:12px;">
                                            <i class="tio-credit-card mr-1"></i> Pay Now
                                        </button>
                                        @endif
                                    </div>
                                    <select id="inlinePaymentStatus" class="form-control mt-1">
                                        @if($order['payment_status'] == 'unpaid')
                                            <option value="unpaid" selected>❌ Unpaid</option>
                                            <option value="paid">✅ Paid (Cash Collected)</option>
                                        @else
                                            <option value="paid" selected>✅ Paid (Cash Collected)</option>
                                            <option value="unpaid">❌ Unpaid</option>
                                        @endif
                                    </select>
                                    <small class="text-muted">If customer paid cash, select "Paid".</small>
                                </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold text-sm">Reason / Note (Optional)</label>
                                <textarea id="inlineCause" class="form-control" rows="2" placeholder="Any delivery note..."></textarea>
                            </div>

                            <button type="button" id="btnSubmitInlineDelivery" class="btn btn-success btn-block font-weight-bold">
                                <i class="tio-checkmark-circle"></i> Confirm Delivery & Save
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <div class="card">
                    <div class="card-body text-center py-4">
                        @if ($order['order_status'] == 'delivered')
                            <i class="tio-checkmark-circle" style="font-size:48px; color:#00c9a7;"></i>
                            <p class="mt-2 mb-0 font-weight-bold text-success">{{ \App\CPU\translate('delivered') }}</p>
                        @elseif($order['order_status'] == 'canceled')
                            <i class="tio-clear-circle" style="font-size:48px; color:#ed4c78;"></i>
                            <p class="mt-2 mb-0 font-weight-bold text-danger">{{ \App\CPU\translate('canceled') }}</p>
                        @else
                            <i class="tio-reply-all" style="font-size:48px; color:#6c757d;"></i>
                            <p class="mt-2 mb-0 font-weight-bold text-muted">{{ \App\CPU\translate('returned') }}</p>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Payment Received Badge (COD + Paid) --}}
            @if($order['payment_method'] == 'cash_on_delivery' && $order['payment_status'] == 'paid')
            <div class="card mt-3" style="border:2px solid #38ef7d;">
                <div class="card-body text-center py-3">
                    <i class="tio-checkmark-circle" style="font-size:28px; color:#00c9a7;"></i>
                    <span class="font-weight-bold ml-2" style="color:#00c9a7;">
                        Payment Received - {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}
                    </span>
                </div>
            </div>
            @endif

        </div>
    </div>

@endsection

{{-- Payment Gateway Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius:12px; border:none;">
            <div class="modal-header" style="background:linear-gradient(135deg, #5f259f, #38cab3); color:#fff; border:none; padding:14px 20px;">
                <h6 class="modal-title font-weight-bold text-white" id="paymentModalLabel">
                    <i class="tio-credit-card mr-1"></i> PhonePe Payment
                </h6>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity:0.8;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <i class="tio-mobile" style="font-size:48px; color:#5f259f;"></i>
                    <h5 class="font-weight-bold text-dark mt-2">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}</h5>
                    <p class="text-muted mb-0" style="font-size:13px;">You will be redirected to PhonePe payment page.</p>
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="padding:10px 24px; border-radius:8px;">Cancel</button>
                    <button type="button" class="btn font-weight-bold" id="btnPayPhonePe"
                            style="border:2px solid #5f259f; color:#fff; background:#5f259f; padding:10px 24px; border-radius:8px; font-size:14px;">
                        <i class="tio-mobile mr-1"></i> Pay Now
                    </button>
                </div>
                <div id="phonepePayLoading" class="mt-3" style="display:none;">
                    <div class="spinner-border text-primary" role="status" style="width:24px; height:24px;"></div>
                    <span class="ml-2 text-muted" style="font-size:13px;">Preparing payment...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        (function() {
            var orderId = {{ $order['id'] }};
            var isCOD = {{ $order['payment_method'] == 'cash_on_delivery' ? 'true' : 'false' }};
            var currentOrderStatus = "{{ $order['order_status'] }}";
            var csrfToken = "{{ csrf_token() }}";

            var sel = document.getElementById('detailStatusSelect');
            var otpContainer = document.getElementById('otpDeliveryContainer');
            var btnSendOtp = document.getElementById('btnSendOtp');
            var btnSendOtpText = document.getElementById('btnSendOtpText');
            var otpAlertMsg = document.getElementById('otpAlertMsg');
            var inlineOtpInput = document.getElementById('inlineOtpInput');
            var inlineOtpError = document.getElementById('inlineOtpError');
            var btnSubmitInlineDelivery = document.getElementById('btnSubmitInlineDelivery');
            var btnPayPhonePe = document.getElementById('btnPayPhonePe');
            var phonepePayLoading = document.getElementById('phonepePayLoading');

            // Pay Now → AJAX to get PhonePe URL → redirect
            if (btnPayPhonePe) {
                btnPayPhonePe.addEventListener('click', function() {
                    var btn = this;
                    btn.disabled = true;
                    btn.innerHTML = '<i class="fa fa-spinner fa-spin mr-1"></i> Processing...';
                    if (phonepePayLoading) phonepePayLoading.style.display = 'block';

                    $.ajax({
                        url: "{{ route('delivery-man.payment.phonepe-get-url') }}",
                        type: "POST",
                        data: {
                            _token: csrfToken,
                            order_id: orderId
                        },
                        success: function(response) {
                            if (response.success && response.redirect_url) {
                                window.location.href = response.redirect_url;
                            } else {
                                btn.disabled = false;
                                btn.innerHTML = '<i class="tio-mobile mr-1"></i> Pay Now';
                                if (phonepePayLoading) phonepePayLoading.style.display = 'none';
                                toastr.error(response.message || 'Failed to start payment');
                            }
                        },
                        error: function(xhr) {
                            btn.disabled = false;
                            btn.innerHTML = '<i class="tio-mobile mr-1"></i> Pay Now';
                            if (phonepePayLoading) phonepePayLoading.style.display = 'none';
                            var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Connection failed';
                            toastr.error(msg);
                        }
                    });
                });
            }

            if (!sel) return;

            sel.addEventListener('change', function() {
                var status = this.value;
                if (!status) {
                    if (otpContainer) otpContainer.style.display = 'none';
                    return;
                }

                if (status === 'delivered') {
                    if (otpContainer) {
                        otpContainer.style.display = 'block';
                        sendOtpEmail();
                    }
                } else {
                    if (otpContainer) otpContainer.style.display = 'none';

                    if (status === 'out_for_delivery') {
                        showConfirmSwal('Out For Delivery?', 'Customer will receive an OTP on email.', 'warning', function() {
                            document.getElementById('hiddenStatus').value = 'out_for_delivery';
                            document.getElementById('statusForm').submit();
                        });
                    } else if (status === 'canceled') {
                        showConfirmSwal('Cancel Order?', 'This order will be canceled.', 'error', function() {
                            document.getElementById('hiddenStatus').value = 'canceled';
                            document.getElementById('statusForm').submit();
                        });
                    } else if (status === 'returned') {
                        showConfirmSwal('Return Order?', 'This order will be marked as returned.', 'warning', function() {
                            document.getElementById('hiddenStatus').value = 'returned';
                            document.getElementById('statusForm').submit();
                        });
                    }
                }
            });

            if (btnSendOtp) {
                btnSendOtp.addEventListener('click', function() {
                    sendOtpEmail();
                });
            }

            function sendOtpEmail() {
                if (!btnSendOtp) return;
                btnSendOtp.disabled = true;
                if (btnSendOtpText) btnSendOtpText.textContent = 'Sending...';
                if (otpAlertMsg) {
                    otpAlertMsg.className = 'alert alert-info py-2 px-3 fz-12 mb-3';
                    otpAlertMsg.textContent = 'Sending 4-digit OTP email to customer...';
                }

                $.ajax({
                    url: "{{ route('delivery-man.order.send-otp') }}",
                    type: "POST",
                    data: {
                        _token: csrfToken,
                        order_id: orderId
                    },
                    success: function(response) {
                        btnSendOtp.disabled = false;
                        if (btnSendOtpText) btnSendOtpText.textContent = 'Resend OTP Email';
                        if (response.success) {
                            if (otpAlertMsg) {
                                otpAlertMsg.className = 'alert alert-success py-2 px-3 fz-12 mb-3';
                                otpAlertMsg.textContent = '✅ ' + response.message;
                            }
                            toastr.success(response.message);
                        } else {
                            if (otpAlertMsg) {
                                otpAlertMsg.className = 'alert alert-danger py-2 px-3 fz-12 mb-3';
                                otpAlertMsg.textContent = '❌ ' + response.message;
                            }
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        btnSendOtp.disabled = false;
                        if (btnSendOtpText) btnSendOtpText.textContent = 'Resend OTP Email';
                        var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Failed to send OTP email';
                        if (otpAlertMsg) {
                            otpAlertMsg.className = 'alert alert-danger py-2 px-3 fz-12 mb-3';
                            otpAlertMsg.textContent = '❌ ' + msg;
                        }
                        toastr.error(msg);
                    }
                });
            }

            if (btnSubmitInlineDelivery) {
                btnSubmitInlineDelivery.addEventListener('click', function() {
                    var otpVal = inlineOtpInput ? inlineOtpInput.value.trim() : '';
                    if (!otpVal || otpVal.length !== 4 || !/^\d{4}$/.test(otpVal)) {
                        if (inlineOtpError) inlineOtpError.classList.remove('d-none');
                        if (inlineOtpInput) inlineOtpInput.focus();
                        return;
                    }
                    if (inlineOtpError) inlineOtpError.classList.add('d-none');

                    document.getElementById('hiddenStatus').value = 'delivered';
                    document.getElementById('hiddenOtp').value = otpVal;
                    
                    var causeInput = document.getElementById('inlineCause');
                    if (causeInput) {
                        document.getElementById('hiddenCause').value = causeInput.value;
                    }

                    if (isCOD) {
                        var psInput = document.getElementById('inlinePaymentStatus');
                        document.getElementById('hiddenPaymentStatus').value = psInput ? psInput.value : 'paid';
                    }

                    document.getElementById('statusForm').submit();
                });
            }

            function showConfirmSwal(title, text, type, callback) {
                Swal.fire({
                    title: title,
                    text: text,
                    type: type,
                    showCancelButton: true,
                    confirmButtonColor: '#377dff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, Update!',
                    cancelButtonText: 'No, Cancel'
                }).then(function(result) {
                    if (result.value) {
                        callback();
                    } else {
                        sel.value = currentOrderStatus;
                    }
                });
            }

            // ==================== INLINE PAYMENT GATEWAY ====================
            var orderAmount = {{ $order['order_amount'] }};
            var paymentStatusMsg = document.getElementById('paymentStatusMsg');

            function showPaymentMsg(type, msg) {
                if (!paymentStatusMsg) return;
                paymentStatusMsg.style.display = 'block';
                var cls = type === 'success' ? 'alert-success' : (type === 'error' ? 'alert-danger' : 'alert-info');
                var icon = type === 'success' ? '✅' : (type === 'error' ? '❌' : '⏳');
                paymentStatusMsg.innerHTML = '<div class="alert ' + cls + ' py-2 px-3 mb-0" style="font-size:12px;">' + icon + ' ' + msg + '</div>';
            }

            function hidePaymentMsg() {
                if (paymentStatusMsg) {
                    paymentStatusMsg.style.display = 'none';
                    paymentStatusMsg.innerHTML = '';
                }
            }

            function hideModalPaymentMsg() {
                if (modalPaymentStatusMsg) {
                    modalPaymentStatusMsg.style.display = 'none';
                    modalPaymentStatusMsg.innerHTML = '';
                }
            }

            function verifyPaymentGateway(method, transactionId) {
                return $.ajax({
                    url: "{{ route('delivery-man.payment.verify') }}",
                    type: "POST",
                    data: {
                        _token: csrfToken,
                        order_id: orderId,
                        payment_method: method,
                        transaction_id: transactionId || ''
                    }
                });
            }

            function onPaymentSuccess(method, transactionId) {
                showPaymentMsg('success', 'Payment received via ' + method.toUpperCase() + '!');
                showModalPaymentMsg('success', 'Payment received via ' + method.toUpperCase() + '!');

                // Update payment status dropdown
                var psInput = document.getElementById('inlinePaymentStatus');
                if (psInput) psInput.value = 'paid';

                // Close modal
                $('#paymentModal').modal('hide');

                // Hide Pay Now button
                var payNowBtn = document.querySelector('[data-target="#paymentModal"]');
                if (payNowBtn) payNowBtn.style.display = 'none';

                // Show success SweetAlert
                Swal.fire({
                    title: 'Payment Successful!',
                    html: '<p class="mb-1">Amount: <strong>' + orderAmount + '</strong></p>' +
                          '<p class="mb-0">Method: <strong>' + method.toUpperCase() + '</strong></p>',
                    icon: 'success',
                    confirmButtonColor: '#00c9a7',
                    confirmButtonText: 'OK, Continue Delivery',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                }).then(function(result) {
                    if (result.value) {
                        // Focus on OTP input
                        if (inlineOtpInput) inlineOtpInput.focus();
                    }
                });
            }

            function onPaymentFailed(method, error) {
                showPaymentMsg('error', 'Payment failed: ' + error);
                showModalPaymentMsg('error', 'Payment failed: ' + error);

                Swal.fire({
                    title: 'Payment Failed!',
                    text: error || 'Something went wrong. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#ed4c78',
                    confirmButtonText: 'Try Again'
                });
            }

            // Gateway button clicks
            document.querySelectorAll('.gateway-btn, .gateway-btn-modal').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var gateway = this.dataset.gateway;

                    if (gateway === 'stripe') {
                        initStripePayment();
                    } else if (gateway === 'razorpay') {
                        initRazorpayPayment();
                    }
                });
            });

            // Modal payment status message
            var modalPaymentStatusMsg = document.getElementById('modalPaymentStatusMsg');
            function showModalPaymentMsg(type, msg) {
                if (!modalPaymentStatusMsg) return;
                modalPaymentStatusMsg.style.display = 'block';
                var cls = type === 'success' ? 'alert-success' : (type === 'error' ? 'alert-danger' : 'alert-info');
                var icon = type === 'success' ? '✅' : (type === 'error' ? '❌' : '⏳');
                modalPaymentStatusMsg.innerHTML = '<div class="alert ' + cls + ' py-2 px-3 mb-0" style="font-size:12px;">' + icon + ' ' + msg + '</div>';
            }

            // ==================== STRIPE PAYMENT ====================
            function initStripePayment() {
                showModalPaymentMsg('info', 'Opening Stripe payment...');

                $.ajax({
                    url: "{{ url('/pay-stripe') }}",
                    type: "GET",
                    success: function(response) {
                        try {
                            var sessionData = typeof response === 'string' ? JSON.parse(response) : response;
                            var stripeKey = '{{ (\App\CPU\Helpers::get_business_settings("stripe")["published_key"] ?? "") }}';

                            if (!stripeKey) {
                                onPaymentFailed('stripe', 'Stripe key not configured');
                                return;
                            }

                            var stripe = Stripe(stripeKey);
                            stripe.redirectToCheckout({ sessionId: sessionData.id })
                                .then(function(result) {
                                    if (result.error) {
                                        onPaymentFailed('stripe', result.error.message);
                                    }
                                });
                        } catch (e) {
                            onPaymentFailed('stripe', 'Invalid response from server');
                        }
                    },
                    error: function(xhr) {
                        onPaymentFailed('stripe', 'Failed to initialize payment');
                    }
                });
            }

            // ==================== RAZORPAY PAYMENT ====================
            function initRazorpayPayment() {
                showModalPaymentMsg('info', 'Creating Razorpay order...');

                $.ajax({
                    url: "{{ route('delivery-man.payment.razorpay-order') }}",
                    type: "POST",
                    data: {
                        _token: csrfToken,
                        order_id: orderId
                    },
                    success: function(response) {
                        if (!response.success) {
                            onPaymentFailed('razorpay', response.message);
                            return;
                        }

                        var options = {
                            key: response.key,
                            amount: response.amount,
                            currency: response.currency,
                            name: response.name,
                            description: response.description,
                            image: response.image,
                            order_id: response.order_id,
                            handler: function(razorpayResponse) {
                                verifyPaymentGateway('razor_pay', razorpayResponse.razorpay_payment_id)
                                    .then(function(res) {
                                        if (res.success) {
                                            onPaymentSuccess('razor_pay', razorpayResponse.razorpay_payment_id);
                                        } else {
                                            onPaymentFailed('razorpay', res.message);
                                        }
                                    })
                                    .catch(function() {
                                        onPaymentFailed('razorpay', 'Verification failed');
                                    });
                            },
                            prefill: {
                                name: response.customer_name,
                                email: response.customer_email,
                                contact: response.customer_contact
                            },
                            theme: {
                                color: '#072654'
                            },
                            modal: {
                                ondismiss: function() {
                                    hideModalPaymentMsg();
                                    showModalPaymentMsg('error', 'Payment cancelled by user');
                                }
                            }
                        };

                        var rzp = new Razorpay(options);
                        rzp.on('payment.failed', function(response) {
                            onPaymentFailed('razorpay', response.error.description || 'Payment failed');
                        });
                        rzp.open();
                    },
                    error: function(xhr) {
                        var msg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Failed to create order';
                        onPaymentFailed('razorpay', msg);
                    }
                });
            }

        })();
    </script>
@endpush
