<?php

namespace Tests\Unit;

use App\CPU\OrderStatusSync;
use PHPUnit\Framework\TestCase;

class DelhiveryTrackingStatusTest extends TestCase
{
    public function test_maps_delivered_status(): void
    {
        $this->assertSame('delivered', OrderStatusSync::map_delhivery_status('Delivered'));
    }

    public function test_maps_out_for_delivery_status(): void
    {
        $this->assertSame('out_for_delivery', OrderStatusSync::map_delhivery_status('Out For Delivery'));
    }

    public function test_maps_cancelled_status(): void
    {
        $this->assertSame('canceled', OrderStatusSync::map_delhivery_status('Cancelled by customer'));
    }

    public function test_maps_not_picked_status_as_cancelled(): void
    {
        $this->assertSame('canceled', OrderStatusSync::map_delhivery_status('Not Picked'));
    }
}
