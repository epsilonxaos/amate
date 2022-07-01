<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocaleEn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evento', function (Blueprint $table) {
            $table -> string('titulo_en');
            $table -> longText('descripcion_en') -> nullable();
            $table -> longText('descripcion2_en') -> nullable();
        });

        Schema::table('evento_categorias', function (Blueprint $table) {
            $table -> string('titulo_en') -> nullable();
        });

        Schema::table('evento_precios', function (Blueprint $table) {
            $table -> string('concepto_en') -> nullable();
        });

        Schema::table('orden', function (Blueprint $table) {
            $table -> string('evento_titulo_en') -> nullable();
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
            $table -> dropColumn('titulo_en');
            $table -> dropColumn('descripcion_en') -> nullable();
            $table -> dropColumn('descripcion2_en') -> nullable();
        });

        Schema::table('evento_categorias', function (Blueprint $table) {
            $table -> dropColumn('titulo_en');
        });

        Schema::table('evento_precios', function (Blueprint $table) {
            $table -> dropColumn('concepto_en');
        });

        Schema::table('orden', function (Blueprint $table) {
            $table -> dropColumn('evento_titulo_en');
        });
    }
}
