<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelhiveryShipmentsTable extends Migration
{
    public function up(): void
    {
        Schema::create('delhivery_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->index();
            $table->string('provider')->default('delhivery');
            $table->string('client_reference')->nullable();
            $table->string('waybill')->nullable()->index();
            $table->string('shipment_reference')->nullable();
            $table->string('status')->default('pending')->index();
            $table->string('tracking_status')->nullable();
            $table->string('pickup_location')->nullable();
            $table->decimal('cod_amount', 12, 2)->default(0);
            $table->decimal('weight_kg', 10, 3)->nullable();
            $table->json('request_payload')->nullable();
            $table->json('response_payload')->nullable();
            $table->json('tracking_payload')->nullable();
            $table->text('error_message')->nullable();
            $table->timestamp('created_at_carrier')->nullable();
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamp('cancel_requested_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delhivery_shipments');
    }
}
