@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Payment Method'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-4 pb-2">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{ asset('/assets/back-end/img/3rd-party.png') }}" alt="">
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
                        <form
                            action="{{ route('admin.business-settings.shipping-method.third-party-shipping-method-store') }}"
                            method="post">
                            @csrf
                            <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
                                <h5 class="text-uppercase">{{ \App\CPU\translate('Delhivery') }}</h5>

                                <label class="switcher show-status-text">
                                    <input class="switcher_input" type="checkbox" name="status" value="1"
                                        {{ isset($config) && $config['status'] == 1 ? 'checked' : '' }}>
                                    <span class="switcher_control"></span>
                                </label>
                            </div>

                            <center class="mb-3 d-flex justify-content-center">
                                <img height="60" src="{{ asset('/assets/front-end/img/download.png') }}"
                                    onerror="this.src='{{ asset('/assets/back-end/img/3rd-party.png') }}'" alt="">
                            </center>


                            <div class="form-group">
                                <label class="d-flex title-color">{{ \App\CPU\translate('api_key') }}</label>
                                <input type="text" class="form-control" name="api_key"
                                    value="{{ isset($config) ? $config['api_key'] : '' }}">
                            </div>

                            <div class="form-group">
                                <label class="d-flex title-color">{{ \App\CPU\translate('api_token') }}</label>
                                <input type="text" class="form-control" name="api_secret"
                                    value="{{ isset($config) ? $config['api_secret'] : '' }}">
                            </div>

                            <div class="form-group">
                                <label class="d-flex title-color">{{ \App\CPU\translate('Environment') }}</label>
                                <select class="form-control" name="environment">
                                    @php($env = isset($config) ? ($config['environment'] ?? 'test') : 'test')
                                    <option value="test" {{ $env === 'test' || $env === 'dev' ? 'selected' : '' }}>
                                        {{ \App\CPU\translate('Test') }}
                                    </option>
                                    <option value="live" {{ $env === 'live' ? 'selected' : '' }}>
                                        {{ \App\CPU\translate('Live') }}
                                    </option>
                                </select>
                                <small class="text-muted d-block mt-1">
                                    {{ \App\CPU\translate('Test = Delhivery staging API | Live = Delhivery production API') }}
                                </small>
                            </div>

                            <div class="mt-3 d-flex flex-wrap justify-content-end gap-10">
                                <button type="submit"
                                    class="btn btn--primary px-4 text-uppercase">{{ \App\CPU\translate('save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
