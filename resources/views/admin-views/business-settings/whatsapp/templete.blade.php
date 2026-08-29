@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Payment Method'))

@push('css_or_js')
    <style>
        .whatsapp-bubble-container {
            padding: 8px !important;
            background-color: #f0f2f5 !important;
        }
        .whatsapp-bubble {
            background-color: #ffffff;
            border-radius: 0 8px 8px 8px;
            padding: 6px 10px;
            position: relative;
            box-shadow: 0 1px 0.5px rgba(0,0,0,0.13);
            margin-bottom: 2px;
            border: 0;
            max-width: 100%;
        }
        .whatsapp-bubble::before {
            content: "";
            position: absolute;
            left: -8px;
            top: 0;
            width: 0;
            height: 0;
            border-top: 0px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 8px solid #ffffff;
        }
        .whatsapp-header-img {
            width: 100%;
            border-radius: 6px;
            margin-bottom: 6px;
            /* max-height: 120px; */
            object-fit: cover;
        }
        .whatsapp-header-text {
            font-weight: bold;
            font-size: 13px;
            margin-bottom: 4px;
            color: #111b21;
        }
        .whatsapp-body {
            font-size: 13px;
            color: #111b21;
            white-space: pre-wrap;
            line-height: 1.4;
        }
        .whatsapp-footer {
            font-size: 11px;
            color: #667781;
            margin-top: 4px;
        }
        .whatsapp-button {
            display: block;
            width: 100%;
            padding: 6px;
            text-align: center;
            color: #008069;
            background: #fff;
            border-top: 1px solid #f0f2f5;
            border-radius: 0;
            font-size: 12.5px;
            font-weight: 500;
            text-decoration: none;
            margin-top: 0;
        }
        .whatsapp-button:first-of-type {
            margin-top: 2px;
            border-top: 0;
            border-radius: 4px 4px 0 0;
        }
        .whatsapp-button:last-of-type {
            border-radius: 0 0 4px 4px;
        }
        .whatsapp-button:hover {
            background: #f8f9fa;
        }
        .wa-var {
            color: #008069;
            background: #e7f3f0;
            padding: 0 2px;
            border-radius: 3px;
            font-family: monospace;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            display: inline-block;
        }
        .wa-var:hover {
            background: #008069;
            color: #fff;
        }
        .wa-var::after {
            content: attr(data-example);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: #fff;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: 0.2s;
            z-index: 10;
            font-family: sans-serif;
        }
        .wa-var:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: calc(100% + 5px);
        }
        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-warning {
            background-color: #ffb100;
        }
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
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-capitalize">{{ \App\CPU\translate('WhatsApp Template Mapping') }}</h5>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ route('admin.business-settings.whatsapp.sync-templates') }}"
                                class="btn btn-info btn-sm" id="syncBtn" onclick="showSyncLoader()">
                                <i class="tio-sync" id="syncIcon"></i> <span id="syncText">{{ \App\CPU\translate('sync_from_api') }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-soft-warning border-warning border mb-0 p-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <i class="tio-info-outined text-warning"></i>
                                <h6 class="mb-0 text-warning">{{ \App\CPU\translate('Important Configuration Note') }}</h6>
                            </div>
                            <p class="mb-2 text-dark">
                                {{ \App\CPU\translate('To ensure successful message delivery, your template names in') }} <strong>Meta Business Suite</strong> {{ \App\CPU\translate('must match the system identifiers below:') }}
                            </p>
                            <div class="row g-2">
                                <div class="col-sm-3">
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <div class="dot dot-warning"></div>
                                        <span>Order Confirmation: <strong>order_confirmation_2</strong></span>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-3">
                                  <div class="d-flex align-items-center gap-2 text-muted small">
                                        <div class="dot dot-warning"></div>
                                        <span>Processing/Packaging: <strong>packaging_order</strong></span>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-3">
                                    <div class="d-flex align-items-center gap-2 text-muted small">
                                        <div class="dot dot-warning"></div>
                                        <span>Returns/Recovery: <strong>order_recovery</strong></span>
                                    </div>
                                   
                                </div>
                                <div class="col-sm-3">
                                     <div class="d-flex align-items-center gap-2 text-muted small">
                                        <div class="dot dot-warning"></div>
                                        <span>Order Cancellation: <strong>order_cancelled</strong></span>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mt-3">
                    <div class="row gy-3 justify-content-center">
                        @foreach ($templetes as $key => $templete)
                            @php
                                $statusType = $templete['status_type'] ?? [];
                            @endphp
                            <div class="col-sm-6 col-xxl-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <div
                                        class="card-header bg-white border-bottom-0 d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-truncate " style="max-width: 70%;"
                                            title="{{ $templete['name'] }}"><span class="fw-bold">Template:</span> {{ $templete['name'] }}</h6>
                                        @if(!empty($statusType))
                                            <div class="d-flex flex-wrap gap-1 justify-content-end">
                                                @foreach($statusType as $st)
                                                    <span class="badge badge-success">{{ $st }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body py-3">
                                      
                                        <div class="whatsapp-bubble-container bg-light p-3 rounded">
                                            @php
                                            // dd($templete);
                                                $components = $templete['components'];
                                                $header = null;
                                                $body = null;
                                                $footer = null;
                                                $buttons = [];
                                                if ($components && is_array($components)) {
                                                    foreach ($components as $component) {
                                                        if ($component['type'] == 'HEADER') $header = $component;
                                                        if ($component['type'] == 'BODY') $body = $component;
                                                        if ($component['type'] == 'FOOTER') $footer = $component;
                                                        if ($component['type'] == 'BUTTONS') $buttons = $component['buttons'] ?? [];
                                                    }
                                                }

                                                $bodyText = trim($body['text'] ?? '');
                                                // Replace multiple newlines with single for compactness if needed, or just let it be. 
                                                // User asked to remove extra space, often means trimming and condensing.
                                                $bodyText = preg_replace("/\n\s*\n/", "\n", $bodyText);

                                                // Wrap placeholders in spans to show variables by default and examples on hover
                                                if (isset($body['example']['body_text'][0]) && is_array($body['example']['body_text'][0])) {
                                                    foreach ($body['example']['body_text'][0] as $index => $example) {
                                                        $placeholder = '{{' . ($index + 1) . '}}';
                                                        $replacement = '<span class="wa-var" data-example="' . htmlspecialchars($example) . '">' . $placeholder . '</span>';
                                                        $bodyText = str_replace($placeholder, $replacement, $bodyText);
                                                    }
                                                }
                                                // Handle NAMED params
                                                if (isset($body['example']['body_text_named_params'])) {
                                                    foreach ($body['example']['body_text_named_params'] as $param) {
                                                        $placeholder = '{{' . $param['param_name'] . '}}';
                                                        $replacement = '<span class="wa-var" data-example="' . htmlspecialchars($param['example']) . '">' . $placeholder . '</span>';
                                                        $bodyText = str_replace($placeholder, $replacement, $bodyText);
                                                    }
                                                }

                                                $headerText = trim($header['text'] ?? '');
                                                if (isset($header['example']['header_text'][0])) {
                                                   $headerText = str_replace('{{1}}', '<span class="wa-var" data-example="' . htmlspecialchars($header['example']['header_text'][0]) . '">{{1}}</span>', $headerText);
                                                }
                                            @endphp

                                            <div class="whatsapp-bubble">
                                                @if($header)
                                                    @if($header['format'] == 'IMAGE')
                                                        <img src="{{ $header['example']['header_handle'][0] ?? asset('assets/back-end/img/image-place-holder.png') }}" class="whatsapp-header-img">
                                                    @elseif($header['format'] == 'TEXT')
                                                        <div class="whatsapp-header-text">{!! $headerText !!}</div>
                                                    @endif
                                                @endif

                                                <div class="whatsapp-body">{!! nl2br($bodyText) !!}</div>

                                                @if($footer)
                                                    <div class="whatsapp-footer">{{ trim($footer['text']) }}</div>
                                                @endif
                                            </div>

                                            @if(!empty($buttons))
                                                @foreach($buttons as $button)
                                                    <div class="whatsapp-button">
                                                        <i class="tio-{{ $button['type'] == 'PHONE_NUMBER' ? 'call' : 'link' }}"></i>
                                                        {{ $button['text'] }}
                                                    </div>
                                                @endforeach
                                            @endif

                                            @if(!$body)
                                                <div class="text-center text-muted italic small py-4">
                                                    {{ \App\CPU\translate('no_preview_available') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (count($templetes) == 0)
                        <div class="text-center p-4 card shadow-sm border-0">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end/svg/illustrations/sorry.svg') }}"
                                alt="Image Description">
                            <p class="mb-0">{{ \App\CPU\translate('no_template_found') }}</p>
                        </div>
                    @endif  
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script>
        function showSyncLoader() {
            var btn = document.getElementById('syncBtn');
            var icon = document.getElementById('syncIcon');
            var text = document.getElementById('syncText');

            btn.classList.add('disabled');
            btn.style.pointerEvents = 'none';
            icon.classList.remove('tio-sync');
            icon.classList.add('fas', 'fa-spinner', 'fa-spin');
            text.innerText = 'Syncing...';
        }
    </script>
@endpush

