<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 250)->nullable();
            $table->tinyInteger('tipo')->nullable();
            $table->decimal('descuento', 10,2)->nullable();
            $table->dateTime('fecha_inicio')->nullable();
            $table->dateTime('fecha_termino')->nullable();
            $table->integer('limite')->nullable();
            $table->integer('usos')->nullable();
            $table->tinyInteger('status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cupon');
    }
}
