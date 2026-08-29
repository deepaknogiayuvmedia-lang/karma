@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Payment Method'))

@push('css_or_js')
<style>
    .test-msg-card { border: 2px dashed #00d26a; }
    .test-msg-card .card-header { background: #00d26a; color: #fff; }
    #testResult { display: none; }
    #testResult.show { display: block; }
</style>
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

            <!-- Send Test Message Section -->
            <div class="col-md-12">
                <div class="card test-msg-card">
                    <div class="card-header">
                        <h5 class="mb-0 text-uppercase">
                            <i class="tio-success"></i> Send Test WhatsApp Message
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label class="d-flex title-color">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="testPhone"
                                    placeholder="Enter phone number (e.g. 9876543210)">
                                <small class="text-muted">10 digit number ya full number with country code</small>
                            </div>
                            <div class="form-group col-lg-4">
                                <label class="d-flex title-color">Select Template <span class="text-danger">*</span></label>
                                <select class="form-control" id="testTemplate">
                                    <option value="">-- Select Template --</option>
                                    <option value="hello_world" selected>hello_world</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-4 d-flex align-items-end">
                                <button type="button" class="btn btn-success px-4" id="sendTestBtn" onclick="sendTestMessage()">
                                    <i class="tio-send"></i> Send Test Message
                                </button>
                            </div>
                        </div>

                        <!-- Result Alert -->
                        <div id="testResult" class="mt-3">
                            <div id="testResultMsg" class="alert"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    function sendTestMessage() {
        var phone = $('#testPhone').val().trim();
        var templateName = $('#testTemplate').val();

        if (!phone) {
            alert('Please enter a phone number');
            return;
        }
        if (!templateName) {
            alert('Please select a template');
            return;
        }

        var btn = $('#sendTestBtn');
        btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');

        $.ajax({
            url: '{{ route("admin.business-settings.whatsapp.send-test") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                phone: phone,
                template_name: templateName
            },
            success: function(response) {
                $('#testResult').addClass('show');
                if (response.status == 1) {
                    $('#testResultMsg').removeClass('alert-danger').addClass('alert-success')
                        .html('<strong>Success!</strong> ' + response.message);
                } else {
                    $('#testResultMsg').removeClass('alert-success').addClass('alert-danger')
                        .html('<strong>Error!</strong> ' + response.message);
                }
                btn.prop('disabled', false).html('<i class="tio-send"></i> Send Test Message');
            },
            error: function(xhr) {
                $('#testResult').addClass('show');
                var msg = xhr.responseJSON ? xhr.responseJSON.message : 'Something went wrong';
                $('#testResultMsg').removeClass('alert-success').addClass('alert-danger')
                    .html('<strong>Error!</strong> ' + msg);
                btn.prop('disabled', false).html('<i class="tio-send"></i> Send Test Message');
            }
        });
    }
</script>
@endpush

