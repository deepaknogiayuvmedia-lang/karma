<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateSellerRanking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:seller-ranking';
    protected $description = 'Updates the ranking of sellers based on reviews, delivery speed, and product visibility.';

    public function handle()
    {
        $sellers = \App\Model\Seller::approved()->get();
        if ($sellers->isEmpty()) {
            $this->info('No approved sellers found.');
            return 0;
        }

        $max_products = \App\Model\Product::active()->where(['added_by' => 'seller'])->groupBy('user_id')->selectRaw('user_id, count(*) as total')->orderByDesc('total')->first();
        $max_product_count = $max_products ? $max_products->total : 1;

        $seller_scores = [];

        foreach ($sellers as $seller) {
            $score = 0;

            // 1. Review Score (Avg Rating >= 3) - Weight 40%
            $avg_rating = \App\Model\Review::whereHas('product', function($q) use($seller) {
                $q->where(['user_id' => $seller->id, 'added_by' => 'seller']);
            })->avg('rating') ?? 0;

            if ($avg_rating >= 3) {
                $score += ($avg_rating / 5) * 40;
            }

            // 2. Delivery Score (Fast Delivery) - Weight 30%
            // Assuming we calculate performance from created_at to updated_at for 'delivered' status orders
            $avg_delivery_days = \App\Model\Order::where(['seller_id' => $seller->id, 'order_status' => 'delivered'])
                ->whereNotNull('updated_at')
                ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
                ->first()->avg_days ?? 10; // Default 10 days if no data

            // Fast delivery score (less days = more score, e.g., 1 day = 100%, 10+ days = 0%)
            $delivery_score = max(0, (10 - $avg_delivery_days) / 10) * 30;
            $score += $delivery_score;

            // 3. Visibility Score (More products) - Weight 30%
            $product_count = \App\Model\Product::active()->where(['user_id' => $seller->id, 'added_by' => 'seller'])->lowestPricePerPid()->count();
            $score += ($product_count / $max_product_count) * 30;

            $seller_scores[] = [
                'id' => $seller->id,
                'score' => $score
            ];
        }

        // Sort by score descending
        usort($seller_scores, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        foreach ($seller_scores as $index => $item) {
            \App\Model\Seller::where('id', $item['id'])->update([
                'seller_rank' => $index + 1,
                'rank_score' => $item['score']
            ]);
        }

        $this->info('Seller rankings updated successfully.');
        return 0;
    }
}
