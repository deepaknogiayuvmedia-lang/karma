<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnvironmentToThirdPartyShippingMethodsTable extends Migration
{
    public function up()
    {
        Schema::table('third_party_shipping_methods', function (Blueprint $table) {
            $table->string('environment', 10)->default('test')->after('status');
        });
    }

    public function down()
    {
        Schema::table('third_party_shipping_methods', function (Blueprint $table) {
            $table->dropColumn('environment');
        });
    }
}
