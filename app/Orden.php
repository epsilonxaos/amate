<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{

    protected $table = 'orden';
    protected $fillable = ['evento_id', 'horario_id', 'evento_titulo', 'nombre_completo', 'correo', 'telefono', 'meet', 'dia', 'hora', 'no_boletos', 'precio_boleto', 'cupon', 'cupon_tipo', 'cupon_valor', 'descuento', 'pago_metodo', 'pago_referencia', 'pago_hora', 'pago_error', 'oxxo_reference', 'status', 'folio', 'informacion'];
}
