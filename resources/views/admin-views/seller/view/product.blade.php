@extends('layouts.back-end.app')

@section('title', $seller->shop ? $seller->shop->name : \App\CPU\translate('shop name not found'))

@push('css_or_js')
    <style>
        .commission-badge {
            font-size: 11px;
            padding: 3px 8px;
            border-radius: 20px;
            cursor: pointer;
        }

        .commission-badge.has-commission {
            background: #d4edda;
            color: #155724;
        }

        .commission-badge.no-commission {
            background: #f8f9fa;
            color: #6c757d;
            border: 1px dashed #dee2e6;
        }

        .commission-badge:hover {
            opacity: 0.8;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/assets/back-end/img/coupon_setup.png') }}" alt="">
                {{ \App\CPU\translate('seller_details') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Page Heading -->
        <div class="flex-between d-sm-flex row align-items-center justify-content-between mb-2 mx-1">
            <div>
                <a href="{{ route('admin.sellers.seller-list') }}"
                    class="btn btn--primary my-3">{{ \App\CPU\translate('Back_to_seller_list') }}</a>
            </div>
            <div>
                @if ($seller->status == 'pending')
                    <div class="mt-4">
                        <div class="flex-start">
                            <div class="mx-1">
                                <h4><i class="tio-shop-outlined"></i></h4>
                            </div>
                            <div>{{ \App\CPU\translate('Seller_request_for_open_a_shop.') }}</div>
                        </div>
                        <div class="text-center">
                            <form class="d-inline-block" action="{{ route('admin.sellers.updateStatus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $seller->id }}">
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                    class="btn btn--primary btn-sm">{{ \App\CPU\translate('Approve') }}</button>
                            </form>
                            <form class="d-inline-block" action="{{ route('admin.sellers.updateStatus') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $seller->id }}">
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit"
                                    class="btn btn-danger btn-sm">{{ \App\CPU\translate('reject') }}</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <div class="flex-between row mx-1">
                <div>
                    <h1 class="page-header-title">{{ $seller->shop ? $seller->shop->name : 'Shop Name : Update Please' }}
                    </h1>
                </div>

            </div>
            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <!-- Nav -->
                <ul class="nav nav-tabs flex-wrap page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link "
                            href="{{ route('admin.sellers.view', $seller->id) }}">{{ \App\CPU\translate('Shop') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'order']) }}">{{ \App\CPU\translate('Order') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'product']) }}">{{ \App\CPU\translate('Product') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'setting']) }}">{{ \App\CPU\translate('Setting') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'transaction']) }}">{{ \App\CPU\translate('Transaction') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('admin.sellers.view', ['id' => $seller->id, 'tab' => 'review']) }}">{{ \App\CPU\translate('Review') }}</a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header-->

        <div class="tab-content">
            <div class="tab-pane fade show active" id="product">
                <div class="row pt-2">
                    <div class="col-md-12">
                        <div class="card h-100">
                            <div class="px-3 py-4">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ \App\CPU\translate('products') }}
                                    <span class="badge badge-soft-dark radius-50 fz-12">{{ $products->total() }}</span>
                                </h5>
                            </div>

                            <div class="table-responsive datatable-custom">
                                <table id="columnSearchDatatable"
                                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};"
                                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                    <thead class="thead-light thead-50 text-capitalize">
                                        <tr>
                                            <th>{{ \App\CPU\translate('SL') }}</th>
                                            <th>{{ \App\CPU\translate('Product Name') }}</th>
                                            <th>{{ \App\CPU\translate('purchase_price') }}</th>
                                            <th>{{ \App\CPU\translate('selling_price') }}</th>
                                            <th>{{ \App\CPU\translate('Commission') }}</th>
                                            <th class="text-center">{{ \App\CPU\translate('featured') }}</th>
                                            <th class="text-center">{{ \App\CPU\translate('Active') }}
                                                {{ \App\CPU\translate('status') }}</th>
                                            <th class="text-center">{{ \App\CPU\translate('Action') }}</th>
                                        </tr>
                                    </thead>

                                    <tbody id="set-rows">
                                        @foreach ($products as $k => $p)
                                            <tr>
                                                <td>{{ $products->firstItem() + $k }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product.view', [$p['id']]) }}"
                                                        class="title-color hover-c1">
                                                        {{ substr($p['name'], 0, 20) }}{{ strlen($p['name']) > 20 ? '...' : '' }}
                                                    </a>
                                                </td>
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
                                                    <span
                                                        class="commission-badge {{ $commVal > 0 ? 'has-commission' : 'no-commission' }}"
                                                        onclick="openCommissionModal({{ $p->id }}, {{ $commVal }}, '{{ $commType }}', '{{ addslashes($p->name) }}')"
                                                        title="{{ \App\CPU\translate('Click to set commission') }}">
                                                        @if ($commVal > 0)
                                                            {{ $commVal }}{{ $commType === 'fixed' ? \App\CPU\BackEndHelper::currency_set_symbol() : '%' }}
                                                        @else
                                                            <i class="tio-settings"></i> {{ \App\CPU\translate('Set') }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <label class="mx-auto switcher">
                                                        <input type="checkbox" class="switcher_input"
                                                            onclick="featured_status('{{ $p['id'] }}', this)"
                                                            {{ $p->featured == 1 ? 'checked' : '' }}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="mx-auto switcher">
                                                        <input type="checkbox" class="switcher_input status"
                                                            id="{{ $p['id'] }}" {{ $p->status == 1 ? 'checked' : '' }}>
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center gap-10">
                                                        <a class="btn btn-outline--primary btn-sm square-btn"
                                                            href="{{ route('admin.product.edit', [$p['id']]) }}">
                                                            <i class="tio-edit"></i>
                                                        </a>
                                                        <a class="btn btn-outline-danger btn-sm square-btn"
                                                            href="javascript:"
                                                            onclick="form_alert('product-{{ $p['id'] }}','Want to delete this item ?')">
                                                            <i class="tio-delete"></i>
                                                        </a>
                                                    </div>
                                                    <form action="{{ route('admin.product.delete', [$p['id']]) }}"
                                                        method="post" id="product-{{ $p['id'] }}">
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
                                    <img class="mb-3 w-160"
                                        src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                        alt="Image Description">
                                    <p class="mb-0">{{ \App\CPU\translate('No_data_to_show') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Commission Modal -->
    <div class="modal fade" id="commissionModal" tabindex="-1" role="dialog" aria-labelledby="commissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="commissionModalLabel">{{ \App\CPU\translate('Set Product Commission') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="font-weight-bold">{{ \App\CPU\translate('Product') }}</label>
                        <p id="commissionProductName" class="mb-0 text-muted"></p>
                    </div>
                    <input type="hidden" id="commissionProductId">
                    <div class="form-group">
                        <label class="font-weight-bold">{{ \App\CPU\translate('Commission Type') }}</label>
                        <select id="commissionType" class="form-control">
                            <option value="percentage">{{ \App\CPU\translate('Percentage') }} (%)</option>
                            <option value="fixed">{{ \App\CPU\translate('Fixed Amount') }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">{{ \App\CPU\translate('Commission Value') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="commissionSymbol">%</span>
                            </div>
                            <input type="number" id="commissionValue" class="form-control" min="0"
                                step="0.01" placeholder="0.00">
                        </div>
                        <small class="form-text text-muted"
                            id="commissionHint">{{ \App\CPU\translate('Enter commission percentage (0-100)') }}</small>
                    </div>
                    <div class="alert alert-info small mb-0" id="commissionInfo">
                        <i class="tio-info-circle"></i>
                        {{ \App\CPU\translate('Product commission overrides seller and global commission settings.') }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ \App\CPU\translate('Cancel') }}</button>
                    <button type="button" class="btn btn--primary" id="saveCommissionBtn" onclick="saveCommission()">
                        <span id="saveBtnText">{{ \App\CPU\translate('Save Commission') }}</span>
                        <span id="saveBtnLoader" class="d-none"><i class="fa fa-spinner fa-spin"></i></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).on('change', '.status', function() {
            var id = $(this).attr("id");
            if ($(this).prop("checked") === true) {
                var status = 1;
            } else if ($(this).prop("checked") === false) {
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
                        toastr.success('{{ \App\CPU\translate('Status updated successfully') }}');
                    } else {
                        toastr.error(
                            '{{ \App\CPU\translate('Status updated failed. Product must be approved') }}'
                            );
                        location.reload();
                    }
                }
            });
        });

        function featured_status(id, element) {
            var originalChecked = element.checked;
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
                success: function(response) {
                    if (response.success) {
                        toastr.success('{{ \App\CPU\translate('Featured status updated successfully') }}');
                    } else {
                        element.checked = originalChecked;
                        Swal.fire({
                            icon: 'error',
                            title: '{{ \App\CPU\translate('Cannot Feature Product') }}',
                            text: response.message,
                            confirmButtonColor: '#d33',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(response) {
                    element.checked = originalChecked;
                    var data = response.responseJSON;
                    Swal.fire({
                        icon: 'error',
                        title: '{{ \App\CPU\translate('Cannot Feature Product') }}',
                        text: data ? data.message : '{{ \App\CPU\translate('Something went wrong') }}',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        // Commission Modal Functions
        function openCommissionModal(productId, currentValue, currentType, productName) {
            $('#commissionProductId').val(productId);
            $('#commissionProductName').text(productName);
            $('#commissionValue').val(currentValue > 0 ? currentValue : '');
            $('#commissionType').val(currentType);
            updateCommissionUI(currentType);
            $('#commissionModal').modal('show');
        }

        function updateCommissionUI(type) {
            if (type === 'fixed') {
                $('#commissionSymbol').html('{{ \App\CPU\BackEndHelper::currency_set_symbol() }}');
                $('#commissionHint').text('{{ \App\CPU\translate('Enter fixed commission amount') }}');
            } else {
                $('#commissionSymbol').html('%');
                $('#commissionHint').text('{{ \App\CPU\translate('Enter commission percentage (0-100)') }}');
            }
        }

        $(document).on('change', '#commissionType', function() {
            updateCommissionUI($(this).val());
        });

        function saveCommission() {
            var productId = $('#commissionProductId').val();
            var commissionValue = $('#commissionValue').val();
            var commissionType = $('#commissionType').val();

            if (commissionValue === '' || commissionValue < 0) {
                toastr.error('{{ \App\CPU\translate('Please enter a valid commission value') }}');
                return;
            }

            if (commissionType === 'percentage' && commissionValue > 100) {
                toastr.error('{{ \App\CPU\translate('Percentage cannot exceed 100') }}');
                return;
            }

            $('#saveBtnText').addClass('d-none');
            $('#saveBtnLoader').removeClass('d-none');
            $('#saveCommissionBtn').prop('disabled', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('admin.product.set-commission') }}",
                method: 'POST',
                data: {
                    product_id: productId,
                    commission: commissionValue,
                    commission_type: commissionType
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('{{ \App\CPU\translate('Commission updated successfully') }}');
                        $('#commissionModal').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    } else {
                        toastr.error(response.message || '{{ \App\CPU\translate('Update failed') }}');
                    }
                },
                error: function() {
                    toastr.error('{{ \App\CPU\translate('Something went wrong') }}');
                },
                complete: function() {
                    $('#saveBtnText').removeClass('d-none');
                    $('#saveBtnLoader').addClass('d-none');
                    $('#saveCommissionBtn').prop('disabled', false);
                }
            });
        }
    </script>
@endpush
