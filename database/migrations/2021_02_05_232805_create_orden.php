<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrden extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('evento_id');
            $table->integer('horario_id')->nullable()->default(0);
            $table->string('evento_titulo')->nullable();
            $table->string('nombre_completo')->nullable();
            $table->string('correo')->nullable();
            $table->string('telefono')->nullable();
            $table->enum('meet', ['redes', 'periodico', 'amigos', 'otro'])->nullable()->default('otro');
            $table->date('dia')->nullable();
            $table->time('hora')->nullable();
            $table->integer('no_boletos')->nullable();
            $table->decimal('precio_boleto', 10, 2)->nullable()->default(0);
            $table->string('cupon')->nullable();
            $table->string('cupon_tipo')->nullable();
            $table->decimal('cupon_valor',10,2)->nullable();
            $table->decimal('descuento',10,2)->nullable()->default(0);
            $table->enum('pago_metodo', ['free', 'paypal', 'oxxo', 'tarjeta'])->nullable()->default('free');
            $table->string('pago_referencia')->nullable();
            $table->string('pago_error')->nullable();
            $table->string('oxxo_reference')->nullable();
            $table->dateTime('pago_hora')->nullable();

            $table->tinyInteger('status')->nullable()->default(0)->comment('0:creado, 1:pendiente_pago, 2:pagado, 3:error_pago');
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
        Schema::dropIfExists('orden');
    }
}
