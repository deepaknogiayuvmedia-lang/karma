@extends('delivery-man-views.layouts.app')

@section('title', \App\CPU\translate('my_orders'))

@push('css_or_js')
    <?php $stripe = \App\CPU\Helpers::get_business_settings('stripe'); ?>
    @if($stripe['status'] ?? false)
    <script src="https://js.stripe.com/v3/"></script>
    @endif
    <?php $razorpay = \App\CPU\Helpers::get_business_settings('razor_pay'); ?>
    @if($razorpay['status'] ?? false)
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @endif
@endpush

@section('content')
    {{-- Page Header --}}
    <div class="mb-4 d-flex align-items-center justify-content-between flex-wrap gap-2">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="22" src="{{ asset('assets/back-end/img/orders.png') }}" alt="">
            {{ \App\CPU\translate('my_orders') }}
        </h2>
        <span class="badge badge-soft-primary fz-14 px-3 py-2">
            {{ $orders->total() }} {{ \App\CPU\translate('orders') }}
        </span>
    </div>

    {{-- Status Filter --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <div class="d-flex flex-wrap gap-2" role="group">
                <a href="{{ route('delivery-man.orders') }}"
                    class="btn btn-sm {{ !request('status') ? 'btn--primary' : 'btn-outline-secondary' }}">
                    <i class="tio-filter-list mr-1"></i> {{ \App\CPU\translate('all') }}
                </a>
                <?php $statuses = ['pending' => ['label' => 'pending', 'color' => 'warning'], 'confirmed' => ['label' => 'confirmed', 'color' => 'info'], 'processing' => ['label' => 'processing', 'color' => 'primary'], 'out_for_delivery' => ['label' => 'out_for_delivery', 'color' => 'secondary'], 'delivered' => ['label' => 'delivered', 'color' => 'success'], 'canceled' => ['label' => 'canceled', 'color' => 'danger']]; ?>
                @foreach ($statuses as $key => $val)
                    <a href="{{ route('delivery-man.orders', ['status' => $key]) }}"
                        class="btn btn-sm {{ request('status') == $key ? 'btn-' . $val['color'] : 'btn-outline-' . $val['color'] }}">
                        {{ ucwords(str_replace('_', ' ', \App\CPU\translate($val['label']))) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Orders Table --}}
    <div class="card">
        <div class="card-header py-3">
            <h5 class="card-title mb-0 d-flex align-items-center gap-2">
                <i class="tio-shopping-cart text--primary"></i>
                @if (request('status'))
                    {{ ucwords(str_replace('_', ' ', request('status'))) }} {{ \App\CPU\translate('orders') }}
                @else
                    {{ \App\CPU\translate('all_orders') }}
                @endif
            </h5>
        </div>

        <div class="card-body p-0">
            @forelse($orders as $order)
                <div class="order-row border-bottom px-4 py-3 {{ $loop->even ? 'bg-light' : '' }}">
                    <div class="row align-items-center g-2">

                        {{-- Order ID & Date --}}
                        <div class="col-6 col-md-2">
                            <div class="font-weight-bold text-dark">#{{ $order['id'] }}</div>
                            <small class="text-muted d-block">
                                <i class="tio-calendar-month"></i>
                                {{ \Carbon\Carbon::parse($order['created_at'])->format('d M Y') }}
                            </small>
                            <small
                                class="text-muted">{{ \Carbon\Carbon::parse($order['created_at'])->format('h:i A') }}</small>
                        </div>

                        {{-- Customer --}}
                        <div class="col-6 col-md-2">
                            <small class="text-uppercase text-muted d-block mb-1"
                                style="font-size:10px; letter-spacing:.5px;">
                                {{ \App\CPU\translate('customer') }}
                            </small>
                            @if ($order->customer)
                                <div class="font-weight-semibold text-dark" style="font-size:13px;">
                                    {{ $order->customer->f_name }} {{ $order->customer->l_name }}
                                </div>
                                <small class="text-muted">{{ $order->customer->phone ?? '' }}</small>
                            @elseif($order->billingAddress)
                                <div class="font-weight-semibold text-dark" style="font-size:13px;">
                                    {{ $order->billingAddress->contact_person_name ?? 'N/A' }}
                                </div>
                                <small class="text-muted">{{ $order->billingAddress->phone ?? '' }}</small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </div>

                        {{-- Delivery Address --}}
                        <div class="col-12 col-md-3 d-none d-md-block">
                            <small class="text-uppercase text-muted d-block mb-1"
                                style="font-size:10px; letter-spacing:.5px;">
                                <i class="tio-location"></i> {{ \App\CPU\translate('delivery_address') }}
                            </small>
                            @if ($order->shippingAddress)
                                <div style="font-size:13px;" class="text-dark">
                                    {{ $order->shippingAddress->address ?? '' }}
                                    @if ($order->shippingAddress->city)
                                        <span class="text-muted">, {{ $order->shippingAddress->city }}</span>
                                    @endif
                                </div>
                                @if ($order->shippingAddress->zip)
                                    <small class="text-muted">PIN: {{ $order->shippingAddress->zip }}</small>
                                @endif
                            @else
                                <span class="text-muted"
                                    style="font-size:13px;">{{ \App\CPU\translate('no_address') }}</span>
                            @endif
                        </div>

                        {{-- Amount --}}
                        <div class="col-6 col-md-2 text-md-center">
                            <small class="text-uppercase text-muted d-block mb-1"
                                style="font-size:10px; letter-spacing:.5px;">
                                {{ \App\CPU\translate('amount') }}
                            </small>
                            <div class="font-weight-bold text-dark" style="font-size:15px;">
                                {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order['order_amount'])) }}
                            </div>
                            <small
                                class="{{ $order['payment_method'] == 'cash_on_delivery' ? 'text-warning' : 'text-success' }}">
                                @if ($order['payment_method'] == 'cash_on_delivery')
                                    COD - {{ $order['payment_status'] == 'paid' ? 'Paid' : 'Unpaid' }}
                                @else
                                    Online
                                @endif
                            </small>
                        </div>

                {{-- Status --}}
                <div class="col-6 col-md-1 text-md-center">
                    <?php $statusColors = ['pending' => 'warning', 'confirmed' => 'info', 'processing' => 'primary', 'out_for_delivery' => 'secondary', 'delivered' => 'success', 'canceled' => 'danger', 'returned' => 'dark']; $sc = $statusColors[$order['order_status']] ?? 'dark'; ?>
                    <span class="badge badge-soft-{{ $sc }} text-capitalize"
                                style="font-size:11px; padding:5px 10px;">
                                {{ ucwords(str_replace('_', ' ', $order['order_status'])) }}
                            </span>
                        </div>

                        {{-- Actions --}}
                        <div class="col-12 col-md-2 d-flex justify-content-md-end gap-2 mt-2 mt-md-0">
                            <a href="{{ route('delivery-man.order-details', $order['id']) }}"
                                class="btn btn-sm btn-outline-primary" title="{{ \App\CPU\translate('view_details') }}">
                                <i class="tio-eye"></i> {{ \App\CPU\translate('view') }}
                            </a>
                            @if (!in_array($order['order_status'], ['delivered', 'canceled', 'returned']))
                                <button type="button" class="btn btn-sm btn--primary order-status-btn"
                                    data-order-id="{{ $order['id'] }}"
                                    data-is-cod="{{ $order['payment_method'] == 'cash_on_delivery' ? '1' : '0' }}"
                                    title="{{ \App\CPU\translate('update_status') }}">
                                    <i class="tio-refresh"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Status Update Modal --}}
                @if (!in_array($order['order_status'], ['delivered', 'canceled', 'returned']))
                    <form id="orderStatusForm{{ $order['id'] }}" action="{{ route('delivery-man.order.update-status') }}"
                        method="POST" style="display:none;">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order['id'] }}">
                        <input type="hidden" name="status" id="orderHiddenStatus{{ $order['id'] }}" value="">
                        <input type="hidden" name="otp" id="orderHiddenOtp{{ $order['id'] }}" value="">
                        <input type="hidden" name="payment_status" id="orderHiddenPayment{{ $order['id'] }}"
                            value="">
                        <input type="hidden" name="cause" id="orderHiddenCause{{ $order['id'] }}" value="">
                    </form>
                @endif

            @empty
                <div class="text-center py-5">
                    <img class="mb-3" style="width:120px; opacity:.5;"
                        src="{{ asset('assets/back-end/svg/illustrations/sorry.svg') }}" alt="">
                    <p class="text-muted mb-0">{{ \App\CPU\translate('no_data_to_show') }}</p>
                </div>
            @endforelse
        </div>

        @if ($orders->hasPages())
            <div class="card-footer d-flex align-items-center justify-content-between flex-wrap gap-2 py-3">
                <div class="text-muted" style="font-size:13px;">
                    {{ \App\CPU\translate('showing') }}
                    <strong>{{ $orders->firstItem() }}</strong> – <strong>{{ $orders->lastItem() }}</strong>
                    {{ \App\CPU\translate('of') }} <strong>{{ $orders->total() }}</strong>
                    {{ \App\CPU\translate('orders') }}
                </div>
                <div>
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>

    @push('script')
        <script>
            document.querySelectorAll('.order-status-btn').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var orderId = this.dataset.orderId;
                    var isCOD = this.dataset.isCod === '1';

                    Swal.fire({
                        title: 'Update Order Status',
                        input: 'select',
                        inputOptions: {
                            'out_for_delivery': 'Out For Delivery',
                            'delivered': 'Delivered',
                            'canceled': 'Canceled',
                            'returned': 'Returned'
                        },
                        inputPlaceholder: 'Select status',
                        showCancelButton: true,
                        confirmButtonColor: '#377dff',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Update',
                        inputValidator: function(value) {
                            if (!value) return 'Please select a status';
                        }
                    }).then(function(result) {
                        if (!result.value) return;
                        var status = result.value;

                        if (status === 'delivered') {
                            showOrderDeliverySwal(orderId, isCOD);
                        } else if (status === 'out_for_delivery') {
                            Swal.fire({
                                title: 'Out For Delivery?',
                                text: 'Customer will receive an OTP on email.',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#377dff',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, Update!'
                            }).then(function(r) {
                                if (r.value) {
                                    document.getElementById('orderHiddenStatus' + orderId)
                                        .value = 'out_for_delivery';
                                    document.getElementById('orderStatusForm' + orderId)
                                    .submit();
                                }
                            });
                        } else if (status === 'canceled') {
                            Swal.fire({
                                title: 'Cancel Order?',
                                text: 'This order will be canceled.',
                                type: 'error',
                                showCancelButton: true,
                                confirmButtonColor: '#ed4c78',
                                cancelButtonColor: '#6c757d',
                                confirmButtonText: 'Yes, Cancel!'
                            }).then(function(r) {
                                if (r.value) {
                                    document.getElementById('orderHiddenStatus' + orderId)
                                        .value = 'canceled';
                                    document.getElementById('orderStatusForm' + orderId)
                                    .submit();
                                }
                            });
                        } else if (status === 'returned') {
                            Swal.fire({
                                title: 'Return Order?',
                                text: 'This order will be marked as returned.',
                                type: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#6c757d',
                                cancelButtonColor: '#377dff',
                                confirmButtonText: 'Yes, Return!'
                            }).then(function(r) {
                                if (r.value) {
                                    document.getElementById('orderHiddenStatus' + orderId)
                                        .value = 'returned';
                                    document.getElementById('orderStatusForm' + orderId)
                                    .submit();
                                }
                            });
                        }
                    });
                });
            });

            function showOrderDeliverySwal(orderId, isCOD) {
                $.ajax({
                    url: "{{ route('delivery-man.order.send-otp') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        order_id: orderId
                    }
                });

                var paymentHtml = '';
                if (isCOD) {
                    var gateways = '';
                    <?php $phonepeO = \App\CPU\Helpers::get_business_settings('phone_pe'); ?>
                    <?php $stripeO = \App\CPU\Helpers::get_business_settings('stripe'); ?>
                    <?php $razorpayO = \App\CPU\Helpers::get_business_settings('razor_pay'); ?>
                    @if($phonepeO['status'] ?? false)
                    gateways += '<a href="{{ route('delivery-man.payment.phonepe') }}?order_id=' + orderId + '" class="btn btn-sm order-gw-btn" style="border:2px solid #5f259f; color:#fff; background:#5f259f; padding:5px 12px; border-radius:6px; font-size:11px; font-weight:700; text-decoration:none;"><i class="tio-mobile mr-1"></i> PhonePe</a> ';
                    @endif
                    @if($razorpayO['status'] ?? false)
                    gateways += '<button type="button" class="btn btn-sm order-gw-btn" data-gw="razorpay" data-oid="' + orderId + '" style="border:2px solid #072654; color:#072654; padding:5px 12px; border-radius:6px; font-size:11px; font-weight:700;"><i class="tio-wallet mr-1"></i> Razorpay</button> ';
                    @endif
                    @if($stripeO['status'] ?? false)
                    gateways += '<button type="button" class="btn btn-sm order-gw-btn" data-gw="stripe" data-oid="' + orderId + '" style="border:2px solid #635bff; color:#635bff; padding:5px 12px; border-radius:6px; font-size:11px; font-weight:700;"><i class="tio-credit-card mr-1"></i> Stripe</button>';
                    @endif

                    paymentHtml = '<div class="text-left mt-3" style="border-top:1px solid #e7eaf3; padding-top:15px;">' +
                        '<label class="font-weight-bold" style="font-size:14px;"><i class="tio-money"></i> Payment Status</label>' +
                        '<select id="orderSwalPaymentStatus" class="swal2-select" style="width:100%; padding:8px 12px; border:1px solid #dee2e6; border-radius:6px; font-size:14px;">' +
                        '<option value="unpaid" selected>❌ Unpaid</option>' +
                        '<option value="paid">✅ Paid (Cash Collected)</option>' +
                        '</select>' +
                        '<div class="mt-2 p-2" style="background:#f0f9ff; border:1px solid #bae6fd; border-radius:8px;">' +
                        '<small class="text-muted d-block mb-1" style="font-size:11px;">Customer hasn\'t paid? Collect digitally:</small>' +
                        '<div class="d-flex gap-1">' + gateways + '</div>' +
                        '<div id="orderPayMsg' + orderId + '" class="mt-1" style="display:none;"></div>' +
                        '</div>' +
                        '</div>';
                }

                Swal.fire({
                    title: '<i class="tio-lock" style="font-size:36px; color:#377dff;"></i><br>Enter Delivery OTP',
                    html: '<p class="text-muted mb-3">4-digit OTP has been emailed to the customer. Ask customer for OTP.</p>' +
                        '<input id="orderSwalOtp" class="swal2-input" type="text" maxlength="4" pattern="[0-9]{4}" ' +
                        'placeholder="Enter 4-digit OTP" autocomplete="off" ' +
                        'style="font-size:24px; letter-spacing:10px; text-align:center; font-weight:bold;">' +
                        paymentHtml,
                    showCancelButton: true,
                    confirmButtonColor: '#00c9a7',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="tio-checkmark-circle mr-1"></i> Confirm Delivery',
                    cancelButtonText: 'Cancel',
                    focusConfirm: false,
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false,
                    didOpen: function() {
                        var inp = document.getElementById('orderSwalOtp');
                        if (inp) inp.focus();
                    },
                    preConfirm: function() {
                        var otp = document.getElementById('orderSwalOtp').value.trim();
                        if (!otp || otp.length !== 4 || !/^\d{4}$/.test(otp)) {
                            Swal.showValidationMessage('Please enter a valid 4-digit OTP');
                            return false;
                        }
                        if (isCOD) {
                            var ps = document.getElementById('orderSwalPaymentStatus').value;
                            if (!ps) {
                                Swal.showValidationMessage('Please select payment status');
                                return false;
                            }
                        }
                        return true;
                    }
                }).then(function(result) {
                    if (result.value) {
                        document.getElementById('orderHiddenStatus' + orderId).value = 'delivered';
                        document.getElementById('orderHiddenOtp' + orderId).value = document.getElementById(
                            'orderSwalOtp').value.trim();
                        if (isCOD) {
                            document.getElementById('orderHiddenPayment' + orderId).value = document.getElementById(
                                'orderSwalPaymentStatus').value;
                        }
                        document.getElementById('orderStatusForm' + orderId).submit();
                    }
                });

                // Inline payment gateway buttons inside Swal
                setTimeout(function() {
                    document.querySelectorAll('.order-gw-btn').forEach(function(btn) {
                        btn.addEventListener('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();
                            var gw = this.dataset.gw;
                            var oid = this.dataset.oid;
                            var msgEl = document.getElementById('orderPayMsg' + oid);
                            if (gw === 'stripe') {
                                if (msgEl) { msgEl.style.display='block'; msgEl.innerHTML='<small class="text-info">⏳ Opening Stripe...</small>'; }
                                window.location.href = '{{ url("/pay-stripe") }}';
                            } else if (gw === 'razorpay') {
                                if (msgEl) { msgEl.style.display='block'; msgEl.innerHTML='<small class="text-info">⏳ Creating order...</small>'; }
                                $.ajax({
                                    url: "{{ route('delivery-man.payment.razorpay-order') }}",
                                    type: "POST",
                                    data: { _token: "{{ csrf_token() }}", order_id: oid },
                                    success: function(resp) {
                                        if (!resp.success) { if(msgEl) msgEl.innerHTML='<small class="text-danger">❌ '+resp.message+'</small>'; return; }
                                        var rzp = new Razorpay({
                                            key: resp.key,
                                            amount: resp.amount,
                                            currency: resp.currency,
                                            name: resp.name,
                                            description: resp.description,
                                            image: resp.image,
                                            order_id: resp.order_id,
                                            handler: function(rz) {
                                                $.ajax({
                                                    url: "{{ route('delivery-man.payment.verify') }}",
                                                    type: "POST",
                                                    data: { _token: "{{ csrf_token() }}", order_id: oid, payment_method: 'razor_pay', transaction_id: rz.razorpay_payment_id },
                                                    success: function(vr) {
                                                        if (vr.success) {
                                                            if(msgEl) msgEl.innerHTML='<small class="text-success">✅ Payment received!</small>';
                                                            var ps = document.getElementById('orderSwalPaymentStatus');
                                                            if(ps) ps.value = 'paid';
                                                            Swal.fire({ title:'Payment Successful!', text:'Amount: '+resp.amount/100, icon:'success', confirmButtonColor:'#00c9a7' });
                                                        } else {
                                                            if(msgEl) msgEl.innerHTML='<small class="text-danger">❌ '+vr.message+'</small>';
                                                        }
                                                    }
                                                });
                                            },
                                            modal: { ondismiss: function() { if(msgEl) msgEl.innerHTML='<small class="text-muted">Payment cancelled</small>'; } }
                                        });
                                        rzp.on('payment.failed', function(r) { if(msgEl) msgEl.innerHTML='<small class="text-danger">❌ '+r.error.description+'</small>'; });
                                        rzp.open();
                                    },
                                    error: function() { if(msgEl) msgEl.innerHTML='<small class="text-danger">❌ Failed to create order</small>'; }
                                });
                            }
                        });
                    });
                }, 500);
            }
        </script>
    @endpush
@endsection
