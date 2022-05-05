<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asiento', function(Blueprint $table) {
            $table->integer('evento_id')->nullable();
        });

        Schema::create('orden_per_asiento', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('asiento_id');
            $table->integer('orden_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asiento', function(Blueprint $table) {
            $table->dropColumn('evento_id');
        });
        Schema::dropIfExists('orden_per_asiento');
    }
}
