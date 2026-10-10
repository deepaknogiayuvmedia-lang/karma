<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPacksTable extends Migration
{
    public function up()
    {
        Schema::create('product_packs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->index();
            $table->enum('type', ['single', 'multi'])->default('single');
            $table->string('name');
            $table->string('sub')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('mrp', 10, 2)->default(0);
            $table->integer('discount')->default(0);
            $table->string('unit_rate')->nullable();
            $table->string('badge')->nullable();
            $table->boolean('is_active')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_packs');
    }
}
