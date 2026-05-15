# Custom Vendor & Delivery Report System

## Overview
This system provides comprehensive reporting capabilities for monitoring vendor (seller) and delivery staff performance with PDF and Excel export functionality.

## Features

### 1. **Vendor Performance Report**
- View detailed vendor metrics including:
  - Shop name and seller information
  - Total earnings and pending balance
  - Order count (total, delivered, cancelled)
  - Average order value
  - Delivery success rate
  - Customer ratings
- Filter by:
  - Date range
  - Vendor status (approved, pending, suspended)
  - Sort by earnings, orders, or rating
- Export to PDF and Excel formats

### 2. **Delivery Staff Performance Report**
- Monitor delivery staff metrics:
  - Total earnings and pending balance
  - Delivery count (completed, pending, cancelled)
  - Delivery success rate
  - Average customer rating
  - Review count
- Filter by:
  - Date range
  - Active/Inactive status
  - Sort by deliveries, earnings, or rating
- Export to PDF and Excel formats

### 3. **Comparison Report**
- Compare top performers:
  - Top 10 vendors by earnings (customizable limit)
  - Top delivery staff by completed deliveries
- Ranked display with medals for top 3
- Date range filtering

## File Structure

```
app/Http/Controllers/Admin/
└── VendorDeliveryReportController.php

resources/views/admin-views/custom-reports/
├── vendor-report.blade.php          # Vendor report view
├── delivery-report.blade.php        # Delivery report view
├── comparison-report.blade.php      # Comparison view
├── vendor-pdf.blade.php             # Vendor PDF export template
├── delivery-pdf.blade.php           # Delivery PDF export template
└── menu-item.blade.php              # Sidebar menu component

routes/
└── admin.php                        # Report routes
```

## Routes

### Custom Report Routes

#### Vendor Reports
- `GET /admin/vendor-report` - View vendor report
- `GET /admin/vendor-report/export-pdf` - Export vendor report as PDF
- `GET /admin/vendor-report/export-excel` - Export vendor report as Excel

#### Delivery Reports
- `GET /admin/delivery-report` - View delivery report
- `GET /admin/delivery-report/export-pdf` - Export delivery report as PDF
- `GET /admin/delivery-report/export-excel` - Export delivery report as Excel

#### Comparison Report
- `GET /admin/comparison-report` - View comparison report

## Query Parameters

All report endpoints support the following filters:

### Vendor Report Filters
```
from_date       : Date (format: YYYY-MM-DD)
to_date         : Date (format: YYYY-MM-DD)
status          : String (approved|pending|suspended|null)
sort_by         : String (earning|orders|rating)
```

### Delivery Report Filters
```
from_date       : Date (format: YYYY-MM-DD)
to_date         : Date (format: YYYY-MM-DD)
status          : String (active|inactive|null)
sort_by         : String (deliveries|earning|rating)
```

### Comparison Report Filters
```
from_date       : Date (format: YYYY-MM-DD)
to_date         : Date (format: YYYY-MM-DD)
limit           : Integer (5-50, default: 10)
```

## Example Usage

### View Vendor Report
```
/admin/vendor-report?from_date=2024-01-01&to_date=2024-12-31&status=approved&sort_by=earning
```

### Export Vendor Report as Excel
```
/admin/vendor-report/export-excel?from_date=2024-01-01&to_date=2024-12-31&sort_by=earning
```

### View Delivery Report
```
/admin/delivery-report?from_date=2024-01-01&to_date=2024-12-31&status=active&sort_by=deliveries
```

### Export Delivery Report as PDF
```
/admin/delivery-report/export-pdf?from_date=2024-01-01&to_date=2024-12-31
```

## Metrics Calculated

### Vendor Metrics
- **Total Earning**: Sum of all seller_amount from OrderTransaction where seller_is='seller'
- **Pending Balance**: Value from SellerWallet.pending_withdraw
- **Withdrawn**: Value from SellerWallet.withdrawn
- **Commission**: Sum of admin_commission from OrderTransaction
- **Order Count**: Total orders assigned to vendor in date range
- **Delivered Orders**: Orders with status='delivered'
- **Cancelled Orders**: Orders with status='cancelled'
- **Average Order Value**: Total order amount / number of orders
- **Delivery Rate**: (Delivered Orders / Total Orders) × 100
- **Rating**: Review rating from Review table

### Delivery Staff Metrics
- **Total Earning**: Sum from deliveryman_transactions
- **Pending Balance**: Value from DeliverymanWallet.pending_withdraw
- **Withdrawn**: Value from DeliverymanWallet.withdrawn
- **Total Deliveries**: Orders with order_status='delivered'
- **Pending Deliveries**: Orders with order_status in ['processing', 'shipped']
- **Cancelled Orders**: Orders with order_status='cancelled'
- **Success Rate**: (Total Deliveries / Total Orders) × 100
- **Average Rating**: Average rating from Review table
- **Review Count**: Total reviews for delivery staff

