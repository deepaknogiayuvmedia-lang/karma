<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Delivery Staff Performance Report</title>
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

        .badge-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .rating {
            color: #ffc107;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Delivery Staff Performance Report</h1>
        <p>Comprehensive delivery performance analytics and metrics</p>
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
                <th>Delivery Staff</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Total Earning</th>
                <th>Pending Balance</th>
                <th>Total Deliveries</th>
                <th>Pending Deliveries</th>
                <th>Cancelled</th>
                <th>Success Rate</th>
                <th>Avg Rating</th>
            </tr>
        </thead>
        <tbody>
            @forelse($delivery_men as $delivery)
                <tr>
                    <td><strong>{{ $delivery->name }}</strong></td>
                    <td>{{ $delivery->email }}</td>
                    <td>{{ $delivery->phone }}</td>
                    <td class="text-center">
                        <span class="badge badge-{{ $delivery->status === 'Active' ? 'success' : 'danger' }}">
                            {{ $delivery->status }}
                        </span>
                    </td>
                    <td class="text-right">${{ number_format($delivery->total_earning, 2) }}</td>
                    <td class="text-right">${{ number_format($delivery->pending_balance, 2) }}</td>
                    <td class="text-center">{{ $delivery->total_deliveries }}</td>
                    <td class="text-center">{{ $delivery->pending_deliveries }}</td>
                    <td class="text-center">{{ $delivery->cancelled_orders }}</td>
                    <td class="text-right">{{ number_format($delivery->delivery_success_rate, 1) }}%</td>
                    <td class="text-center"><span class="rating">★ {{ $delivery->avg_rating }}</span></td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">No delivery staff found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($delivery_men->count() > 0)
        <table style="margin-top: 15px;">
            <thead>
                <tr class="total-row">
                    <th colspan="4" class="text-right">TOTALS:</th>
                    <th class="text-right">${{ number_format($delivery_men->sum('total_earning'), 2) }}</th>
                    <th class="text-right">${{ number_format($delivery_men->sum('pending_balance'), 2) }}</th>
                    <th class="text-center">{{ $delivery_men->sum('total_deliveries') }}</th>
                    <th class="text-center">{{ $delivery_men->sum('pending_deliveries') }}</th>
                    <th class="text-center">{{ $delivery_men->sum('cancelled_orders') }}</th>
                    <th class="text-right">{{ number_format($delivery_men->count() > 0 ? $delivery_men->avg('delivery_success_rate') : 0, 1) }}%</th>
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
