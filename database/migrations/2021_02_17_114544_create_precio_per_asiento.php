<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecioPerAsiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precio_per_asiento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('precio_id');
            $table->integer('asiento_id');
            $table->timestamps();
        });

        Schema::table('orden_per_asiento', function(Blueprint $table){
            $table->decimal('precio',10,2)->nullable()->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precio_per_asiento');
        Schema::table('orden_per_asiento', function(Blueprint $table) {
            $table->dropColumn('precio');
        });
    }
}
