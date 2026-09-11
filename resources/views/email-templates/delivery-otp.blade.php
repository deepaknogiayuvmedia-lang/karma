<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Delivery OTP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
    body { font-family: 'Roboto', sans-serif; }
    body, table, td, a { -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; }
    table, td { mso-table-rspace: 0pt; mso-table-lspace: 0pt; }
    img { -ms-interpolation-mode: bicubic; }
    a[x-apple-data-detectors] { font-family: inherit !important; font-size: inherit !important; font-weight: inherit !important; line-height: inherit !important; color: inherit !important; text-decoration: none !important; }
    table { border-collapse: collapse !important; }
    img { height: auto; line-height: 100%; text-decoration: none; border: 0; outline: none; }
  </style>
</head>
<body style="background-color: #ececec; margin:0; padding:0;">
<?php
    use App\Model\BusinessSetting;
    $company_name = BusinessSetting::where('type', 'company_name')->first()->value ?? config('app.name');
    $company_phone = BusinessSetting::where('type', 'company_phone')->first()->value ?? '';
    $company_email = BusinessSetting::where('type', 'company_email')->first()->value ?? '';
    $company_web_logo = BusinessSetting::where('type', 'company_web_logo')->first()->value ?? '';
?>

<div style="width:650px; margin:auto; background-color:#ececec; height:50px;"></div>

<div style="width:650px; margin:auto; background-color:white; margin-top:40px; padding-top:40px; padding-bottom:40px; border-radius:3px;">

    {{-- Header --}}
    <table style="background-color:rgb(255,255,255); width:90%; margin:auto; height:72px; border-bottom:1px ridge;">
        <tbody>
            <tr>
                <td>
                    <h2 style="margin:0;">Your Delivery OTP</h2>
                    <h3 style="color:#0a3d62; margin:5px 0 0 0;">Order #{{ $order->id }}</h3>
                </td>
                <td>
                    <div style="text-align:right; margin-right:15px;">
                        <img style="max-width:250px; border:0;"
                            src="{{asset('/'.config('app.public_storage_path').'/company/'.$company_web_logo)}}"
                            title="" class="sitelogo" width="60%" alt=""/>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- Greeting --}}
    <table style="width:90%; margin:auto; margin-top:30px;">
        <tbody>
            <tr>
                <td style="padding:10px 0;">
                    <span style="font-size:16px; color:#414141;">
                        Hello {{ $order->billingAddress->contact_person_name ?? ($order->customer->f_name ?? 'Customer') }},
                    </span>
                </td>
            </tr>
            <tr>
                <td style="padding:10px 0;">
                    <span style="font-size:14px; color:#666; line-height:1.6;">
                        Your order <strong>#{{ $order->id }}</strong> is out for delivery.
                        Please share the following OTP with the delivery person to confirm your delivery:
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    {{-- OTP Box --}}
    <div style="width:80%; margin:30px auto; background-color:#f0f7ff; border:2px dashed #0a3d62; border-radius:10px; padding:30px; text-align:center;">
        <p style="margin:0 0 10px; color:#555; font-size:14px;">Your Delivery OTP</p>
        <div style="font-size:48px; font-weight:700; color:#0a3d62; letter-spacing:15px; padding:10px 0; font-family:monospace;">
            {{ $otp }}
        </div>
        <p style="margin:15px 0 0; color:#999; font-size:12px;">Valid for this delivery only</p>
    </div>

    {{-- Order Details --}}
    <table style="background-color:rgb(248,248,248); width:90%; margin:auto; margin-top:30px;">
        <div style="padding:20px;">
            <span style="color:#130505; text-transform:capitalize; font-weight:bold; font-size:14px;">Order Summary</span>
            <table style="width:100%; margin-top:10px;">
                <tbody>
                    <tr>
                        <td style="padding:8px 0; color:#414141; width:50%;">Order ID</td>
                        <td style="padding:8px 0; color:#414141; text-align:right; font-weight:bold;">#{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0; color:#414141;">Order Date</td>
                        <td style="padding:8px 0; color:#414141; text-align:right;">{{ $order->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0; color:#414141;">Payment Method</td>
                        <td style="padding:8px 0; color:#414141; text-align:right; text-transform:capitalize;">{{ str_replace('_', ' ', $order->payment_method) }}</td>
                    </tr>
                    <tr>
                        <td style="padding:8px 0; color:#414141;">Order Amount</td>
                        <td style="padding:8px 0; color:#0a3d62; text-align:right; font-weight:bold; font-size:16px;">
                            {{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->order_amount)) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </table>

    {{-- Delivery Address --}}
    @if($order->shippingAddress)
    <table style="background-color:rgb(255,255,255); width:90%; margin:auto; margin-top:20px;">
        <tbody>
            <tr>
                <td style="padding:10px 0;">
                    <span style="color:#130505; text-transform:capitalize; font-weight:bold; font-size:14px;">Delivery Address</span><br>
                    <span style="color:#666; font-size:13px; line-height:1.6;">
                        {{ $order->shippingAddress->contact_person_name ?? '' }}<br>
                        {{ $order->shippingAddress->address ?? '' }}<br>
                        {{ $order->shippingAddress->city ?? '' }}{{ $order->shippingAddress->state ? ', ' . $order->shippingAddress->state : '' }}<br>
                        {{ $order->shippingAddress->country ?? '' }} {{ $order->shippingAddress->zip ? '- ' . $order->shippingAddress->zip : '' }}
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
    @endif

    {{-- Warning --}}
    <table style="width:90%; margin:auto; margin-top:30px;">
        <tbody>
            <tr>
                <td style="background-color:#fff3cd; border:1px solid #ffc107; border-radius:4px; padding:15px;">
                    <span style="color:#856404; font-size:13px;">
                        <strong>Important:</strong> Do not share this OTP with anyone except the assigned delivery person.
                        If you did not request this delivery, please contact our support immediately.
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

</div>

{{-- Footer --}}
<div style="padding:5px; width:650px; margin:auto; margin-top:5px; margin-bottom:50px;">
    <table style="margin:auto; width:90%; color:#777777;">
        <tbody>
            <tr>
                <th style="text-align:left;">
                    <h1>{{ $company_name }}</h1>
                </th>
            </tr>
            <tr>
                <th style="text-align:left;">
                    <div>Phone: {{ $company_phone }}</div>
                    <div>Website: {{ url('/') }}</div>
                    <div>Email: {{ $company_email }}</div>
                </th>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
