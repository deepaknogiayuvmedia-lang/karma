<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFarmLocationAddressToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'farm_location_name')) {
                $table->string('farm_location_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'farm_address')) {
                $table->text('farm_address')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'farm_location_name')) {
                $table->dropColumn('farm_location_name');
            }
            if (Schema::hasColumn('users', 'farm_address')) {
                $table->dropColumn('farm_address');
            }
        });
    }
}
