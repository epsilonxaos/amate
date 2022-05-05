<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',250)->nullable();
            $table->text('lugar', 250)->nullable();
            $table->string('latitud', 250)->nullable();
            $table->string('longitud', 250)->nullable();
            $table->string('portada',250)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('descripcion_2')->nullable();
            $table->tinyInteger('status')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('evento_horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->date('fecha')->nullable();
            $table->time('hora')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('cascade');
        });

        Schema::create('evento_precios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->decimal('precio','10',2)->nullable();
            $table->string('concepto',250)->nullable();
            $table->timestamps();
            $table->foreign('evento_id')->references('id')->on('evento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evento_horarios');
        Schema::dropIfExists('evento_precios');
        Schema::dropIfExists('evento');
    }
}
