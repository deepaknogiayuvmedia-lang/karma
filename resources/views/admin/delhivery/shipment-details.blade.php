@extends('layouts.back-end.app')

@section('title', 'Delhivery Shipment')

@section('content')
    <div class="content container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0">Delhivery Shipment Details</h3>
            </div>
            <div class="card-body">
                <p><strong>Waybill:</strong> {{ $shipment->waybill ?? 'N/A' }}</p>
                <p><strong>Status:</strong> {{ $shipment->status ?? 'N/A' }}</p>
                <p><strong>Tracking Status:</strong> {{ $shipment->tracking_status ?? 'N/A' }}</p>
                <p><strong>Pickup Location:</strong> {{ $shipment->pickup_location ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
@endsection
