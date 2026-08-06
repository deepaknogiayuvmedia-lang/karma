<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ \App\CPU\translate('Email Verification') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style type="text/css">
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table {
            border-collapse: collapse !important;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .header {
            background-color: #3f51b5; /* Default primary color */
            padding: 40px 20px;
            text-align: center;
            color: #ffffff;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 1px;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
            color: #333333;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .otp-box {
            background-color: #f8f9fa;
            border-radius: 12px;
            padding: 24px;
            display: inline-block;
            margin-bottom: 30px;
            border: 2px dashed #3f51b5;
        }
        .otp-code {
            font-size: 36px;
            font-weight: 700;
            color: #3f51b5;
            letter-spacing: 10px;
            margin: 0;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #888888;
        }
        .footer a {
            color: #3f51b5;
            text-decoration: none;
        }
        @media screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div style="padding: 40px 0;">
        <div class="container">
            <div class="header">
                @php($logo = \App\CPU\Helpers::get_business_settings('company_web_logo'))
                @if($logo)
                    <img src="{{ asset(config('app.public_storage_path').'/company/'.$logo) }}" alt="Logo" style="max-height: 50px; margin-bottom: 20px;">
                @endif
                <h1>{{ \App\CPU\translate('Verify Your Email') }}</h1>
            </div>
            <div class="content">
                <p>{{ \App\CPU\translate('Hello') }},</p>
                <p>{{ \App\CPU\translate('Please use the following One-Time Password (OTP) to complete your email verification process. This code is valid for a limited time.') }}</p>
                
                <div class="otp-box" style="background-color: #f8f9fa; border-radius: 12px; padding: 24px; display: inline-block; margin-bottom: 30px; border: 2px dashed #3f51b5;">
                    <h2 class="otp-code" style="font-size: 36px; font-weight: 700; color: #3f51b5; letter-spacing: 10px; margin: 0;">{{ $token }}</h2>
                </div>

                <p style="margin-top:20px; font-size: 14px; color: #666;">
                    {{ \App\CPU\translate('If you did not request this verification, please ignore this email or contact support if you have concerns.') }}
                </p>
            </div>
            <div class="footer">
                @php($company_name = \App\CPU\Helpers::get_business_settings('company_name'))
                <p>&copy; {{ date('Y') }} {{ $company_name }}. {{ \App\CPU\translate('All rights reserved.') }}</p>
                <p>
                    <a href="{{ url('/') }}" style="color: #3182ce; text-decoration: none;">{{ \App\CPU\translate('Visit our Website') }}</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>

