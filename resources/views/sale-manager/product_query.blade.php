@extends('layouts.back-end.sale_app')

@section('title', \App\CPU\translate('Product Query'))

@push('css_or_js')
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Header -->
        <div>
            <!-- Page Title -->
            <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
                <h2 class="h1 mb-0">
                    <img src="{{ asset('/assets/back-end/img/all-orders.png') }}" class="mb-1 mr-1" alt="">
                    <span class="page-header-title">
                    </span>
                    {{ \App\CPU\translate('Product Query') }}
                </h2>
                <span class="badge badge-soft-dark radius-50 fz-14">{{ $orders->total() }}</span>
            </div>
            <!-- End Page Title -->

            <!-- Order States -->
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url()->current() }}" id="form-data" method="GET">
                            <div class="row gy-3 gx-2">
                                <div class="col-12 pb-0">
                                    <h4>{{ \App\CPU\translate('select') }} {{ \App\CPU\translate('date') }}
                                        {{ \App\CPU\translate('range') }}</h4>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <select name="filter" class="form-control">
                                        <option value="0">{{ \App\CPU\translate('all') }}</option>
                                        <!--<option value="1" @if (Request::get('filter') == '1') selected @endif >{{ \App\CPU\translate('pending') }}</option>-->
                                        <option value="2" @if (Request::get('filter') == '2') selected @endif>
                                            {{ \App\CPU\translate('Approval pending') }}</option>
                                        <option value="3" @if (Request::get('filter') == '3') selected @endif>
                                            {{ \App\CPU\translate('confirmed') }}</option>
                                        <option value="4" @if (Request::get('filter') == '4') selected @endif>
                                            {{ \App\CPU\translate('canceled') }}</option>
                                        <option value="5" @if (Request::get('filter') == '5') selected @endif>
                                            {{ \App\CPU\translate('hold') }}</option>
                                        <option value="6" @if (Request::get('filter') == '6') selected @endif>
                                            {{ \App\CPU\translate('Approval confirmed') }}</option>

                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-3">
                                    <div class="form-floating">
                                        <input type="date" name="from" value="{{ Request::get('from') }}"
                                            id="from_date" class="form-control">
                                        <label>{{ \App\CPU\translate('Start_Date') }}</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3 mt-2 mt-sm-0">
                                    <div class="form-floating">
                                        <input type="date" value="{{ Request::get('to') }}" name="to"
                                            id="to_date" class="form-control">
                                        <label>{{ \App\CPU\translate('End_Date') }}</label>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-3 mt-2 mt-sm-0  ">
                                    <button type="submit" class="btn btn--primary btn-block" onclick="formUrlChange(this)"
                                        data-action="{{ url()->current() }}">
                                        {{ \App\CPU\translate('show') }} {{ \App\CPU\translate('data') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <!--Order stats -->
                    <?php $datacount = \App\model\ProductQuery::where('sale_employ_id', auth('sale_manager')->user()->id)->get(); ?>
                    <div class="row g-2 mb-20">
                        <!--<div class="col-sm-6 col-lg-3">-->

                        <!--    <div class="order-stats order-stats_pending">-->
                        <!--        <div class="order-stats__content">-->
                        <!--            <img width="20" src="{{ asset('/assets/back-end/img/pending.png') }}" class="svg" alt="">-->
                        <!--            <h6 class="order-stats__subtitle">{{ \App\CPU\translate('pending') }}</h6>-->
                        <!--        </div>-->
                        <!--        <span class="order-stats__title">-->
                        <!--            {{ $datacount->where('status', 1)->count() }}-->
                        <!--        </span>-->


                        <!--</div>-->
                        <!--</div>-->

                        <div class="col-sm-6 col-lg-3">
                            <!--Card -->
                            <div class="order-stats order-stats_confirmed">
                                <div class="order-stats__content"
                                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                    <img width="20" src="{{ asset('/assets/back-end/img/confirmed.png') }}"
                                        alt="">
                                    <h6 class="order-stats__subtitle">{{ \App\CPU\translate('confirmed') }} </h6>
                                </div>
                                <span class="order-stats__title">
                                    {{ $datacount->where('status', 3)->count() }}
                                </span>

                            </div>
                            <!--End Card -->
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <!--Card -->
                            <div class="order-stats order-stats_packaging">
                                <div class="order-stats__content"
                                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                    <img width="20" src="{{ asset('/assets/back-end/img/packaging.png') }}"
                                        alt="">
                                    <h6 class="order-stats__subtitle">{{ \App\CPU\translate('Approval') }}
                                        {{ \App\CPU\translate('pending') }}</h6>
                                </div>
                                <span class="order-stats__title">
                                    {{ $datacount->where('status', 2)->count() }}
                                </span>
                            </div>
                            <!--End Card -->
                        </div>



                        <div class="col-sm-6 col-lg-3">
                            <div class="order-stats order-stats_canceled ">
                                <div class="order-stats__content"
                                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                    <img width="20" src="{{ asset('/assets/back-end/img/canceled.png') }}"
                                        alt="">
                                    <h6 class="order-stats__subtitle">{{ \App\CPU\translate('canceled') }}</h6>
                                </div>
                                <span class="order-stats__title">
                                    {{ $datacount->where('status', 4)->count() }}
                                </span>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="order-stats order-stats_returned">
                                <div class="order-stats__content"
                                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                                    <img width="20" src="{{ asset('/assets/back-end/img/returned.png') }}"
                                        alt="">
                                    <h6 class="order-stats__subtitle">{{ \App\CPU\translate('Hold') }}</h6>
                                </div>
                                <span class="order-stats__title">
                                    {{ $datacount->where('status', 5)->count() }}
                                </span>
                            </div>
                        </div>


                    </div>


                    <!--Data Table Top -->
                    <div class="px-3 py-4 light-bg">
                        <div class="row g-2 flex-grow-1 justify-content-between">
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <form action="" method="GET">
                                    <!--Search -->
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ \App\CPU\translate('Search Name Mobile No Or Email Id') }}"
                                            aria-label="Search Name Mobile Email" value="{{ Request::get('search') }}">
                                        <button type="submit"
                                            class="btn btn--primary input-group-text">{{ \App\CPU\translate('search') }}</button>
                                    </div>
                                    <!--End Search -->
                                </form>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-2 d-flex justify-content-sm-end">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">Add Lead</button>
                            </div>
                        </div>
                        <!--End Row -->
                    </div>
                    <!--End Data Table Top -->

                    <!--Table -->
                    <div class="table-responsive datatable-custom">
                        <table
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100"
                            style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th class="">{{ \App\CPU\translate('SL') }}</th>
                                    <th>{{ \App\CPU\translate('Order') }} {{ \App\CPU\translate('ID') }}</th>
                                    <th>{{ \App\CPU\translate('Product') }} {{ \App\CPU\translate('Name') }}</th>
                                    <th> {{ \App\CPU\translate('Customer') }}</th>
                                    <th>{{ \App\CPU\translate('Pincode') }} </th>
                                    <th>{{ \App\CPU\translate('CHID') }} </th>
                                    <th>{{ \App\CPU\translate('Total') }} </th>
                                    <th>{{ \App\CPU\translate('Status') }} </th>
                                    {{-- <th>{{ \App\CPU\translate('Date') }}{{ \App\CPU\translate(' Action') }} </th> --}}
                                    <th>{{ \App\CPU\translate('Date') }}{{ \App\CPU\translate(' Updatedad') }} </th>
                                    <th>{{ \App\CPU\translate('Action') }} </th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($orders as $key => $order)
                                    <tr class="status class-all">
                                        <td class="">

                                            {{ $orders->firstItem() + $key }}
                                        </td>
                                        <td class="">
                                            LEAD#{{ $order['query_id'] }}
                                        </td>
                                        <td>

                                            {{ $order['product_name'] }}
                                        </td>
                                        <td>
                                            <strong class="title-name">{{ $order['name'] }}</strong>
                                            <div>{{ $order['email'] }} </div>
                                            <div>{{ $order['mobile'] }} </div>

                                        <td> {{ $order['address'] }} </td>
                                        <td> {{ $order['chid'] }} </td>
                                        <?php $price = $order['unit_price'];
                                        if ($order['discount_type'] == 'flat') {
                                            $disprice = $price - $order['discount'];
                                        } elseif ($order['discount_type'] == 'percent') {
                                            $disprice = ($price * $order['discount']) / 100;
                                        }
                                        
                                        if ($order['tax_model'] == 'exclude') {
                                            if ($order['tax_type'] == 'percent') {
                                                if ($order['tax'] == 0) {
                                                    $taxprice = $disprice;
                                                } else {
                                                    $taxprice = ($disprice * $order['tax']) / 100;
                                                }
                                            } else {
                                                $taxprice = $disprice - $order['tax'];
                                            }
                                        } else {
                                            $taxprice = $disprice;
                                        }
                                        
                                        ?>

                                        <td>{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency(round($taxprice, 2))) }}
                                        </td>
                                        <td>
                                            @if ($order['status'] != '3')
                                                <select id="status{{ $order['id'] }}"
                                                    onchange="status({{ $order['id'] }})">

                                                    <!--<option value="1" @if ($order['status'] == '1') selected @endif >{{ \App\CPU\translate('pending') }}</option>-->
                                                    <option value="2"
                                                        @if ($order['status'] == '2') selected @endif>
                                                        {{ \App\CPU\translate('Approval pending') }}</option>
                                                    <option value="6"
                                                        @if ($order['status'] == '6') selected @endif>
                                                        {{ \App\CPU\translate('Approval confirmed') }}</option>
                                                    <option value="4"
                                                        @if ($order['status'] == '4') selected @endif>
                                                        {{ \App\CPU\translate('canceled') }}</option>
                                                    <option value="5"
                                                        @if ($order['status'] == '5') selected @endif>
                                                        {{ \App\CPU\translate('hold') }}</option>
                                                    <option value="3"
                                                        @if ($order['status'] == '3') selected @endif disabled>
                                                        {{ \App\CPU\translate('confirmed') }}</option>
                                                </select>
                                            @endif

                                        </td>

                                        {{-- <td>
                                            <div>{{ date('d M Y', strtotime($order['created_at'])) }},</div>
                                            <div>{{ date('h:i A', strtotime($order['created_at'])) }}</div>
                                        </td> --}}
                                        <td>
                                            <div>{{ date('d M Y', strtotime($order['updated_at'])) }},</div>
                                            <div>{{ date('h:i A', strtotime($order['updated_at'])) }}</div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                    title="{{ \App\CPU\translate('edit') }}"
                                                    href="{{ route('sale.customer_edit', ['id' => $order['id']]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                @if ($order['status'] == '6')
                                                    <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                        title="{{ \App\CPU\translate('create_order') }}"
                                                        href="{{ route('sale.create_order', ['id' => $order['id']]) }}">
                                                        <i class="tio-shopping"></i>
                                                    </a>
                                                @endif
                                                <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                    title="{{ \App\CPU\translate('vieworder_details') }}"
                                                    href="{{ route('sale.pro.vieworder_details', ['id' => $order['id']]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12"
                                                        viewBox="0 0 14 12" fill="none" class="svg replaced-svg">
                                                        <path
                                                            d="M6.79584 3.75937C6.86389 3.75234 6.93195 3.75 7 3.75C8.2882 3.75 9.33333 4.73672 9.33333 6C9.33333 7.24219 8.2882 8.25 7 8.25C5.68993 8.25 4.66667 7.24219 4.66667 6C4.66667 5.93437 4.6691 5.86875 4.67639 5.80313C4.90243 5.90859 5.16493 6 5.44445 6C6.30243 6 7 5.32734 7 4.5C7 4.23047 6.90521 3.97734 6.79584 3.75937ZM11.6813 2.63906C12.8188 3.65625 13.5795 4.85391 13.9392 5.71172C14.0194 5.89687 14.0194 6.10312 13.9392 6.28828C13.5795 7.125 12.8188 8.32266 11.6813 9.36094C10.5365 10.3875 8.96389 11.25 7 11.25C5.03611 11.25 3.46354 10.3875 2.31924 9.36094C1.18174 8.32266 0.42146 7.125 0.059818 6.28828C0.0203307 6.19694 0 6.09896 0 6C0 5.90104 0.0203307 5.80306 0.059818 5.71172C0.42146 4.85391 1.18174 3.65625 2.31924 2.63906C3.46354 1.61344 5.03611 0.75 7 0.75C8.96389 0.75 10.5365 1.61344 11.6813 2.63906ZM7 2.625C5.06771 2.625 3.5 4.13672 3.5 6C3.5 7.86328 5.06771 9.375 7 9.375C8.93229 9.375 10.5 7.86328 10.5 6C10.5 4.13672 8.93229 2.625 7 2.625Z"
                                                            fill="#0177CD"></path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!--End Table -->

                    <!--Pagination -->
                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            <!--Pagination -->
                            {!! $orders->links() !!}
                        </div>
                    </div>
                    <!--End Pagination -->
                </div>
            </div>
            <!--End Order States -->

            <!-- Nav Scroller -->
            <div class="js-nav-scroller hs-nav-scroller-horizontal d-none">
                <span class="hs-nav-scroller-arrow-prev d-none">
                    <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                        <i class="tio-chevron-left"></i>
                    </a>
                </span>

                <span class="hs-nav-scroller-arrow-next d-none">
                    <a class="hs-nav-scroller-arrow-link" href="javascript:;">
                        <i class="tio-chevron-right"></i>
                    </a>
                </span>

                <!-- Nav -->
                <ul class="nav nav-tabs page-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{ \App\CPU\translate('product_query') }}</a>
                    </li>
                </ul>
                <!-- End Nav -->
            </div>
            <!-- End Nav Scroller -->
        </div>
        <!-- End Page Header -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Lead</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('sale.pro.product_sales_query') }}" class="row g-2" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="email">Product:</label>
                                <select class="form-control" name="product_id">
                                    @foreach ($products as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control name" name="name" required />
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile Number:</label>
                                <input type="tel" class="form-control mobile" name="mobile" required />
                            </div>
                            <div class="col-md-6">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control email" name="email" required />
                            </div>
                            <div class="col-md-6">
                                <label for="email">Chanal:</label>
                                <select class="form-control" name="chanal_id">
                                    @foreach ($chanals as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="address">Pincode:</label>
                                <input type="number" name="address" class="form-control number" required />
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn text-center d-block w-100 mt-2"
                                    style="background: #00695c;color:#ffffff"><i class="fa fa-shopping-bag"
                                        aria-hidden="true"></i>ADD LEAD</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        function status(id) {

            var status = document.getElementById('status' + id).value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('sale.pro.status') }}",
                method: 'POST',
                data: {
                    rowid: id,
                    status: status
                },
                success: function(data) {
                    console.log(data);
                    if (data.success == true) {
                        toastr.success('{{ \App\CPU\translate('Status updated successfully') }}');
                        setTimeout(function() {
                            window.location.reload(1);
                        }, 2000);
                    }
                }
            });




        }
    </script>
@endpush
