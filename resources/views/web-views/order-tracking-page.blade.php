@extends('layouts.front-end.app')

@section('title',\App\CPU\translate('Track Order Result'))

@push('css_or_js')
    <meta property="og:image" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']->value}}"/>
    <meta property="og:title" content="{{$web_config['name']->value}} "/>
    <meta property="og:url" content="{{env('APP_URL')}}">
    <meta property="og:description" content="{!! substr($web_config['about']->value,0,100) !!}">

    <meta property="twitter:card" content="{{asset(env('PUBLIC_STORAGE_PATH').'/company')}}/{{$web_config['web_logo']}}"/>
    <meta property="twitter:title" content="{{$web_config['name']->value}}"/>
    <meta property="twitter:url" content="{{env('APP_URL')}}">
    <meta property="twitter:description" content="{!! substr($web_config['about']->value,0,100) !!}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .closet{
            float: {{Session::get('direction') === "rtl" ? 'left' : 'right'}};
        }

        /* ===== Premium Track Order ===== */
        .track-order-wrap {
            max-width: 520px;
            margin: 0 auto;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        .track-order-wrap .track-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            text-align: center;
            text-transform: capitalize;
            letter-spacing: -.02em;
            margin: 0 0 24px;
        }
        .track-order-card {
            border: 1px solid #E5E9F0;
            border-radius: 16px;
            background: #FFFFFF;
            box-shadow: 0 4px 24px rgba(17, 24, 39, .06);
            overflow: hidden;
        }
        .track-order-card .card-body {
            padding: 28px;
        }
        .track-order-card form {
            margin: 0;
            padding: 0;
        }

        /* Alert */
        .track-order-card .alert {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border: 1px solid #FECACA;
            background: #FEF2F2;
            color: #B91C1C;
            border-radius: 11px;
            padding: 12px 14px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .track-order-card .alert .closet {
            position: static;
            float: none;
            font-size: 18px;
            line-height: 1;
            color: #B91C1C;
            opacity: .7;
            cursor: pointer;
            margin-left: auto;
        }
        .track-order-card .alert .closet:hover {
            opacity: 1;
        }

        /* Fields */
        .track-order-card .form-group {
            margin-bottom: 18px;
        }
        .track-order-card .field-label {
            display: block;
            font-size: 13.5px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 7px;
            letter-spacing: -.01em;
        }
        .track-order-card .input-icon-wrap {
            position: relative;
        }
        .track-order-card .input-icon-wrap > i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: #9CA3AF;
            z-index: 3;
            pointer-events: none;
            transition: color 180ms ease;
        }
        .track-order-card .input-icon-wrap:focus-within > i {
            color: {{$web_config['primary_color']}};
        }
        .track-order-card .form-control {
            display: block;
            width: 100%;
            height: 50px;
            padding: 0 16px 0 42px;
            font-size: 14.5px;
            font-weight: 400;
            line-height: 1.5;
            color: #1F2937;
            background-color: #FFFFFF;
            border: 1px solid #D9DEE7;
            border-radius: 11px;
            box-shadow: none;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            transition: border-color 180ms ease, box-shadow 180ms ease;
            -webkit-appearance: none;
            appearance: none;
        }
        .track-order-card .form-control::placeholder {
            color: #9CA3AF;
        }
        .track-order-card .form-control:hover {
            border-color: #B8C0CC;
        }
        .track-order-card .form-control:focus,
        .track-order-card .form-control:focus-visible {
            outline: none;
            border-color: {{$web_config['primary_color']}};
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .08);
            background-color: #FFFFFF;
        }

        /* Button */
        .track-order-card .track-actions {
            display: flex;
            justify-content: flex-end;
            padding-top: 8px;
        }
        .track-order-card .btn-track {
            height: 48px;
            min-width: 160px;
            border-radius: 11px;
            padding: 0 28px;
            font-size: 14.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: {{$web_config['primary_color']}};
            border: 1px solid {{$web_config['primary_color']}};
            color: #FFFFFF;
            font-family: 'Inter', sans-serif;
            letter-spacing: -.01em;
            transition: filter 150ms ease, box-shadow 150ms ease;
        }
        .track-order-card .btn-track:hover {
            filter: brightness(.94);
            color: #FFFFFF;
        }
        .track-order-card .btn-track:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .15);
        }

        @media (max-width: 575.98px) {
            .track-order-card .card-body { padding: 20px 16px; }
            .track-order-card .track-actions { justify-content: stretch; }
            .track-order-card .btn-track { width: 100%; }
            .track-order-wrap .track-title { font-size: 1.3rem; }
        }
    </style>
@endpush

@section('content')
    <!-- Page Content-->
    <div class="container rtl py-5" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
        <div class="track-order-wrap">
            <h3 class="track-title">{{\App\CPU\translate('track_order')}}</h3>
            <div class="track-order-card">
                <div class="card-body">
                    <form action="{{route('track-order.result')}}" type="submit" method="post">
                        @csrf

                        @if(session()->has('Error'))
                            <div class="alert alert-danger alert-block">
                                <i class="fa fa-exclamation-circle mt-1"></i>
                                <strong>{{ session()->get('Error') }}</strong>
                                <span type="" class="closet __closet" data-dismiss="alert">×</span>
                            </div>
                        @endif

                        <div class="form-group mb-0">
                            <label class="field-label" for="order_id">{{\App\CPU\translate(' Traking Id ')}}</label>
                            <div class="input-icon-wrap">
                                <i class="fa fa-hashtag"></i>
                                <input class="form-control" type="text" id="order_id" name="order_id"
                                    placeholder="{{\App\CPU\translate(' Traking Id ')}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="field-label" for="phone_number">{{\App\CPU\translate('your_phone_number')}}</label>
                            <div class="input-icon-wrap">
                                <i class="fa fa-phone"></i>
                                <input class="form-control" type="text" id="phone_number" name="phone_number"
                                    placeholder="{{\App\CPU\translate('your_phone_number')}}" required>
                            </div>
                        </div>
                        <div class="track-actions">
                            <button class="btn btn-track" type="submit" name="trackOrder">
                                <i class="fa fa-search"></i>
                                {{\App\CPU\translate('track_order')}}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    <script src="{{asset('assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.js">
    </script>
@endpush

