<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToSellerNotificationsTable extends Migration
{
    public function up()
    {
        $missingColumns = [];

        if (!Schema::hasColumn('seller_notifications', 'seller_id')) {
            $missingColumns[] = 'seller_id';
        }
        if (!Schema::hasColumn('seller_notifications', 'product_id')) {
            $missingColumns[] = 'product_id';
        }
        if (!Schema::hasColumn('seller_notifications', 'title')) {
            $missingColumns[] = 'title';
        }
        if (!Schema::hasColumn('seller_notifications', 'description')) {
            $missingColumns[] = 'description';
        }
        if (!Schema::hasColumn('seller_notifications', 'type')) {
            $missingColumns[] = 'type';
        }
        if (!Schema::hasColumn('seller_notifications', 'is_read')) {
            $missingColumns[] = 'is_read';
        }

        if ($missingColumns) {
            Schema::table('seller_notifications', function (Blueprint $table) use ($missingColumns) {
                foreach ($missingColumns as $column) {
                    if ($column === 'seller_id') {
                        $table->unsignedBigInteger($column)->nullable()->index();
                    } elseif ($column === 'product_id') {
                        $table->unsignedBigInteger($column)->nullable()->index();
                    } elseif ($column === 'title') {
                        $table->string($column)->nullable();
                    } elseif ($column === 'description') {
                        $table->text($column)->nullable();
                    } elseif ($column === 'type') {
                        $table->string($column)->default('warning');
                    } elseif ($column === 'is_read') {
                        $table->boolean($column)->default(false)->index();
                    }
                }
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('seller_notifications', 'product_id')) {
            Schema::table('seller_notifications', function (Blueprint $table) {
                $table->dropColumn('product_id');
            });
        }
    }
}
