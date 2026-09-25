@extends('layouts.front-end.app')

@section('title',auth('customer')->user()->f_name.' '.auth('customer')->user()->l_name)

@push('css_or_js')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        /* ===== Premium Profile Info Card ===== */
        .profile-info-card {
            border: 1px solid #E5E9F0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(17, 24, 39, .06);
            background: #FFFFFF;
            max-width: 1100px;
            margin: 0 auto;
        }
        .profile-info-card .card-header {
            background: #FFFFFF;
            border-bottom: 1px solid #EEF1F6;
            padding: 0;
        }
        .profile-info-card form {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            margin: 0;
            padding: 0;
        }
        .profile-info-card .profile-header {
            display: flex;
            align-items: center;
            gap: 18px;
            padding: 24px 28px 20px;
            border-bottom: 1px solid #EEF1F6;
            background: #FAFBFC;
        }
        .profile-info-card .profile-avatar-wrap {
            position: relative;
            flex-shrink: 0;
        }
        .profile-info-card .profile-avatar {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #FFFFFF;
            box-shadow: 0 2px 10px rgba(17, 24, 39, .10);
            display: block;
        }
        .profile-info-card .profile-meta h5 {
            font-size: 1.05rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 4px;
            letter-spacing: -.01em;
        }
        .profile-info-card .profile-meta label.spandHeadO {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13.5px;
            font-weight: 500;
            color: {{$web_config['primary_color']}} !important;
            cursor: pointer;
            margin: 0;
        }
        .profile-info-card .profile-meta label.spandHeadO:hover {
            text-decoration: underline;
        }
        .profile-info-card .profile-meta .img-hint {
            font-size: 12px;
            color: #9CA3AF;
            margin-top: 3px;
            display: block;
        }
        .profile-info-card .card-body {
            padding: 28px;
        }
        .profile-info-card .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #111827;
            margin: 0 0 20px;
            letter-spacing: -.01em;
        }
        .profile-info-card .section-title i {
            color: {{$web_config['primary_color']}};
            margin-right: 8px;
            font-size: .95rem;
        }

        /* Grid */
        .profile-info-card .form-row {
            margin-left: -12px;
            margin-right: -12px;
        }
        .profile-info-card .form-row .form-group {
            padding-left: 12px;
            padding-right: 12px;
            margin-bottom: 20px;
        }

        /* Labels */
        .profile-info-card .form-group > label {
            display: block;
            font-size: 13.5px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 7px;
            line-height: 1.4;
            letter-spacing: -.01em;
        }
        .profile-info-card .form-group label small,
        .profile-info-card .form-group .field-hint {
            display: block;
            font-size: 12px;
            font-weight: 400;
            color: #6B7280;
            margin-top: 4px;
        }

        /* Inputs */
        .profile-info-card .form-control {
            display: block;
            width: 100%;
            height: 50px;
            padding: 0 16px;
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
        .profile-info-card .form-control::placeholder {
            color: #9CA3AF;
        }
        .profile-info-card .form-control:hover:not(:disabled) {
            border-color: #B8C0CC;
        }
        .profile-info-card .form-control:focus,
        .profile-info-card .form-control:focus-visible {
            outline: none;
            border-color: {{$web_config['primary_color']}};
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .08);
            background-color: #FFFFFF;
        }
        .profile-info-card .form-control:disabled,
        .profile-info-card .form-control[readonly] {
            background-color: #F9FAFB;
            color: #6B7280;
            cursor: not-allowed;
        }

        /* Password toggle */
        .profile-info-card .password-toggle {
            position: relative;
        }
        .profile-info-card .password-toggle .form-control {
            padding-right: 48px;
        }
        .profile-info-card .password-toggle-btn {
            position: absolute;
            right: 0;
            top: 50%;
            bottom: 0;
            width: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            cursor: pointer;
            z-index: 4;
            color: #9CA3AF;
            transition: color 150ms ease;
        }
        .profile-info-card .password-toggle-btn:hover {
            color: #374151;
        }
        .profile-info-card .password-toggle-btn .password-toggle-indicator {
            font-size: 17px;
            line-height: 1;
        }
        .profile-info-card #message {
            font-size: 13px;
            margin-top: 6px;
            min-height: 0;
        }

        /* Actions */
        .profile-info-card .profile-btns {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 12px;
            padding-top: 24px;
            margin-top: 4px;
            border-top: 1px solid #EEF1F6;
        }
        .profile-info-card .profile-btns .btn {
            height: 48px;
            border-radius: 11px;
            padding: 0 28px;
            font-size: 14.5px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: background 150ms ease, border-color 150ms ease, box-shadow 150ms ease, color 150ms ease;
            letter-spacing: -.01em;
            font-family: 'Inter', sans-serif;
        }
        .profile-info-card .profile-btns .btn:focus-visible {
            outline: none;
            box-shadow: 0 0 0 3px rgba(17, 24, 39, .15);
        }
        .profile-info-card .profile-btns .btn--primary {
            background: {{$web_config['primary_color']}};
            border: 1px solid {{$web_config['primary_color']}};
            color: #FFFFFF;
        }
        .profile-info-card .profile-btns .btn--primary:hover {
            filter: brightness(.94);
            color: #FFFFFF;
        }

        @media (max-width: 991.98px) {
            .profile-info-card .card-body { padding: 24px 20px; }
            .profile-info-card .profile-header { padding: 20px; }
        }
        @media (max-width: 767.98px) {
            .profile-info-card { border-radius: 14px; max-width: 100%; }
            .profile-info-card .card-body { padding: 20px 16px; }
            .profile-info-card .profile-header {
                flex-direction: column;
                align-items: flex-start;
                padding: 18px 16px;
                gap: 12px;
            }
            .profile-info-card .form-row .form-group {
                padding-left: 0;
                padding-right: 0;
                margin-bottom: 18px;
            }
            .profile-info-card .form-row .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
                width: 100%;
            }
            .profile-info-card .profile-btns {
                flex-direction: column-reverse;
                gap: 10px;
            }
            .profile-info-card .profile-btns .btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <!-- Page Title-->
    <div class="container rtl pb-5">
        <h3 class="py-3 m-0 text-center headerTitle">{{\App\CPU\translate('profile_Info')}}</h3>
    </div>
    <!-- Page Content-->
    <div class="container pb-5 mb-2 mb-md-4 rtl">
        <div class="row">
            <!-- Sidebar-->
        @include('web-views.partials._profile-aside')
        <!-- Content  -->
            <section class="col-lg-9 col-md-9 __customer-profile">
                <div class="card box-shadow-sm profile-info-card">
                    <div class="card-header">
                        <form class="px-sm-0 pb-0" action="{{route('user-update')}}" method="post"
                              enctype="multipart/form-data">
                            <div class="photoHeader g-0">
                                @csrf
                                <div class="profile-header">
                                    <div class="profile-avatar-wrap">
                                        <img id="blah"
                                            class="profile-avatar"
                                            onerror="this.src='{{asset('assets/front-end/img/image-place-holder.png')}}'"
                                            src="{{asset(config('app.public_storage_path').'/profile')}}/{{$customerDetail['image']}}">
                                    </div>
                                    <div class="profile-meta">
                                        <h5>{{$customerDetail->f_name. ' '.$customerDetail->l_name}}</h5>
                                        <label for="files" class="spandHeadO m-0">
                                            <i class="fa fa-camera"></i>
                                            {{\App\CPU\translate('change_your_profile')}}
                                        </label>
                                        <span class="img-hint">* {{\App\CPU\translate('Image ratio should be 1:1')}}</span>
                                        <input id="files" name="image" hidden type="file">
                                    </div>
                                </div>


                                <div class="card-body">
                                    <h3 class="section-title"><i class="fa fa-user-circle"></i>{{\App\CPU\translate('account_information')}} </h3>


                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <label for="f_name">{{\App\CPU\translate('first_name')}} </label>
                                            <input type="text" class="form-control" id="f_name" name="f_name"
                                                   value="{{$customerDetail['f_name']}}" placeholder="{{\App\CPU\translate('first_name')}}" required>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <label for="l_name"> {{\App\CPU\translate('last_name')}} </label>
                                            <input type="text" class="form-control" id="l_name" name="l_name"
                                                   value="{{$customerDetail['l_name']}}" placeholder="{{\App\CPU\translate('last_name')}}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <label for="account-email">{{\App\CPU\translate('Email')}} </label>
                                            <input type="email" class="form-control" id="account-email"
                                                   value="{{$customerDetail['email']}}" disabled>
                                        </div>
                                        <div class="form-group col-md-6 mb-0">
                                            <label for="phone">{{\App\CPU\translate('phone_number')}} </label>
                                           
                                            <input type="number" class="form-control" id="phone"
                                                   name="phone"
                                                   value="{{$customerDetail['phone']}}" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 mb-0">
                                            <label for="password">{{\App\CPU\translate('new_password')}}</label>
                                            <div class="password-toggle">
                                                <input class="form-control" name="password" type="password"
                                                       id="password"
                                                >
                                                <label class="password-toggle-btn">
                                                    <input class="custom-control-input" type="checkbox"
                                                           style="display: none">
                                                    <i class="czi-eye password-toggle-indicator"
                                                       onChange="checkPasswordMatch()"></i>
                                                    <span
                                                        class="sr-only">{{\App\CPU\translate('Show')}} {{\App\CPU\translate('password')}} </span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-0">
                                            <label for="confirm_password">{{\App\CPU\translate('confirm_password')}} </label>
                                            <div class="password-toggle">
                                                <input class="form-control" name="confirm_password" type="password"
                                                       id="confirm_password">
                                                <label class="password-toggle-btn">
                                                    <input class="custom-control-input" type="checkbox"
                                                           style="display: none">
                                                    <i class="czi-eye password-toggle-indicator"
                                                       onChange="checkPasswordMatch()"></i><span
                                                        class="sr-only">{{\App\CPU\translate('Show')}} {{\App\CPU\translate('password')}} </span>
                                                </label>
                                            </div>
                                            <div id='message'></div>
                                        </div>
                                        <div class="col-12 profile-btns __profile-btns">
                                             {{-- <a class="btn btn-danger"
                                                 href="javascript:"
                                                 onclick="route_alert('{{ route('account-delete',[$customerDetail['id']]) }}','{{\App\CPU\translate('want_to_delete_this_account?')}}')">
                                                 {{\App\CPU\translate('delete_account')}}
                                             </a> --}}
                                             <button type="submit" class="btn btn--primary">{{\App\CPU\translate('update')}}   </button>
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('assets/front-end')}}/vendor/nouislider/distribute/nouislider.min.js"></script>
    <script src="{{asset('assets/back-end/js/croppie.js')}}"></script>
    <script>
        function checkPasswordMatch() {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            $("#message").removeAttr("style");
            $("#message").html("");
            if (confirmPassword == "") {
                $("#message").attr("style", "color:black");
                $("#message").html("{{\App\CPU\translate('Please ReType Password')}}");

            } else if (password == "") {
                $("#message").removeAttr("style");
                $("#message").html("");

            } else if (password != confirmPassword) {
                $("#message").html("{{\App\CPU\translate('Passwords do not match')}}!");
                $("#message").attr("style", "color:red");
            } else if (confirmPassword.length <= 6) {
                $("#message").html("{{\App\CPU\translate('password Must Be 6 Character')}}");
                $("#message").attr("style", "color:red");
            } else {

                $("#message").html("{{\App\CPU\translate('Passwords match')}}.");
                $("#message").attr("style", "color:green");
            }

        }

        $(document).ready(function () {
            $("#confirm_password").keyup(checkPasswordMatch);

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#files").change(function () {
            readURL(this);
        });

    </script>
    <script>
        function form_alert(id, message) {
            Swal.fire({
                title: '{{\App\CPU\translate('Are you sure')}}?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#' + id).submit()
                }
            })
        }
    </script>
@endpush

