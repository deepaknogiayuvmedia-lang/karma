@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Order Details'))

@push('css_or_js')
    <style>
        .page-item.active .page-link {
            background-color: {{$web_config['primary_color']}} !important;
        }

        .amount {
            margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 60px;
        }

        .w-49{
            width: 49% !important
        }

        a {
            color: {{$web_config['primary_color']}};
        }

        @media (max-width: 360px) {
            .for-glaxy-mobile {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 6px;
            }
        }

        @media (max-width: 600px) {
            .for-glaxy-mobile {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 6px;
            }
            .order_table_info_div_2 {
                text-align: {{Session::get('direction') === "rtl" ? 'left' : 'right'}} !important;
            }
            .spandHeadO {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 16px;
            }
            .spanTr {
                margin-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}: 16px;
            }
            .amount {
                margin-{{Session::get('direction') === "rtl" ? 'right' : 'left'}}: 0px;
            }
        }

        /* ===== Modern Order Details Styling ===== */
        .order-details-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 24px;
        }

        .order-header-banner {
            background: {{$web_config['primary_color']}};
            color: #ffffff !important;
            padding: 24px 28px;
            border-radius: 16px 16px 0 0;
        }
        .order-header-banner * {
            color: #ffffff !important;
        }
        .order-info-label {
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            opacity: 0.88;
            margin-bottom: 4px;
            display: block;
        }
        .order-info-value {
            font-size: 1.05rem;
            font-weight: 700;
            line-height: 1.4;
            word-break: break-word;
        }

        .verification-badge-box {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 12px;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }
        .verification-code-val {
            font-family: monospace;
            font-size: 1.15rem;
            font-weight: 700;
            background: #ffffff;
            padding: 3px 12px;
            border-radius: 8px;
            border: 1px solid #86efac;
            color: #15803d !important;
            letter-spacing: 1px;
        }

        .order-item-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        .order-item-table tr {
            border-bottom: 1px solid #f3f4f6;
        }
        .order-item-table tr:last-child {
            border-bottom: none;
        }
        .order-item-table td {
            padding: 18px 20px;
            vertical-align: middle;
        }
        .product-img-box {
            width: 68px;
            height: 68px;
            border-radius: 12px;
            border: 1px solid #eaefe9;
            overflow: hidden;
            background: #f9fafb;
            flex-shrink: 0;
        }
        .product-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .product-title-link {
            font-weight: 600;
            font-size: 0.95rem;
            color: #111827 !important;
            text-decoration: none !important;
            transition: color 0.2s;
        }
        .product-title-link:hover {
            color: {{$web_config['primary_color']}} !important;
        }
        .product-variant-tag {
            font-size: 0.8125rem;
            color: #6b7280;
            margin-top: 3px;
        }

        .summary-card-box {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e5e7eb;
            padding: 22px 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        }
        .summary-table-custom {
            width: 100%;
            margin-bottom: 0;
        }
        .summary-table-custom td {
            padding: 8px 0;
            font-size: 0.9rem;
            color: #4b566b;
        }
        .summary-table-custom td:last-child {
            text-align: {{Session::get('direction') === "rtl" ? 'left' : 'right'}};
            font-weight: 600;
            color: #111827;
        }
        .summary-table-custom tr.total-row td {
            padding-top: 14px;
            border-top: 2px dashed #e5e7eb;
            font-size: 1.1rem;
            font-weight: 700;
            color: #111827;
        }
        .summary-table-custom tr.total-row td:last-child {
            color: {{$web_config['primary_color']}};
            font-size: 1.25rem;
        }

        .btn-invoice-action {
            background: {{$web_config['primary_color']}};
            color: #ffffff !important;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: filter 0.2s ease;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
            text-decoration: none !important;
        }
        .btn-invoice-action:hover {
            filter: brightness(0.92);
            color: #ffffff !important;
        }

        .btn-track-action {
            background: #f3f4f6;
            color: #374151 !important;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 12px;
            border: 1px solid #d1d5db;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s ease, color 0.2s ease;
            text-decoration: none !important;
        }
        .btn-track-action:hover {
            background: #e5e7eb;
            color: #111827 !important;
        }

        @media (max-width: 767.98px) {
            .order-header-banner {
                padding: 18px 16px;
            }
            .order-item-table td {
                padding: 14px 12px;
            }
        }
    </style>
@endpush

