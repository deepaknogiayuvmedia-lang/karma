<?php

namespace App\Console\Commands;

use App\Model\Product;
use App\Model\OrderDetail;
use App\Model\Tempproduct;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncTempProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:temp-products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync qty and price from tempproducts table to products table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tempProducts = Tempproduct::whereNotNull('product_id')->get();

        if ($tempProducts->isEmpty()) {
            $this->info('No temp products found to sync.');
            Log::info('SyncTempProducts: No temp products found.');
            return 0;
        }

        $synced = 0;
        $failed = 0;

        foreach ($tempProducts as $temp) {
            try {
                $product = Product::find($temp->product_id);

                if (!$product) {
                    $this->warn("Product ID {$temp->product_id} not found, skipping.");
                    $failed++;
                    continue;
                }

                $update_data = [];

                // Calculate pending order qty for this product+variant
                $pending_statuses = ['pending', 'confirmed', 'processing', 'out_for_delivery'];

                // Update variation qty and price if variant is specified
                if (!empty($temp->variant)) {
                    $variations = json_decode($product->variation, true);

                    // Get pending qty for this specific variant
                    $pending_qty = OrderDetail::where('product_id', $temp->product_id)
                        ->where('variant', $temp->variant)
                        ->whereHas('order', function($q) use ($pending_statuses) {
                            $q->whereIn('order_status', $pending_statuses);
                        })
                        ->sum('qty');

                    if (is_array($variations)) {
                        $variant_found = false;
                        $total_qty = 0;

                        foreach ($variations as &$var) {
                            if ($var['type'] == $temp->variant) {
                                // Tally qty minus pending order qty
                                $var['qty'] = max(0, $temp->qty - $pending_qty);
                                $var['price'] = $temp->rate;
                                $variant_found = true;
                            }
                            $total_qty += $var['qty'];
                        }
                        unset($var);

                        if ($variant_found) {
                            $update_data['variation'] = json_encode($variations);
                            $update_data['current_stock'] = $total_qty;
                            $this->info("  -> Pending orders qty: {$pending_qty}, Available: " . max(0, $temp->qty - $pending_qty));
                        } else {
                            $this->warn("Variant '{$temp->variant}' not found in Product ID {$temp->product_id}, skipping.");
                            $failed++;
                            continue;
                        }
                    }
                } else {
                    // No variant — get total pending qty for this product
                    $pending_qty = OrderDetail::where('product_id', $temp->product_id)
                        ->whereHas('order', function($q) use ($pending_statuses) {
                            $q->whereIn('order_status', $pending_statuses);
                        })
                        ->sum('qty');

                    $update_data['current_stock'] = max(0, $temp->qty - $pending_qty);
                    $update_data['unit_price'] = $temp->rate;
                    $this->info("  -> Pending orders qty: {$pending_qty}, Available: " . max(0, $temp->qty - $pending_qty));
                }

                Product::where('id', $temp->product_id)->update($update_data);
                $synced++;

                $this->info("Synced Product ID {$temp->product_id}" . (!empty($temp->variant) ? " variant: {$temp->variant}" : '') . " | qty: {$temp->qty}, rate: {$temp->rate}");

            } catch (\Exception $e) {
                $this->error("Error syncing Product ID {$temp->product_id}: " . $e->getMessage());
                Log::error("SyncTempProducts Error: Product ID {$temp->product_id} - " . $e->getMessage());
                $failed++;
            }
        }

        // Clear temp products after sync
        Tempproduct::whereNotNull('product_id')->delete();

        $this->info("Sync complete. Synced: {$synced}, Failed: {$failed}");
        Log::info("SyncTempProducts: Synced: {$synced}, Failed: {$failed}");

        return 0;
    }
}
