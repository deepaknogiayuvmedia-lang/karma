<?php

namespace App\Console\Commands;

use App\CPU\OrderStatusSync;
use App\Model\Order;
use App\Models\DelhiveryShipment;
use App\Services\DelhiveryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SyncDelhiveryTracking extends Command
{
    protected $signature = 'delhivery:sync-tracking {--limit=50 : Maximum number of shipments to check per run}';

    protected $description = 'Sync Delhivery shipment tracking data and update local status records.';

    public function handle(): int
    {
        $limit = max(1, (int) $this->option('limit'));

        $shipments = DelhiveryShipment::query()
            ->whereNotNull('waybill')
            ->whereNotIn('status', ['delivered', 'cancelled', 'failed'])
            ->orderByDesc('id')
            ->limit($limit)
            ->get();

        if ($shipments->isEmpty()) {
            return $this->syncOrderShipments($limit);
        }

        $service = new DelhiveryService();

        foreach ($shipments as $shipment) {
            try {
                $tracking = $service->trackShipment($shipment->waybill);
                $shipment->tracking_payload = $tracking;
                $shipment->last_synced_at = now();

                $courierStatus = data_get($tracking, 'ShipmentData.0.Shipment.Status.Status')
                    ?? data_get($tracking, 'ShipmentData.0.Shipment.Status')
                    ?? data_get($tracking, 'ShipmentData.0.Status.Status')
                    ?? $shipment->tracking_status;

                $shipment->tracking_status = $courierStatus ?? $shipment->tracking_status;

                $mappedStatus = $courierStatus ? OrderStatusSync::map_delhivery_status($courierStatus) : null;

                if ($mappedStatus) {
                    $order = Order::query()
                        ->where('third_party_delivery_tracking_id', $shipment->waybill)
                        ->where('delivery_service_name', 'Delhivery')
                        ->first();

                    if ($order) {
                        OrderStatusSync::apply($order, $mappedStatus, 'Delhivery tracking sync');
                    }

                    if ($mappedStatus === 'delivered') {
                        $shipment->status = 'delivered';
                    } elseif ($mappedStatus === 'canceled' || $mappedStatus === 'returned' || $mappedStatus === 'failed') {
                        $shipment->status = $mappedStatus;
                    } elseif ($shipment->status === 'created' || $shipment->status === 'processing') {
                        $shipment->status = 'in_transit';
                    }
                }

                $shipment->save();
            } catch (\Throwable $exception) {
                Log::error('Delhivery tracking sync failed', [
                    'shipment_id' => $shipment->id,
                    'waybill' => $shipment->waybill,
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        $this->info('Delhivery tracking sync completed.');

        return 0;
    }

    private function syncOrderShipments(int $limit): int
    {
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

        $service = new DelhiveryService();

        foreach ($orders as $order) {
            try {
                $tracking = $service->trackShipment($order->third_party_delivery_tracking_id);
                $courierStatus = data_get($tracking, 'ShipmentData.0.Shipment.Status.Status')
                    ?? data_get($tracking, 'ShipmentData.0.Shipment.Status')
                    ?? data_get($tracking, 'ShipmentData.0.Status.Status');
                $mappedStatus = $courierStatus ? OrderStatusSync::map_delhivery_status($courierStatus) : null;

                if ($mappedStatus) {
                    OrderStatusSync::apply($order, $mappedStatus, 'Delhivery tracking sync');
                }
            } catch (\Throwable $exception) {
                Log::error('Delhivery order tracking sync failed', [
                    'order_id' => $order->id,
                    'waybill' => $order->third_party_delivery_tracking_id,
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        $this->info('Delhivery order tracking sync completed.');

        return 0;
    }
}
