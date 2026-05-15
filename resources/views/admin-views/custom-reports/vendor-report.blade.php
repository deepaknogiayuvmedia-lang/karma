@extends('layouts.back-end.app')

@section('title', 'Vendor Performance Report')

@push('css_or_js')
    <style>
        .report-filter {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .filter-group {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 0;
        }

        .filter-group input,
        .filter-group select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 150px;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .export-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-pdf {
            background-color: #dc3545;
            color: white;
        }

        .btn-pdf:hover {
            background-color: #c82333;
        }

        .btn-excel {
            background-color: #28a745;
            color: white;
        }

        .btn-excel:hover {
            background-color: #218838;
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .report-table thead {
            background-color: #f8f9fa;
        }

        .report-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .report-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .report-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
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

        .metric-value {
            font-weight: 600;
            color: #2c3e50;
        }

        .stats-summary {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: white;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .stat-label {
            font-size: 12px;
            color: #666;
            margin-bottom: 5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <h1 class="page-header-title">{{ translate('Vendor_Performance_Report') }}</h1>
            <p class="text-muted">{{ translate('Analyze_vendor_sales_performance_and_metrics') }}</p>
        </div>

        <!-- Filter Section -->
        <div class="report-filter card">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.vendor-report.index') }}" class="filter-form">
                    <div class="filter-group">
                        <div>
                            <label for="from_date">{{ translate('From_Date') }}</label>
                            <input type="date" id="from_date" name="from_date" value="{{ $from_date->format('Y-m-d') }}" class="form-control">
                        </div>
                        <div>
                            <label for="to_date">{{ translate('To_Date') }}</label>
                            <input type="date" id="to_date" name="to_date" value="{{ $to_date->format('Y-m-d') }}" class="form-control">
                        </div>
                        <div>
                            <label for="status">{{ translate('Status') }}</label>
                            <select id="status" name="status" class="form-control">
                                <option value="">{{ translate('All') }}</option>
                                <option value="approved" {{ $status === 'approved' ? 'selected' : '' }}>{{ translate('Approved') }}</option>
                                <option value="pending" {{ $status === 'pending' ? 'selected' : '' }}>{{ translate('Pending') }}</option>
                                <option value="suspended" {{ $status === 'suspended' ? 'selected' : '' }}>{{ translate('Suspended') }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort_by">{{ translate('Sort_By') }}</label>
                            <select id="sort_by" name="sort_by" class="form-control">
                                <option value="earning" {{ $sort_by === 'earning' ? 'selected' : '' }}>{{ translate('Earning') }}</option>
                                <option value="orders" {{ $sort_by === 'orders' ? 'selected' : '' }}>{{ translate('Orders') }}</option>
                                <option value="rating" {{ $sort_by === 'rating' ? 'selected' : '' }}>{{ translate('Rating') }}</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                        </div>
                    </div>

                    <div class="export-buttons">
                        <a href="{{ route('admin.vendor-report.export-pdf', request()->query()) }}" class="export-btn btn-pdf">
                            <i class="tio-download"></i> {{ translate('Export_PDF') }}
                        </a>
                        <a href="{{ route('admin.vendor-report.export-excel', request()->query()) }}" class="export-btn btn-excel">
                            <i class="tio-download"></i> {{ translate('Export_Excel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Summary -->
        <div class="stats-summary">
            <div class="stat-card">
                <div class="stat-label">{{ translate('Total_Vendors') }}</div>
                <div class="stat-value">{{ $sellers->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ translate('Total_Earnings') }}</div>
                <div class="stat-value">{{ currency_symbol() }}{{ number_format($sellers->sum('total_earning'), 2) }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #28a745;">
                <div class="stat-label">{{ translate('Total_Orders') }}</div>
                <div class="stat-value">{{ $sellers->sum('order_count') }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #ffc107;">
                <div class="stat-label">{{ translate('Avg_Order_Value') }}</div>
                <div class="stat-value">{{ currency_symbol() }}{{ number_format($sellers->count() > 0 ? $sellers->sum('total_earning') / $sellers->sum('order_count') : 0, 2) }}</div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>{{ translate('Shop_Name') }}</th>
                                <th>{{ translate('Seller_Name') }}</th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Phone') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Total_Earning') }}</th>
                                <th>{{ translate('Pending_Balance') }}</th>
                                <th>{{ translate('Orders') }}</th>
                                <th>{{ translate('Delivered') }}</th>
                                <th>{{ translate('Cancelled') }}</th>
                                <th>{{ translate('Avg_Order_Value') }}</th>
                                <th>{{ translate('Delivery_Rate') }}</th>
                                <th>{{ translate('Rating') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sellers as $seller)
                                <tr>
                                    <td>
                                        <strong>{{ $seller->shop_name }}</strong>
                                    </td>
                                    <td>{{ $seller->seller_name }}</td>
                                    <td>{{ $seller->email }}</td>
                                    <td>{{ $seller->phone }}</td>
                                    <td>
                                        <span class="badge badge-{{ $seller->status === 'approved' ? 'success' : ($seller->status === 'pending' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($seller->status) }}
                                        </span>
                                    </td>
                                    <td class="metric-value">{{ currency_symbol() }}{{ number_format($seller->total_earning, 2) }}</td>
                                    <td class="metric-value">{{ currency_symbol() }}{{ number_format($seller->pending_balance, 2) }}</td>
                                    <td class="metric-value">{{ $seller->order_count }}</td>
                                    <td class="metric-value">{{ $seller->delivered_orders }}</td>
                                    <td class="metric-value">{{ $seller->cancelled_orders }}</td>
                                    <td class="metric-value">{{ currency_symbol() }}{{ number_format($seller->avg_order_value, 2) }}</td>
                                    <td>{{ number_format($seller->delivery_rate, 1) }}%</td>
                                    <td>⭐ {{ $seller->rating }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="13" class="text-center text-muted py-4">
                                        {{ translate('No_vendors_found') }}
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Date range presets
        document.addEventListener('DOMContentLoaded', function() {
            // Add any custom date range functionality here
        });
    </script>
@endpush
