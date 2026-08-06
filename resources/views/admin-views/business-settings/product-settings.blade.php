@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('product_settings'))

@push('css_or_js')
    <link href="{{ asset('assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/custom.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="pb-2">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/business-setup.png')}}" alt="">
                {{\App\CPU\translate('Business_Setup')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.business-settings.business-setup-inline-menu')
        <!-- End Inlile Menu -->

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.product-settings.stock-limit-warning') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            @php($stock_limit=\App\Model\BusinessSetting::where('type','stock_limit')->first())
                            <div class="form-group">
                                <label class="title-color d-flex">{{\App\CPU\translate('minimum_stock_limit_for_warning')}}</label>
                                <input class="form-control" type="number" name="stock_limit"
                                        value="{{ $stock_limit->value?$stock_limit->value:"" }}"
                                        placeholder="{{\App\CPU\translate('EX:123')}}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="d-flex">
                                <button type="submit" class="btn btn--primary px-4">{{\App\CPU\translate('submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6 mt-2 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Digital Product')}}</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{route('admin.product-settings.update-digital-product')}}"
                              method="post">
                            @csrf
                            <label class="title-color d-flex mb-3">{{\App\CPU\translate('Digital Product on/off')}}</label>
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <input class="" name="digital_product" type="radio" value="1"
                                       id="defaultCheck1" {{$digital_product==1?'checked':''}}>
                                <label class="title-color mb-0" for="defaultCheck1">
                                    {{\App\CPU\translate('Turn on')}}
                                </label>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <input class="" name="digital_product" type="radio" value="0"
                                       id="defaultCheck2" {{$digital_product==0?'checked':''}}>
                                <label class="title-color mb-0" for="defaultCheck2">
                                    {{\App\CPU\translate('Turn off')}}
                                </label>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn--primary">{{\App\CPU\translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mt-2 mt-md-0">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{\App\CPU\translate('Product_Brand')}}</h5>
                    </div>

                    <div class="card-body">
                        <form action="{{route('admin.product-settings.update-product-brand')}}"
                              method="post">
                            @csrf
                            <label class="title-color d-flex mb-3">{{\App\CPU\translate('Product Brand on/off')}}</label>
                            <div class="d-flex gap-2 align-items-center mb-2">
                                <input class="" name="product_brand" type="radio" value="1"
                                       id="defaultCheck3" {{$brand==1?'checked':''}}>
                                <label class="title-color mb-0" for="defaultCheck3">
                                    {{\App\CPU\translate('Turn on')}}
                                </label>
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <input class="" name="product_brand" type="radio" value="0"
                                       id="defaultCheck4" {{$brand==0?'checked':''}}>
                                <label class="title-color mb-0" for="defaultCheck4">
                                    {{\App\CPU\translate('Turn off')}}
                                </label>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn--primary">{{\App\CPU\translate('Save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Ranking Priority Weights -->
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="tio-chart-bar-4"></i> {{\App\CPU\translate('Product Ranking Priority Weights')}}
                </h5>
                <span class="badge badge-soft-dark">{{\App\CPU\translate('Total weight must equal 100')}}</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product-settings.save-ranking-weights') }}" method="post" id="rankingWeightsForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="title-color d-flex align-items-center gap-2">
                                    <i class="tio-money-bill"></i>
                                    {{\App\CPU\translate('1. Lowest Price')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="weight_price" class="form-control ranking-weight"
                                           value="{{ $rankingWeights['price'] ?? 20 }}" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <small class="text-muted">{{\App\CPU\translate('Lower price products get higher ranking')}}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="title-color d-flex align-items-center gap-2">
                                    <i class="tio-truck"></i>
                                    {{\App\CPU\translate('2. Dispatch Time')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="weight_dispatch" class="form-control ranking-weight"
                                           value="{{ $rankingWeights['dispatch'] ?? 15 }}" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <small class="text-muted">{{\App\CPU\translate('Fast on-time delivery boosts ranking')}}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="title-color d-flex align-items-center gap-2">
                                    <i class="tio-refresh-undo"></i>
                                    {{\App\CPU\translate('3. Low Cancel / Return Rate')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="weight_cancel_return" class="form-control ranking-weight"
                                           value="{{ $rankingWeights['cancel_return'] ?? 20 }}" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <small class="text-muted">{{\App\CPU\translate('Fewer cancellations and returns = better rank')}}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="title-color d-flex align-items-center gap-2">
                                    <i class="tio-shield-check"></i>
                                    {{\App\CPU\translate('4. Low Damage Complaints')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="weight_damage" class="form-control ranking-weight"
                                           value="{{ $rankingWeights['damage'] ?? 15 }}" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <small class="text-muted">{{\App\CPU\translate('Fewer low ratings (damage proxy) = better rank')}}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="title-color d-flex align-items-center gap-2">
                                    <i class="tio-star"></i>
                                    {{\App\CPU\translate('5. Review Rating')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="weight_review" class="form-control ranking-weight"
                                           value="{{ $rankingWeights['review'] ?? 15 }}" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <small class="text-muted">{{\App\CPU\translate('Higher average review rating = better rank')}}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="title-color d-flex align-items-center gap-2">
                                    <i class="tio-local-shipping"></i>
                                    {{\App\CPU\translate('6. Low Delivery Charges')}}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="weight_delivery" class="form-control ranking-weight"
                                           value="{{ $rankingWeights['delivery'] ?? 15 }}" min="0" max="100" step="1">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                                <small class="text-muted">{{\App\CPU\translate('Free or low shipping cost = better rank')}}</small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                        <div>
                            <strong>{{\App\CPU\translate('Total Weight')}}: </strong>
                            <span id="totalWeightDisplay" class="font-weight-bold">100</span>
                            <span id="weightStatus" class="ml-2"></span>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-primary" onclick="recalculateRanking()">
                                <i class="tio-refresh"></i> {{\App\CPU\translate('Recalculate All Rankings')}}
                            </button>
                            <button type="submit" class="btn btn--primary">
                                <i class="tio-save"></i> {{\App\CPU\translate('Save Weights')}}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function updateWeightTotal() {
            var total = 0;
            $('.ranking-weight').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            $('#totalWeightDisplay').text(total);
            if (total === 100) {
                $('#weightStatus').html('<span class="text-success"><i class="tio-check-circle"></i> Valid</span>');
            } else {
                $('#weightStatus').html('<span class="text-danger"><i class="tio-warning"></i> Must equal 100</span>');
            }
        }

        $(document).on('input', '.ranking-weight', function() {
            updateWeightTotal();
        });

        $('#rankingWeightsForm').on('submit', function(e) {
            var total = 0;
            $('.ranking-weight').each(function() {
                total += parseInt($(this).val()) || 0;
            });
            if (total !== 100) {
                e.preventDefault();
                toastr.error('Total weight must equal 100. Current total: ' + total);
                return false;
            }
        });

        function recalculateRanking() {
            if (!confirm('This will recalculate ranking scores for ALL products. Continue?')) {
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.product-settings.recalculate-ranking') }}",
                method: 'POST',
                beforeSend: function() {
                    $('body').css('cursor', 'wait');
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message || 'Failed to recalculate');
                    }
                },
                error: function() {
                    toastr.error('Something went wrong');
                },
                complete: function() {
                    $('body').css('cursor', 'default');
                }
            });
        }

        $(document).ready(function() {
            updateWeightTotal();
        });
    </script>
@endpush

