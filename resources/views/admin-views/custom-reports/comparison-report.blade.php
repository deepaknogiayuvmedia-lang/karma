@extends('layouts.back-end.app')

@section('title', 'Vendor & Delivery Comparison Report')

@push('css_or_js')
    <style>
        .comparison-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .comparison-container {
                grid-template-columns: 1fr;
            }
        }

        .comparison-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .comparison-card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            font-size: 16px;
            font-weight: 600;
        }

        .comparison-card:nth-child(2) .comparison-card-header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .comparison-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .comparison-list-item {
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .comparison-list-item:last-child {
            border-bottom: none;
        }

        .comparison-list-item:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .rank {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #007bff;
            color: white;
            font-weight: 600;
            font-size: 14px;
            margin-right: 10px;
        }

        .rank.gold {
            background-color: #ffc107;
            color: #333;
        }

        .rank.silver {
            background-color: #c0c0c0;
            color: #333;
        }

        .rank.bronze {
            background-color: #cd7f32;
            color: white;
        }

        .comparison-name {
            flex: 1;
        }

        .comparison-value {
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .filter-section {
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

        .filter-group input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            min-width: 150px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <h1 class="page-header-title">{{ translate('Comparison_Report') }}</h1>
            <p class="text-muted">{{ translate('Compare_top_vendors_and_delivery_staff_performance') }}</p>
        </div>

        <!-- Filter Section -->
        <div class="filter-section card">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.comparison-report') }}" class="filter-form">
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
                            <label for="limit">{{ translate('Show_Top') }}</label>
                            <input type="number" id="limit" name="limit" value="10" min="5" max="50" class="form-control">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">{{ translate('Filter') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Comparison Container -->
        <div class="comparison-container">
            <!-- Top Vendors -->
            <div class="comparison-card">
                <div class="comparison-card-header">
                    <i class="tio-shop"></i> {{ translate('Top_Vendors_by_Earnings') }}
                </div>
                <ul class="comparison-list">
                    @forelse($top_sellers as $index => $seller)
                        <li class="comparison-list-item">
                            <span class="rank {{ $index == 0 ? 'gold' : ($index == 1 ? 'silver' : ($index == 2 ? 'bronze' : '')) }}">
                                {{ $index + 1 }}
                            </span>
                            <span class="comparison-name">{{ $seller->shop_name }}</span>
                            <span class="comparison-value">{{ currency_symbol() }}{{ number_format($seller->total_earning, 2) }}</span>
                        </li>
                    @empty
                        <li class="comparison-list-item">
                            <span class="text-muted">{{ translate('No_data_available') }}</span>
                        </li>
                    @endforelse
                </ul>
            </div>

            <!-- Top Delivery Staff -->
            <div class="comparison-card">
                <div class="comparison-card-header">
                    <i class="tio-local_shipping"></i> {{ translate('Top_Delivery_Staff_by_Deliveries') }}
                </div>
                <ul class="comparison-list">
                    @forelse($top_delivery as $index => $delivery)
                        <li class="comparison-list-item">
                            <span class="rank {{ $index == 0 ? 'gold' : ($index == 1 ? 'silver' : ($index == 2 ? 'bronze' : '')) }}">
                                {{ $index + 1 }}
                            </span>
                            <span class="comparison-name">{{ $delivery->name }}</span>
                            <span class="comparison-value">{{ $delivery->delivered }} {{ translate('Deliveries') }}</span>
                        </li>
                    @empty
                        <li class="comparison-list-item">
                            <span class="text-muted">{{ translate('No_data_available') }}</span>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection
