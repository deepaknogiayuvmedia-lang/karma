@extends('layouts.front-end.app')

@section('title', \App\CPU\translate('Technical Names'))

@push('css_or_js')
<style>
    .tech-name-item {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border-radius: 25px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        text-decoration: none;
        color: #333;
        font-size: 0.95rem;
        transition: all 0.2s;
    }
    .tech-name-item:hover {
        background: {{ $web_config['primary_color'] }};
        color: #fff;
        border-color: {{ $web_config['primary_color'] }};
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .alpha-header {
        font-size: 1.5rem;
        font-weight: bold;
        color: {{ $web_config['primary_color'] }};
        border-bottom: 2px solid {{ $web_config['primary_color'] }};
        padding-bottom: 5px;
        margin: 20px 0 15px;
    }
</style>
@endpush

@section('content')
<div class="container py-4">
    <div class="text-center mb-4">
        <h2 style="color: {{ $web_config['primary_color'] }}">{{ \App\CPU\translate('Technical Names') }}</h2>
        <p class="text-muted">{{ \App\CPU\translate('Browse products by technical name') }}</p>
    </div>

    @php($grouped = $technicalNames->groupBy(fn($name) => strtoupper(substr($name, 0, 1))))

    @if($technicalNames->isEmpty())
        <div class="text-center py-5">
            <i class="fa fa-tags fa-3x text-muted mb-3"></i>
            <p class="text-muted">{{ \App\CPU\translate('No technical names found') }}</p>
        </div>
    @else
        @foreach($grouped as $letter => $names)
            <div class="alpha-header">{{ $letter }}</div>
            <div class="mb-3">
                @foreach($names as $name)
                    <a href="{{ route('products', ['data_from' => 'technical_name', 'technical_name' => $name, 'page' => 1]) }}" class="tech-name-item">
                        {{ $name }}
                    </a>
                @endforeach
            </div>
        @endforeach
    @endif
</div>
@endsection
