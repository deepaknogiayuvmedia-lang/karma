<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductPackageAndConditionImagesToReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->integer('product_package')->nullable();
            $table->integer('product_delivery')->nullable();
            $table->integer('product_quality')->nullable();
            $table->string('condition_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn('product_package');
            $table->dropColumn('product_delivery');
            $table->dropColumn('product_quality');
            $table->dropColumn('condition_images');
        });
    }
}
