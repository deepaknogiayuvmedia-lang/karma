<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelhiverySettingsTable extends Migration
{
    public function up(): void
    {
        Schema::create('delhivery_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Delhivery');
            $table->string('environment')->default('staging');
            $table->string('base_url');
            $table->text('api_token')->nullable();
            $table->string('pickup_location')->nullable();
            $table->boolean('is_enabled')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delhivery_settings');
    }
}
