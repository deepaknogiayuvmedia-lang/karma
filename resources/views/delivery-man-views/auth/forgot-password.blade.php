<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{\App\CPU\translate('forgot_password')}}</title>
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/vendor/icon-set/style.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/toastr.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/style.css">
</head>
<body>
<main id="content" role="main" class="main">
    <div class="position-fixed top-0 right-0 left-0 bg-img-hero __h-32rem"
         style="background-image: url({{asset('assets/admin')}}/svg/components/abstract-bg-4.svg);">
        <figure class="position-absolute right-0 bottom-0 left-0">
            <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
                <polygon fill="#fff" points="0,273 1921,273 1921,0 "/>
            </svg>
        </figure>
    </div>

    <div class="container py-5 py-sm-7">
        @php($e_commerce_logo=\App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
        <a class="d-flex justify-content-center mb-5" href="javascript:">
            <img class="z-index-2" height="40" src="{{asset(config('app.public_storage_path')."/company/".$e_commerce_logo)}}" alt="Logo"
                 onerror="this.src='{{asset('assets/back-end/img/400x400/img2.jpg')}}'">
        </a>

        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="card card-lg mb-5">
                    <div class="card-body">
                        <form action="{{route('delivery-man.forgot-password.submit')}}" method="post">
                            @csrf
                            <div class="text-center">
                                <div class="mb-5">
                                    <h1 class="display-4">{{\App\CPU\translate('forgot_password')}}</h1>
                                    <center><h1 class="h4 text-gray-900 mb-4">{{\App\CPU\translate('enter_your_phone_to_request_password_reset')}}</h1></center>
                                </div>
                            </div>

                            <div class="alert alert-info">
                                <i class="tio-info-circle"></i>
                                {{\App\CPU\translate('Your seller/admin will be notified and will reset your password.')}}
                            </div>

                            <div class="js-form-message form-group">
                                <label class="input-label" for="phone">{{\App\CPU\translate('your_phone')}}</label>
                                <input type="text" class="form-control form-control-lg" name="phone" id="phone"
                                       placeholder="Enter phone number" required>
                            </div>

                            <button type="submit" class="btn btn-lg btn-block btn--primary">{{\App\CPU\translate('send_reset_request')}}</button>

                            <div class="text-center mt-3">
                                <a href="{{route('delivery-man.auth.login')}}">{{\App\CPU\translate('back_to_login')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>
<script src="{{asset('assets/back-end')}}/js/theme.min.js"></script>
<script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', 'Error', {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
</body>
</html>
