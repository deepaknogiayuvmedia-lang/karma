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
                                        @if ($verified_filter)
                                            <input type="hidden" value="{{ $verified_filter }}" name="verified">
                                        @endif
                                        <button type="submit"
                                            class="btn btn--primary">{{ \App\CPU\translate('search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                                @if (auth('seller')->user() && auth('seller')->user()->tally_sync_enabled)
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
                                @if (!isset($request_status))
                                    <a href="{{ route('admin.product.add-new') }}" class="btn btn--primary">
                                        <i class="tio-add"></i>
                                        <span class="text">{{ \App\CPU\translate('Add_New_Product') }}</span>
                                    </a>
                                @endif
                                @if ($verified_filter === 'unverified')
                                    <button type="button" class="btn btn-success" onclick="bulkVerifySelected()">
                                        <i class="tio-check"></i> {{ \App\CPU\translate('Bulk_Verify_Selected') }}
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Verified Filter Tabs -->
                    <div class="px-3 pb-2">
                        <ul class="nav nav-tabs nav-custom">
                            <li class="nav-item">
                                <a class="nav-link {{ !$verified_filter ? 'active' : '' }}"
                                    href="{{ route('admin.product.list', $type) }}?status={{ $request_status }}">
                                    {{ \App\CPU\translate('All') }} <span
                                        class="badge badge-soft-dark ml-1">{{ $all_count }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $verified_filter === 'verified' ? 'active' : '' }}"
                                    href="{{ route('admin.product.list', $type) }}?status={{ $request_status }}&verified=verified">
                                    <i class="tio-check-circle text-success"></i> {{ \App\CPU\translate('Verified') }}
                                    <span class="badge badge-soft-success ml-1">{{ $verified_count }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ $verified_filter === 'unverified' ? 'active' : '' }}"
                                    href="{{ route('admin.product.list', $type) }}?status={{ $request_status }}&verified=unverified">
                                    <i class="tio-warning text-warning"></i> {{ \App\CPU\translate('Unverified') }} <span
                                        class="badge badge-soft-danger ml-1">{{ $unverified_count }}</span>
                                </a>
                            </li>
                        </ul>
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
                                    <th class="text-center">{{ \App\CPU\translate('Verified') }}</th>
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
                                                    onclick="toggle_verified('{{ $p['id'] }}')"
                                                    {{ isset($p->verified) && $p->verified == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
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

        function toggle_verified(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product.verify') }}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function(data) {
                    if (data.message) {
                        toastr.success(data.message);
                    }
                },
                error: function(data) {
                    toastr.error(data.responseJSON.error || 'Something went wrong');
                }
            });
        }

        function bulkVerifySelected() {
            var ids = [];
            $('.product-checkbox:checked').each(function() {
                ids.push($(this).val());
            });
            if (ids.length === 0) {
                toastr.warning('Please select at least one product');
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product.bulk-verify') }}",
                method: 'POST',
                data: {
                    product_ids: ids
                },
                success: function(data) {
                    if (data.message) {
                        toastr.success(data.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                },
                error: function(data) {
                    toastr.error(data.responseJSON.error || 'Something went wrong');
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
