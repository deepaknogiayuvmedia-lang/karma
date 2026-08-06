<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title>{{\App\CPU\translate('Admin | OTP Verification')}}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/vendor.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/vendor/icon-set/style.css">
    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/theme.minc619.css?v=1.0">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets/back-end')}}/css/toastr.css">

    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Open Sans', sans-serif;
        }

        .otp-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }

        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background: linear-gradient(135deg, rgba(63, 81, 181, 0.05) 0%, rgba(248, 250, 252, 0.9) 100%);
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: 1;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: rgba(63, 81, 181, 0.2);
            top: -100px;
            right: -50px;
        }

        .shape-2 {
            width: 400px;
            height: 400px;
            background: rgba(0, 188, 212, 0.15);
            bottom: -150px;
            left: -100px;
        }

        .card-otp {
            z-index: 2;
            width: 100%;
            max-width: 460px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-otp:hover {
            transform: translateY(-2px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.08);
        }

        .otp-inputs {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin: 2rem 0;
        }

        .otp-field {
            width: 50px;
            height: 56px;
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background-color: #ffffff;
            color: #1e293b;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            outline: none;
        }

        .otp-field:focus {
            border-color: #3f51b5;
            box-shadow: 0 0 0 4px rgba(63, 81, 181, 0.15);
            background-color: #ffffff;
        }

        .otp-field::-webkit-outer-spin-button,
        .otp-field::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        .otp-field[type=number] {
            -moz-appearance: textfield;
        }

        .btn-verify {
            background: linear-gradient(135deg, #3f51b5 0%, #5c6bc0 100%);
            border: none;
            border-radius: 12px;
            color: white;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(63, 81, 181, 0.2);
        }

        .btn-verify:hover {
            background: linear-gradient(135deg, #303f9f 0%, #3f51b5 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(63, 81, 181, 0.3);
        }

        .btn-verify:active {
            transform: translateY(0);
        }

        .resend-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 8px;
            margin-top: 1.5rem;
        }

        .timer-text {
            font-size: 14px;
            color: #64748b;
        }

        .timer-highlight {
            font-weight: 600;
            color: #3f51b5;
        }

        .btn-resend {
            background: none;
            border: none;
            color: #3f51b5;
            font-weight: 600;
            font-size: 14px;
            padding: 4px 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-resend:hover:not(:disabled) {
            background-color: rgba(63, 81, 181, 0.08);
            color: #303f9f;
        }

        .btn-resend:disabled {
            color: #94a3b8;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

<div class="otp-container">
    <div class="background-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
    </div>

    <!-- Card -->
    <div class="card card-otp">
        <div class="card-body p-4 p-sm-5">
            <div class="text-center mb-4">
                @php($e_commerce_logo = \App\Model\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                <img class="mb-4" height="40" src="{{asset(config('app.public_storage_path')."/company/".$e_commerce_logo)}}" alt="Logo"
                     onerror="this.src='{{asset('assets/back-end/img/400x400/img2.jpg')}}'">
                <h2 class="h3 font-weight-bold mb-1">{{\App\CPU\translate('Security Verification')}}</h2>
                <p class="text-muted mb-0">{{\App\CPU\translate('Please enter the 6-digit OTP code sent to your registered email address.')}}</p>
                @if(Session::has('admin_otp_verification'))
                    <span class="badge badge-soft-info mt-2 px-3 py-1" style="font-size: 13px;">
                        {{ substr(Session::get('admin_otp_verification')['email'], 0, 3) }}***{{ strstr(Session::get('admin_otp_verification')['email'], '@') }}
                    </span>
                @endif
            </div>

            <!-- Form -->
            <form action="{{route('admin.auth.otp-verification')}}" method="post" id="otp-form">
                @csrf

                <!-- OTP inputs -->
                <div class="otp-inputs">
                    <input type="number" class="otp-field" name="otp[]" min="0" max="9" maxlength="1" required autocomplete="off" autofocus>
                    <input type="number" class="otp-field" name="otp[]" min="0" max="9" maxlength="1" required autocomplete="off">
                    <input type="number" class="otp-field" name="otp[]" min="0" max="9" maxlength="1" required autocomplete="off">
                    <input type="number" class="otp-field" name="otp[]" min="0" max="9" maxlength="1" required autocomplete="off">
                    <input type="number" class="otp-field" name="otp[]" min="0" max="9" maxlength="1" required autocomplete="off">
                    <input type="number" class="otp-field" name="otp[]" min="0" max="9" maxlength="1" required autocomplete="off">
                </div>

                <button type="submit" class="btn btn-verify mb-3">
                    {{\App\CPU\translate('Verify & Sign In')}}
                </button>
            </form>
            <!-- End Form -->

            <div class="resend-container">
                <div class="timer-text" id="timer-box">
                    {{\App\CPU\translate('Resend code in')}} <span class="timer-highlight" id="timer-countdown">01:00</span>
                </div>
                <button type="button" class="btn btn-resend" id="resend-btn" disabled onclick="resendOtp()">
                    {{\App\CPU\translate('Resend OTP')}}
                </button>
            </div>
        </div>
    </div>
    <!-- End Card -->
</div>

<!-- JS Implementing Plugins -->
<script src="{{asset('assets/back-end')}}/js/vendor.min.js"></script>
<!-- JS Front -->
<script src="{{asset('assets/back-end')}}/js/theme.min.js"></script>
<script src="{{asset('assets/back-end')}}/js/toastr.js"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif

<script>
    // Shift focus between inputs
    const inputs = document.querySelectorAll('.otp-field');
    const form = document.getElementById('otp-form');

    inputs.forEach((input, index) => {
        // Handle input value change
        input.addEventListener('input', (e) => {
            const val = e.target.value;
            // Clear any characters beyond 1st digit
            if (val.length > 1) {
                e.target.value = val.slice(0, 1);
            }

            // Move to next input if filled
            if (e.target.value !== "" && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        // Handle backspace or delete key
        input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && e.target.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Handle pasting a 6 digit code
        input.addEventListener('paste', (e) => {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text');
            if (text.length === 6 && /^\d+$/.test(text)) {
                inputs.forEach((inp, idx) => {
                    inp.value = text[idx];
                });
                inputs[5].focus();
            }
        });
    });

    // Countdown Timer logic
    let duration = 60; // 60 seconds
    const timerCountdown = document.getElementById('timer-countdown');
    const timerBox = document.getElementById('timer-box');
    const resendBtn = document.getElementById('resend-btn');
    let timerInterval;

    function startTimer() {
        clearInterval(timerInterval);
        duration = 60;
        timerBox.style.display = 'block';
        resendBtn.disabled = true;

        timerInterval = setInterval(() => {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;

            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;

            timerCountdown.textContent = `${minutes}:${seconds}`;

            if (--duration < 0) {
                clearInterval(timerInterval);
                timerBox.style.display = 'none';
                resendBtn.disabled = false;
            }
        }, 1000);
    }

    startTimer();

    // Resend OTP via AJAX
    function resendOtp() {
        resendBtn.disabled = true;
        toastr.info("{{\App\CPU\translate('Requesting new OTP...')}}");

        $.ajax({
            url: "{{route('admin.auth.resend-otp')}}",
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    // Clear inputs
                    inputs.forEach(inp => inp.value = "");
                    inputs[0].focus();
                    // Restart timer
                    startTimer();
                } else {
                    toastr.error(response.message);
                    resendBtn.disabled = false;
                }
            },
            error: function(xhr, status, error) {
                toastr.error("{{\App\CPU\translate('Failed to resend OTP. Please try again.')}}");
                resendBtn.disabled = false;
            }
        });
    }
</script>

</body>
</html>
