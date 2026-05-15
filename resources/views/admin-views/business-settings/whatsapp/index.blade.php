@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Payment Method'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-4 pb-2">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/public/assets/back-end/img/3rd-party.png') }}" alt="">
                {{ \App\CPU\translate('3rd_party') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.business-settings.third-party-inline-menu')
        <!-- End Inlile Menu -->

        <div class="row gy-3">
            <div class="col-md-12 ">
                <div class="card h-100">
                    <div class="card-body">
                        <form action="{{ route('admin.business-settings.whatsapp.store') }}" method="post">
                            @csrf
                            <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
                                <h5 class="text-uppercase">{{ \App\CPU\translate('WhatsApp') }}</h5>

                                <label class="switcher show-status-text">
                                    <input class="switcher_input" type="checkbox" name="status" value="1"
                                        {{ isset($whatsapp_setting) && $whatsapp_setting['status'] == 1 ? 'checked' : '' }}>
                                    <span class="switcher_control"></span>
                                </label>
                            </div>

                            <center class="mb-3">
                                <img height="60" src="{{ asset('/public/assets/front-end/img/--whatsapp.png') }}"
                                    alt="">
                            </center>
                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <label class="d-flex title-color">{{ \App\CPU\translate('App Id') }}</label>
                                    <input type="text" class="form-control" name="app_id"
                                        value="{{ $whatsapp_setting['app_id'] ?? '' }}">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="d-flex title-color">{{ \App\CPU\translate('App  Secret Key') }}</label>
                                    <input type="text" class="form-control" name="api_secret_key"
                                        value="{{ $whatsapp_setting['api_secret_key'] ?? '' }}">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label class="d-flex title-color">{{ \App\CPU\translate('Phone Number Id') }}</label>
                                    <input type="text" class="form-control" name="phone_number_id"
                                        value="{{ $whatsapp_setting['phone_number_id'] ?? '' }}">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label
                                        class="d-flex title-color">{{ \App\CPU\translate('WhatsApp Business Account Id') }}</label>
                                    <input type="text" class="form-control" name="whatsapp_business_account_id"
                                        value="{{ $whatsapp_setting['whatsapp_business_account_id'] ?? '' }}">
                                </div>
                                <div class="form-group col-lg-12">
                                    <label class="d-flex title-color">{{ \App\CPU\translate('Access Token') }}</label>
                                    <input type="text" class="form-control" name="access_token"
                                        value="{{ $whatsapp_setting['access_token'] ?? '' }}">
                                </div>


                            </div>
                            <div class="mt-3 d-flex flex-wrap justify-content-end gap-10">

                                <button type="submit"
                                    class="btn btn--primary px-4 text-uppercase">{{ \App\CPU\translate('Save') }}
                                </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
