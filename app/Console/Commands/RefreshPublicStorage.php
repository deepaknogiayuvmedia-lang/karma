<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RefreshPublicStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'storage:refresh-public';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete public/storage and recreate storage link';

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
        $path = public_path('public/storage');
        // PowerShell: Remove-Item -Path "public/storage" -Recurse -Force
        if (File::exists($path)) {
            File::deleteDirectory($path);          // folder + sab content delete[web:116]
            $message = $this->info('public/storage deleted.');
        } else {
            $message = $this->info('public/storage not found, skipping delete.');
        }
        Log::info('[storage:refresh-public] ' . $message);   // log me likho[web:139][web:152]
        // PHP: php artisan storage:link
        $this->call('storage:link');               // built‑in artisan command[web:86]
        $this->info('storage:link executed.');
        $linkMsg = 'storage:link executed. The [' . public_path('storage') . '] link has been connected to [' . storage_path('app/public') . '].';

        Log::info('[storage:refresh-public] ' . $linkMsg);   // log me bhi same line[web:139]
        return Command::SUCCESS;
    }
}
