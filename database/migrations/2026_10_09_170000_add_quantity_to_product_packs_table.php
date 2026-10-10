<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddQuantityToProductPacksTable extends Migration
{
    public function up()
    {
        Schema::table('product_packs', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('sub');
        });

        // Backfill quantity from names like "1 liter x 2 Pack"
        $packs = DB::table('product_packs')->get(['id', 'name']);
        foreach ($packs as $pack) {
            if (preg_match('/x\s*(\d+)\s*Pack/i', (string) $pack->name, $m)) {
                DB::table('product_packs')->where('id', $pack->id)->update(['quantity' => (int) $m[1]]);
            }
        }
    }

    public function down()
    {
        Schema::table('product_packs', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
