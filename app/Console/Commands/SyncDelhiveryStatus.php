<?php

namespace App\Console\Commands;

use App\CPU\OrderStatusSync;
use App\CPU\shepping;
use App\Model\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncDelhiveryStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:sync-delhivery-status {--limit=50 : Maximum number of orders to check per run}';

    protected $description = 'Poll Delhivery for shipment status and automatically update matching order statuses.';

    public function handle()
    {
        $limit = max(1, (int) $this->option('limit'));

        $orders = Order::query()
            ->whereNotNull('third_party_delivery_tracking_id')
            ->where('delivery_service_name', 'Delhivery')
            ->whereNotIn('order_status', ['delivered', 'canceled', 'returned', 'failed'])
            ->orderByDesc('id')
            ->limit($limit)
            ->get();

        if ($orders->isEmpty()) {
            $this->info('No active Delhivery shipments to sync.');
            return 0;
        }

        $checked = $updated = $skipped = $errors = 0;

        foreach ($orders as $order) {
            $checked++;

            try {
                $result = shepping::track_shipment($order->third_party_delivery_tracking_id);
            } catch (\Exception $e) {
                $errors++;
                Log::error('Delhivery status sync: tracking API exception', [
                    'order_id' => $order->id,
                    'message' => $e->getMessage(),
                ]);
                continue;
            }

            if (($result['status'] ?? 'error') != 'success') {
                $errors++;
                Log::error('Delhivery status sync: tracking API failed', [
                    'order_id' => $order->id,
                    'waybill' => $order->third_party_delivery_tracking_id,
                    'message' => $result['message'] ?? 'Unknown error',
                ]);
                continue;
            }

            $shipment = $result['data']['ShipmentData'][0]['Shipment'] ?? null;
            if (!$shipment) {
                $skipped++;
                Log::info('Delhivery status sync: no shipment data returned', [
                    'order_id' => $order->id,
                    'waybill' => $order->third_party_delivery_tracking_id,
                ]);
                continue;
            }

            $courier_status = $shipment['Status']['Status'] ?? null;
            $mapped = OrderStatusSync::map_delhivery_status($courier_status);

            if ($mapped === null) {
                $skipped++;
                Log::info('Delhivery status sync: unmapped courier status', [
                    'order_id' => $order->id,
                    'courier_status' => $courier_status,
                ]);
                continue;
            }

            $previous_status = $order->order_status;

            if (OrderStatusSync::apply($order, $mapped)) {
                $updated++;
                $this->line(sprintf(
                    'Order #%s: %s -> %s (courier: %s)',
                    $order->id,
                    $previous_status,
                    $mapped,
                    $courier_status
                ));
            } else {
                $skipped++;
            }
        }

        $this->info(sprintf(
            'Delhivery status sync complete. Checked: %d, Updated: %d, Skipped: %d, Errors: %d',
            $checked,
            $updated,
            $skipped,
            $errors
        ));

        return 0;
    }
}
