<?php

namespace App\Console\Commands;

use App\Model\OrderDetail;
use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdatePriceSuggestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:update-suggestions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update price suggestions for products based on market trends and performance.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Starting price suggestion updates...');

        

        $products = Product::where('pid', '!=' ,null)->get();
        $count = 0;
        
        foreach ($products as $product) {
            $has_orders = OrderDetail::where('product_id', $product->id)
                ->where('updated_at', '>=', Carbon::now()->subMinutes(2))             
                ->exists();
         
            $is_new = $product->updated_at  >= Carbon::now()->subMinutes(2);
            $is_not_approved = $product->request_status != 1;

            if (!$has_orders || $is_new || $is_not_approved) {
                $categories = json_decode($product->category_ids, true);
                
                if (isset($categories[0]['id'])) {
                    $category_id = $categories[0]['id'];
                    
                    $lowest_price = Product::where(['status' => 1, 'request_status' => 1])
                        ->where('id', '!=', $product->id)->where('pid', $product->pid)
                        ->min('actual_amount');
                    $this->info($lowest_price);
                    if ($lowest_price && $product->actual_amount > $lowest_price) {
                        $product->lowest_market_price = $lowest_price;
                        $product->suggested_price = $lowest_price - ($lowest_price/10);
                        $product->save();
                        $count++;
                    } else {
                        $product->lowest_market_price = 0;
                        $product->suggested_price = 0;
                        $product->save();
                    }
                } else {
                    $product->lowest_market_price = 0;
                    $product->suggested_price = 0;
                    $product->save();
                }
            } else {
                 $product->lowest_market_price = 0;
                        $product->suggested_price = 0;
                        $product->save();
            }
        }

        $this->info("Successfully updated {$count} products with price suggestions.");
        return 0;
    }
}
