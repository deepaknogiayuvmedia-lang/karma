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
                                @if (auth('seller')->user()->tally_sync_enabled)
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
    </script>
@endpush
