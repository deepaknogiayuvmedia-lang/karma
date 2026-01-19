@extends('layouts.back-end.app-seller')

@section('title',\App\CPU\translate('Product List'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Title -->
    <div class="mb-4 d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="{{asset('/public/assets/back-end/img/products.png')}}" alt="">
            {{\App\CPU\translate('Bidding List ')}}
            <span class="badge badge-soft-dark radius-50 fz-14 ml-1"></span>
        </h2>
        <div>
            <a class="btn btn--primary" href="{{ route('seller.product.bidding-win') }}">
                <i class="tio-invisible"></i>
                <span class="text">{{\App\CPU\translate('Win Bid')}}</span>
            </a>
            <a class="btn btn--primary" onclick="show_modal()">
                <i class="tio-add"></i>
                <span class="text">{{\App\CPU\translate('Add New Bid')}}</span>
            </a>
        </div>
    </div>
    <!-- End Page Title -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h1>Self Biddings {{ $biddings->total() }}</h1>
                        </div>
                        <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                            <form action="{{ url()->current() }}" method="GET">
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-custom">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="{{\App\CPU\translate('Search by Product Name')}}" aria-label="Search orders" value="{{ $search }}" required>
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
                                <th>{{\App\CPU\translate('SL')}}</th>
                                <th>{{\App\CPU\translate('Product Name')}}</th>
                                <th>Product Quantity</th>
                                <th>{{\App\CPU\translate('Description')}}</th>
                                <th>{{\App\CPU\translate('status')}}</th>
                                <th>{{\App\CPU\translate('vander bids')}}</th>
                                <th class="text-center __w-5px">{{\App\CPU\translate('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($biddings as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_qty}}</td>

                                <td>{{ $product->description }}</td>
                                <td>
                                    <label class="switcher">
                                        <input type="checkbox" class="status switcher_input"
                                            id="{{$product->id}}" {{$product->status == 'pending'?'':'checked' }} disabled>
                                        <span class="switcher_control"></span>
                                    </label>
                                </td>
                                <td>
                                    @if ($product->bedders != null)
                                    <button class="btn btn-outline-success btn-sm view-bid-model" data-id="{{$product->id}}">
                                        <i class="tio-invisible"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-outline--primary btn-sm " data-id="{{$product->id}}">
                                        No Bidding
                                    </button>
                                    @endif

                                </td>
                                <td class="text-center __w-5px">
                                    @if ($product->status == 'pending')
                                    <button class="btn btn-outline--primary btn-sm edit-btn" data-id="{{ $product->id }}">
                                        <i class="tio-edit"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $product->id  }}">
                                        <i class="tio-delete"></i>
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
                        {{$biddings->links()}}
                    </div>
                </div>
                @if ($biddings->isEmpty())

                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif


            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-lg-4">
                            <h1>Other vendor Biddings {{ $allbiddings->total() }}</h1>
                        </div>
                        <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                            <form action="{{ url()->current() }}" method="GET">
                                <!-- Search -->
                                <div class="input-group input-group-merge input-group-custom">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input type="search" name="search1" class="form-control"
                                        placeholder="{{\App\CPU\translate('Search by Product Name')}}" aria-label="Search orders" value="{{$search1}}" required>
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
                                <th>{{\App\CPU\translate('SL')}}</th>
                                <th>{{\App\CPU\translate('Product Name')}}</th>
                                <th>Product Quantity</th>

                                <th>{{\App\CPU\translate('Description')}}</th>
                                <th>{{\App\CPU\translate('Bid Amount')}}</th>
                                <th class="text-center __w-5px">{{\App\CPU\translate('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($allbiddings as $key=>$product1)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product1->product_name}}</td>
                                <td>{{$product1->product_qty}}</td>

                                <td>{{ $product1->description }}</td>
                                <td>
                                    @php
                                    $bidders = json_decode($product1->bedders);
                                    $vendor_bid = null;
                                    @endphp
                                    @if($bidders)
                                    @foreach($bidders as $bidder)
                                    @if($bidder->vendor_id == auth('seller')->id())
                                    @php
                                    $vendor_bid = $bidder->price;
                                    @endphp
                                    @endif
                                    @endforeach
                                    @endif
                                    <input type="number" class="form-control bid-amount" name="amount" placeholder="Ex: 500" value="{{ $vendor_bid }}" required="">
                                    <p class="error d-none text-danger"> Please enter a valid bid amount greater than zero. </p>
                                </td>
                                <td class="text-center __w-5px">
                                    <button class="btn btn-outline--primary btn-sm bid-button" href="" data-id="{{ $product1->id }}">
                                        <i class="tio-edit"></i> Submit
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
                        {{$allbiddings->links()}}
                    </div>
                </div>
                @if ($allbiddings->isEmpty())

                <div class="text-center p-4">
                    <img class="mb-3 w-160" src="{{asset('public/assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif


            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addFundModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="background-color: #00000036;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Bidding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('seller.product.bidding-place')}}" method="post" enctype="multipart/form-data" id="add_fund">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <input type="hidden" name="id">
                            <div class="form-group">
                                <label class="input-label d-flex" for="customer">Product</label>
                                <input type="text" id='form-customer' name="product_id" list="product-list" data-placeholder="{{\App\CPU\translate('select_customer')}}" class="js-data-example-ajax form-control w-100" required>
                                <datalist id="product-list">
                                    <option value="" disabled selected>Select product</option>
                                    @foreach($Product as $product)
                                    <option>{{$product->name}}</option>
                                    @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label class="input-label d-flex" for="amount">Quantity</label>
                                <input type="number" class="form-control" name="qty" placeholder="Ex: 500" required="">
                            </div>
                        </div>
                        <!-- <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label class="input-label d-flex" for="amount">bid Amount</label>

                                <input type="number" class="form-control" name="amount" id="amount" step=".01" placeholder="Ex: 500" required="">
                            </div>
                        </div> -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="input-label d-flex align-items-center gap-1" for="referance">Description</label>
                                <textarea name="description" class="form-control" id="referance"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submit" name="sumbit" class="btn btn--primary px-4">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="biddingDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-modal="true" style="background-color: #00000036;">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Bidding</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="bidsTable" class="table">
                    <thead>
                        <tr>
                            <th onclick="sortTable(0)">Select</th>
                            <th onclick="sortTable(1)">Vendor Name</th>
                            <th onclick="sortTable(2)">Price</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody"></tbody>
                </table>
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

    $('.bid-amount').on('input', function() {
        var value = $(this).val();
        if (value < 0) {
            $(this).val(0);
        }
    });

    $('.bid-button').on('click', function() {
        var bidAmount = $(this).closest('tr').find('.bid-amount').val();
        var productId = $(this).data('id');
        if (bidAmount === '' || isNaN(bidAmount) || Number(bidAmount) <= 0) {
            $(this).closest('tr').find('.error').removeClass('d-none');
            // after 3 seconds hide the error message
            setTimeout(() => {
                $(this).closest('tr').find('.error').addClass('d-none');
            }, 3000);
            return;
        }
        // make object of values
        var data = {
            '_token': '{{ csrf_token() }}',
            'product_id': productId,
            'amount': bidAmount
        };
        //ajaqx request
        $.ajax({
            url: "{{ route('seller.product.vendor-bidding-place') }}",
            method: 'POST',
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.message);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while submitting the bid.');
            }
        });

    });

    $('.view-bid-model').on('click', function() {
        var productId = $(this).data('id');
        $.ajax({
            url: "{{ route('seller.product.get-bidding-details') }}",
            method: 'GET',
            data: {
                product_id: productId,
                data: 0,
            },
            success: function(response) {
                if (response.status == 'success') {
                    // Display bidding details in modal or handle response
                    const tbody = document.getElementById('tableBody');
                    tbody.innerHTML = '';

                    response.data.forEach((bid, index) => {
                        const row = tbody.insertRow();
                        let checkbox
                        let html = '';
                        if (response.bidstatus == 'pending') {
                            html = `<input type="radio" name="r1" class="form-check" onclick="palce_bid(${productId} , ${bid.vendor_id})" ${checkbox}  style="width: 37px;height: 24px;">`;
                        }

                        if (bid.done == 1) {
                            checkbox = 'checked';
                            html = '👑';
                            if (response.document != null) {
                                html = `
                                    <a class="btn btn-outline-info btn-sm square-btn" target="_blank" title="Invoice" href="${response.document_url} ">
                                                <i class="tio-download"></i>
                                            </a>
                                `;
                            }

                        }
                        row.innerHTML = `
                                <td class="editable fs-1">${html}</td>
                                <td class="editable">${bid.name}</td>
                                <td class="editable">${bid.price}</td>
                            `;
                    });
                    // $('#biddingDetailsModal .modal-body').html(response.data);
                    $('#biddingDetailsModal').modal('show');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while fetching bidding details.');
            }
        });
    });

    function palce_bid(bid, userid) {
        var data = {
            '_token': '{{ csrf_token() }}',
            'product_id': bid,
            'userid': userid
        };
        $.ajax({
            url: "{{ route('seller.product.bidding-close') }}",
            method: 'POST',
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    toastr.success(response.message);

                } else {
                    toastr.error(response.message);

                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while submitting the bid.');
            },


        });
    }

    $('.delete-btn').on('click', function() {
        var recordid = $(this).data('id');
        $.ajax({
            url: "{{ route('seller.product.bidding-delete') }}",
            method: 'GET',
            data: {
                recordid: recordid
            },
            success: function(response) {
                if (response.status == 'success') {
                    // Display bidding details in modal or handle response
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = " @php url()->current() @endphp "
                    }, 3000);
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while fetching bidding details.');
            }
        });
    });

    $('.edit-btn').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ route('seller.product.get-bidding-details') }}",
            method: 'GET',
            data: {
                product_id: id,
                data: 1,
            },
            success: function(response) {
                if (response.status == 'success') {
                    // Display bidding details in modal or handle response
                    // Set quantity input


                    const idInput = document.querySelector('input[name="id"]');
                    if (idInput) idInput.value = response.alldata.id;

                    const productselect = document.querySelector('select[name="product_id"]');
                    if (productselect) productselect.value = response.alldata.product_id;

                    const qtyInput = document.querySelector('input[name="qty"]');
                    if (qtyInput) qtyInput.value = response.alldata.product_qty;

                    // Set bid amount input
                    const amountInput = document.querySelector("#amount");
                    if (amountInput) amountInput.value = response.alldata.product_bit;
                    console.log(response.alldata.product_bit)
                    console.log(amountInput)
                    // Set description textarea
                    const descTextarea = document.querySelector('textarea[name="description"]');
                    if (descTextarea) descTextarea.value = response.alldata.description;

                    document.querySelector('button[name="sumbit"]').innerText = 'Update'
                    $('#addFundModal').modal('show');
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                toastr.error('An error occurred while fetching bidding details.');
            }
        })
    })

    function show_modal() {
        document.querySelector('button[name="sumbit"]').innerText = 'Submit'
        $('#addFundModal').modal('show');
    }
</script>
@endpush