@section('content')

    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 mt-3 rtl __inline-47"
         style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="row">
            <!-- Sidebar-->
            @include('web-views.partials._profile-aside')

            {{-- Content --}}
            <section class="col-lg-9 col-md-9">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <a class="page-link d-inline-flex align-items-center gap-2" href="{{ route('account-oder') }}">
                            <i class="czi-arrow-{{Session::get('direction') === "rtl" ? 'right ml-2' : 'left mr-2'}}"></i>{{\App\CPU\translate('back')}}
                        </a>
                    </div>
                </div>



                @if(isset($order['seller_id']) != 0)
                    @php($shopName=\App\Model\Shop::where('seller_id', $order['seller_id'])->first())
                @endif

                @if($order->order_type == 'default_type')
                    @if($order->shippingAddress)
                        @php($shipping=$order->shippingAddress)
                    @else
                        @php($shipping=json_decode($order['shipping_address_data']))
                    @endif

                    @if($order->billingAddress)
                        @php($billing=$order->billingAddress)
                    @else
                        @php($billing=json_decode($order['billing_address_data']))
                    @endif
                @endif

                <div class="order-details-card">
                    <!-- Header Banner -->
                    <div class="order-header-banner">
                        <div class="row align-items-center">
                            <div class="col-6 col-md-3 mb-3 mb-md-0">
                                <span class="order-info-label">{{\App\CPU\translate('order_no')}}</span>
                                <div class="order-info-value">#{{$order->id}}</div>
                            </div>
                            <div class="col-6 col-md-3 mb-3 mb-md-0">
                                <span class="order-info-label">{{\App\CPU\translate('order_date')}}</span>
                                <div class="order-info-value">{{date('d M, Y', strtotime($order->created_at))}}</div>
                            </div>
                            @if($order->order_type == 'default_type')
                                <div class="col-12 col-md-3 mb-3 mb-md-0">
                                    <span class="order-info-label">{{\App\CPU\translate('shipping_address')}}</span>
                                    <div class="order-info-value">
                                        @if(isset($shipping) && $shipping)
                                            {{$shipping->address}}, {{$shipping->city}}, {{$shipping->zip}}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <span class="order-info-label">{{\App\CPU\translate('billing_address')}}</span>
                                    <div class="order-info-value">
                                        @if(isset($billing) && $billing)
                                            {{$billing->address}}, {{$billing->city}}, {{$billing->zip}}
                                        @elseif(isset($shipping) && $shipping)
                                            {{$shipping->address}}, {{$shipping->city}}, {{$shipping->zip}}
                                        @else
                                            N/A
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Products Table -->
                    <div class="table-responsive">
                        <table class="order-item-table">
                            <tbody>
                            @foreach ($order->details as $key=>$detail)
                                @php($product=json_decode($detail->product_details,true))
                                @if($product)
                                    <?php
                                    $refund_day_limit = \App\CPU\Helpers::get_business_settings('refund_day_limit');
                                    $order_details_date = $detail->created_at;
                                    $current = \Carbon\Carbon::now();
                                    $length = $order_details_date->diffInDays($current);
                                    ?>
                                    <tr>
                                        <td style="width: 80px;">
                                            <div class="product-img-box" onclick="location.href='{{route('product',$product['slug'])}}'" style="cursor: pointer;">
                                                <img onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                                     src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$product['thumbnail']}}"
                                                     alt="{{$product['name'] ?? ''}}">
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{route('product',[$product['slug']])}}" class="product-title-link">
                                                {{isset($product['name']) ? Str::limit($product['name'], 50) : ''}}
                                            </a>

                                            @if($detail->refund_request == 1)
                                                <span class="badge badge-warning ml-1">{{\App\CPU\translate('refund_pending')}}</span>
                                            @elseif($detail->refund_request == 2)
                                                <span class="badge badge-success ml-1">{{\App\CPU\translate('refund_approved')}}</span>
                                            @elseif($detail->refund_request == 3)
                                                <span class="badge badge-danger ml-1">{{\App\CPU\translate('refund_rejected')}}</span>
                                            @elseif($detail->refund_request == 4)
                                                <span class="badge badge-info ml-1">{{\App\CPU\translate('refund_refunded')}}</span>
                                            @endif

                                            @if($detail->variant)
                                                <div class="product-variant-tag">
                                                    <span>{{\App\CPU\translate('variant')}}:</span> {{$detail->variant}}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="text-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" style="white-space: nowrap;">
                                            <div class="font-weight-bold text-dark font-size-md">
                                                {{\App\CPU\Helpers::currency_converter($detail->price)}}
                                            </div>
                                            <div class="text-muted small">
                                                {{\App\CPU\translate('qty')}}: {{$detail->qty}}
                                            </div>
                                        </td>
                                        <td class="text-{{Session::get('direction') === "rtl" ? 'left' : 'right'}}" style="min-width: 140px;">
                                            @if($detail->product && $order->payment_status == 'paid' && $detail->product->digital_product_type == 'ready_product')
                                                <a href="{{ route('digital-product-download', $detail->id) }}" class="btn btn-success btn-sm mb-1" data-toggle="tooltip" title="{{\App\CPU\translate('Download')}}">
                                                    <i class="fa fa-download mr-1"></i> {{\App\CPU\translate('Download')}}
                                                </a>
                                            @elseif($detail->product && $order->payment_status == 'paid' && $detail->product->digital_product_type == 'ready_after_sell')
                                                @if($detail->digital_file_after_sell)
                                                    <a href="{{ route('digital-product-download', $detail->id) }}" class="btn btn-success btn-sm mb-1" data-toggle="tooltip" title="{{\App\CPU\translate('Download')}}">
                                                        <i class="fa fa-download mr-1"></i> {{\App\CPU\translate('Download')}}
                                                    </a>
                                                @else
                                                    <span class="btn btn-secondary btn-sm disabled mb-1" data-toggle="tooltip" title="{{\App\CPU\translate('Product_not_uploaded_yet')}}">
                                                        <i class="fa fa-download mr-1"></i> {{\App\CPU\translate('Download')}}
                                                    </span>
                                                @endif
                                            @endif

                                            @if($order->order_type == 'default_type')
                                                @if($order->order_status=='delivered')
                                                    <a href="{{route('submit-review',[$detail->id])}}"
                                                       class="btn btn-outline-primary btn-sm d-inline-block mb-1">{{\App\CPU\translate('review')}}</a>

                                                    @if($detail->refund_request !=0)
                                                        <a href="{{route('refund-details',[$detail->id])}}"
                                                           class="btn btn-outline-info btn-sm d-inline-block mb-1">
                                                            {{\App\CPU\translate('refund_details')}}
                                                        </a>
                                                    @endif
                                                    @if( $length <= $refund_day_limit && $detail->refund_request == 0)
                                                        <a href="{{route('refund-request',[$detail->id])}}"
                                                           class="btn btn-outline-warning btn-sm d-inline-block mb-1">{{\App\CPU\translate('refund_request')}}</a>
                                                    @endif
                                                @endif
                                            @else
                                                <span class="badge badge-secondary">{{\App\CPU\translate('pos_order')}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            @php($summary=\App\CPU\OrderManager::order_summary($order))
                            </tbody>
                        </table>
                    </div>

                    <!-- Delivery Info & Order Note -->
                    @if($order->delivery_type != null || $order->order_note != null)
                        <div class="px-4 py-3 border-top bg-light">
                            @if($order->delivery_type != null)
                                <div class="mb-2">
                                    <h6 class="font-weight-bold text-capitalize mb-2"><i class="fa fa-truck mr-1 text-primary"></i> {{\App\CPU\translate('delivery_info')}}</h6>
                                    <div class="row align-items-center">
                                        <div class="col-md-7">
                                            @if ($order->delivery_type == 'self_delivery' && $order->delivery_man_id  && isset($order->delivery_man))
                                                <p class="mb-0 text-dark">
                                                    <span class="text-capitalize font-weight-bold">
                                                        {{\App\CPU\translate('delivery_man_name')}} :
                                                    </span> 
                                                    {{$order->delivery_man['f_name'].' '.$order->delivery_man['l_name']}}
                                                </p>
                                            @else
                                                <p class="mb-0 text-dark">
                                                    <span class="font-weight-bold">
                                                        {{\App\CPU\translate('delivery_service_name')}} :
                                                    </span> {{$order->delivery_service_name}}
                                                    <br>
                                                    <span class="font-weight-bold">
                                                        {{\App\CPU\translate('tracking_id')}} :
                                                    </span> {{$order->third_party_delivery_tracking_id}}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="col-md-5 text-md-right mt-2 mt-md-0">
                                            @if ($order->delivery_type == 'self_delivery' && $order->delivery_man_id  && isset($order->delivery_man))
                                                @if($order->order_type == 'default_type')
                                                    <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#exampleModal">
                                                        <i class="fa fa-envelope mr-1"></i>
                                                        {{\App\CPU\translate('Chat_with_deliveryman')}}
                                                    </button>
                                                @endif
                                            @endif
                                            @if($order->order_type == 'default_type' && $order->order_status=='delivered' && $order->delivery_man_id)
                                                <a href="{{route('deliveryman-review',[$order->id])}}"
                                                   class="btn btn-outline-primary btn-sm ml-1">
                                                    <i class="fa fa-star mr-1"></i>
                                                    {{ $order->delivery_man_review ? \App\CPU\translate('update') : '' }}
                                                    {{\App\CPU\translate('Deliveryman_Review')}}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($order->order_note != null)
                                <div class="mt-2 pt-2 border-top">
                                    <h6 class="font-weight-bold mb-1"><i class="fa fa-sticky-note-o mr-1 text-primary"></i> {{\App\CPU\translate('order_note')}}</h6>
                                    <p class="mb-0 text-muted small">
                                        {{$order->order_note}}
                                    </p>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                {{-- Modal --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="card-header">
                                {{\App\CPU\translate('write_something')}}
                            </div>
                            <div class="modal-body">
                                <form action="{{route('messages_store')}}" method="post" id="chat-form">
                                    @csrf
                                    <input value="{{$order->delivery_man_id}}" name="delivery_man_id" hidden>

                                    <textarea name="message" class="form-control" required></textarea>
                                    <br>
                                    <button class="btn btn--primary" style="color: white;">{{\App\CPU\translate('send')}}</button>
                                </form>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('chat', ['type' => 'delivery-man'])}}" class="btn btn--primary mx-1">
                                    {{\App\CPU\translate('go_to')}} {{\App\CPU\translate('chatbox')}}
                                </a>
                                <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal">{{\App\CPU\translate('close')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{--Calculation & Actions--}}
                @php($extra_discount=0)
                <?php
                if ($order['extra_discount_type'] == 'percent') {
                    $extra_discount = ($summary['subtotal'] / 100) * $order['extra_discount'];
                } else {
                    $extra_discount = $order['extra_discount'];
                }
                ?>
                <div class="row d-flex justify-content-end">
                    <div class="col-md-8 col-lg-5">
                        <div class="summary-card-box">
                            <table class="summary-table-custom">
                                <tbody>
                                <tr>
                                    <td>{{\App\CPU\translate('Item')}}</td>
                                    <td>{{$order->details->count()}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\CPU\translate('Subtotal')}}</td>
                                    <td>{{\App\CPU\Helpers::currency_converter($summary['subtotal'])}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\CPU\translate('tax_fee')}}</td>
                                    <td>{{\App\CPU\Helpers::currency_converter($summary['total_tax'])}}</td>
                                </tr>
                                @if($order->order_type == 'default_type')
                                    <tr>
                                        <td>{{\App\CPU\translate('Shipping')}} {{\App\CPU\translate('Fee')}}</td>
                                        <td>{{\App\CPU\Helpers::currency_converter($summary['total_shipping_cost'])}}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td>{{\App\CPU\translate('Discount')}} {{\App\CPU\translate('on_product')}}</td>
                                    <td>- {{\App\CPU\Helpers::currency_converter($summary['total_discount_on_product'])}}</td>
                                </tr>
                                <tr>
                                    <td>{{\App\CPU\translate('Coupon')}} {{\App\CPU\translate('Discount')}}</td>
                                    <td>- {{\App\CPU\Helpers::currency_converter($order->discount_amount)}}</td>
                                </tr>
                                @if($order->order_type != 'default_type')
                                    <tr>
                                        <td>{{\App\CPU\translate('extra')}} {{\App\CPU\translate('Discount')}}</td>
                                        <td>- {{\App\CPU\Helpers::currency_converter($extra_discount)}}</td>
                                    </tr>
                                @endif
                                <tr class="total-row">
                                    <td>{{\App\CPU\translate('Total')}}</td>
                                    <td>{{\App\CPU\Helpers::currency_converter($order->order_amount)}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex align-items-center justify-content-between gap-3 mt-4">
                            <a href="{{route('generate-invoice',[$order->id])}}" class="btn-invoice-action flex-grow-1" target="_blank">
                                <i class="fa fa-file-text-o"></i>
                                {{\App\CPU\translate('generate_invoice')}}
                            </a>
                            <a href="{{route('track-order.result',['order_id'=>$order['id'],'from_order_details'=>1])}}" class="btn-track-action flex-grow-1">
                                <i class="fa fa-truck"></i>
                                {{\App\CPU\translate('Track')}} {{\App\CPU\translate('Order')}}
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection

@push('script')
    <script>
        function review_message() {
            toastr.info('{{\App\CPU\translate('you_can_review_after_the_product_is_delivered!')}}', {
                CloseButton: true,
                ProgressBar: true
            });
        }

        function refund_message() {
            toastr.info('{{\App\CPU\translate('you_can_refund_request_after_the_product_is_delivered!')}}', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
    <script>
        $('#chat-form').on('submit', function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                type: "post",
                url: '{{route('messages_store')}}',
                data: $('#chat-form').serialize(),
                success: function (respons) {

                    toastr.success('{{\App\CPU\translate('send successfully')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $('#chat-form').trigger('reset');
                }
            });

        });
    </script>
@endpush
