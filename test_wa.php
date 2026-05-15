<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$res = \App\CPU\Helpers::send_whatsapp_notification('9876543210', 'canceled', 1);
file_put_contents('wa_res.json', json_encode(array_pop(\Illuminate\Support\Facades\Event::getRawListeners()??[]), JSON_PRETTY_PRINT));
