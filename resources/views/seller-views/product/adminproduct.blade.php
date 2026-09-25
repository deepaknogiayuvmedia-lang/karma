@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('Copy Product List'))

@push('css_or_js')
@endpush

@section('content')
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
                        <div class="row align-items-center justify-content-between">
                            <div class="col-lg-6">
                                <h1>{{ \App\CPU\translate('Copy Product List') }}</h1>
                            </div>
                            <div class="col-lg-4 ">
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
                                            aria-label="Search orders" value="{{ $search }}">
                                        <button type="submit"
                                            class="btn btn--primary">{{ \App\CPU\translate('search') }}</button>
                                    </div>
                                    <!-- End Search -->
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ \App\CPU\translate('Product Name') }}</th>
                                    <th>{{ \App\CPU\translate('Unit_price') }}</th>
                                    <th>{{ \App\CPU\translate('Market price') }}</th>
                                    <th>{{ \App\CPU\translate('Commission') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $k => $p)
                                    @php
                                        $commVal = $p->admin_commission ?? 0;
                                        $commType = $p->admin_commission_type ?? 'percentage';
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ route('seller.product.view', [$p['id']]) }}"
                                                class="media align-items-center gap-2 w-max-content">
                                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $p['thumbnail'] }}"
                                                    onerror="this.src='{{ asset('/assets/back-end/img/brand-logo.png') }}'"
                                                    class="avatar border" alt="">
                                                <span class="media-body title-color hover-c1">
                                                    {{ \Illuminate\Support\Str::limit($p['name'], 30) }}
                                                </span>
                                            </a>
                                        </td>
                                        <td>
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price'])) }}
                                        </td>
                                        <td>
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])) }}
                                        </td>
                                        <td>
                                            @if ($commVal > 0)
                                                <span class="badge badge-soft-success">
                                                    {{ $commVal }}{{ $commType === 'fixed' ? \App\CPU\BackEndHelper::currency_set_symbol() : '%' }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <button type="button"
                                                class="btn btn--primary btn-sm copy-product-btn"
                                                data-id="{{ $p['id'] }}"
                                                data-name="{{ $p['name'] }}"
                                                data-unit="{{ $p['unit'] ?? 'pc' }}"
                                                data-unit-price="{{ \App\CPU\BackEndHelper::usd_to_currency($p['unit_price']) }}"
                                                data-purchase-price="{{ \App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']) }}"
                                                data-tax="{{ $p['tax'] ?? 0 }}"
                                                data-tax-model="{{ $p['tax_model'] ?? 'include' }}"
                                                data-discount="{{ $p['discount'] ?? 0 }}"
                                                data-discount-type="{{ $p['discount_type'] ?? 'flat' }}"
                                                data-shipping-cost="{{ \App\CPU\BackEndHelper::usd_to_currency($p['shipping_cost'] ?? 0) }}"
                                                data-min-order="{{ $p['minimum_order_qty'] ?? 1 }}">
                                                <i class="tio-copy"></i>
                                                {{ \App\CPU\translate('Copy') }}
                                            </button>
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

    <!-- Copy Product Modal (same as seller product variant modal) -->
    <div class="modal fade" id="copyProductModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="max-height: 85vh; display: flex; flex-direction: column;">
                <div class="modal-header"
                    style="border-bottom: 1px solid #dee2e6; padding: 12px 20px; background: #f8f9fa;">
                    <h5 class="modal-title font-weight-bold" style="font-size: 16px;">
                        <i class="tio-copy mr-1"></i> {{ \App\CPU\translate('Copy Product') }}
                        <span class="text-primary ml-1" id="copyProductName" style="font-size: 14px;"></span>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" style="padding: 4px 8px;">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="overflow-y: auto; flex: 1; padding: 20px;">
                    <input type="hidden" id="copyProductId">
                    <input type="hidden" id="deletedVariants" value="">
                    <input type="hidden" id="newVariantsAdded" value="0">

                    <div class="card mb-3" style="border: 1px solid #e9ecef;">
                        <div class="card-header py-2" style="background: #f1f3f5;">
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px;">
                                <i class="tio-money mr-1"></i> {{ \App\CPU\translate('Product_price_&_stock') }}
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('Unit') }} <span
                                            class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" id="copyUnit">
                                        @foreach (\App\CPU\Helpers::units() as $x)
                                            <option value="{{ $x }}">{{ $x }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('Unit_price') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control form-control-sm" id="copyUnitPrice">
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('Market price') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control form-control-sm" id="copyPurchasePrice">
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('Tax') }}</label>
                                    <label class="badge badge-soft-info mb-1"
                                        style="font-size: 10px;">{{ \App\CPU\translate('Percent') }} ( % )</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control form-control-sm" id="copyTax">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('Tax_Model') }}</label>
                                    <select class="form-control form-control-sm" id="copyTaxModel">
                                        <option value="include">{{ \App\CPU\translate('include') }}</option>
                                        <option value="exclude">{{ \App\CPU\translate('exclude') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('discount_type') }}</label>
                                    <select class="form-control form-control-sm" id="copyDiscountType">
                                        <option value="flat">{{ \App\CPU\translate('Flat') }}</option>
                                        <option value="percent">{{ \App\CPU\translate('Percent') }}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('Discount') }}</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control form-control-sm" id="copyDiscount">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('minimum_order_quantity') }}</label>
                                    <input type="number" min="1" step="1"
                                        class="form-control form-control-sm" id="copyMinOrder">
                                </div>
                                <div class="col-md-6 form-group mb-2">
                                    <label class="title-color mb-1"
                                        style="font-size: 12px;">{{ \App\CPU\translate('shipping_cost') }}</label>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control form-control-sm" id="copyShippingCost">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" style="border: 1px solid #e9ecef;">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center"
                            style="background: #f1f3f5;">
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px;">
                                <i class="tio-list mr-1"></i> {{ \App\CPU\translate('Variants') }}
                            </h6>
                            <button type="button" class="btn btn--primary btn-sm" id="addVariantBtn"
                                style="font-size: 12px; padding: 3px 10px;">
                                <i class="tio-add mr-1"></i> {{ \App\CPU\translate('Add Variant') }}
                            </button>
                        </div>
                        <div class="card-body p-3">
                            <div id="copyVariantsContainer">
                                <p class="text-muted text-center mb-0">
                                    <i class="fa fa-spinner fa-spin mr-1"></i>
                                    {{ \App\CPU\translate('Loading variants...') }}
                                </p>
                            </div>

                            <div id="addVariantForm" class="mt-3 d-none"
                                style="border: 1px dashed #4e73df; border-radius: 6px; padding: 12px; background: #f0f4ff;">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="title-color mb-1"
                                            style="font-size: 12px;">{{ \App\CPU\translate('Variant Name') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="newVariantType"
                                            placeholder="e.g. Red-XL">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-1"
                                            style="font-size: 12px;">{{ \App\CPU\translate('Price') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0"
                                            class="form-control form-control-sm" id="newVariantPrice" placeholder="0.00">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-1"
                                            style="font-size: 12px;">{{ \App\CPU\translate('Quantity') }} <span
                                                class="text-danger">*</span></label>
                                        <input type="number" min="0" class="form-control form-control-sm"
                                            id="newVariantQty" placeholder="0">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-1" style="font-size: 12px;">SKU</label>
                                        <input type="text" class="form-control form-control-sm" id="newVariantSku"
                                            placeholder="SKU">
                                    </div>
                                    <div class="col-md-3 d-flex gap-1">
                                        <button type="button" class="btn btn--primary btn-sm" id="confirmAddVariantBtn"
                                            style="font-size: 12px; padding: 5px 12px;">
                                            <i class="tio-check mr-1"></i> {{ \App\CPU\translate('Add') }}
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" id="cancelAddVariantBtn"
                                            style="font-size: 12px; padding: 5px 12px;">
                                            <i class="tio-clear mr-1"></i> {{ \App\CPU\translate('Cancel') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #dee2e6; padding: 12px 20px; background: #f8f9fa;">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        <i class="tio-clear mr-1"></i> {{ \App\CPU\translate('Cancel') }}
                    </button>
                    <button type="button" class="btn btn--primary btn-sm" id="confirmCopyBtn"
                        onclick="confirmCopyProduct()">
                        <i class="tio-copy mr-1"></i>
                        <span id="copyBtnText">{{ \App\CPU\translate('Copy_Product') }}</span>
                        <span id="copyBtnLoader" class="d-none"><i class="fa fa-spinner fa-spin mr-1"></i></span>
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        function currencyToNumber(val) {
            if (val === null || val === undefined || val === '') return 0;
            var n = parseFloat(String(val).replace(/[^\d.-]/g, ''));
            return isNaN(n) ? 0 : n;
        }

        // Open copy modal with price fields + variants
        $(document).on('click', '.copy-product-btn', function() {
            var btn = $(this);
            var productId = btn.data('id');

            $('#copyProductId').val(productId);
            $('#copyProductName').text(btn.data('name'));
            $('#copyUnit').val(btn.data('unit') || 'pc');
            $('#copyUnitPrice').val(btn.data('unit-price'));
            $('#copyPurchasePrice').val(btn.data('purchase-price'));
            $('#copyTax').val(btn.data('tax'));
            $('#copyTaxModel').val(btn.data('tax-model'));
            $('#copyDiscount').val(btn.data('discount'));
            $('#copyDiscountType').val(btn.data('discount-type'));
            $('#copyShippingCost').val(btn.data('shipping-cost'));
            $('#copyMinOrder').val(btn.data('min-order'));
            $('#deletedVariants').val('');
            $('#newVariantsAdded').val('0');
            $('#addVariantForm').addClass('d-none');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('seller.product.get-variations') }}",
                method: 'POST',
                data: {
                    id: productId
                },
                success: function(data) {
                    var container = $('#copyVariantsContainer');
                    container.empty();
                    $('#deletedVariants').val('');

                    if (data.variations && data.variations.length > 0) {
                        data.variations.forEach(function(variant) {
                            container.append(`
                                <div class="row mb-2 variant-row align-items-center p-2" style="background: #f8f9fa; border-radius: 4px;">
                                    <div class="col-md-2">
                                        <label class="title-color mb-0" style="font-size: 12px; font-weight: 600;">${variant.type}</label>
                                        <input type="hidden" class="variant-type" value="${variant.type}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Price') }}</label>
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm variant-price" value="${variant.price || 0}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Quantity') }}</label>
                                        <input type="number" min="0" class="form-control form-control-sm variant-qty" value="${variant.qty || 0}">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="title-color mb-0" style="font-size: 11px;">SKU</label>
                                        <input type="text" class="form-control form-control-sm variant-sku" value="${variant.sku || ''}">
                                    </div>
                                    <div class="col-md-2 text-right">
                                        <label class="title-color mb-0 d-block" style="font-size: 11px; visibility: hidden;">-</label>
                                        <button type="button" class="btn btn-danger btn-sm delete-variant-btn" title="{{ \App\CPU\translate('Delete Variant') }}" style="padding: 4px 8px; font-size: 11px;">
                                            <i class="tio-delete"></i>
                                        </button>
                                    </div>
                                </div>
                            `);
                        });
                    } else {
                        container.append(`
                            <div class="row mb-2 variant-row align-items-center p-2" style="background: #f8f9fa; border-radius: 4px;">
                                <div class="col-md-2">
                                    <label class="title-color mb-0" style="font-size: 12px; font-weight: 600;">Default</label>
                                    <input type="hidden" class="variant-type" value="default">
                                </div>
                                <div class="col-md-3">
                                    <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Price') }}</label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm variant-price" value="0">
                                </div>
                                <div class="col-md-2">
                                    <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Quantity') }}</label>
                                    <input type="number" min="0" class="form-control form-control-sm variant-qty" value="0">
                                </div>
                                <div class="col-md-3">
                                    <label class="title-color mb-0" style="font-size: 11px;">SKU</label>
                                    <input type="text" class="form-control form-control-sm variant-sku" value="">
                                </div>
                                <div class="col-md-2 text-right">
                                    <label class="title-color mb-0 d-block" style="font-size: 11px; visibility: hidden;">-</label>
                                    <button type="button" class="btn btn-danger btn-sm delete-variant-btn" title="{{ \App\CPU\translate('Delete Variant') }}" style="padding: 4px 8px; font-size: 11px;">
                                        <i class="tio-delete"></i>
                                    </button>
                                </div>
                            </div>
                        `);
                    }
                    $('#copyProductModal').modal('show');
                },
                error: function() {
                    toastr.error('{{ \App\CPU\translate('Failed to load product variations') }}');
                }
            });
        });

        // Confirm copy product
        function confirmCopyProduct() {
            var id = $('#copyProductId').val();
            var variants = [];

            $('.variant-row').each(function() {
                variants.push({
                    type: $(this).find('.variant-type').val(),
                    price: $(this).find('.variant-price').val(),
                    qty: $(this).find('.variant-qty').val(),
                    sku: $(this).find('.variant-sku').val()
                });
            });

            var deletedVariants = $('#deletedVariants').val() ? $('#deletedVariants').val().split(',').filter(
                Boolean) : [];

            $('#copyBtnText').addClass('d-none');
            $('#copyBtnLoader').removeClass('d-none');
            $('#confirmCopyBtn').prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('seller.product.admintoseller') }}",
                method: 'POST',
                data: {
                    id: id,
                    price: currencyToNumber($('#copyUnitPrice').val()),
                    unit: $('#copyUnit').val(),
                    purchase_price: currencyToNumber($('#copyPurchasePrice').val()),
                    tax: currencyToNumber($('#copyTax').val()),
                    tax_model: $('#copyTaxModel').val(),
                    discount: currencyToNumber($('#copyDiscount').val()),
                    discount_type: $('#copyDiscountType').val(),
                    shipping_cost: currencyToNumber($('#copyShippingCost').val()),
                    minimum_order_qty: currencyToNumber($('#copyMinOrder').val()) || 1,
                    variants: variants,
                    deleted_variants: deletedVariants
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.message);
                        $('#copyProductModal').modal('hide');
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    toastr.error('{{ \App\CPU\translate('Something went wrong') }}');
                },
                complete: function() {
                    $('#copyBtnText').removeClass('d-none');
                    $('#copyBtnLoader').addClass('d-none');
                    $('#confirmCopyBtn').prop('disabled', false);
                }
            });
        }

        // Add Variant - Show form
        $(document).on('click', '#addVariantBtn', function() {
            $('#addVariantForm').removeClass('d-none');
            $('#newVariantType').val('').focus();
            $('#newVariantPrice').val('');
            $('#newVariantQty').val('');
            $('#newVariantSku').val('');
        });

        // Cancel Add Variant
        $(document).on('click', '#cancelAddVariantBtn', function() {
            $('#addVariantForm').addClass('d-none');
        });

        // Confirm Add Variant
        $(document).on('click', '#confirmAddVariantBtn', function() {
            var variantType = $.trim($('#newVariantType').val());
            var variantPrice = $('#newVariantPrice').val();
            var variantQty = $('#newVariantQty').val();
            var variantSku = $('#newVariantSku').val();

            if (!variantType) {
                toastr.error('{{ \App\CPU\translate('Variant name is required') }}');
                $('#newVariantType').focus();
                return;
            }
            if (!variantPrice || parseFloat(variantPrice) < 0) {
                toastr.error('{{ \App\CPU\translate('Valid price is required') }}');
                $('#newVariantPrice').focus();
                return;
            }
            if (!variantQty || parseInt(variantQty) < 0) {
                toastr.error('{{ \App\CPU\translate('Valid quantity is required') }}');
                $('#newVariantQty').focus();
                return;
            }

            var exists = false;
            $('.variant-row').each(function() {
                if ($(this).find('.variant-type').val() === variantType) {
                    exists = true;
                }
            });
            if (exists) {
                toastr.error('{{ \App\CPU\translate('Variant with this name already exists') }}');
                return;
            }

            var container = $('#copyVariantsContainer');
            container.append(`
                <div class="row mb-2 variant-row align-items-center p-2" style="background: #f0fff4; border-radius: 4px; border: 1px solid #28a745;">
                    <div class="col-md-2">
                        <label class="title-color mb-0" style="font-size: 12px; font-weight: 600;">${variantType}</label>
                        <input type="hidden" class="variant-type" value="${variantType}">
                    </div>
                    <div class="col-md-3">
                        <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Price') }}</label>
                        <input type="number" step="0.01" min="0" class="form-control form-control-sm variant-price" value="${variantPrice}">
                    </div>
                    <div class="col-md-2">
                        <label class="title-color mb-0" style="font-size: 11px;">{{ \App\CPU\translate('Quantity') }}</label>
                        <input type="number" min="0" class="form-control form-control-sm variant-qty" value="${variantQty}">
                    </div>
                    <div class="col-md-3">
                        <label class="title-color mb-0" style="font-size: 11px;">SKU</label>
                        <input type="text" class="form-control form-control-sm variant-sku" value="${variantSku || ''}">
                    </div>
                    <div class="col-md-2 text-right">
                        <label class="title-color mb-0 d-block" style="font-size: 11px; visibility: hidden;">-</label>
                        <button type="button" class="btn btn-danger btn-sm delete-variant-btn" title="{{ \App\CPU\translate('Delete Variant') }}" style="padding: 4px 8px; font-size: 11px;">
                            <i class="tio-delete"></i>
                        </button>
                    </div>
                </div>
            `);

            $('#addVariantForm').addClass('d-none');
            toastr.success('{{ \App\CPU\translate('Variant added') }}');
        });

        // Delete Variant
        $(document).on('click', '.delete-variant-btn', function() {
            var btn = $(this);
            var row = btn.closest('.variant-row');
            var variantType = row.find('.variant-type').val();

            swal({
                title: "{{ \App\CPU\translate('Are you sure?') }}",
                text: "{{ \App\CPU\translate('Are you sure you want to delete this variant?') }}",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                confirmButtonText: "{{ \App\CPU\translate('OK') }}",
            }).then(function(willDelete) {
                if (willDelete.value) {
                    var deleted = $('#deletedVariants').val() ? $('#deletedVariants').val() : '';
                    if (deleted) {
                        deleted += ',' + variantType;
                    } else {
                        deleted = variantType;
                    }
                    $('#deletedVariants').val(deleted);

                    row.fadeOut(300, function() {
                        $(this).remove();
                    });
                }
            });
        });
    </script>
@endpush
