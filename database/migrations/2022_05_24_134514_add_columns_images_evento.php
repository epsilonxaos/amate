<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsImagesEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evento', function (Blueprint $table) {
            $table -> string('imagen_lateral_1') -> nullable();
            $table -> string('imagen_lateral_2') -> nullable();
            $table -> string('imagen_lateral_3') -> nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evento', function (Blueprint $table) {
            $table -> dropColumn('imagen_lateral_1');
            $table -> dropColumn('imagen_lateral_2');
            $table -> dropColumn('imagen_lateral_3');
        });
    }
}
