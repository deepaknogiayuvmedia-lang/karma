@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('All Products'))

@section('content')
    <div class="content container-fluid">
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset('/public/assets/back-end/img/inhouse-product-list.png') }}" alt="">
                {{ \App\CPU\translate('All_Products') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $pro->total() }}</span>
            </h2>
        </div>

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-8">
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="d-flex flex-wrap gap-2">
                                        <div class="input-group input-group-custom input-group-merge flex-grow-1" style="max-width: 350px;">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="tio-search"></i>
                                                </div>
                                            </div>
                                            <input id="datatableSearch_" type="search" name="search" class="form-control"
                                                placeholder="{{ \App\CPU\translate('Search by Product, Seller or Shop name') }}"
                                                aria-label="Search products" value="{{ $search }}">
                                            <button type="submit"
                                                class="btn btn--primary">{{ \App\CPU\translate('search') }}</button>
                                        </div>
                                        <select name="seller_id" class="form-control" style="max-width: 250px;" onchange="this.form.submit()">
                                            <option value="">{{ \App\CPU\translate('All Vendors') }}</option>
                                            @foreach($sellers as $seller)
                                                @php($shopName = $seller->shop ? $seller->shop->name : $seller->f_name . ' ' . $seller->l_name)
                                                <option value="{{ $seller->id }}" {{ $seller_id == $seller->id ? 'selected' : '' }}>
                                                    {{ $shopName }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
                                    <th>{{ \App\CPU\translate('SL') }}</th>
                                    <th>{{ \App\CPU\translate('Product Name') }}</th>
                                    <th class="text-right">{{ \App\CPU\translate('purchase_price') }}</th>
                                    <th class="text-right">{{ \App\CPU\translate('selling_price') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Active') }} {{ \App\CPU\translate('status') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Verify Status') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Added By') }}</th>
                                    <th class="text-center">{{ \App\CPU\translate('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pro as $k => $p)
                                    <tr>
                                        <th scope="row">{{ $pro->firstItem() + $k }}</th>
                                        <td>
                                            <a href="{{ route('admin.product.view', [$p['id']]) }}"
                                                class="media align-items-center gap-2">
                                                <img src="{{ \App\CPU\ProductManager::product_image_path('thumbnail') }}/{{ $p['thumbnail'] }}"
                                                    onerror="this.src='{{ asset('/public/assets/back-end/img/brand-logo.png') }}'"
                                                    class="avatar border" alt="">
                                                <span class="media-body title-color hover-c1">
                                                    {{ \Illuminate\Support\Str::limit($p['name'], 30) }}
                                                </span>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])) }}
                                        </td>
                                        <td class="text-right">
                                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price'])) }}
                                        </td>
                                        <td class="text-center">
                                            <label class="mx-auto switcher">
                                                <input type="checkbox" class="status switcher_input"
                                                    id="{{ $p['id'] }}" {{ $p->status == 1 ? 'checked' : '' }}>
                                                <span class="switcher_control"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <select class="form-control form-control-sm approval-status" data-id="{{ $p['id'] }}" style="width: auto; display: inline-block;">
                                                <option value="draft" {{ ($p->approval_status ?? 'draft') == 'draft' ? 'selected' : '' }}>{{ \App\CPU\translate('Draft') }}</option>
                                                <option value="pending" {{ ($p->approval_status ?? 'draft') == 'pending' ? 'selected' : '' }}>{{ \App\CPU\translate('Pending') }}</option>
                                                <option value="approved" {{ ($p->approval_status ?? 'draft') == 'approved' ? 'selected' : '' }}>{{ \App\CPU\translate('Approved') }}</option>
                                                <option value="rejected" {{ ($p->approval_status ?? 'draft') == 'rejected' ? 'selected' : '' }}>{{ \App\CPU\translate('Rejected') }}</option>
                                                <option value="pending_edit" {{ ($p->approval_status ?? 'draft') == 'pending_edit' ? 'selected' : '' }}>{{ \App\CPU\translate('Pending Edit') }}</option>
                                            </select>
                                        </td>
                                        <td class="text-center">
                                            @if ($p['added_by'] == 'seller' && $p->seller)
                                                @php($shop = $p->seller->shop)
                                                <span class="badge badge-soft-primary">
                                                    <i class="tio-user"></i>
                                                    {{ \Illuminate\Support\Str::limit($shop ? $shop->name : $p->seller->f_name . ' ' . $p->seller->l_name, 20) }}
                                                </span>
                                            @elseif($p['added_by'] == 'admin')
                                                <span class="badge badge-soft-info">{{ \App\CPU\translate('In-House') }}</span>
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn" title="View"
                                                    href="{{ route('admin.product.view', [$p['id']]) }}">
                                                    <i class="tio-invisible"></i>
                                                </a>
                                                <a class="btn btn-outline--primary btn-sm square-btn"
                                                    title="{{ \App\CPU\translate('Edit') }}"
                                                    href="{{ route('admin.product.edit', [$p['id']]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
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

@push('script_2')
    <script>
        $(document).ready(function() {
            $(".status").on("change", function () {
                var id = $(this).attr("id");
                $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                        type: 'POST',
                        url: '{{ route('admin.product.status-update') }}',
                        data: { id: id },
                        success: function (data) {
                            toastr.success('{{ \App\CPU\translate('Status updated successfully') }}');
                        }
                    });
                });

                $(".approval-status").on("change", function () {
                    var id = $(this).data("id");
                    var approval_status = $(this).val();
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') },
                    type: 'POST',
                    url: '{{ route('admin.product.approval-status-update') }}',
                    data: { id: id, approval_status: approval_status },
                    success: function (data) {
                        toastr.success('{{ \App\CPU\translate('Verify status updated successfully') }}');
                    }
                });
            });
        });
    </script>
@endpush
