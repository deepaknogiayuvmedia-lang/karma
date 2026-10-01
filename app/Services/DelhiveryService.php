<?php

namespace App\Services;

use App\CPU\Helpers;
use App\Model\ThirdPartyShippingMethod;
use App\Models\DelhiverySetting;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class DelhiveryService
{
    protected function settings(): DelhiverySetting
    {
        $settings = DelhiverySetting::query()
            ->where('is_enabled', true)
            ->latest('id')
            ->first();

        if (!$settings) {
            $legacy = ThirdPartyShippingMethod::query()
                ->where('status', 1)
                ->latest('id')
                ->first();

            if ($legacy && !empty($legacy->api_secret)) {
                $legacyEnv = strtolower((string) ($legacy->environment ?? 'test'));
                $isLive = in_array($legacyEnv, ['live', 'production'], true);

                $settings = new DelhiverySetting([
                    'name' => 'Delhivery',
                    'environment' => $isLive ? 'production' : 'staging',
                    'base_url' => $isLive
                        ? 'https://track.delhivery.com'
                        : 'https://staging-express.delhivery.com',
                    'api_token' => $legacy->api_secret,
                    'pickup_location' => 'Default Warehouse',
                    'is_enabled' => true,
                ]);
            }
        }

        if (!$settings || empty($settings->api_token) || empty($settings->base_url)) {
            throw new RuntimeException('Delhivery is not configured or enabled.');
        }

        return $settings;
    }

    protected function client()
    {
        $settings = $this->settings();

        return Http::baseUrl(rtrim($settings->base_url, '/'))
            ->withHeaders([
                'Authorization' => 'Token ' . $settings->api_token,
                'Accept' => 'application/json',
            ])
            ->timeout(45);
    }

    public function getPinCode(string $pinCode): array
    {
        $response = $this->client()->get('/c/api/pin-codes/json/', [
            'filter_codes' => $pinCode,
        ]);

        if (!$response->successful()) {
            throw new RuntimeException('Delhivery PIN-code lookup failed: HTTP ' . $response->status());
        }

        return $response->json() ?? [];
    }

    public function createShipment(array $payload): array
    {
        $response = $this->client()
            ->asForm()
            ->post('/api/cmu/create.json', [
                'format' => 'json',
                'data' => json_encode($payload),
            ]);

        if (!$response->successful()) {
            throw new RuntimeException(
                'Delhivery shipment creation failed: HTTP ' . $response->status() . ' - ' . $response->body()
            );
        }

        return $response->json() ?? [];
    }

    public function trackShipment(string $waybill): array
    {
        $response = $this->client()->get('/api/v1/packages/json/', [
            'waybill' => $waybill,
        ]);

        if (!$response->successful()) {
            throw new RuntimeException('Delhivery tracking failed: HTTP ' . $response->status());
        }

        return $response->json() ?? [];
    }

    public function cancelShipment(string $waybill): array
    {
        $response = $this->client()->asForm()->post('/api/p/edit', [
            'waybill' => $waybill,
            'cancellation' => 'true',
        ]);

        if (!$response->successful()) {
            throw new RuntimeException('Delhivery cancellation failed: HTTP ' . $response->status());
        }

        return $response->json() ?? [];
    }
}
