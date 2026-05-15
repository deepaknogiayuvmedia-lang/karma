@extends('layouts.back-end.app')

@section('title', 'Delivery Staff Performance Report')

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

        .rating-display {
            color: #ffc107;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <h1 class="page-header-title">{{ translate('Delivery_Staff_Performance_Report') }}</h1>
            <p class="text-muted">{{ translate('Monitor_delivery_performance_and_metrics') }}</p>
        </div>

        <!-- Filter Section -->
        <div class="report-filter card">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.delivery-report.index') }}" class="filter-form">
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
                                <option value="active" {{ $status === 'active' ? 'selected' : '' }}>{{ translate('Active') }}</option>
                                <option value="inactive" {{ $status === 'inactive' ? 'selected' : '' }}>{{ translate('Inactive') }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="sort_by">{{ translate('Sort_By') }}</label>
                            <select id="sort_by" name="sort_by" class="form-control">
                                <option value="deliveries" {{ $sort_by === 'deliveries' ? 'selected' : '' }}>{{ translate('Deliveries') }}</option>
                                <option value="earning" {{ $sort_by === 'earning' ? 'selected' : '' }}>{{ translate('Earning') }}</option>
                                <option value="rating" {{ $sort_by === 'rating' ? 'selected' : '' }}>{{ translate('Rating') }}</option>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                        </div>
                    </div>

                    <div class="export-buttons">
                        <a href="{{ route('admin.delivery-report.export-pdf', request()->query()) }}" class="export-btn btn-pdf">
                            <i class="tio-download"></i> {{ translate('Export_PDF') }}
                        </a>
                        <a href="{{ route('admin.delivery-report.export-excel', request()->query()) }}" class="export-btn btn-excel">
                            <i class="tio-download"></i> {{ translate('Export_Excel') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Summary -->
        <div class="stats-summary">
            <div class="stat-card">
                <div class="stat-label">{{ translate('Total_Delivery_Staff') }}</div>
                <div class="stat-value">{{ $delivery_men->count() }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">{{ translate('Total_Deliveries') }}</div>
                <div class="stat-value">{{ $delivery_men->sum('total_deliveries') }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #28a745;">
                <div class="stat-label">{{ translate('Total_Earnings') }}</div>
                <div class="stat-value">{{ currency_symbol() }}{{ number_format($delivery_men->sum('total_earning'), 2) }}</div>
            </div>
            <div class="stat-card" style="border-left-color: #ffc107;">
                <div class="stat-label">{{ translate('Avg_Success_Rate') }}</div>
                <div class="stat-value">{{ number_format($delivery_men->count() > 0 ? $delivery_men->avg('delivery_success_rate') : 0, 1) }}%</div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>{{ translate('Name') }}</th>
                                <th>{{ translate('Email') }}</th>
                                <th>{{ translate('Phone') }}</th>
                                <th>{{ translate('Status') }}</th>
                                <th>{{ translate('Total_Earning') }}</th>
                                <th>{{ translate('Pending_Balance') }}</th>
                                <th>{{ translate('Total_Deliveries') }}</th>
                                <th>{{ translate('Pending_Deliveries') }}</th>
                                <th>{{ translate('Cancelled_Orders') }}</th>
                                <th>{{ translate('Success_Rate') }}</th>
                                <th>{{ translate('Avg_Rating') }}</th>
                                <th>{{ translate('Reviews') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($delivery_men as $delivery)
                                <tr>
                                    <td>
                                        <strong>{{ $delivery->name }}</strong>
                                    </td>
                                    <td>{{ $delivery->email }}</td>
                                    <td>{{ $delivery->phone }}</td>
                                    <td>
                                        <span class="badge badge-{{ $delivery->is_active ? 'success' : 'danger' }}">
                                            {{ $delivery->is_active ? translate('Active') : translate('Inactive') }}
                                        </span>
                                    </td>
                                    <td class="metric-value">{{ currency_symbol() }}{{ number_format($delivery->total_earning, 2) }}</td>
                                    <td class="metric-value">{{ currency_symbol() }}{{ number_format($delivery->pending_balance, 2) }}</td>
                                    <td class="metric-value">{{ $delivery->total_deliveries }}</td>
                                    <td class="metric-value">{{ $delivery->pending_deliveries }}</td>
                                    <td class="metric-value">{{ $delivery->cancelled_orders }}</td>
                                    <td class="metric-value">{{ number_format($delivery->delivery_success_rate, 1) }}%</td>
                                    <td class="rating-display">⭐ {{ $delivery->avg_rating }}</td>
                                    <td class="metric-value">{{ $delivery->review_count }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="text-center text-muted py-4">
                                        {{ translate('No_delivery_staff_found') }}
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
        document.addEventListener('DOMContentLoaded', function() {
            // Add any custom functionality here
        });
    </script>
@endpush
