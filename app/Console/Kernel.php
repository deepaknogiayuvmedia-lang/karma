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
        // Sync temp products to products table every 5 minutes
        $schedule->command('sync:temp-products')->everySecond();
        
        // Update product auto indexing based on price, reviews, and stock
        $schedule->command('products:update-indexing')->everyMinute();

        // Update seller ranking based on reviews, delivery speed, and product count
        $schedule->command('update:seller-ranking')->everySixHours();

        // Update price suggestions based on market trends and performance
        $schedule->command('price:update-suggestions')->everySixHours();
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
