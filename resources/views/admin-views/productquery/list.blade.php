@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Product Query'))
@push('css_or_js')
@endpush
@section('content')

<div class="content container-fluid">

    <!-- Page Title -->
    <div class="mb-4 d-flex flex-wrap gap-3 justify-content-between align-items-center">
        <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
            <img width="20" src="{{asset('assets/back-end/img/products.png')}}" alt="">
            {{\App\CPU\translate('Bidding List ')}} {{ $biddings->total()}}
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
                            <h1>Self Biddings</h1>
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
                                <th>{{\App\CPU\translate('pBid price')}}</th>
                                <th>{{\App\CPU\translate('Description')}}</th>
                                <th>{{\App\CPU\translate('status')}}</th>
                                <th>{{\App\CPU\translate('vander bids')}}</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($biddings as $key=>$product)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$product->product_name}}</td>
                                <td>{{$product->product_qty}}</td>
                                <td>{{ $product->product_bit }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                  <span class="badge  {{$product->status == 'close'?' badge-warning':' badge-info' }}"> {{$product->status == 'close'?'Win':'Pending' }}</span>
                                </td>
                                <td>
                                    @if ($product->bedders != null)
                                    <button class="btn btn-outline-success btn-sm view-bid-model" data-id="{{$product->id}}">
                                        <i class="tio-invisible"></i>
                                    </button>
                                    @else
                                    <button class="btn btn-outline--primary btn-sm  " data-id="{{$product->id}}">
                                        No Bidding
                                    </button>
                                    @endif

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
                    <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                    <p class="mb-0">{{\App\CPU\translate('No data to show')}}</p>
                </div>
                @endif


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
                            <th>Select</th>
                            <th>Vendor Name</th>
                            <th>Vendor number</th>
                            <th>Price</th>
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
<script>
      $('.view-bid-model').on('click', function() {
        var productId = $(this).data('id');
        $.ajax({
            url: "{{ route('seller.product.get-bidding-details') }}",
            method: 'GET',
            data: {
                product_id: productId
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
                            html = `<i class="tio-close"></i>`;
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
                                <td class="editable">${bid.phone}</td>
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
</script>
@endpush
