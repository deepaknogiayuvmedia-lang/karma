@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Product List'))

@push('css_or_js')
@endpush

@section('content')
    <style>
        .hratebit {
            animation: hratebit 1s infinite;
        }

        @keyframes hratebit {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
    <div class="content container-fluid">

        <!-- Page Title -->
        <div class="mb-4">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('assets/back-end/img/products.png') }}" alt="">
                {{ \App\CPU\translate('Products') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $products->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <form action="{{ url()->current() }}" method="GET">
                                    <!-- Search -->
                                    <div class="input-group input-group-merge input-group-custom">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ \App\CPU\translate('Search by Product Name') }}"
                                            aria-label="Search orders" value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary">{{ \App\CPU\translate('search') }}</button>
                                    </div>
                                    <!-- End Search -->
                                </form>
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                                @if (auth('seller')->user()->tally_sync)
                                    <div>
                                        <button type="button" class="btn btn-outline--primary" data-toggle="dropdown">
                                            <i class="tio-download-to"></i>
                                            {{ \App\CPU\translate('Sysc') }}
                                            <i class="tio-chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <div onclick="sysc_to_tally(this)"
                                                    data-message-success="{{ \App\CPU\translate('Sysc Web to Tally successfully') }}"
                                                    data-message-error="{{ \App\CPU\translate('Sysc Web to Tally failed') }}"
                                                    data-url="{{ route('seller.product.sysc_tally') }}"
                                                    class="dropdown-item">
                                                    {{ \App\CPU\translate('Web to Tally') }}</div>
                                            </li>
                                            <li>
                                                <div onclick="sysc_to_tally(this)"
                                                    data-message-success="{{ \App\CPU\translate('Sysc Tally to Web successfully') }}"
                                                    data-message-error="{{ \App\CPU\translate('Sysc Tally to Web failed') }}"
                                                    data-url="{{ route('seller.product.sysc_web') }}"
                                                    class="dropdown-item">
                                                    {{ \App\CPU\translate('Tally to Web') }}</div>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                        </ul>
                                    </div>
                                @endif
                                <div>
                                    <button type="button" class="btn btn-outline--primary" data-toggle="dropdown">
                                        <i class="tio-download-to"></i>
                                        {{ \App\CPU\translate('export') }}
                                        <i class="tio-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a class="dropdown-item"
                                                href="{{ route('seller.product.bulk-export') }}">{{ \App\CPU\translate('excel') }}</a>
                                        </li>
                                        <div class="dropdown-divider"></div>
                                    </ul>
                                </div>
                                <a href="{{ route('seller.product.adminlist') }}" class="btn btn-info">
                                    <i class="tio-add-circle"></i>
                                    <span class="text">{{ \App\CPU\translate('Admin Product') }}</span>
                                </a>
                                <a href="{{ route('seller.product.stock-limit-list', ['in_house', '']) }}"
                                    class="btn btn-info">
                                    <i class="tio-add-circle"></i>
                                    <span class="text">{{ \App\CPU\translate('Stock Report') }}</span>
                                </a>
                                <a href="{{ route('seller.product.add-new') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ \App\CPU\translate('Add new product') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ \App\CPU\translate('SL') }}</th>
                                    <th>{{ \App\CPU\translate('Product Name') }}</th>
                                    <th>{{ \App\CPU\translate('Product Type') }}</th>
                                    <th>{{ \App\CPU\translate('purchase_price') }}</th>
                                    <th>{{ \App\CPU\translate('selling_price') }}</th>
                                    <th>{{ \App\CPU\translate('Commission') }}</th>
                                    <th>{{ \App\CPU\translate('price_suggestion') }}</th>
                                    <th>{{ \App\CPU\translate('verify_status') }}</th>
                                    <th>{{ \App\CPU\translate('Admin_Verified') }}</th>
                                    <th>{{ \App\CPU\translate('Featured') }}</th>
                                    <th>{{ \App\CPU\translate('Active') }} {{ \App\CPU\translate('status') }}</th>
                                    <th class="text-center __w-5px">{{ \App\CPU\translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $k => $p)
                                    {{-- @dd($p['lowest_market_price']) --}}
                                    <tr>
                                        <th scope="row">{{ $products->firstitem() + $k }}</th>
                                        <td>
                                            <a href="{{ route('seller.product.view', [$p['id']]) }}"
                                                class="media align-items-center gap-2 w-max-content">
                                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $p['thumbnail'] }}"
                                                    onerror="this.src='{{ asset('/public/assets/back-end/img/brand-logo.png') }}'"class="avatar border"
                                                    alt="">
                                                <span class="media-body title-color hover-c1">
                                                    {{ \Illuminate\Support\Str::limit($p['name'], 30) }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>{{ ucfirst($p['product_type']) }}</td>
                                        <td>
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])) }}
                                        </td>
                                        <td>
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price'])) }}
                                        </td>
                                        <td>
                                            @php
                                                $commVal = $p->admin_commission ?? 0;
                                                $commType = $p->admin_commission_type ?? 'percentage';
                                            @endphp
                                            @if ($commVal > 0)
                                                <span class="badge badge-soft-success">
                                                    {{ $commVal }}{{ $commType === 'fixed' ? \App\CPU\BackEndHelper::currency_set_symbol() : '%' }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>

                                            @if ($p['indexing'] != 1 && $p['lowest_market_price'] > $p['actual_amount'])
                                                <div style="color: red;" class="hratebit">
                                                    {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['suggested_price'])) . '-' . \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['lowest_market_price'])) }}
                                                </div>
                                            @endif

                                        </td>
                                        <td>
                                            @if ($p->request_status == 0)
                                                <label
                                                    class="badge badge-soft-warning">{{ \App\CPU\translate('New Request') }}</label>
                                            @elseif($p->request_status == 1)
                                                <label
                                                    class="badge badge-soft-success">{{ \App\CPU\translate('Approved') }}</label>
                                            @elseif($p->request_status == 2)
                                                <label
                                                    class="badge badge-soft-danger">{{ \App\CPU\translate('Denied') }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($p->verified) && $p->verified == 1)
                                                <label class="badge badge-soft-success"><i class="tio-check-circle"></i>
                                                    {{ \App\CPU\translate('Verified') }}</label>
                                            @else
                                                <label class="badge badge-soft-warning"><i class="tio-warning"></i>
                                                    {{ \App\CPU\translate('Unverified') }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($p->featured) && $p->featured == 1)
                                                <span class="badge badge-soft-success"><i class="tio-star"></i> {{ \App\CPU\translate('Featured') }}</span>
                                            @else
                                                <span class="badge badge-soft-secondary">{{ \App\CPU\translate('Not Featured') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <label class="switcher">
                                                <input type="checkbox" class="status switcher_input"
                                                    id="{{ $p['id'] }}" {{ $p->status == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-10">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                    title="{{ \App\CPU\translate('barcode') }}"
                                                    href="{{ route('seller.product.barcode', [$p['id']]) }}">
                                                    <i class="tio-barcode"></i>
                                                </a>

                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                    title="{{ \App\CPU\translate('view') }}"
                                                    href="{{ route('seller.product.view', [$p['id']]) }}">
                                                    <i class="tio-invisible"></i>
                                                </a>

                                                <button type="button" class="btn btn-outline-primary btn-sm square-btn edit-price-btn"
                                                    title="{{ \App\CPU\translate('Edit Price & Variants') }}"
                                                    data-id="{{ $p['id'] }}"
                                                    data-unit-price="{{ \App\CPU\BackEndHelper::usd_to_currency($p['unit_price']) }}"
                                                    data-purchase-price="{{ \App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']) }}"
                                                    data-discount="{{ $p['discount'] ?? 0 }}"
                                                    data-discount-type="{{ $p['discount_type'] ?? 'flat' }}"
                                                    data-tax="{{ $p['tax'] ?? 0 }}"
                                                    data-tax-model="{{ $p['tax_model'] ?? 'include' }}"
                                                    data-shipping-cost="{{ \App\CPU\BackEndHelper::usd_to_currency($p['shipping_cost'] ?? 0) }}"
                                                    data-min-order="{{ $p['minimum_order_qty'] ?? 1 }}"
                                                    data-current-stock="{{ $p['current_stock'] ?? 0 }}"
                                                    data-name="{{ $p['name'] }}">
                                                    <i class="tio-money"></i>
                                                </button>

                                                @php
                                                    $editReq = \App\Model\ProductEditRequest::where('product_id', $p['id'])
                                                        ->where('seller_id', auth('seller')->id())
                                                        ->latest()
                                                        ->first();
                                                    $hasApprovedEdit = $editReq && $editReq->status == 'approved';
                                                    $hasPendingEdit = $editReq && $editReq->status == 'pending';
                                                @endphp

                                                @if($hasApprovedEdit)
                                                    <a class="btn btn-outline-primary btn-sm square-btn"
                                                        title="{{ \App\CPU\translate('Edit') }}"
                                                        href="{{ route('seller.product.edit', [$p['id']]) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                @elseif($hasPendingEdit)
                                                    <span class="btn btn-outline-warning btn-sm square-btn" title="{{ \App\CPU\translate('Edit request pending') }}">
                                                        <i class="tio-time"></i>
                                                    </span>
                                                @else
                                                    <button type="button" class="btn btn-outline-secondary btn-sm square-btn"
                                                        title="{{ \App\CPU\translate('Request Edit Access') }}"
                                                        data-toggle="modal" data-target="#editRequestModal{{ $p['id'] }}">
                                                        <i class="tio-lock"></i>
                                                    </button>

                                                    <!-- Edit Request Modal -->
                                                    <div class="modal fade" id="editRequestModal{{ $p['id'] }}" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{ route('seller.product.request-edit') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="product_id" value="{{ $p['id'] }}">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">{{ \App\CPU\translate('Request Edit Access') }}</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label>{{ \App\CPU\translate('Reason for editing') }} <span class="text-danger">*</span></label>
                                                                            <textarea name="note" class="form-control" rows="4" required
                                                                                placeholder="{{ \App\CPU\translate('Enter reason for editing this product') }}"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ \App\CPU\translate('Cancel') }}</button>
                                                                        <button type="submit" class="btn btn--primary">{{ \App\CPU\translate('Send Request') }}</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif

                                                <a class="btn btn-outline-danger btn-sm square-btn" href="javascript:"
                                                    title="{{ \App\CPU\translate('Delete') }}"
                                                    onclick="form_alert('product-{{ $p['id'] }}','{{ \App\CPU\translate('Want to delete this item') }} ?')">
                                                    <i class="tio-delete"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('seller.product.delete', [$p['id']]) }}" method="post"
                                                id="product-{{ $p['id'] }}">
                                                @csrf @method('delete')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $products->links() }}
                        </div>
                    </div>

                    @if (count($products) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ \App\CPU\translate('No data to show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Price & Variants Modal -->
    <div class="modal fade" id="editPriceVariantsModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="max-height: 85vh; display: flex; flex-direction: column;">
                <div class="modal-header" style="border-bottom: 1px solid #dee2e6; padding: 12px 20px; background: #f8f9fa;">
                    <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
                        <i class="tio-money mr-1"></i> {{ \App\CPU\translate('Edit Price & Variants') }}
                        <span class="text-primary ml-1" id="modalProductName" style="font-size: 14px;"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="padding: 4px 8px;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: auto; flex: 1; padding: 20px;">
                    <input type="hidden" id="editProductId">

                    <div class="card mb-3" style="border: 1px solid #e9ecef;">
                        <div class="card-header py-2" style="background: #f1f3f5;">
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px;">
                                <i class="tio-money mr-1"></i> {{ \App\CPU\translate('Product_price_&_stock') }}
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Unit_price') }} <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editUnitPrice">
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Market price') }} <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editPurchasePrice">
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Tax') }}</label>
                                    <label class="badge badge-soft-info mb-1" style="font-size: 10px;">{{ \App\CPU\translate('Percent') }} ( % )</label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editTax">
                                    <input type="hidden" name="tax_type" value="percent">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Tax_Model') }}</label>
                                    <select class="form-control form-control-sm" id="editTaxModel">
                                        <option value="include">{{ \App\CPU\translate('include') }}</option>
                                        <option value="exclude">{{ \App\CPU\translate('exclude') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('discount_type') }}</label>
                                    <select class="form-control form-control-sm" id="editDiscountType">
                                        <option value="flat">{{ \App\CPU\translate('Flat') }}</option>
                                        <option value="percent">{{ \App\CPU\translate('Percent') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Discount') }}</label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editDiscount">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('total') }} {{ \App\CPU\translate('Quantity') }}</label>
                                    <input type="number" min="0" step="1" class="form-control form-control-sm" id="editCurrentStock">
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('minimum_order_quantity') }}</label>
                                    <input type="number" min="1" step="1" class="form-control form-control-sm" id="editMinOrder">
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('shipping_cost') }}</label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editShippingCost">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="border: 1px solid #e9ecef;">
                        <div class="card-header py-2" style="background: #f1f3f5;">
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px;">
                                <i class="tio-list mr-1"></i> {{ \App\CPU\translate('Variants') }}
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div id="editVariantsContainer">
                                <p class="text-muted text-center mb-0">
                                    <i class="fa fa-spinner fa-spin mr-1"></i> {{ \App\CPU\translate('Loading variants...') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 12px 20px; background: #f8f9fa;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        <i class="tio-clear mr-1"></i> {{ \App\CPU\translate('Cancel') }}
                    </button>
                    <button type="button" class="btn btn--primary btn-sm" id="savePriceVariantsBtn">
                        <i class="tio-save mr-1"></i>
                        <span id="saveBtnText">{{ \App\CPU\translate('Save Changes') }}</span>
                        <span id="saveBtnLoader" class="d-none"><i class="fa fa-spinner fa-spin mr-1"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.status').on('change', function() {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            let t = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('seller.product.status-update') }}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ \App\CPU\translate('Status updated successfully') }}');
                    } else if (data.success == false) {
                        t.removeAttr('checked');
                        toastr.error(
                            '{{ \App\CPU\translate('Status updated failed. Product must be approved') }}'
                            );
                    }
                }
            });
        });

        function sysc_to_tally(element) {
            var url = element.getAttribute('data-url');

            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    if (data.success == true) {
                        toastr.success(element.getAttribute('data-message-success'));
                    } else {
                        toastr.error(element.getAttribute('data-message-error'));
                    }
                }
            });
        }

        // Edit Price & Variants Modal
        $(document).on('click', '.edit-price-btn', function() {
            var btn = $(this);
            var productId = btn.data('id');

            $('#editProductId').val(productId);
            $('#modalProductName').text(btn.data('name'));
            $('#editUnitPrice').val(btn.data('unit-price'));
            $('#editPurchasePrice').val(btn.data('purchase-price'));
            $('#editDiscount').val(btn.data('discount'));
            $('#editDiscountType').val(btn.data('discount-type'));
            $('#editTax').val(btn.data('tax'));
            $('#editTaxModel').val(btn.data('tax-model'));
            $('#editShippingCost').val(btn.data('shipping-cost'));
            $('#editMinOrder').val(btn.data('min-order'));
            $('#editCurrentStock').val(btn.data('current-stock'));

            // Load variations via AJAX
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $.ajax({
                url: "{{ route('seller.product.get-variations') }}",
                method: 'POST',
                data: { id: productId },
                success: function(data) {
                    var container = $('#editVariantsContainer');
                    container.empty();

                    if (data.variations && data.variations.length > 0) {
                        data.variations.forEach(function(variant) {
                            container.append(`
                                <div class="row mb-2 variant-row align-items-center p-2" style="background: #f8f9fa; border-radius: 4px;">
                                    <div class="col-md-3">
                                        <label class="title-color mb-0" style="font-size: 12px; font-weight: 600;">${variant.type}</label>
                                        <input type="hidden" class="variant-type" value="${variant.type}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Price') }}</label>
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm variant-price" value="${variant.price || 0}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Quantity') }}</label>
                                        <input type="number" min="0" class="form-control form-control-sm variant-qty" value="${variant.qty || 0}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="title-color mb-0" style="font-size: 11px;">SKU</label>
                                        <input type="text" class="form-control form-control-sm variant-sku" value="${variant.sku || ''}">
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        container.append(`
                            <div class="row mb-2 variant-row align-items-center p-2" style="background: #f8f9fa; border-radius: 4px;">
                                <div class="col-md-3">
                                    <label class="title-color mb-0" style="font-size: 12px; font-weight: 600;">Default</label>
                                    <input type="hidden" class="variant-type" value="default">
                                </div>
                                <div class="col-md-3">
                                    <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Price') }}</label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm variant-price" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Quantity') }}</label>
                                    <input type="number" min="0" class="form-control form-control-sm variant-qty" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="title-color mb-0" style="font-size: 11px;">SKU</label>
                                    <input type="text" class="form-control form-control-sm variant-sku" value="">
                                </div>
                            </div>
                        `);
                    }
                }
            });

            $('#editPriceVariantsModal').modal('show');
        });

        // Save Price & Variants
        $('#savePriceVariantsBtn').on('click', function() {
            var productId = $('#editProductId').val();
            var variants = [];

            $('.variant-row').each(function() {
                variants.push({
                    type: $(this).find('.variant-type').val(),
                    price: $(this).find('.variant-price').val(),
                    qty: $(this).find('.variant-qty').val(),
                    sku: $(this).find('.variant-sku').val()
                });
            });

            $('#saveBtnText').addClass('d-none');
            $('#saveBtnLoader').removeClass('d-none');
            $('#savePriceVariantsBtn').prop('disabled', true);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $.ajax({
                url: "{{ route('seller.product.update-price-variants') }}",
                method: 'POST',
                data: {
                    id: productId,
                    unit_price: $('#editUnitPrice').val(),
                    purchase_price: $('#editPurchasePrice').val(),
                    discount: $('#editDiscount').val(),
                    discount_type: $('#editDiscountType').val(),
                    tax: $('#editTax').val(),
                    tax_model: $('#editTaxModel').val(),
                    shipping_cost: $('#editShippingCost').val(),
                    minimum_order_qty: $('#editMinOrder').val(),
                    variants: variants
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.message);
                        $('#editPriceVariantsModal').modal('hide');
                        location.reload();
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    toastr.error('{{ \App\CPU\translate("Something went wrong") }}');
                },
                complete: function() {
                    $('#saveBtnText').removeClass('d-none');
                    $('#saveBtnLoader').addClass('d-none');
                    $('#savePriceVariantsBtn').prop('disabled', false);
                }
            });
        });
    </script>
@endpush
