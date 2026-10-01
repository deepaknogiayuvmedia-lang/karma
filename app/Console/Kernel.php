<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Sync temp products to products table every minute
        $schedule->command('sync:temp-products')->everyMinute();
        
        // Update product auto indexing based on price, reviews, and stock
        $schedule->command('products:update-indexing')->everyMinute();

        // Update seller ranking based on reviews, delivery speed, and product count
        $schedule->command('update:seller-ranking')->everySixHours();

        // Update price suggestions based on market trends and performance
        $schedule->command('price:update-suggestions')->everySixHours();

        // Recalculate product ranking scores based on priority, performance, and reviews
        $schedule->command('products:update-ranking')->daily();

        // Poll Delhivery for shipment status and update order statuses
        $schedule->command('orders:sync-delhivery-status')->everyFiveMinutes();

        // Keep Delhivery shipment records in sync with the carrier
        $schedule->command('delhivery:sync-tracking')->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
