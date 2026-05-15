<?php

namespace App\CPU;

use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Helper class for vendor and delivery report calculations
 */
class ReportHelper
{
    /**
     * Format currency value
     */
    public static function format_currency($amount, $decimals = 2)
    {
        return currency_symbol() . number_format($amount, $decimals);
    }

    /**
     * Format percentage value
     */
    public static function format_percentage($value, $decimals = 1)
    {
        return number_format($value, $decimals) . '%';
    }

    /**
     * Get date range for reports
     */
    public static function get_date_range($from_date = null, $to_date = null)
    {
        $from = $from_date ? Carbon::parse($from_date) : Carbon::now()->subMonth();
        $to = $to_date ? Carbon::parse($to_date) : Carbon::now();

        return ['from' => $from, 'to' => $to];
    }

    /**
     * Get status badge class
     */
    public static function get_status_badge($status)
    {
        switch ($status) {
            case 'approved':
            case 'active':
            case 'delivered':
                return 'badge-success';
            case 'pending':
                return 'badge-warning';
            case 'cancelled':
            case 'inactive':
            case 'suspended':
                return 'badge-danger';
            default:
                return 'badge-secondary';
        }
    }

    /**
     * Calculate success rate
     */
    public static function calculate_success_rate($successful, $total)
    {
        if ($total == 0) {
            return 0;
        }
        return ($successful / $total) * 100;
    }

    /**
     * Get report statistics summary
     */
    public static function get_summary_stats(Collection $data, $metric_field)
    {
        return [
            'total' => $data->sum($metric_field),
            'average' => $data->avg($metric_field),
            'max' => $data->max($metric_field),
            'min' => $data->min($metric_field),
        ];
    }

    /**
     * Export array to CSV format
     */
    public static function to_csv_array(array $data)
    {
        $csv = [];
        foreach ($data as $row) {
            if (is_object($row)) {
                $csv[] = (array)$row;
            } else {
                $csv[] = $row;
            }
        }
        return $csv;
    }

    /**
     * Get vendor performance level
     */
    public static function get_vendor_performance_level($successful_deliveries, $total_orders, $average_rating)
    {
        $success_rate = self::calculate_success_rate($successful_deliveries, $total_orders);

        if ($success_rate >= 95 && $average_rating >= 4.5) {
            return ['level' => 'excellent', 'color' => 'success'];
        } elseif ($success_rate >= 85 && $average_rating >= 4.0) {
            return ['level' => 'good', 'color' => 'info'];
        } elseif ($success_rate >= 70 && $average_rating >= 3.0) {
            return ['level' => 'average', 'color' => 'warning'];
        } else {
            return ['level' => 'poor', 'color' => 'danger'];
        }
    }

    /**
     * Get delivery performance level
     */
    public static function get_delivery_performance_level($deliveries_completed, $total_orders, $average_rating)
    {
        $success_rate = self::calculate_success_rate($deliveries_completed, $total_orders);

        if ($success_rate >= 98 && $average_rating >= 4.7) {
            return ['level' => 'excellent', 'color' => 'success'];
        } elseif ($success_rate >= 95 && $average_rating >= 4.3) {
            return ['level' => 'very_good', 'color' => 'info'];
        } elseif ($success_rate >= 90 && $average_rating >= 3.8) {
            return ['level' => 'good', 'color' => 'primary'];
        } elseif ($success_rate >= 85 && $average_rating >= 3.5) {
            return ['level' => 'satisfactory', 'color' => 'warning'];
        } else {
            return ['level' => 'needs_improvement', 'color' => 'danger'];
        }
    }

    /**
     * Generate report header
     */
    public static function generate_report_header($report_name, $from_date, $to_date)
    {
        return [
            'title' => $report_name,
            'from_date' => Carbon::parse($from_date)->format('Y-m-d'),
            'to_date' => Carbon::parse($to_date)->format('Y-m-d'),
            'generated_at' => now()->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Get trend indicator
     */
    public static function get_trend($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 'up' : 'stable';
        }

        $percentage = (($current - $previous) / $previous) * 100;

        if ($percentage > 10) {
            return 'up';
        } elseif ($percentage < -10) {
            return 'down';
        } else {
            return 'stable';
        }
    }
}
