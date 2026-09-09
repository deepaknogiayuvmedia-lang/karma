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
            // Product Priority (Phase 7)
            $table->tinyInteger('priority')->default(0)->after('indexing');

            // Per-Product Commission (Phase 6)
            $table->decimal('admin_commission', 10, 2)->default(0)->after('priority');
            $table->string('admin_commission_type', 20)->default('percentage')->after('admin_commission');

            // Product Approval Workflow (Phase 8)
            $table->string('approval_status', 20)->default('draft')->after('admin_commission_type');
            $table->string('edit_status', 20)->default('none')->after('approval_status');

            // Add indexes for performance
            $table->index('priority');
            $table->index('approval_status');
            $table->index(['approval_status', 'status']);
            $table->index(['seller_id', 'approval_status']);
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
