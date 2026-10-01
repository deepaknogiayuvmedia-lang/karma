<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\shepping;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Models\DelhiverySetting;
use App\Models\DelhiveryShipment;
use App\Services\DelhiveryService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DelhiveryController extends Controller
{
    public function settings()
    {
        $settings = DelhiverySetting::query()->latest('id')->first();

        return view('admin.delhivery.settings', compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        $request->validate([
            'environment' => ['required', 'in:test,live'],
            'base_url' => ['required', 'url'],
            'api_token' => ['nullable', 'string', 'max:5000'],
            'pickup_location' => ['required', 'string', 'max:255'],
            'is_enabled' => ['nullable', 'boolean'],
        ]);

        $settings = DelhiverySetting::query()->latest('id')->first();
        $environment = $request->environment === 'live' ? 'production' : 'staging';

        $payload = [
            'name' => 'Delhivery',
            'environment' => $environment,
            'base_url' => $request->base_url,
            'pickup_location' => $request->pickup_location,
            'is_enabled' => (bool) $request->boolean('is_enabled'),
        ];

        if ($request->filled('api_token')) {
            $payload['api_token'] = $request->api_token;
        }

        $saved = DelhiverySetting::query()->updateOrCreate(
            ['id' => $settings?->id],
            $payload
        );

        if ($saved && $saved->is_enabled) {
            $legacy = Helpers::get_shipping_config();
            if ($legacy) {
                $legacy->update([
                    'api_secret' => $request->filled('api_token') ? $request->api_token : $legacy->api_secret,
                    'environment' => $request->environment === 'live' ? 'live' : 'test',
                    'status' => 1,
                ]);
            }
        }

        Toastr::success('Delhivery settings saved successfully!');

        return back();
    }

    public function createShipment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        $existing = DelhiveryShipment::query()
            ->where('order_id', $order->id)
            ->whereNotIn('status', ['failed'])
            ->first();

        if ($existing) {
            Toastr::warning('A shipment already exists for this order.');
            return back();
        }

        $result = shepping::CreateShipment($order->id);

        if (($result['status'] ?? null) === 'success' || ($result['status'] ?? null) === 'partial') {
            $waybill = $result['waybill'] ?? null;
            DelhiveryShipment::query()->create([
                'order_id' => $order->id,
                'provider' => 'delhivery',
                'client_reference' => (string) $order->id,
                'waybill' => $waybill,
                'status' => $result['status'] === 'success' ? 'created' : 'processing',
                'tracking_status' => 'created',
                'pickup_location' => $order->pick_up_location ?? null,
                'cod_amount' => $order->payment_method === 'cash_on_delivery' ? $order->order_amount : 0,
                'weight_kg' => 0.5,
                'request_payload' => $result['data'] ?? [],
                'response_payload' => $result['data'] ?? [],
                'error_message' => $result['message'] ?? null,
            ]);

            Toastr::success('Shipment created successfully on Delhivery.');
            return back();
        }

        $message = $result['message'] ?? 'Unable to create Delhivery shipment.';
        Log::error('Delhivery controller shipment creation failed', ['order_id' => $order->id, 'message' => $message]);
        Toastr::error('Delhivery Shipment Error: ' . $message);

        return back();
    }

    public function syncTracking(DelhiveryShipment $shipment)
    {
        try {
            $service = new DelhiveryService();
            $tracking = $service->trackShipment($shipment->waybill);
            $shipment->tracking_payload = $tracking;
            $shipment->last_synced_at = now();
            $shipment->save();

            Toastr::success('Delhivery tracking synced successfully.');
        } catch (\Throwable $exception) {
            Log::error('Delhivery syncTracking error', ['shipment_id' => $shipment->id, 'message' => $exception->getMessage()]);
            Toastr::error('Tracking sync failed: ' . $exception->getMessage());
        }

        return back();
    }

    public function cancelShipment(DelhiveryShipment $shipment)
    {
        try {
            $service = new DelhiveryService();
            $service->cancelShipment($shipment->waybill);
            $shipment->status = 'cancel_requested';
            $shipment->cancel_requested_at = now();
            $shipment->save();

            Toastr::success('Delhivery cancellation requested successfully.');
        } catch (\Throwable $exception) {
            Log::error('Delhivery cancellation error', ['shipment_id' => $shipment->id, 'message' => $exception->getMessage()]);
            Toastr::error('Cancellation failed: ' . $exception->getMessage());
        }

        return back();
    }
}
