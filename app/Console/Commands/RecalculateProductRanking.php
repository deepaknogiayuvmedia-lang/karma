<?php

namespace App\Console\Commands;

use App\CPU\ProductRanking;
use Illuminate\Console\Command;

class RecalculateProductRanking extends Command
{
    protected $signature = 'products:update-ranking';
    protected $description = 'Recalculate product ranking scores based on priority, price, performance, and reviews';

    public function handle()
    {
        $this->info('Starting product ranking recalculation...');

        ProductRanking::recalculateAll();

        $this->info('Product ranking recalculation completed successfully.');
    } 
}
