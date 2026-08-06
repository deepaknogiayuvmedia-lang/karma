<?php

namespace App\CPU;

use App\Model\Product;
use App\Model\OrderDetail;
use App\Model\BusinessSetting;
use Illuminate\Support\Facades\DB;

class ProductRanking
{
    /**
     * Default weights for each ranking factor (total = 100).
     * Configurable via admin BusinessSettings.
     */
    private static function getWeights()
    {
        $stored = BusinessSetting::where('type', 'ranking_weights')->first();
        if ($stored && $stored->value) {
            return json_decode($stored->value, true);
        }
        return [
            'price'         => 20,
            'dispatch'      => 15,
            'cancel_return' => 20,
            'damage'        => 15,
            'review'        => 15,
            'delivery'      => 15,
        ];
    }

    /**
     * Calculate and update ranking score for all products.
     */
    public static function recalculateAll()
    {
        $products = Product::where('status', 1)
            ->where('approval_status', 'approved')
            ->get();

        foreach ($products as $product) {
            $score = self::calculateScore($product);
            $product->update(['ranking_score' => $score]);
        }
    }

    /**
     * Calculate ranking score for a single product.
     * Each factor is normalized to 0-1, then multiplied by its weight.
     */
    public static function calculateScore(Product $product)
    {
        $weights = self::getWeights();
        $score = 0;

        // 1. Price Factor (lower price = higher score)
        $maxPrice = Product::where('status', 1)
            ->where('approval_status', 'approved')
            ->max('unit_price') ?? 1;
        $priceScore = 1 - ($product->unit_price / $maxPrice);
        $score += $priceScore * ($weights['price'] ?? 20);

        // 2. Fast Dispatch (delivered on/before expected date)
        $dispatchRate = self::getFastDispatchRate($product->id);
        $score += $dispatchRate * ($weights['dispatch'] ?? 15);

        // 3. Low Cancel + Return Rate
        $cancelRate = self::getCancelRate($product->id);
        $returnRate = self::getReturnRate($product->id);
        $cancelReturnScore = 1 - (($cancelRate + $returnRate) / 2);
        $score += $cancelReturnScore * ($weights['cancel_return'] ?? 20);

        // 4. Low Damage Rate (1-star reviews as proxy)
        $damageRate = self::getDamageRate($product->id);
        $score += (1 - $damageRate) * ($weights['damage'] ?? 15);

        // 5. Review Rating
        $avgRating = $product->reviews()->whereNull('delivery_man_id')->avg('rating') ?? 0;
        $reviewScore = $avgRating / 5;
        $score += $reviewScore * ($weights['review'] ?? 15);

        // 6. Delivery Charges (free shipping = best, lower cost = better)
        $deliveryScore = self::getDeliveryScore($product);
        $score += $deliveryScore * ($weights['delivery'] ?? 15);

        return round($score, 4);
    }

    /**
     * Get the rate of orders delivered on or before expected date.
     * Returns float 0-1.
     */
    private static function getFastDispatchRate($productId)
    {
        $totalDelivered = OrderDetail::where('product_id', $productId)
            ->where('delivery_status', 'delivered')
            ->count();

        if ($totalDelivered == 0) {
            return 0.5;
        }

        $onTimeDelivered = DB::table('order_details')
            ->join('orders', 'order_details.order_id', '=', 'orders.id')
            ->where('order_details.product_id', $productId)
            ->where('order_details.delivery_status', 'delivered')
            ->whereNotNull('orders.expected_delivery_date')
            ->where('order_details.updated_at', '<=', DB::raw('orders.expected_delivery_date'))
            ->count();

        return $onTimeDelivered / $totalDelivered;
    }

    /**
     * Get the cancellation rate for a product.
     * Returns float 0-1.
     */
    private static function getCancelRate($productId)
    {
        $totalOrders = OrderDetail::where('product_id', $productId)->count();
        if ($totalOrders == 0) return 0;

        $cancelledOrders = OrderDetail::where('product_id', $productId)
            ->where('delivery_status', 'cancelled')
            ->count();

        return $cancelledOrders / $totalOrders;
    }

    /**
     * Get the return rate for a product.
     * Returns float 0-1.
     */
    private static function getReturnRate($productId)
    {
        $totalOrders = OrderDetail::where('product_id', $productId)->count();
        if ($totalOrders == 0) return 0;

        $returnedOrders = OrderDetail::where('product_id', $productId)
            ->where('delivery_status', 'returned')
            ->count();

        return $returnedOrders / $totalOrders;
    }

    /**
     * Get the damage complaint rate for a product.
     * Returns float 0-1 (1-star reviews as proxy).
     */
    private static function getDamageRate($productId)
    {
        $totalReviews = DB::table('reviews')
            ->where('product_id', $productId)
            ->whereNull('delivery_man_id')
            ->count();

        if ($totalReviews == 0) return 0;

        $damageReviews = DB::table('reviews')
            ->where('product_id', $productId)
            ->whereNull('delivery_man_id')
            ->where('rating', '<=', 1)
            ->count();

        return $damageReviews / $totalReviews;
    }

    /**
     * Get delivery score for a product.
     * Free shipping = 1.0, paid = normalized lower cost = better.
     * Returns float 0-1.
     */
    private static function getDeliveryScore(Product $product)
    {
        if ($product->free_shipping) {
            return 1.0;
        }

        $maxShipping = Product::where('status', 1)
            ->where('approval_status', 'approved')
            ->where('free_shipping', 0)
            ->max('shipping_cost') ?? 1;

        if ($product->shipping_cost > 0) {
            return 1 - ($product->shipping_cost / $maxShipping);
        }

        return 0.5;
    }
}
