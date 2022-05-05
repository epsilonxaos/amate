<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEventoPrecio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evento_precios', function(Blueprint $table) {
            $table->tinyInteger('tipo')->nullable()->default(0)->comment('0=interno, 1=publico');
            $table->decimal('comision', 10,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento_precios', function(Blueprint $table) {
            $table->dropColumn('tipo');
            $table->dropColumn('comision');
        });
    }
}
