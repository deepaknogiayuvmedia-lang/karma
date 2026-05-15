<!-- Custom Reports Menu Item - Add to your admin sidebar/navigation -->
<!-- This can be integrated into your admin navigation menu -->

<li class="nav-item">
    <a class="nav-link" href="#reportsMenu" data-toggle="collapse" role="button"
       aria-expanded="false" aria-controls="reportsMenu">
        <i class="tio-bar-chart-horizontal"></i>
        <span>{{ translate('Custom_Reports') }}</span>
    </a>
    <div class="collapse" id="reportsMenu">
        <ul class="nav nav-sub nav-flush">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.vendor-report.index') }}"
                   role="button">
                    <i class="tio-shop"></i>
                    <span>{{ translate('Vendor_Performance') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.delivery-report.index') }}"
                   role="button">
                    <i class="tio-local_shipping"></i>
                    <span>{{ translate('Delivery_Staff_Performance') }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.comparison-report') }}"
                   role="button">
                    <i class="tio-balance_scale"></i>
                    <span>{{ translate('Comparison_Report') }}</span>
                </a>
            </li>
        </ul>
    </div>
</li>
