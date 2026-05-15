<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vendor Performance Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #2c3e50;
            padding-bottom: 10px;
        }

        .header h1 {
            font-size: 18px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 10px;
            color: #666;
            margin: 2px 0;
        }

        .report-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            font-size: 10px;
        }

        .report-info div {
            flex: 1;
        }

        .report-info strong {
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        thead {
            background-color: #f0f0f0;
        }

        th {
            padding: 8px 5px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
            background-color: #e8e8e8;
            font-size: 10px;
        }

        td {
            padding: 7px 5px;
            border: 1px solid #ddd;
            font-size: 10px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 15px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 9px;
            color: #666;
            text-align: center;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-success {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Vendor Performance Report</h1>
        <p>Comprehensive vendor analytics and metrics</p>
    </div>

    <div class="report-info">
        <div>
            <strong>Report Period:</strong> {{ $from_date }} to {{ $to_date }}
        </div>
        <div class="text-right">
            <strong>Generated:</strong> {{ $generated_at }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Shop Name</th>
                <th>Seller Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Total Earning</th>
                <th>Pending Balance</th>
                <th>Orders</th>
                <th>Delivered</th>
                <th>Cancelled</th>
                <th>Avg Order Value</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sellers as $seller)
                <tr>
                    <td><strong>{{ $seller->shop_name }}</strong></td>
                    <td>{{ $seller->seller_name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>{{ $seller->phone }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $seller->status === 'approved' ? 'success' : ($seller->status === 'pending' ? 'warning' : 'danger') }}">
                            {{ ucfirst($seller->status) }}
                        </span>
                    </td>
                    <td class="text-right">${{ number_format($seller->total_earning, 2) }}</td>
                    <td class="text-right">${{ number_format($seller->pending_balance, 2) }}</td>
                    <td class="text-center">{{ $seller->order_count }}</td>
                    <td class="text-center">{{ $seller->delivered_orders }}</td>
                    <td class="text-center">{{ $seller->cancelled_orders }}</td>
                    <td class="text-right">${{ number_format($seller->avg_order_value, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">No vendors found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($sellers->count() > 0)
        <table style="margin-top: 15px;">
            <thead>
                <tr class="total-row">
                    <th colspan="5" class="text-right">TOTALS:</th>
                    <th class="text-right">${{ number_format($sellers->sum('total_earning'), 2) }}</th>
                    <th class="text-right">${{ number_format($sellers->sum('pending_balance'), 2) }}</th>
                    <th class="text-center">{{ $sellers->sum('order_count') }}</th>
                    <th class="text-center">{{ $sellers->sum('delivered_orders') }}</th>
                    <th class="text-center">{{ $sellers->sum('cancelled_orders') }}</th>
                    <th></th>
                </tr>
            </thead>
        </table>
    @endif

    <div class="footer">
        <p>This is an automatically generated report. For questions or concerns, please contact the administration.</p>
    </div>
</body>
</html>
