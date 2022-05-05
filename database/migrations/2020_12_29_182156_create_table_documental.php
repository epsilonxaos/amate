<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocumental extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documental', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 250)->nullable();
            $table->string('portada', 250)->nullable();
            $table->text('descripcion')->nullable();
            $table->text('descripcion_2')->nullable();
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
        Schema::dropIfExists('documental');
    }
}
