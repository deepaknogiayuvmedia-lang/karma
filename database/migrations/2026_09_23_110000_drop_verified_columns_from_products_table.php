<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            foreach (['verified', 'verified_by', 'verified_at'] as $column) {
                if (Schema::hasColumn('products', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'verified')) {
                $table->tinyInteger('verified')->default(0);
            }
            if (!Schema::hasColumn('products', 'verified_by')) {
                $table->unsignedBigInteger('verified_by')->nullable();
            }
            if (!Schema::hasColumn('products', 'verified_at')) {
                $table->timestamp('verified_at')->nullable();
            }
        });
    }
};
