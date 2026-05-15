# Quick Reference Guide - Vendor & Delivery Reports

## Quick Start

### Access Reports
1. **Vendor Report**: `/admin/vendor-report`
2. **Delivery Report**: `/admin/delivery-report`
3. **Comparison Report**: `/admin/comparison-report`

### Basic Workflow
1. Navigate to the report page
2. Set date range and filters
3. Click "Filter" to view results
4. Click "Export PDF" or "Export Excel" to download

---

## Report Endpoints

### Vendor Report
```
GET /admin/vendor-report
    ?from_date=2024-01-01
    &to_date=2024-01-31
    &status=approved
    &sort_by=earning

GET /admin/vendor-report/export-pdf
    ?from_date=2024-01-01
    &to_date=2024-01-31

GET /admin/vendor-report/export-excel
    ?from_date=2024-01-01
    &to_date=2024-01-31
```

### Delivery Report
```
GET /admin/delivery-report
    ?from_date=2024-01-01
    &to_date=2024-01-31
    &status=active
    &sort_by=deliveries

GET /admin/delivery-report/export-pdf

GET /admin/delivery-report/export-excel
```

### Comparison Report
```
GET /admin/comparison-report
    ?from_date=2024-01-01
    &to_date=2024-01-31
    &limit=10
```

---

## Key Metrics Explained

### Vendor Metrics
| Metric | Description |
|--------|-------------|
| Total Earning | Sum of all seller commissions |
| Pending Balance | Amount waiting to be withdrawn |
| Order Count | Total orders placed with this vendor |
| Delivered Orders | Successfully completed orders |
| Cancelled Orders | Orders that were cancelled |
| Avg Order Value | Average amount per order |
| Delivery Rate | % of orders successfully delivered |
| Rating | Customer satisfaction rating |

### Delivery Metrics
| Metric | Description |
|--------|-------------|
| Total Earning | Delivery commission earned |
| Pending Balance | Amount waiting to be withdrawn |
| Total Deliveries | Successfully completed deliveries |
| Pending Deliveries | In-progress deliveries |
| Cancelled Orders | Orders cancelled by delivery staff |
| Success Rate | % of successful deliveries |
| Avg Rating | Customer rating for delivery |
| Review Count | Number of customer reviews |

---

## Filter Options

### Vendor Report Filters
- **From Date** - Report start date
- **To Date** - Report end date
- **Status** - Approved / Pending / Suspended
- **Sort By** - Earning / Orders / Rating

### Delivery Report Filters
- **From Date** - Report start date
- **To Date** - Report end date
- **Status** - Active / Inactive
- **Sort By** - Deliveries / Earning / Rating

### Comparison Report Filters
- **From Date** - Report start date
- **To Date** - Report end date
- **Show Top** - Number of entries (5-50)

---

## Routes (Named)

### View Routes
```php
route('admin.vendor-report.index')
route('admin.delivery-report.index')
route('admin.comparison-report')
```

### Export Routes
```php
route('admin.vendor-report.export-pdf')
route('admin.vendor-report.export-excel')
route('admin.delivery-report.export-pdf')
route('admin.delivery-report.export-excel')
```

### Alternative Routes (Group)
```php
route('admin.vendor-delivery-report.vendor')
route('admin.vendor-delivery-report.vendor-pdf')
route('admin.vendor-delivery-report.delivery')
route('admin.vendor-delivery-report.comparison')
```

---

## Using in Blade Templates

### Link to Vendor Report
```blade
<a href="{{ route('admin.vendor-report.index') }}">View Report</a>
<a href="{{ route('admin.vendor-report.export-pdf') }}">Export PDF</a>
<a href="{{ route('admin.vendor-report.export-excel') }}">Export Excel</a>
```

### Link to Delivery Report
```blade
<a href="{{ route('admin.delivery-report.index') }}">View Report</a>
<a href="{{ route('admin.delivery-report.export-pdf') }}">Export PDF</a>
<a href="{{ route('admin.delivery-report.export-excel') }}">Export Excel</a>
```

### Link with Filters
```blade
<a href="{{ route('admin.vendor-report.index', [
    'from_date' => '2024-01-01',
    'to_date' => '2024-01-31',
    'status' => 'approved',
    'sort_by' => 'earning'
]) }}">
    View Top Vendors
</a>
```

---

## Common Queries

### Top Vendors by Earnings (Last 30 Days)
```
/admin/vendor-report?sort_by=earning
```

### Approved Vendors Performance (Q1 2024)
```
/admin/vendor-report?from_date=2024-01-01&to_date=2024-03-31&status=approved
```

### Top Delivery Staff by Deliveries (Last Month)
```
/admin/delivery-report?sort_by=deliveries
```

### Active Delivery Staff Export
```
/admin/delivery-report/export-excel?status=active
```

### Export Comparison Report
```
/admin/comparison-report?limit=15
```

---

## Files Included

### Controller
```
app/Http/Controllers/Admin/VendorDeliveryReportController.php
```

### Views
```
resources/views/admin-views/custom-reports/
├── vendor-report.blade.php
├── delivery-report.blade.php
├── comparison-report.blade.php
├── vendor-pdf.blade.php
├── delivery-pdf.blade.php
├── menu-item.blade.php
└── dashboard-widget.blade.php
```

### Helpers
```
app/CPU/ReportHelper.php
```

### Routes
```
routes/admin.php (routes added)
```

### Documentation
```
VENDOR_DELIVERY_REPORTS_README.md
INSTALLATION_GUIDE.md
QUICK_REFERENCE.md (this file)
```

---

## Troubleshooting

### Report shows "No data"
- Check date range contains orders
- Verify vendors/staff exist in system
- Try expanding date range

### PDF download fails
- Clear browser cache
- Check storage/ directory permissions
- Verify DomPDF is installed

### Excel download fails
- Ensure FastExcel package is installed
- Check file encoding (should be UTF-8)
- Check storage/ directory

### Routes not found
```bash
php artisan route:cache
php artisan cache:clear
```

---

## Translation Keys

Add to your language files:

```php
'Vendor_Performance_Report' => 'Vendor Performance Report',
'Delivery_Staff_Performance_Report' => 'Delivery Staff Performance Report',
'From_Date' => 'From Date',
'To_Date' => 'To Date',
'Status' => 'Status',
'Filter' => 'Filter',
'Export_PDF' => 'Export PDF',
'Export_Excel' => 'Export Excel',
'Total_Vendors' => 'Total Vendors',
'Total_Earnings' => 'Total Earnings',
'Total_Orders' => 'Total Orders',
```

See `resources/lang/en/custom_report_translations.php` for complete list.

---

## Performance Tips

1. **Limit Date Range** - Smaller date ranges = faster queries
2. **Use Filters** - Filter by status/type to reduce data
3. **Database Indexes** - Ensure key columns are indexed (see docs)
4. **Cache Reports** - Store frequently accessed reports

---

## Support

- **Full Documentation**: See `VENDOR_DELIVERY_REPORTS_README.md`
- **Installation Guide**: See `INSTALLATION_GUIDE.md`
- **API Reference**: Check method documentation in controller

---

Last Updated: 2024
