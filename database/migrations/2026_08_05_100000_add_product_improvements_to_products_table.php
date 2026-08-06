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

            // Admin Verified Products (Phase 9)
            $table->boolean('verified')->default(0)->after('priority');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verified');
            $table->timestamp('verified_at')->nullable()->after('verified_by');

            // Per-Product Commission (Phase 6)
            $table->decimal('admin_commission', 10, 2)->default(0)->after('verified_at');
            $table->string('admin_commission_type', 20)->default('percentage')->after('admin_commission');

            // Product Approval Workflow (Phase 8)
            $table->string('approval_status', 20)->default('draft')->after('admin_commission_type');
            $table->string('edit_status', 20)->default('none')->after('approval_status');

            // Smart Product Ranking (Phase 10)
            $table->decimal('ranking_score', 10, 4)->default(0)->after('edit_status');

            // Add indexes for performance
            $table->index('priority');
            $table->index('verified');
            $table->index('approval_status');
            $table->index('ranking_score');
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
                'verified',
                'verified_by',
                'verified_at',
                'admin_commission',
                'admin_commission_type',
                'approval_status',
                'edit_status',
                'ranking_score',
            ]);
        });
    }
}
