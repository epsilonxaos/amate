<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('evento', function(Blueprint $table) {
            $table->tinyInteger('tipo')->nullable()->default(0)->comment('0=sin lugares, 1=con_lugares');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento', function(Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
}
