@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('loyalty_point'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">

        <!-- Page Title -->
        <div class="mb-4 pb-2">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/assets/back-end/img/business-setup.png') }}" alt="">
                {{ \App\CPU\translate('Business_Setup') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Inline Menu -->
        @include('admin-views.business-settings.business-setup-inline-menu')
        <!-- End Inline Menu -->

        <form action="{{ route('admin.business-settings.loyalty-point-update') }}" method="post"
            enctype="multipart/form-data" id="update-settings">
            @csrf
            <div class="row gy-2 pb-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="border-bottom py-3 px-4">
                            <div class="d-flex justify-content-between align-items-center gap-10">
                                <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2">
                                    <i class="tio-award"></i>
                                    {{ \App\CPU\translate('loyalty_point') }}:
                                </h5>
                                <label class="switcher" for="loyalty_point_status">
                                    <input type="checkbox" class="switcher_input"
                                        onclick="section_visibility('loyalty_point_status')"
                                        name="loyalty_point_status" id="loyalty_point_status"
                                        value="1" {{ isset($data['loyalty_point_status']) && $data['loyalty_point_status'] == 1 ? 'checked' : '' }}>
                                    <span class="switcher_control"></span>
                                </label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="loyalty-point-section" id="loyalty_point_status_section">
                                <div class="form-group">
                                    <label class="title-color d-flex" for="loyalty_point_exchange_rate">
                                        1 {{ \App\CPU\Helpers::currency_code() }}
                                        = {{ \App\CPU\translate('how_much_point') }}</label>
                                    <input type="number" class="form-control" name="loyalty_point_exchange_rate"
                                        step="1" value="{{ $data['loyalty_point_exchange_rate'] ?? '0' }}">
                                </div>
                                <div class="form-group">
                                    <label class="title-color d-flex">{{ \App\CPU\translate('percentage_of_loyalty_point_on_order_amount') }}</label>
                                    <input type="number" class="form-control" name="item_purchase_point" step=".01"
                                        value="{{ $data['loyalty_point_item_purchase_point'] ?? '0' }}">
                                </div>
                                <div class="form-group">
                                    <label class="title-color d-flex">{{ \App\CPU\translate('minimum_point_to_transfer') }}</label>
                                    <input type="number" class="form-control" name="minimun_transfer_point" min="0"
                                        step="1" value="{{ $data['loyalty_point_minimum_point'] ?? '0' }}">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" id="submit"
                                        class="btn px-4 btn--primary">{{ \App\CPU\translate('save') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script_2')
    <script>
        $(document).on('ready', function() {
            @if (isset($data['loyalty_point_status']) && $data['loyalty_point_status'] != 1)
                $('#loyalty_point_status_section').attr('style', 'display: none !important');
            @endif
        });
    </script>
    <script>
        function section_visibility(id) {
            if ($('#' + id).is(':checked')) {
                $('#' + id + '_section').attr('style', 'display: block');
            } else {
                $('#' + id + '_section').attr('style', 'display: none !important');
            }
        }
    </script>
@endpush
