<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductImprovementsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'priority')) {
                $table->tinyInteger('priority')->default(0)->after('indexing');
            }
            if (!Schema::hasColumn('products', 'admin_commission')) {
                $table->decimal('admin_commission', 10, 2)->default(0)->after('priority');
            }
            if (!Schema::hasColumn('products', 'admin_commission_type')) {
                $table->string('admin_commission_type', 20)->default('percentage')->after('admin_commission');
            }
            if (!Schema::hasColumn('products', 'approval_status')) {
                $table->string('approval_status', 20)->default('draft')->after('admin_commission_type');
            }
            if (!Schema::hasColumn('products', 'edit_status')) {
                $table->string('edit_status', 20)->default('none')->after('approval_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex(['approval_status', 'status']);
            $table->dropIndex(['seller_id', 'approval_status']);
            $table->dropColumn([
                'priority',
                'admin_commission',
                'admin_commission_type',
                'approval_status',
                'edit_status',
            ]);
        });
    }
}
