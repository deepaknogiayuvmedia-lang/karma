# Installation & Setup Guide - Custom Vendor & Delivery Reports

## Overview
This guide walks you through the installation and setup of the custom vendor and delivery staff report system with PDF and Excel export capabilities.

## Prerequisites

Ensure your Laravel project has the following packages installed:
- `barryvdh/laravel-dompdf` (PDF generation)
- `rap2hpoutre/fast-excel` (Excel export)

These should already be in your composer.json. If not, install them:

```bash
composer require barryvdh/laravel-dompdf
composer require rap2hpoutre/fast-excel
```

## Installation Steps

### Step 1: Copy Files

The following files have already been created:

1. **Controller**: `/app/Http/Controllers/Admin/VendorDeliveryReportController.php`
2. **Views**: 
   - `/resources/views/admin-views/custom-reports/vendor-report.blade.php`
   - `/resources/views/admin-views/custom-reports/delivery-report.blade.php`
   - `/resources/views/admin-views/custom-reports/comparison-report.blade.php`
   - `/resources/views/admin-views/custom-reports/vendor-pdf.blade.php`
   - `/resources/views/admin-views/custom-reports/delivery-pdf.blade.php`
3. **Helper**: `/app/CPU/ReportHelper.php`
4. **Routes**: Routes added to `/routes/admin.php`

### Step 2: Update Language Files

Add translation keys to your language files:

**File**: `resources/lang/en/messages.php` (or your language file)

Copy all translation keys from `resources/lang/en/custom_report_translations.php` to your existing language files.

### Step 3: Add Routes

Routes are already added to `/routes/admin.php`. The following routes are now available:

```php
// Vendor Reports
GET  /admin/vendor-report                    # View report
GET  /admin/vendor-report/export-pdf         # Export as PDF
GET  /admin/vendor-report/export-excel       # Export as Excel

// Delivery Reports  
GET  /admin/delivery-report                  # View report
GET  /admin/delivery-report/export-pdf       # Export as PDF
GET  /admin/delivery-report/export-excel     # Export as Excel

// Comparison Report
GET  /admin/comparison-report                # View comparison
```

### Step 4: Update Navigation/Sidebar

To add the reports to your admin sidebar, include the menu item in your admin layout:

**File**: `resources/views/layouts/back-end/app.blade.php` (or your admin layout)

Add this line where you want the reports menu to appear:
```blade
@include('admin-views.custom-reports.menu-item')
```

### Step 5: Add Dashboard Widget (Optional)

To add report cards to your dashboard, include the widget in your dashboard view:

**File**: `resources/views/admin-views/system/dashboard.blade.php`

Add this near the end of the page content:
```blade
@include('admin-views.custom-reports.dashboard-widget')
```

### Step 6: Clear Cache

Clear Laravel's cache for changes to take effect:

```bash
php artisan cache:clear
php artisan config:cache
```

## Configuration

### Report Date Defaults

The reports default to the last 30 days. To change this, modify in `VendorDeliveryReportController.php`:

```php
// Current: last 30 days
$from_date = $request->get('from_date', Carbon::now()->subMonth());
$to_date = $request->get('to_date', Carbon::now());

// Change to: last 90 days
$from_date = $request->get('from_date', Carbon::now()->subDays(90));
$to_date = $request->get('to_date', Carbon::now());
```

### Export Format Customization

#### PDF Header/Footer

Edit the PDF templates:
- `resources/views/admin-views/custom-reports/vendor-pdf.blade.php`
- `resources/views/admin-views/custom-reports/delivery-pdf.blade.php`

Change company name, logo, or styling in the header section.

#### Excel Column Order

Modify the array keys in the `export_vendor_excel()` or `export_delivery_excel()` methods to change column order.

## Usage

### Accessing Reports

1. **Via Dashboard**: Click the report cards added to the dashboard
2. **Via Sidebar**: Click the "Custom Reports" menu → Select report type
3. **Direct URL**:
   - Vendor Report: `/admin/vendor-report`
   - Delivery Report: `/admin/delivery-report`
   - Comparison Report: `/admin/comparison-report`

### Filtering Reports

Each report includes several filter options:

**Vendor Report Filters:**
- Date Range (From/To)
- Vendor Status (All/Approved/Pending/Suspended)
- Sort By (Earnings/Orders/Rating)

**Delivery Report Filters:**
- Date Range (From/To)
- Staff Status (All/Active/Inactive)
- Sort By (Deliveries/Earnings/Rating)

**Comparison Report Filters:**
- Date Range (From/To)
- Show Top N (default: 10, max: 50)

### Generating Reports

#### View in Browser
1. Navigate to the report page
2. Set desired filters
3. Click "Filter"
4. View results in table format

#### Export to PDF
1. Set desired filters on report page
2. Click "Export PDF" button
3. PDF file downloads automatically
4. File naming: `vendor-report-YYYY-MM-DD-HHMMSS.pdf`

