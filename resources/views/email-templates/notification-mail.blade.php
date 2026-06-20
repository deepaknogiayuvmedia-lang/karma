    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        @media screen {
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 400;
                src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'),
                     url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
            }
            @font-face {
                font-family: 'Source Sans Pro';
                font-style: normal;
                font-weight: 700;
                src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'),
                     url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
            }
        }
        body, table, td, a {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }
        table, td { mso-table-rspace: 0pt; mso-table-lspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }
        div[style*="margin: 16px 0;"] { margin: 0 !important; }
        body { width: 100% !important; height: 100% !important; padding: 0 !important; margin: 0 !important; }
        table { border-collapse: collapse !important; }
        a { color: #1a82e2; }
        img { height: auto; line-height: 100%; text-decoration: none; border: 0; outline: none; }
    </style>
</head>
<body style="background-color: #f0f4f8; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;">

<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" style="padding: 36px 24px;">

            <!-- Email wrapper -->
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">

                <!-- Header -->
                @php
                    $bgColor = '#4f46e5'; // Default info
                    if ($notificationType === 'danger') $bgColor = '#ef4444';
                    elseif ($notificationType === 'warning') $bgColor = '#f59e0b';
                @endphp
                <tr>
                    <td align="center" bgcolor="{{ $bgColor }}" style="border-radius: 12px 12px 0 0; padding: 36px 24px;">
                        <h1 style="margin: 0; font-size: 28px; font-weight: 700; color: #ffffff; letter-spacing: -0.5px;">
                            @if($notificationType === 'danger') 🚨 @elseif($notificationType === 'warning') ⚠️ @else 🔔 @endif {{ $title }}
                        </h1>
                    </td>
                </tr>

                <!-- Body -->
                <tr>
                    <td bgcolor="#ffffff" style="padding: 36px 48px; border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0;">

                        @if (!empty($userName))
                            <p style="margin: 0 0 16px; font-size: 16px; color: #374151;">
                                Hi <strong>{{ $userName }}</strong>,
                            </p>
                        @endif

                        <p style="margin: 0 0 24px; font-size: 16px; line-height: 1.7; color: #4b5563;">
                            {{ $body }}
                        </p>

                        <!-- CTA Button -->
                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center" style="padding: 12px 0 24px;">
                                    <a href="{{ url('/') }}"
                                       style="display: inline-block; padding: 14px 36px; background-color: #4f46e5;
                                              color: #ffffff; font-size: 16px; font-weight: 700; text-decoration: none;
                                              border-radius: 8px; letter-spacing: 0.5px;">
                                        Visit Our Store →
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin: 0; font-size: 14px; color: #9ca3af;">
                            If you have any questions, feel free to reply to this email.
                        </p>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td bgcolor="#f8fafc" style="border-radius: 0 0 12px 12px; border: 1px solid #e2e8f0;
                                                  border-top: none; padding: 24px 48px; text-align: center;">
                        <p style="margin: 0; font-size: 13px; color: #9ca3af;">
                            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                        </p>
                        <p style="margin: 8px 0 0; font-size: 12px; color: #d1d5db;">
                            You are receiving this email because you are a registered user.
                        </p>
                    </td>
                </tr>

            </table>
            <!-- /Email wrapper -->

        </td>
    </tr>
</table>

</body>
</html>

