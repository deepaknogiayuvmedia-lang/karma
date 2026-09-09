@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product List'))

@push('css_or_js')
    <style>
        .nav-custom .nav-link {
            font-size: 14px;
            padding: 6px 14px;
            border-radius: 8px;
            margin-right: 4px;
            color: #666;
        }

        .nav-custom .nav-link.active {
            background-color: #1a1a2e;
            color: #fff;
        }

        .modal-backdrop {
            background-color: #00000047 !important;
        }

        #viewSellerModal .modal-dialog,
        #commissionModal .modal-dialog {
            display: flex !important;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 1rem);
            max-width: 800px;
            margin: 0.5rem auto;
        }

        #viewSellerModal .modal-content,
        #commissionModal .modal-content {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        }

        #commissionModal .modal-dialog {
            max-width: 450px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset('/public/assets/back-end/img/inhouse-product-list.png') }}" alt="">
                @if ($type == 'in_house')
                    {{ \App\CPU\translate('In-House_Product_List') }}
                @elseif($type == 'seller')
                    {{ \App\CPU\translate('Seller_Product_List') }}
                @endif
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $pro->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ \App\CPU\translate('Search Product Name') }}"
                                            aria-label="Search orders" value="{{ $search }}" required>
                                        <input type="hidden" value="{{ $request_status }}" name="status">
                                        <button type="submit"
                                            class="btn btn--primary">{{ \App\CPU\translate('search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                                @if (auth('seller')->user() && auth('seller')->user()->tally_sync)
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
                                                    data-url="{{ route('admin.product.sysc-tally') }}"
                                                    class="dropdown-item">
                                                    {{ \App\CPU\translate('Web to Tally') }}</div>
                                            </li>
                                            <li>
                                                <div onclick="sysc_to_tally(this)"
                                                    data-message-success="{{ \App\CPU\translate('Sysc Tally to Web successfully') }}"
                                                    data-message-error="{{ \App\CPU\translate('Sysc Tally to Web failed') }}"
                                                    data-url="{{ route('admin.product.sysc-web') }}" class="dropdown-item">
                                                    {{ \App\CPU\translate('Tally to Web') }}</div>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                        </ul>
                                    </div>
                                @endif
                                @if ($type == 'in_house')
                                    <div>
                                        <button type="button" class="btn btn-outline--primary" data-toggle="dropdown">
                                            <i class="tio-download-to"></i>
                                            {{ \App\CPU\translate('Export') }}
                                            <i class="tio-chevron-down"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('admin.product.export-excel', ['in_house', '']) }}">{{ \App\CPU\translate('Excel') }}</a>
                                            </li>
                                            <div class="dropdown-divider"></div>
                                        </ul>
                                    </div>
                                    <a href="{{ route('admin.product.stock-limit-list', ['in_house']) }}"
                                        class="btn btn-info">
                                        <span class="text">{{ \App\CPU\translate('Stock Report') }}</span>
                                    </a>
                                @endif
                                @if (!isset($request_status) || $request_status == 'all')
                                    <a href="{{ route('admin.product.add-new') }}" class="btn btn--primary">
                                        <i class="tio-add"></i>
                                        <span class="text">{{ \App\CPU\translate('Add_New_Product') }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable"
                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th class="text-center" style="width:40px;">
                                        <input type="checkbox" id="selectAll" class="select-all-checkbox">
                                    </th>
                                    <th>{{ \App\CPU\translate('SL') }}</th>
                                    <th>{{ \App\CPU\translate('Product Name') }}</th>
                                    <th class="text-right">{{ \App\CPU\translate('Commission') }}</th>
                                    <th class="text-right">{{ \App\CPU\translate('purchase_price') }}</th>
                                    <th class="text-right">{{ \App\CPU\translate('selling_price') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Show_as_featured') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Active') }}
                                        {{ \App\CPU\translate('status') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Seller ') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pro as $k => $p)
                                    <tr>
                                        <td class="text-center">
                                            <input type="checkbox" class="product-checkbox" value="{{ $p['id'] }}">
                                        </td>
                                        <th scope="row">{{ $pro->firstItem() + $k }}</th>
                                        <td>
                                            <a href="{{ route('admin.product.view', [$p['id']]) }}"
                                                class="media align-items-center gap-2">
                                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $p['thumbnail'] }}"
                                                    onerror="this.src='{{ asset('/public/assets/back-end/img/brand-logo.png') }}'"
                                                    class="avatar border" alt="">
                                                <span class="media-body title-color hover-c1">
                                                    {{ \Illuminate\Support\Str::limit($p['name'], 20) }}
                                                </span>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            <button type="button"
                                                class="btn btn-outline--primary btn-sm set-commission-btn"
                                                data-id="{{ $p['id'] }}"
                                                data-name="{{ \Illuminate\Support\Str::limit($p['name'], 20) }}"
                                                data-commission="{{ $p['admin_commission_type'] == 'fixed' ? \App\CPU\BackEndHelper::usd_to_currency($p['admin_commission'] ?? 0) : $p['admin_commission'] ?? 0 }}"
                                                data-type="{{ $p['admin_commission_type'] ?? 'percentage' }}">
                                                @if ($p['admin_commission_type'] == 'percentage')
                                                    {{ $p['admin_commission'] }}%
                                                @elseif($p['admin_commission'] > 0)
                                                    {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['admin_commission'])) }}
                                                @else
                                                    <i class="tio-plus-circle"></i> Set
                                                @endif
                                            </button>
                                        </td>
                                        <td class="text-right">
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])) }}
                                        </td>
                                        <td class="text-right">
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price'])) }}
                                        </td>
                                        <td class="text-center">
                                            <label class="mx-auto switcher">
                                                <input class="switcher_input" type="checkbox"
                                                    onclick="featured_status('{{ $p['id'] }}')"
                                                    {{ $p->featured == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <label class="mx-auto switcher">
                                                <input type="checkbox" class="status switcher_input"
                                                    id="{{ $p['id'] }}" {{ $p->status == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            @if ($p['added_by'] == 'seller' && $p->seller)
                                                @php($uploaderSeller = $p->seller)
                                                @php($shop = $uploaderSeller->shop)
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <button type="button"
                                                        class="btn btn-soft-primary btn-sm show-uploader-seller-btn text-capitalize"
                                                        data-seller-name="{{ $uploaderSeller->f_name . ' ' . $uploaderSeller->l_name }}"
                                                        data-shop-name="{{ $shop ? $shop->name : 'N/A' }}"
                                                        data-phone="{{ $uploaderSeller->phone ?? ($shop ? $shop->contact : 'N/A') }}"
                                                        data-email="{{ $uploaderSeller->email ?? 'N/A' }}"
                                                        data-address="{{ $shop ? $shop->address : 'N/A' }}"
                                                        data-status="{{ $uploaderSeller->status }}"
                                                        data-profile-url="{{ route('admin.sellers.view', $uploaderSeller->id) }}"
                                                        data-product-name="{{ \Illuminate\Support\Str::limit($p['name'], 30) }}"
                                                        title="{{ \App\CPU\translate('View Seller Details') }}">
                                                        <i class="tio-user"></i>
                                                        {{ \Illuminate\Support\Str::limit($shop ? $shop->name : $uploaderSeller->f_name . ' ' . $uploaderSeller->l_name, 15) }}
                                                    </button>

                                                    @php($copiedCount = \App\Model\Product::where('pid', $p['id'])->count())
                                                    @if ($copiedCount > 0)
                                                        <button type="button" class="btn btn-outline-info btn-xs mt-1"
                                                            onclick="viewSellers({{ $p['id'] }}, '{{ \Illuminate\Support\Str::limit($p['name'], 20) }}')"
                                                            title="{{ \App\CPU\translate('Sellers who copied') }}">
                                                            <i class="tio-group"></i> {{ $copiedCount }} Copied
                                                        </button>
                                                    @endif
                                                </div>
                                            @elseif($p['added_by'] == 'admin')
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <span class="badge badge-soft-info">{{ \App\CPU\translate('In-House') }}</span>
                                                    @php($copiedCount = \App\Model\Product::where('pid', $p['id'])->count())
                                                    @if ($copiedCount > 0)
                                                        <button type="button" class="btn btn-outline-info btn-xs mt-1"
                                                            onclick="viewSellers({{ $p['id'] }}, '{{ \Illuminate\Support\Str::limit($p['name'], 20) }}')"
                                                            title="{{ \App\CPU\translate('Sellers who copied') }}">
                                                            <i class="tio-group"></i> {{ $copiedCount }} Copied
                                                        </button>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                    title="{{ \App\CPU\translate('barcode') }}"
                                                    href="{{ route('admin.product.barcode', [$p['id']]) }}">
                                                    <i class="tio-barcode"></i>
                                                </a>
                                                <a class="btn btn-outline-info btn-sm square-btn" title="View"
                                                    href="{{ route('admin.product.view', [$p['id']]) }}">
                                                    <i class="tio-invisible"></i>
                                                </a>
                                                <button type="button" class="btn btn-outline-primary btn-sm square-btn edit-price-btn"
                                                    title="{{ \App\CPU\translate('Edit Price & Variants') }}"
                                                    data-id="{{ $p['id'] }}"
                                                    data-unit="{{ $p['unit'] ?? 'pc' }}"
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
                                                <a class="btn btn-outline--primary btn-sm square-btn"
                                                    title="{{ \App\CPU\translate('Edit') }}"
                                                    href="{{ route('admin.product.edit', [$p['id']]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-sm square-btn" href="javascript:"
                                                    title="{{ \App\CPU\translate('Delete') }}"
                                                    onclick="form_alert('product-{{ $p['id'] }}','Want to delete this item ?')">
                                                    <i class="tio-delete"></i>
                                                </a>
                                            </div>
                                            <form action="{{ route('admin.product.delete', [$p['id']]) }}" method="post"
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
                            {{ $pro->links() }}
                        </div>
                    </div>

                    @if (count($pro) == 0)
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
                    <input type="hidden" id="deletedVariants" value="">
                    <input type="hidden" id="newVariantsAdded" value="0">

                    <div class="card mb-3" style="border: 1px solid #e9ecef;">
                        <div class="card-header py-2" style="background: #f1f3f5;">
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px;">
                                <i class="tio-money mr-1"></i> {{ \App\CPU\translate('Product price & stock') }}
                            </h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Unit') }} <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" id="editUnit">
                                        @foreach (\App\CPU\Helpers::units() as $x)
                                            <option value="{{ $x }}">{{ $x }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Unit price') }} <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editUnitPrice">
                                </div>
                                <div class="col-md-3 form-group mb-2">
                                    <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Market price') }} <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="editPurchasePrice">
                                </div>
                                <div class="col-md-3 form-group mb-2">
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
                        <div class="card-header py-2 d-flex justify-content-between align-items-center" style="background: #f1f3f5;">
                            <h6 class="mb-0 font-weight-bold" style="font-size: 13px;">
                                <i class="tio-list mr-1"></i> {{ \App\CPU\translate('Variants') }}
                            </h6>
                            <button type="button" class="btn btn--primary btn-sm" id="addVariantBtn" style="font-size: 12px; padding: 3px 10px;">
                                <i class="tio-add mr-1"></i> {{ \App\CPU\translate('Add Variant') }}
                            </button>
                        </div>
                        <div class="card-body p-3">
                            <div id="editVariantsContainer">
                                <p class="text-muted text-center mb-0">
                                    <i class="fa fa-spinner fa-spin mr-1"></i> {{ \App\CPU\translate('Loading variants...') }}
                                </p>
                            </div>

                            <div id="addVariantForm" class="mt-3 d-none" style="border: 1px dashed #4e73df; border-radius: 6px; padding: 12px; background: #f0f4ff;">
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Variant Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="newVariantType" placeholder="e.g. Red-XL">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Price') }} <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" min="0" class="form-control form-control-sm" id="newVariantPrice" placeholder="0.00">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-1" style="font-size: 12px;">{{ \App\CPU\translate('Quantity') }} <span class="text-danger">*</span></label>
                                        <input type="number" min="0" class="form-control form-control-sm" id="newVariantQty" placeholder="0">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="title-color mb-1" style="font-size: 12px;">SKU</label>
                                        <input type="text" class="form-control form-control-sm" id="newVariantSku" placeholder="SKU">
                                    </div>
                                    <div class="col-md-3 d-flex gap-1">
                                        <button type="button" class="btn btn--primary btn-sm" id="confirmAddVariantBtn" style="font-size: 12px; padding: 5px 12px;">
                                            <i class="tio-check mr-1"></i> {{ \App\CPU\translate('Add') }}
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" id="cancelAddVariantBtn" style="font-size: 12px; padding: 5px 12px;">
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
    <!-- Page level custom scripts -->
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).on('change', '.status', function() {
            var id = $(this).attr("id");
            if ($(this).prop("checked") == true) {
                var status = 1;
            } else if ($(this).prop("checked") == false) {
                var status = 0;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product.status-update') }}",
                method: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(data) {
                    if (data.success == true) {
                        toastr.success(
                            '{{ \App\CPU\translate('
                                                                                                                                        Status updated successfully ') }}'
                        );
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ \App\CPU\translate('
                                                                                                                                        Status updated failed.Product must be approved ') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        function featured_status(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product.featured-status') }}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function() {
                    toastr.success(
                        '{{ \App\CPU\translate('
                                                                                                                    Featured status updated successfully ') }}'
                    );
                }
            });
        }

        function sysc_to_tally(element) {
            // console.log(element);
            var url = element.getAttribute('data-url');
            // console.log(url);
            $.ajax({
                url: url,
                method: 'GET',
                success: function(data) {
                    //    console.log(data.message);
                    if (data.success == true) {
                        toastr.success(element.getAttribute('data-message-success'));
                    } else {
                        toastr.error(element.getAttribute('data-message-error'));
                    }
                }
            });
        }

        function viewSellers(productId, productName) {
            $('#viewSellerModalLabel').text('Sellers who copied: ' + productName);
            $('#sellerTableBody').html(
                '<tr><td colspan="7" class="text-center"><i class="fa fa-spinner fa-spin"></i> Loading...</td></tr>');
            $('#viewSellerModal').modal('show');

            $.ajax({
                url: '{{ route('admin.product.get-sellers', ':id') }}'.replace(':id', productId),
                method: 'GET',
                success: function(data) {
                    var tbody = $('#sellerTableBody');
                    tbody.empty();
                    if (data.sellers.length === 0) {
                        tbody.html(
                            '<tr><td colspan="7" class="text-center text-muted">No sellers have copied this product yet</td></tr>'
                            );
                        return;
                    }
                    $.each(data.sellers, function(index, seller) {
                        var featuredBtn = buildFeaturedBtn(seller.id, seller.featured);
                        tbody.append('<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + seller.name + '</td>' +
                            '<td>' + seller.shop_name + '</td>' +
                            '<td>' + formatPrice(seller.price) + '</td>' +
                            '<td>' + seller.stock + '</td>' +
                            '<td><span class="badge badge-' + (seller.status == 1 ? 'success' : 'danger') + '">' + (seller.status == 1 ? 'Active' : 'Inactive') + '</span></td>' +
                            '<td>' + featuredBtn + '</td>' +
                            '</tr>');
                    });
                },
                error: function() {
                    $('#sellerTableBody').html(
                        '<tr><td colspan="7" class="text-center text-danger">Failed to load seller data</td></tr>'
                        );
                }
            });
        }

        // Build featured toggle switch based on current featured state
        function buildFeaturedBtn(id, isFeatured) {
            var checked = (isFeatured == 1 || isFeatured === true) ? 'checked' : '';
            return '<label class="mx-auto switcher">' +
                   '<input class="switcher_input toggle-seller-featured-chk" type="checkbox" data-id="' + id + '" ' + checked + '>' +
                   '<span class="switcher_control"></span>' +
                   '</label>';
        }

        // Handle toggle feature switch change inside sellers modal
        $(document).on('change', '.toggle-seller-featured-chk', function() {
            var chk = $(this);
            var sellerId = chk.data('id');
            var isChecked = chk.is(':checked');

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $.ajax({
                url: '{{ route('admin.product.toggle-seller-featured') }}',
                method: 'POST',
                data: { seller_product_id: sellerId },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.message);
                        if (data.featured == 1) {
                            // Reset all other switches in modal to unchecked
                            $('#sellerTableBody .toggle-seller-featured-chk').each(function() {
                                if ($(this).data('id') != sellerId) {
                                    $(this).prop('checked', false);
                                }
                            });
                        }
                        chk.prop('checked', data.featured == 1);
                    } else {
                        toastr.error(data.message || 'Failed to update featured status');
                        chk.prop('checked', !isChecked);
                    }
                },
                error: function() {
                    toastr.error('Something went wrong');
                    chk.prop('checked', !isChecked);
                }
            });
        });

        function formatPrice(price) {
            return '{{ \App\CPU\BackEndHelper::currency_symbol() }}' + parseFloat(price).toFixed(2);
        }

        $(document).on('click', '.set-commission-btn', function() {
            var btn = $(this);
            setCommission(
                btn.data('id'),
                btn.data('name'),
                btn.data('commission'),
                btn.data('type')
            );
        });

        function setCommission(productId, productName, currentCommission, currentType) {
            $('#commissionProductId').val(productId);
            $('#commissionProductName').text(productName);
            currentCommission = parseFloat(currentCommission) || 0;
            currentType = currentType || 'percentage';
            $('#commissionValue').val(currentCommission > 0 ? currentCommission : '');
            $('#commissionType').val(currentType);
            $('#commissionModal').modal('show');
        }

        function saveCommission() {
            var productId = $('#commissionProductId').val();
            var commission = $('#commissionValue').val();
            var commissionType = $('#commissionType').val();

            if (commission === '' || commission < 0) {
                toastr.error('Please enter a valid commission value');
                return;
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('admin.product.set-commission') }}',
                method: 'POST',
                data: {
                    product_id: productId,
                    commission: commission,
                    commission_type: commissionType
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.message);
                        $('#commissionModal').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(data.message || 'Failed to update commission');
                    }
                },
                error: function(xhr) {
                    var msg = 'Something went wrong';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        for (var key in errors) {
                            msg = errors[key][0];
                            break;
                        }
                    }
                    toastr.error(msg);
                }
            });
        }

        $(document).on('click', '.show-uploader-seller-btn', function() {
            var btn = $(this);
            var sellerName = btn.data('seller-name') || 'N/A';
            var shopName = btn.data('shop-name') || 'N/A';
            var phone = btn.data('phone') || 'N/A';
            var email = btn.data('email') || 'N/A';
            var address = btn.data('address') || 'N/A';
            var status = btn.data('status') || 'N/A';
            var profileUrl = btn.data('profile-url') || '#';
            var productName = btn.data('product-name') || '';

            $('#modalShopName').text(shopName);
            $('#modalSellerName').text(sellerName);
            $('#modalSellerPhone').text(phone);
            $('#modalSellerEmail').text(email);
            $('#modalSellerAddress').text(address);
            $('#modalProductNameSpan').text(productName);
            $('#modalSellerProfileBtn').attr('href', profileUrl);

            var statusBadge = $('#modalSellerStatus');
            if (status === 'approved') {
                statusBadge.removeClass().addClass('badge badge-soft-success font-weight-semibold px-3 py-1 mt-1').text('Active / Approved');
            } else if (status === 'pending') {
                statusBadge.removeClass().addClass('badge badge-soft-warning font-weight-semibold px-3 py-1 mt-1').text('Pending Approval');
            } else {
                statusBadge.removeClass().addClass('badge badge-soft-danger font-weight-semibold px-3 py-1 mt-1').text(status.charAt(0).toUpperCase() + status.slice(1));
            }

            $('#uploaderSellerModal').modal('show');
        });

        // Edit Price & Variants Modal
        $(document).on('click', '.edit-price-btn', function() {
            var btn = $(this);
            var productId = btn.data('id');

            $('#editProductId').val(productId);
            $('#modalProductName').text(btn.data('name'));
            $('#editUnit').val(btn.data('unit') || 'pc');
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
                url: "{{ route('admin.product.get-variations') }}",
                method: 'GET',
                data: { id: productId },
                success: function(data) {
                    var container = $('#editVariantsContainer');
                    container.empty();
                    $('#deletedVariants').val('');
                    $('#newVariantsAdded').val('0');

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
                }
            });

            $('#editPriceVariantsModal').modal('show');
        });

        // Save Price & Variants
        $(document).on('click', '#savePriceVariantsBtn', function() {
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

            var deletedVariants = $('#deletedVariants').val() ? $('#deletedVariants').val().split(',').filter(Boolean) : [];

            $('#saveBtnText').addClass('d-none');
            $('#saveBtnLoader').removeClass('d-none');
            $('#savePriceVariantsBtn').prop('disabled', true);

            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });
            $.ajax({
                url: "{{ route('admin.product.update-price-variants') }}",
                method: 'POST',
                data: {
                    id: productId,
                    unit: $('#editUnit').val(),
                    unit_price: $('#editUnitPrice').val(),
                    purchase_price: $('#editPurchasePrice').val(),
                    discount: $('#editDiscount').val(),
                    discount_type: $('#editDiscountType').val(),
                    tax: $('#editTax').val(),
                    tax_model: $('#editTaxModel').val(),
                    shipping_cost: $('#editShippingCost').val(),
                    minimum_order_qty: $('#editMinOrder').val(),
                    variants: variants,
                    deleted_variants: deletedVariants
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
                toastr.error('{{ \App\CPU\translate("Variant name is required") }}');
                $('#newVariantType').focus();
                return;
            }
            if (!variantPrice || parseFloat(variantPrice) < 0) {
                toastr.error('{{ \App\CPU\translate("Valid price is required") }}');
                $('#newVariantPrice').focus();
                return;
            }
            if (!variantQty || parseInt(variantQty) < 0) {
                toastr.error('{{ \App\CPU\translate("Valid quantity is required") }}');
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
                toastr.error('{{ \App\CPU\translate("Variant with this name already exists") }}');
                return;
            }

            var container = $('#editVariantsContainer');
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
            toastr.success('{{ \App\CPU\translate("Variant added") }}');
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

<!-- View Sellers Modal -->
<div class="modal fade" id="viewSellerModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSellerModalLabel">Sellers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Seller Name</th>
                                <th>Shop Name</th>
                                <th>Copy Rate</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Featured</th>
                            </tr>
                        </thead>
                        <tbody id="sellerTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Set Commission Modal -->
<div class="modal fade" id="commissionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Set Commission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="commissionProductId">
                <div class="mb-3">
                    <label class="font-weight-bold">Product</label>
                    <p id="commissionProductName" class="mb-0 text-muted"></p>
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Commission Type</label>
                    <select id="commissionType" class="form-control">
                        <option value="percentage">Percentage (%)</option>
                        <option value="fixed">Fixed ({{ \App\CPU\BackEndHelper::currency_symbol() }})</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="font-weight-bold">Commission Value</label>
                    <input type="number" id="commissionValue" class="form-control" min="0" step="0.01"
                        placeholder="Enter commission value">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn--primary" onclick="saveCommission()">Save Commission</button>
            </div>
        </div>
    </div>
</div>

<!-- Uploader Seller Details Modal -->
<div class="modal fade" id="uploaderSellerModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 14px; overflow: hidden; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            <div class="modal-header bg-primary text-white" style="background: linear-gradient(135deg, #1b7e5a 0%, #156347 100%); padding: 18px 24px;">
                <h5 class="modal-title text-white font-weight-bold d-flex align-items-center gap-2" id="uploaderSellerModalLabel">
                    <i class="tio-user-big"></i> {{ \App\CPU\translate('Uploader Seller Details') }}
                </h5>
                <button type="button" class="close text-white opacity-80" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="avatar avatar-xxl avatar-circle mx-auto mb-2 border shadow-sm" style="width: 70px; height: 70px; background-color: #eaf5f0; display: flex; align-items: center; justify-content: center;">
                        <i class="tio-shop text-success" style="font-size: 32px;"></i>
                    </div>
                    <h4 class="font-weight-bold mb-0 text-dark" id="modalShopName">Shop Name</h4>
                    <span class="badge badge-soft-success font-weight-semibold px-3 py-1 mt-1" id="modalSellerStatus">Active</span>
                </div>

                <div class="card border-0 bg-light rounded-10 p-3 mb-3">
                    <div class="row g-3">
                        <div class="col-6 mb-3">
                            <label class="text-muted fz-12 mb-1 d-block"><i class="tio-user"></i> {{ \App\CPU\translate('Seller Name') }}</label>
                            <span class="font-weight-bold text-dark d-block" id="modalSellerName">-</span>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="text-muted fz-12 mb-1 d-block"><i class="tio-call"></i> {{ \App\CPU\translate('Phone') }}</label>
                            <span class="font-weight-bold text-dark d-block" id="modalSellerPhone">-</span>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="text-muted fz-12 mb-1 d-block"><i class="tio-email"></i> {{ \App\CPU\translate('Email') }}</label>
                            <span class="font-weight-bold text-dark d-block" id="modalSellerEmail">-</span>
                        </div>
                        <div class="col-12">
                            <label class="text-muted fz-12 mb-1 d-block"><i class="tio-poi"></i> {{ \App\CPU\translate('Shop Address') }}</label>
                            <span class="font-weight-bold text-dark d-block" id="modalSellerAddress">-</span>
                        </div>
                    </div>
                </div>

                <div class="text-muted fz-12 text-center" id="modalProductName">
                    Product: <span class="font-weight-bold" id="modalProductNameSpan"></span>
                </div>
            </div>
            <div class="modal-footer bg-light px-4 py-3 justify-content-between">
                <button type="button" class="btn btn-secondary radius-50 px-4" data-dismiss="modal">{{ \App\CPU\translate('Close') }}</button>
                <a href="#" id="modalSellerProfileBtn" class="btn btn--primary radius-50 px-4" target="_blank">
                    <i class="tio-invisible"></i> {{ \App\CPU\translate('View Full Profile') }}
                </a>
            </div>
        </div>
    </div>
</div>
