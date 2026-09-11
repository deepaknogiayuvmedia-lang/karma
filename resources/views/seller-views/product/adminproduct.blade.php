@extends('layouts.back-end.app-seller')

@section('title',\App\CPU\translate('Product List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="mb-4">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="{{asset('assets/back-end/img/products.png')}}" alt="">
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
                          <h1>{{\App\CPU\translate('Product List')}}</h1>
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
                                <th>{{\App\CPU\translate('selling_price')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $k=>$p)
                            <tr>
                                <th scope="row">
                                    <label class="switcher">
                                        <input type="checkbox" class="selectItem switcher_input"
                                            id="{{$p['id']}}">
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
                    <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Copy Product Modal with Variant Qty -->
<div class="modal fade" id="copyProductModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{\App\CPU\translate('Set_Variant_Quantities')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="copyProductId">
                <input type="hidden" id="copyProductPrice">
                <div class="mb-3">
                    <label class="font-weight-bold">{{\App\CPU\translate('Product')}}</label>
                    <p id="copyProductName" class="mb-0 text-muted"></p>
                </div>
                <div id="variantQtyContainer">
                    <!-- Variant qty inputs will be loaded here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{\App\CPU\translate('Cancel')}}</button>
                <button type="button" class="btn btn--primary" id="confirmCopyBtn" onclick="confirmCopyProduct()">
                    <span id="copyBtnText">{{\App\CPU\translate('Copy_Product')}}</span>
                    <span id="copyBtnLoader" class="d-none"><i class="fa fa-spinner fa-spin"></i></span>
                </button>
            </div>
        </div>
    </div>
</div>

@push('script')
<!-- Page level plugins -->
<script src="{{asset('assets/back-end')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });

    var pendingProductId = null;

    // Override the toggle behavior - fetch variations first, then show modal
    $(document).off('change', '.selectItem').on('change', '.selectItem', function() {
        if (!$(this).prop("checked")) {
            return;
        }
        var id = $(this).attr("id");
        var price = $('.sellprice' + id).val();
        var productName = $(this).closest('tr').find('td:nth-child(2)').text().trim();
        pendingProductId = id;

        // Fetch product variations
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{route('seller.product.get-variations')}}",
            method: 'POST',
            data: { id: id },
            success: function(data) {
                var container = $('#variantQtyContainer');
                container.empty();
                $('#copyProductId').val(id);
                $('#copyProductPrice').val(price);
                $('#copyProductName').text(productName);

                if (data.variations && data.variations.length > 0) {
                    data.variations.forEach(function(variant, index) {
                        container.append(`
                            <div class="form-group">
                                <label class="font-weight-bold">${variant.type}</label>
                                <div class="input-group">
                                    <input type="number" class="form-control variant-qty"
                                        data-variant='${JSON.stringify(variant)}'
                                        min="0" value="0" placeholder="Enter quantity">
                                </div>
                            </div>
                        `);
                    });
                } else {
                    container.append(`
                        <div class="form-group">
                            <label class="font-weight-bold">{{\App\CPU\translate('Quantity')}}</label>
                            <input type="number" class="form-control variant-qty" min="0" value="0"
                                data-variant='{"type":"default","price":0,"sku":"","qty":0}'
                                placeholder="Enter quantity">
                        </div>
                    `);
                }
                $('#copyProductModal').modal('show');
            },
            error: function() {
                toastr.error('Failed to load product variations');
            }
        });
    });

    function confirmCopyProduct() {
        var id = $('#copyProductId').val();
        var price = $('#copyProductPrice').val();

        var variants = [];
        $('.variant-qty').each(function() {
            var variant = JSON.parse($(this).attr('data-variant'));
            variant.qty = parseInt($(this).val()) || 0;
            variants.push(variant);
        });

        $('#copyBtnText').addClass('d-none');
        $('#copyBtnLoader').removeClass('d-none');
        $('#confirmCopyBtn').prop('disabled', true);

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
                price: price.replace(/[^\d.]/g, ""),
                variants: variants
            },
            success: function(data) {
                if (data.success) {
                    toastr.success(data.message);
                    // Disable the checkbox
                    $('.selectItem#' + id).attr('disabled', true);
                    $('#copyProductModal').modal('hide');
                } else {
                    toastr.error(data.message);
                    // Uncheck the checkbox
                    $('.selectItem#' + id).prop('checked', false);
                }
            },
            error: function() {
                toastr.error('Something went wrong');
                $('.selectItem#' + id).prop('checked', false);
            },
            complete: function() {
                $('#copyBtnText').removeClass('d-none');
                $('#copyBtnLoader').addClass('d-none');
                $('#confirmCopyBtn').prop('disabled', false);
            }
        });
    }
</script>
@endpush
