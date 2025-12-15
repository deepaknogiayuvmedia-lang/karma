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
            {{\App\CPU\translate('Products23')}}
            <span class="badge badge-soft-dark radius-50 fz-14 ml-1"></span>
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
                                        placeholder="{{\App\CPU\translate('Search by Product Name')}}" aria-label="Search orders" value="" required>
                                    <button type="submit" class="btn btn--primary">{{\App\CPU\translate('search')}}</button>
                                </div>
                                <!-- End Search -->
                            </form>
                        </div>
                        <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                            <div>
                                <button type="button" class="btn btn-outline--primary" data-toggle="dropdown">
                                    <i class="tio-download-to"></i>
                                    {{\App\CPU\translate('export')}}
                                    <i class="tio-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a class="dropdown-item" href="{{ route('seller.product.bulk-export') }}">{{\App\CPU\translate('excel')}}</a></li>
                                    <div class="dropdown-divider"></div>
                                </ul>
                            </div>

                            <a href="{{route('seller.product.add-new')}}" class="btn btn--primary">
                                <i class="tio-add"></i>
                                <span class="text">{{\App\CPU\translate('Add new bid')}}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="datatable" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                        <thead class="thead-light thead-50 text-capitalize">
                            <tr>
                                <th>{{\App\CPU\translate('SL')}}</th>
                                <th>{{\App\CPU\translate('Product Name')}}</th>
                                <th>{{\App\CPU\translate('Product Type')}}</th>
                                <th>{{\App\CPU\translate('purchase_price')}}</th>
                                <th>{{\App\CPU\translate('selling_price')}}</th>
                                <th>{{\App\CPU\translate('verify_status')}}</th>
                                <th>{{\App\CPU\translate('Active')}} {{\App\CPU\translate('status')}}</th>
                                <th class="text-center __w-5px">{{\App\CPU\translate('Action')}}</th>
                            </tr>
                        </thead>
                        
                    </table>
                </div>

                <div class="table-responsive mt-4">
                    <div class="px-4 d-flex justify-content-lg-end">
                        <!-- Pagination -->

                    </div>
                </div>


                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>

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
            url: "{{route('seller.product.status-update')}}",
            method: 'POST',
            data: {
                id: id,
                status: status
            },
            success: function(data) {
                if (data.success == true) {
                    toastr.success('{{\App\CPU\translate('
                        Status updated successfully ')}}');
                } else if (data.success == false) {
                    t.removeAttr('checked');
                    toastr.error('{{\App\CPU\translate('
                        Status updated failed.Product must be approved ')}}');
                }
            }
        });
    });
</script>
@endpush