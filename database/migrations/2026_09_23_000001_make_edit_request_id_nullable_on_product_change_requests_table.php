<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeEditRequestIdNullableOnProductChangeRequestsTable extends Migration
{
    public function up()
    {
        Schema::table('product_change_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('edit_request_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('product_change_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('edit_request_id')->nullable(false)->change();
        });
    }
}
