@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Payment Method'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-4 pb-2">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/3rd-party.png')}}" alt="">
                {{\App\CPU\translate('3rd_party')}}
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
                        @php($config=\App\CPU\Helpers::get_business_settings('bkash'))
                        <form
                            action=""
                            method="post">
                        @csrf
                        @if(isset($config))
                                @php($config['environment'] = $config['environment']??'sandbox')
                                <div class="d-flex flex-wrap gap-2 justify-content-between mb-3">
                                    <h5 class="text-uppercase">{{\App\CPU\translate('bkash')}}</h5>

                                    <label class="switcher show-status-text">
                                        <input class="switcher_input" type="checkbox"
                                               name="status" value="1" {{$config['status']==1?'checked':''}}>
                                        <span class="switcher_control"></span>
                                    </label>
                                </div>

                                <center class="mb-3">
                                    <img height="60" src="{{asset('/public/assets/back-end/img/bkash.png')}}" alt="">
                                </center>

                                <div class="form-group">
                                    <label class="d-flex title-color">
                                        {{\App\CPU\translate('choose_environment')}}
                                    </label>
                                    <select class="js-example-responsive form-control" name="environment">
                                        <option value="sandbox" {{$config['environment']=='sandbox'?'selected':''}}>
                                            {{\App\CPU\translate('sandbox')}}
                                        </option>
                                        <option value="live" {{$config['environment']=='live'?'selected':''}}>
                                            {{\App\CPU\translate('live')}}
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="d-flex title-color">{{\App\CPU\translate('api_key')}}</label>
                                    <input type="text" class="form-control" name="api_key"
                                           value="{{env('APP_MODE')!='demo'?$config['api_key']:''}}">
                                </div>

                                <div class="form-group">
                                    <label class="d-flex title-color">{{\App\CPU\translate('api_secret')}}</label>
                                    <input type="text" class="form-control" name="api_secret"
                                           value="{{env('APP_MODE')!='demo'?$config['api_secret']:''}}">
                                </div>

                                <div class="form-group">
                                    <label class="d-flex title-color">{{\App\CPU\translate('username')}}</label>
                                    <input type="text" class="form-control" name="username"
                                           value="{{env('APP_MODE')!='demo'?$config['username']:''}}">
                                </div>

                                <div class="form-group">
                                    <label class="d-flex title-color">{{\App\CPU\translate('password')}}</label>
                                    <input type="text" class="form-control" name="password"
                                           value="{{env('APP_MODE')!='demo'?$config['password']:''}}">
                                </div>


                                <div class="mt-3 d-flex flex-wrap justify-content-end gap-10">
                                    <button type="{{env('APP_MODE')!='demo'?'submit':'button'}}"
                                            onclick="{{env('APP_MODE')!='demo'?'':'call_demo()'}}"
                                            class="btn btn--primary px-4 text-uppercase">{{\App\CPU\translate('save')}}</button>
                                    @else
                                        <button type="submit"
                                                class="btn btn--primary px-4 text-uppercase">{{\App\CPU\translate('configure')}}</button>
                                    @endif
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