## Integration with Dashboard

To add these reports to your admin dashboard:

1. Include the menu item in your admin sidebar:
```blade
@include('admin-views.custom-reports.menu-item')
```

2. Add dashboard cards/widgets pointing to these reports

## Export Formats

### PDF Export
- Professional formatted PDF with company branding
- Includes report header with date range
- All metrics properly formatted with currency symbols
- Totals row for quick summary
- Page breaks for large reports

### Excel Export
- Clean spreadsheet format
- Column headers clearly labeled
- Numbers properly formatted (currency with 2 decimals, percentages)
- One sheet per report type
- Suitable for further analysis in Excel

## Permissions & Access Control

Currently, reports are accessible to admin users with 'admin_role_id==1' or appropriate module permissions.

To add role-based access control, modify the middleware in `routes/admin.php`:

```php
Route::group(['middleware' => ['admin', 'permission:view_vendor_reports']], function() {
    // Vendor report routes
});

Route::group(['middleware' => ['admin', 'permission:view_delivery_reports']], function() {
    // Delivery report routes
});
```

## Performance Considerations

For large databases with many transactions:

1. **Date Range Filtering**: Always use specific date ranges to limit query results
2. **Pagination**: For future enhancements, consider adding pagination to report views
3. **Caching**: Consider caching report results for frequently viewed periods
4. **Database Indexes**: Ensure the following columns are indexed:
   - Order.delivery_man_id
   - Order.seller_id
   - OrderTransaction.seller_id
   - OrderTransaction.seller_is
   - Review.delivery_man_id
   - deliveryman_transactions.delivery_man_id

## Customization

### Adding New Metrics

To add new metrics to vendor or delivery reports:

1. Add calculation logic in the map function within controller
2. Add new column header in blade template
3. Format and display in table row

### Modifying PDF Template

Edit the PDF blade templates (`vendor-pdf.blade.php`, `delivery-pdf.blade.php`) to customize:
- Header styling
- Column widths
- Footer information
- Page breaks

### Changing Export File Names

Modify the download filename in export methods:
```php
// Current format: vendor-report-2024-01-15-143022.pdf
$filename = 'custom-vendor-report-' . now()->format('Y-m-d-His') . '.pdf';
```

## Translation Keys Required

Add these translation keys to your language files:

```
Vendor_Performance_Report
Delivery_Staff_Performance_Report
Analyze_vendor_sales_performance_and_metrics
Monitor_delivery_performance_and_metrics
From_Date
To_Date
Status
Sort_By
Earning
Rating
Filter
Export_PDF
Export_Excel
Total_Vendors
Total_Earnings
Total_Orders
Avg_Order_Value
Shop_Name
Seller_Name
Phone
Pending_Balance
Orders
Delivered
Cancelled
Delivery_Rate
Total_Delivery_Staff
Total_Deliveries
Avg_Success_Rate
Active
Inactive
Success_Rate
Avg_Rating
Reviews
Vendor_Performance_Report
Delivery_Staff_Performance_Report
Top_Vendors_by_Earnings
Top_Delivery_Staff_by_Deliveries
No_vendors_found
No_delivery_staff_found
Comparison_Report
Compare_top_vendors_and_delivery_staff_performance
Custom_Reports
No_data_available
```

## Troubleshooting

### Reports showing no data
- Check date range is correct
- Verify orders exist in the database for selected period
- Check vendor/delivery staff status filters

### PDF export not working
- Ensure `barryvdh/laravel-dompdf` is installed
- Check file permissions for storage directory
- Verify PDF memory limit in php.ini

### Excel export not working
- Ensure `rap2hpoutre/fast-excel` is installed
- Check for special characters in data that might cause encoding issues

### Slow report loading
- Narrow down the date range
- Add database indexes on foreign keys
- Consider implementing pagination

## Dependencies

- Laravel 8.0+
- `barryvdh/laravel-dompdf` (already in project)
- `rap2hpoutre/fast-excel` (already in project)

## Security Notes

- Reports are accessible only to authenticated admin users
- All user inputs are sanitized through Laravel query builder
- Date ranges help prevent large dataset queries
- Consider adding additional permission checks for sensitive data

## Future Enhancements

- Add email scheduling for periodic report delivery
- Implement report caching for faster load times
- Add more detailed charts and visualizations
- Export to additional formats (CSV, JSON)
- Add custom report builder functionality
- Implement drill-down capabilities to view detailed transactions
- Add email to specific stakeholders with report summaries
