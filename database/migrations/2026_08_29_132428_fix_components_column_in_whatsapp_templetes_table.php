<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixComponentsColumnInWhatsappTempletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('whatsapp_templetes', function (Blueprint $table) {
            if (Schema::hasColumn('whatsapp_templetes', 'components')) {
                $table->longText('components')->change();
            }
        });
    }

    public function down()
    {
        Schema::table('whatsapp_templetes', function (Blueprint $table) {
            $table->string('components')->change();
        });
    }
}
