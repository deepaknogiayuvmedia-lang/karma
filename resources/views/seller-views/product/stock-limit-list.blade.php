@extends('layouts.back-end.app-seller')

@section('title', \App\CPU\translate('stock_limit_products'))

@push('css_or_js')
<!-- DataTables CSS -->
<link href="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Title -->
    <div class="mb-3 d-flex flex-column gap-1">
        <h2 class="h1 text-capitalize d-flex gap-2">
            <img src="{{asset('/public/assets/back-end/img/inhouse-product-list.png')}}" class="mb-1 mr-1" alt="">
            {{\App\CPU\translate('stock_limit_products_list')}}
            <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $pro->count() }}</span>
        </h2>
        <p class="d-flex">{{ \App\CPU\translate('the_products_are_shown_in_this_list,_which_quantity_is_below') }} <span id="stock_limit">{{ $stock_limit }}</span></p>
    </div>
    <!-- End Page Title -->

    <div class="row mt-30">
        <div class="col-md-12">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row justify-content-between align-items-center gy-2">
                        <div class="col-auto">
                            <!-- Search -->
                            <form action="{{ url()->current() }}" method="GET">
                                <div class="input-group input-group-custom input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="{{\App\CPU\translate('Search Product Name')}}"
                                        aria-label="Search orders"
                                        value="{{ $search }}" required>
                                    <input type="hidden" value="{{ $request_status }}" name="status">
                                    <input type="hidden" value="{{ $sort_oqrderQty }}" name="sort_oqrderQty">
                                    <button type="submit"
                                        class="btn btn--primary">{{\App\CPU\translate('search')}}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>

                        <div class="col-12 mt-1 col-md-6 col-lg-3">
                            <select name="sort_oqrderQty" class="form-control">
                                <option value="default" {{ $sort_oqrderQty== "default"?'selected':''}}>{{\App\CPU\translate('default_sort')}}</option>
                                <option value="quantity_asc" {{ $sort_oqrderQty== "quantity_asc"?'selected':''}}>{{\App\CPU\translate('quantity_sort_by_(low_to_high)')}}</option>
                                <option value="quantity_desc" {{ $sort_oqrderQty== "quantity_desc"?'selected':''}}>{{\App\CPU\translate('quantity_sort_by_(high_to_low)')}}</option>
                                <option value="order_asc" {{ $sort_oqrderQty== "order_asc"?'selected':''}}>{{\App\CPU\translate('order_sort_by_(low_to_high)')}}</option>
                                <option value="order_desc" {{ $sort_oqrderQty== "order_desc"?'selected':''}}>{{\App\CPU\translate('order_sort_by_(high_to_low)')}}</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="table-responsive pb-3">
                    <table id="datatable" data-paginate_limit="{{ $paginate_limit }}"
                        style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{\App\CPU\translate('SL')}}</th>
                                <th>{{\App\CPU\translate('Product_Name')}}</th>
                                <th>{{\App\CPU\translate('Variation')}}</th>
                                <th>{{\App\CPU\translate('purchase_price')}}</th>
                                <th>{{\App\CPU\translate('selling_price')}}</th>
                                <th>{{\App\CPU\translate('Commission')}}</th>
                                <th>{{\App\CPU\translate('quantity')}}</th>
                                <th class="text-center">{{\App\CPU\translate('action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $count = 1;
                            @endphp
                            @foreach($pro as $k=>$p)
                            @php
                            $combinations = json_decode($p->variation,true);
                            @endphp
                            @if($combinations)
                                @foreach ($combinations as $value)
                                <tr data-id="{{ $p->id }}" data-url="{{route('seller.product.update-quantity')}}">
                                    <th scope="row">{{ $count++ }}</th>
                                    <td>
                                        <a href="{{route('seller.product.view',[$p['id']])}}" class="media align-items-center gap-2">
                                            <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$p['thumbnail']}}"
                                                onerror="this.src='{{asset('/public/assets/back-end/img/brand-logo.png')}}'" class="avatar border" alt="">
                                            <span class="media-body title-color hover-c1">
                                                {{\Illuminate\Support\Str::limit($p['name'],20)}}
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <span>
                                            {{ $value['type'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                {{ \App\CPU\BackEndHelper::currency_set_symbol()}}</span>
                                            <input type="text" name="purchase_price" id="" value="{{\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])}}" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                {{ \App\CPU\BackEndHelper::currency_set_symbol()}}</span>
                                            <input type="text" name="price" id="" value="{{\App\CPU\BackEndHelper::usd_to_currency($value['price']) }}" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $commVal = $p->admin_commission ?? 0;
                                            $commType = $p->admin_commission_type ?? 'percentage';
                                        @endphp
                                        @if($commVal > 0)
                                            <span class="badge badge-soft-success">
                                                {{ $commVal }}{{ $commType === 'fixed' ? \App\CPU\BackEndHelper::currency_set_symbol() : '%' }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center product-quantity">
                                            <input type="number" name="qty" id="" value="{{ $value['qty'] }}" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-outline--primary btn-sm square-btn update-row"
                                                title="{{\App\CPU\translate('Update')}}">
                                                <i class="tio-save"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr data-id="{{ $p->id }}" data-url="{{route('seller.product.update-quantity')}}">
                                    <th scope="row">{{ $count++ }}</th>
                                    <td>
                                        <a href="{{route('seller.product.view',[$p['id']])}}" class="media align-items-center gap-2">
                                            <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$p['thumbnail']}}"
                                                onerror="this.src='{{asset('/public/assets/back-end/img/brand-logo.png')}}'" class="avatar border" alt="">
                                            <span class="media-body title-color hover-c1">
                                                {{\Illuminate\Support\Str::limit($p['name'],20)}}
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <span>
                                            {{\App\CPU\translate('Default')}}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                {{ \App\CPU\BackEndHelper::currency_set_symbol()}}</span>
                                            <input type="text" name="purchase_price" id="" value="{{\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price'])}}" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">
                                                {{ \App\CPU\BackEndHelper::currency_set_symbol()}}</span>
                                            <input type="text" name="price" id="" value="{{\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']) }}" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $commVal = $p->admin_commission ?? 0;
                                            $commType = $p->admin_commission_type ?? 'percentage';
                                        @endphp
                                        @if($commVal > 0)
                                            <span class="badge badge-soft-success">
                                                {{ $commVal }}{{ $commType === 'fixed' ? \App\CPU\BackEndHelper::currency_set_symbol() : '%' }}
                                            </span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center product-quantity">
                                            <input type="number" name="qty" id="" value="{{ $p['current_stock'] }}" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-outline--primary btn-sm square-btn update-row"
                                                title="{{\App\CPU\translate('Update')}}">
                                                <i class="tio-save"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if(count($pro)==0)
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg"
                        alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- DataTables scripts -->
<script src="{{asset('assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        var $table = $('#datatable');
        var pageLen = parseInt($table.data('paginate_limit'), 10) || 10;

        var dataTable = $table.DataTable({
            pageLength: pageLen,
            paging: true,
            ordering: true,
            lengthChange: false,
            searching: false,
            order: [
                [6, 'asc']
            ]
        });

        $(document).on('click', '.update-row', function() {
            var $row = $(this).closest('tr');
            var url = $row.data('url');
            var check_qty = $row.find('input[name="qty"]').val();
            
            var rowData = {
                id: $row.data('id'),
                variation: $row.find('td:nth-child(3) span').text().trim(),
                purchase_price: $row.find('input[name="purchase_price"]').val(),
                price: $row.find('input[name="price"]').val(),
                qty: check_qty,
            };
            
            var $btn = $(this);
            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    data : rowData
                },
               success: function (data) {
                    if(data.success){
                        toastr.success(data.message || 'Quantity updated successfully');
                    }else{
                        toastr.error(data.message || 'Update failed');
                    }
                },
                error: function() {
                    toastr.error('Update failed');
                },
                complete: function() {
                    $btn.prop('disabled', false).html('<i class="tio-save"></i>');
                }
            });
        });
    });
</script>
@endpush

