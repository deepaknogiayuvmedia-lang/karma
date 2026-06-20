<!-- Dashboard Widget for Custom Reports -->
<!-- Add this to resources/views/admin-views/system/dashboard.blade.php -->

<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title d-flex align-items-center gap-2 mb-0">
                    <i class="tio-bar-chart-horizontal"></i>
                    {{ translate('Custom_Reports') }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <!-- Vendor Report Card -->
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('admin.vendor-report.index') }}" class="text-decoration-none">
                            <div class="card h-100 border-0 bg-light hover-shadow" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="tio-shop" style="font-size: 32px; color: #667eea;"></i>
                                    </div>
                                    <h6 class="card-title">{{ translate('Vendor_Performance') }}</h6>
                                    <p class="text-muted small mb-0">{{ translate('Analyze_vendor_sales_performance') }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top text-center">
                                    <small class="text-primary">{{ translate('View_Report') }} →</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Delivery Report Card -->
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('admin.delivery-report.index') }}" class="text-decoration-none">
                            <div class="card h-100 border-0 bg-light hover-shadow" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="tio-local_shipping" style="font-size: 32px; color: #f5576c;"></i>
                                    </div>
                                    <h6 class="card-title">{{ translate('Delivery_Performance') }}</h6>
                                    <p class="text-muted small mb-0">{{ translate('Monitor_delivery_performance') }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top text-center">
                                    <small class="text-primary">{{ translate('View_Report') }} →</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Comparison Report Card -->
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('admin.comparison-report') }}" class="text-decoration-none">
                            <div class="card h-100 border-0 bg-light hover-shadow" style="cursor: pointer;">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <i class="tio-balance_scale" style="font-size: 32px; color: #ffc107;"></i>
                                    </div>
                                    <h6 class="card-title">{{ translate('Comparison_Report') }}</h6>
                                    <p class="text-muted small mb-0">{{ translate('Compare_top_performers') }}</p>
                                </div>
                                <div class="card-footer bg-transparent border-top text-center">
                                    <small class="text-primary">{{ translate('View_Report') }} →</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Export Reports Card -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-100 border-0 bg-light">
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <i class="tio-download" style="font-size: 32px; color: #28a745;"></i>
                                </div>
                                <h6 class="card-title">{{ translate('Export_Options') }}</h6>
                                <small class="text-muted d-block mb-2">PDF • Excel</small>
                                <small class="text-muted">Available on each report</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    transform: translateY(-2px);
}
</style>

