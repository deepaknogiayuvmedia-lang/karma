<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Delivery OTP</title>
</head>
<body style="font-family: 'Open Sans', Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 0;">
    <div style="max-width: 500px; margin: 30px auto; background: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

        <!-- Header -->
        <div style="background: #0a3d62; padding: 25px 30px; text-align: center;">
            <h1 style="color: #ffffff; margin: 0; font-size: 22px;">{{ $companyName }}</h1>
        </div>

        <!-- Body -->
        <div style="padding: 30px;">
            <h2 style="color: #333; text-align: center; margin-bottom: 5px;">Your Delivery OTP</h2>
            <p style="color: #666; text-align: center; font-size: 14px;">Order #{{ $order->id }} is out for delivery</p>

            <!-- OTP Box -->
            <div style="background: #f0f7ff; border: 2px dashed #0a3d62; border-radius: 10px; padding: 25px; text-align: center; margin: 25px 0;">
                <p style="margin: 0 0 10px; color: #555; font-size: 14px;">Share this OTP with the delivery person to confirm your delivery:</p>
                <div style="font-size: 42px; font-weight: 700; color: #0a3d62; letter-spacing: 12px; padding: 10px 0;">
                    {{ $otp }}
                </div>
            </div>

            <p style="color: #999; font-size: 13px; text-align: center; margin-top: 25px;">
                This OTP is valid for this delivery only. Do not share it with anyone except the assigned delivery person.
            </p>

            <hr style="border: none; border-top: 1px solid #eee; margin: 25px 0;">

            <!-- Order Summary -->
            <table style="width: 100%; font-size: 14px; color: #555;">
                <tr>
                    <td style="padding: 5px 0;"><strong>Order ID:</strong></td>
                    <td style="padding: 5px 0; text-align: right;">#{{ $order->id }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;"><strong>Amount:</strong></td>
                    <td style="padding: 5px 0; text-align: right;">{{ \App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($order->order_amount)) }}</td>
                </tr>
                <tr>
                    <td style="padding: 5px 0;"><strong>Payment:</strong></td>
                    <td style="padding: 5px 0; text-align: right;">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div style="background: #f8f9fa; padding: 15px 30px; text-align: center;">
            <p style="margin: 0; color: #999; font-size: 12px;">&copy; {{ date('Y') }} {{ $companyName }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
