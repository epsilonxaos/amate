<?php

namespace App\Http\Controllers;

use App\Cupon;
use App\Evento;
use App\EventoHorario;
use App\Mail\PagoCompletado;
use App\Mail\PagoCompletadoStaff;
use App\Orden;
use App\OrdenPerAsiento;
use Conekta\Charge;
use Conekta\Conekta;
use Conekta\Customer;
use Conekta\Handler;
use Conekta\Order;
use Conekta\ParameterValidationError;
use Conekta\ProcessingError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Jenssegers\Optimus\Optimus;

class ConektaTarjeta extends Controller
{
    function payment(Request $request, Optimus $optimus){
        if(Session::exists('orden_id')){
            Conekta::setApiKey(env('CONEKTA_SK'));
            Conekta::setApiVersion('2.0.0');
            $success_customer = false;
            $orden = Orden::find(Session::get('orden_id'));
            $orden -> pago_metodo = 'tarjeta';
            $orden -> save();
            try {
                $customer = Customer::create(
                    array(
                        "name" => $orden -> nombre_completo,
                        "email" => $orden -> correo,
                        "phone" => $orden -> telefono,
                        "payment_sources" => [
                            [
                                "type" => "card",
                                "token_id" => $request ->conektaTokenId
                            ]
                        ]
                    )//customer
                );
                $success_customer = true;
            } catch (ProcessingError $error) {
                $er = $error->getMesage();
            } catch (ParameterValidationError $error) {
                $er = $error->getMessage();
            } catch (Handler $error) {
                $er = $error->getMessage();
            }
            if($success_customer){
                $success = false;
                try {
                    $_pre_order = array(
                        "line_items" => array(
                            array(
                                "name" => 'Boletos Evento '.$orden -> evento_titulo,
                                "unit_price" => $orden -> precio_boleto * 100,
                                "quantity" => $orden -> no_boletos
                            )//first line_item
                        ), //line_items
                        /*"shipping_lines" => array(
                            array(
                                "amount" => $orden -> transporte * 100,
                                "carrier" => 'OKANA'
                            )
                        ), //shipping_lines*/
                        "currency" => 'MXN',
                        "metadata" => array(
                            "id_orden" => $orden -> id
                        ),
                        /*"customer_info" => array(
                            "name" 	=> $orden -> name_client,
                            "email" => $orden -> email ? $orden -> email : 'luisjcaamal@gmail.com',
                            "phone" => $orden -> phone ? $orden -> phone : '9999235689'
                        ),*/
                        "customer_info" => array(
                            "customer_id" => $customer->id
                        ),

                        /*"shipping_contact" => array(
                            "address" => array(
                                "street1" => $_direccion . " " . $_ciudad . " " . $_estado,
                                "postal_code" => $_cp,
                                "country" => "MX"
                            )//address
                        ), //shipping_contact - required only for physical goods*/
                        "charges" => array(
                            array(
                                "payment_method" => array(
                                    "type" => "default",
                                )//payment_method
                            ) //first charge
                        ) //charges
                    );//order

                    //------SE DESCOMENTE ESTA LINEA CUANDO SE INTEGREN LOS CUPONES-------
                    if($orden -> descuento > 0){
                        $cupon_name = $orden -> cupon;
                        $descuento = $orden -> descuento * 100;
                        $_pre_order['discount_lines'] = Array(
                            array(
                                "code" => $cupon_name,
                                "type" => "coupon",
                                "amount" => $descuento
                            )
                        );
                    }
                    $order = Order::create(
                        $_pre_order
                    );

                    $success = true;
                } catch (\Conekta\ProcessingError $error) {
                    $error = 'Error: ' . $error->getMessage();
                } catch (\Conekta\ParameterValidationError $error) {
                    $error = 'Error: ' . $error->getMessage();
                } catch (\Conekta\Handler $error) {
                    $error = 'Error: ' . $error->getMessage();
                } catch (\Conekta\ResourceNotFoundError $error) {
                    $error = 'Error: ' . $error->getMessage();
                }

                if ($success) {
                    $status = $order->charges[0]->status;
                    switch ($status) {
                        case 'paid':
                            $orden -> status = 2;
                            $orden -> pago_referencia = $order->charges[0]->id;
                            $orden -> pago_hora = date('Y-m-d H:i:s');
                            $orden -> save();
                            if($orden -> descuento > 0){
                                $cupon = Cupon::where('titulo', $orden -> cupon)->first();
                                $cupon -> usos = $cupon -> usos + 1;
                                $cupon -> save();
                            }

                            $subtotal =  OrdenPerAsiento::where('orden_id', $orden->id)->sum('precio');
                            $asientos = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden->id)->get()->toArray();
                            $data = [
                                'orden' => $orden,
                                'evento' => Evento::find($orden -> evento_id),
                                'asientos' => FrontController::asientosToString($asientos),
                                'no_asientos' => count($asientos),
                                'fecha' => FrontController::ParseDate($orden -> dia),
                                'subtotal' => $subtotal,
                                'descuento' => $orden -> descuento,
                                'total' => $subtotal - $orden ->descuento
                            ];
                            Mail::to($orden->correo)->send(new PagoCompletado($data));
                            Mail::to('aguila-josue@hotmail.com')->send(new PagoCompletadoStaff($data, true));
                            $info['id'] = $optimus ->encode(Session::get('orden_id'));
                            return redirect()->route('front.eventos.pago.completado', $info);
                        break;
                        default:
                            $orden -> status = 3;
                            $orden -> pago_error = 'Ocurrio un error desconocido en el pago';
                            $orden -> save();
                            return redirect()->back()->with('message',$error);
                        break;
                    }

                } else {
                    $orden -> status = 3;
                    $orden -> pago_error = $error;
                    $orden -> save();
                    return redirect()->back()->with('message',$error);
                }
            }else{
                $orden -> status = 3;
                $orden -> pago_error = $er;
                $orden -> save();
                return redirect()->back()->with('message',$er);
            }
        }else{
            return redirect()->back()->with('message','La session ha expirado');
        }

    }

    static public function findOrder($order_id){
        Conekta::setApiKey(env('CONEKTA_SK'));
        Conekta::setApiVersion('2.0.0');
        $order = Order::find($order_id);
        return $order;
    }

}
