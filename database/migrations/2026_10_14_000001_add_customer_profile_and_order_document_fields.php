<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomerProfileAndOrderDocumentFields extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'farm_acres')) {
                $table->decimal('farm_acres', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('users', 'crops_sown')) {
                $table->text('crops_sown')->nullable();
            }
            if (!Schema::hasColumn('users', 'farm_latitude')) {
                $table->decimal('farm_latitude', 10, 7)->nullable();
            }
            if (!Schema::hasColumn('users', 'farm_longitude')) {
                $table->decimal('farm_longitude', 10, 7)->nullable();
            }
            if (!Schema::hasColumn('users', 'terms_accepted_at')) {
                $table->timestamp('terms_accepted_at')->nullable();
            }
            if (!Schema::hasColumn('users', 'terms_version')) {
                $table->string('terms_version', 32)->nullable();
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'terms_accepted_at')) {
                $table->timestamp('terms_accepted_at')->nullable();
            }
            if (!Schema::hasColumn('orders', 'terms_version')) {
                $table->string('terms_version', 32)->nullable();
            }
            if (!Schema::hasColumn('orders', 'original_invoice_path')) {
                $table->string('original_invoice_path')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['farm_acres', 'crops_sown', 'farm_latitude', 'farm_longitude', 'terms_accepted_at', 'terms_version'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            $columns = ['terms_accepted_at', 'terms_version', 'original_invoice_path'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('orders', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
}
