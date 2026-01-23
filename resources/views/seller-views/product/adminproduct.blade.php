@extends('layouts.back-end.app-seller')

@section('title',\App\CPU\translate('Product List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="{{asset('/public/assets/back-end/img/products.png')}}" alt="">
            {{\App\CPU\translate('Products')}}
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
                          <h1 > Admin Productlist</h1>
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
                                        placeholder="{{\App\CPU\translate('Search by Product Name')}}" aria-label="Search orders" value="{{ $search }}">
                                    <button type="submit" class="btn btn--primary">{{\App\CPU\translate('search')}}</button>
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{\App\CPU\translate('Select Item')}}</th>
                                <th>{{\App\CPU\translate('Product Name')}}</th>
                                <th>{{\App\CPU\translate('Product Type')}}</th>
                                <!-- <th>{{\App\CPU\translate('purchase_price')}}</th> -->
                                <th>{{\App\CPU\translate('selling_price')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $k=>$p)
                            <tr>
                                <th scope="row">
                                    <label class="switcher">
                                        <input type="checkbox" class="selectItem switcher_input"
                                            id="{{$p['id']}}" @if(in_array($p['id'], $sellerproduct)) disabled checked @endif >
                                        <span class="switcher_control"></span>
                                    </label>
                                </th>
                                <td>
                                    <a href="{{route('seller.product.view',[$p['id']])}}" class="media align-items-center gap-2 w-max-content">
                                        <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$p['thumbnail']}}"
                                            onerror="this.src='{{asset('/public/assets/back-end/img/brand-logo.png')}}'" class="avatar border" alt="">
                                        <span class="media-body title-color hover-c1">
                                            {{\Illuminate\Support\Str::limit($p['name'],30)}}
                                        </span>
                                    </a>
                                </td>
                                <td>{{ ucfirst($p['product_type']) }}</td>
                                <!-- <td>
                                    {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}
                                </td> -->
                                <td>
                                    <input type="text" class="form-control sellprice{{$p['id']}}" value="{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-4">
                    <div class="px-4 d-flex justify-content-lg-end">
                        <!-- Pagination -->
                        {{$products->links()}}
                    </div>
                </div>

                @if(count($products)==0)
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif
            </div>
            <div class="card mt-5">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                          <h1 > Other Seller Product</h1>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable1" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{\App\CPU\translate('Select Item')}}</th>
                                <th>{{\App\CPU\translate('Product Name')}}</th>
                                <th>{{\App\CPU\translate('Product Type')}}</th>
                                <!-- <th>{{\App\CPU\translate('purchase_price')}}</th> -->
                                <th>{{\App\CPU\translate('selling_price')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productssell as $k=>$p)
                          
                            <tr>
                                <th scope="row">
                                    <label class="switcher">
                                        <input type="checkbox" class="selectItem switcher_input"
                                            id="{{$p['id']}}" @if(in_array($p['id'], $sellerproduct)) disabled checked @endif >
                                        <span class="switcher_control"></span>
                                    </label>
                                </th>
                                <td>
                                    <a href="{{route('seller.product.view',[$p['id']])}}" class="media align-items-center gap-2 w-max-content">
                                        <img src="{{\App\CPU\ProductManager::product_image_path('thumbnail')}}/{{$p['thumbnail']}}"
                                            onerror="this.src='{{asset('/public/assets/back-end/img/brand-logo.png')}}'" class="avatar border" alt="">
                                        <span class="media-body title-color hover-c1">
                                            {{\Illuminate\Support\Str::limit($p['name'],30)}}
                                        </span>
                                    </a>
                                </td>
                                <td>{{ ucfirst($p['product_type']) }}</td>
                                <!-- <td>
                                    {{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['purchase_price']))}}
                                </td> -->
                                <td>
                                    <input type="text" class="form-control sellprice{{$p['id']}}" value="{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($p['unit_price']))}}">
                                </td>
                            </tr> 
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive mt-4">
                    <div class="px-4 d-flex justify-content-lg-end">
                        <!-- Pagination -->
                        {{$productssell->links()}}
                    </div>
                </div>

                @if(count($productssell)==0)
                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<!-- Page level plugins -->
<script src="{{asset('public/assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    // Call the dataTables jQuery plugin
    $(document).ready(function() {
        $('#dataTable').DataTable();
        $('#dataTable1').DataTable();
    });

    $('.selectItem').on('change', function() {
        if ($(this).prop("checked") != true) {
            return;
        }
        var id = $(this).attr("id");
        var price = $('.sellprice' + id).val()
        let t = $(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('seller.product.admintoseller')}}",
            method: 'POST',
            data: {
                id: id,
                price: price.replace(/[^\d.]/g, "")
            },
            success: function(data) {
                const translate = (msg) => `{{ \App\CPU\translate('${msg}') }}`;

                if (data.success) {
                    t.attr('disabled', true);
                    toastr.success(translate(data.message));
                } else {
                    t.attr('disabled', true);
                    console.log(t);
                    toastr.error(translate(data.message));
                }
            }
        });
    });
</script>
@endpush