#### Export to Excel
1. Set desired filters on report page
2. Click "Export Excel" button
3. Excel file downloads automatically
4. File naming: `vendor-report-YYYY-MM-DD-HHMMSS.xlsx`

## Database Optimization

For optimal performance with large datasets, ensure these columns are indexed:

```sql
-- Vendor-related indexes
ALTER TABLE sellers ADD INDEX idx_status (status);
ALTER TABLE sellers ADD INDEX idx_created_at (created_at);

-- Order-related indexes
ALTER TABLE orders ADD INDEX idx_seller_id (seller_id);
ALTER TABLE orders ADD INDEX idx_delivery_man_id (delivery_man_id);
ALTER TABLE orders ADD INDEX idx_order_status (order_status);
ALTER TABLE orders ADD INDEX idx_created_at (created_at);

-- Transaction-related indexes
ALTER TABLE order_transactions ADD INDEX idx_seller_id (seller_id);
ALTER TABLE order_transactions ADD INDEX idx_seller_is (seller_is);
ALTER TABLE order_transactions ADD INDEX idx_created_at (created_at);

-- Delivery-related indexes
ALTER TABLE deliveryman_transactions ADD INDEX idx_delivery_man_id (delivery_man_id);
ALTER TABLE deliveryman_transactions ADD INDEX idx_created_at (created_at);

-- Review-related indexes
ALTER TABLE reviews ADD INDEX idx_delivery_man_id (delivery_man_id);
```

## Troubleshooting

### Issue: Routes not found

**Solution**: Run `php artisan route:cache` and `php artisan cache:clear`

### Issue: PDF export not working

**Causes**:
- Missing `barryvdh/laravel-dompdf` package
- File permissions issue
- Low PHP memory limit

**Solutions**:
1. Install DomPDF: `composer require barryvdh/laravel-dompdf`
2. Check file permissions on `storage/` directory
3. Increase PHP memory in `php.ini`: `memory_limit = 256M`

### Issue: Excel export not working

**Causes**:
- Missing `rap2hpoutre/fast-excel` package
- Special characters in data

**Solutions**:
1. Install FastExcel: `composer require rap2hpoutre/fast-excel`
2. Ensure data encoding is UTF-8

### Issue: Reports showing no data

**Checks**:
1. Verify vendors/delivery staff exist in database
2. Check date range includes data
3. Verify order data exists for the period
4. Check filters aren't too restrictive

### Issue: Slow report loading

**Solutions**:
1. Narrow date range
2. Add database indexes (see above)
3. Implement pagination (future enhancement)

## Advanced Customization

### Adding New Metrics

To add a new metric to the vendor report:

1. **Update Controller**: Modify `vendor_report()` method in `VendorDeliveryReportController.php`
2. **Calculate Metric**:
   ```php
   'new_metric' => $this->calculateNewMetric($seller, $from_date, $to_date),
   ```
3. **Update View**: Add column header and data cell in `vendor-report.blade.php`
4. **Update PDF**: Add to `vendor-pdf.blade.php` template
5. **Update Excel**: Add to array in `export_vendor_excel()` method

### Custom Styling

Modify CSS in report view files or add custom stylesheet:

```blade
@push('css_or_js')
    <link rel="stylesheet" href="{{ asset('your-custom-styles.css') }}">
@endpush
```

### Adding Email Reports

Create a new command to email reports:

```bash
php artisan make:command SendVendorReportEmail
```

Then schedule it in `app/Console/Kernel.php`:

```php
$schedule->command('send:vendor-report')->daily();
```

### Role-Based Access Control

To restrict report access by role, add middleware in `routes/admin.php`:

```php
Route::group(['middleware' => ['admin', 'role:manager']], function() {
    Route::get('vendor-report', 'VendorDeliveryReportController@vendor_report');
});
```

## Performance Monitoring

Monitor report performance using Laravel Debugbar or monitoring tools:

```php
// Add to controller for debugging
\DB::enableQueryLog();
// ... report code ...
dd(\DB::getQueryLog());
```

## Maintenance

### Regular Tasks

1. **Monitor Database Size**: Large transaction logs can slow queries
2. **Archive Old Data**: Consider archiving data older than 6/12 months
3. **Update Indexes**: Periodically verify indexes are optimal
4. **Clean Logs**: Remove old report generation logs

### Backup Recommendations

Before running reports on critical data, ensure:
- Database is backed up
- Storage directory is backed up (for exports)

## Support & Troubleshooting

For issues or questions:

1. Check the [README](VENDOR_DELIVERY_REPORTS_README.md) for complete documentation
2. Review the troubleshooting section above
3. Check Laravel and package documentation
4. Review application error logs in `storage/logs/`

## Next Steps

After installation:

1. ✅ Test vendor report
2. ✅ Test delivery report
3. ✅ Test PDF export
4. ✅ Test Excel export
5. ✅ Verify all filters work
6. ✅ Customize styling as needed
7. ✅ Add to your monitoring workflows
8. ✅ Train staff on using reports

## Support Contact

For issues specific to this report system, consult the included documentation or contact your development team.
