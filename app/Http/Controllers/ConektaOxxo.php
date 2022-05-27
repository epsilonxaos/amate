<?php

namespace App\Http\Controllers;

use App\Cupon;
use App\Evento;
use App\EventoHorario;
use App\Mail\PagoCompletado;
use App\Mail\PagoPendiente;
use App\Mail\PagoPendienteStaff;
use App\Orden;
use App\Mail\test_webhook;
use App\OrdenPerAsiento;
use Conekta\Conekta;
use Conekta\Customer;
use Conekta\Handler;
use Conekta\Order;
use Conekta\ParameterValidationError;
use Conekta\ProcessingError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use DateTime;
use DateInterval;
use Jenssegers\Optimus\Optimus;

class ConektaOxxo extends Controller
{
    function payment(Request $request, Optimus $optimus){
        if(Session::exists('orden_id')){
            Conekta::setApiKey(env('CONEKTA_SK', 'key_DiRAqecfbC4rHk3xa4cGTQ'));
            Conekta::setApiVersion('2.0.0');
            $thirty_days_from_now = (new DateTime())->add(new DateInterval('P1D'))->getTimestamp();
            $success_customer = false;
            $orden = Orden::find(Session::get('orden_id'));
            $orden -> pago_metodo = 'oxxo';
            $orden -> save();
            try {
                $customer = Customer::create(
                    array(
                        "name" => $orden -> nombre_completo,
                        "email" => $orden -> correo,
                        "phone" => $orden -> telefono,
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
                                    "type" => "oxxo_cash",
                                    "expires_at" => $thirty_days_from_now
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
                    /*$status = $order->charges[0]->status;
                    switch ($status) {
                        case 'paid':
                            $orden -> status = 2;
                            $orden -> pago_referencia = $order->charges[0]->id;
                            $orden -> pago_hora = date('Y-m-d H:i:s');
                            $orden -> save();
                            break;
                        default:
                            $orden -> status = 3;
                            $orden -> pago_error = 'Ocurrio un error desconocido en el pago';
                            $orden -> save();
                            break;
                    }*/
                    $orden -> status = 4;
                    $orden -> pago_referencia = $order->id;
                    $orden -> oxxo_reference = $order->charges[0]->payment_method->reference;
                    $orden -> save();

                    $subtotal =  OrdenPerAsiento::where('orden_id', $orden->id)->sum('precio');
                    $asientos = OrdenPerAsiento::select(['asiento.num', 'asiento.letra'])->join('asiento', 'asiento.id', '=', 'orden_per_asiento.asiento_id')->where('orden_per_asiento.orden_id', $orden->id)->get()->toArray();
                    //dd($order);
                    $data = [
                        'orden' => $orden,
                        'evento' => Evento::find($orden -> evento_id),
                        'asientos' => FrontController::asientosToString($asientos),
                        'no_asientos' => count($asientos),
                        'fecha' => FrontController::ParseDate($orden -> dia),
                        'fecha_limite' => FrontController::ParseDate($order->charges[0]->payment_method->expires_at),
                        'subtotal' => $subtotal,
                        'descuento' => $orden -> descuento,
                        'total' => $subtotal - $orden ->descuento
                    ];
                    Mail::to($orden->correo)->send(new PagoPendiente($data));
                    Mail::to('aguila-josue@hotmail.com')->send(new PagoPendienteStaff($data));
                    //Session::forget('orden_id');
                    //return view('pages.eventos.ticket_oxxo', ['orden' => $orden]);
                    $info['id'] = $optimus ->encode(Session::get('orden_id'));
                    return redirect()->route('front.eventos.pago.ticket', $info);
                } else {
                    $orden -> status = 3;
                    $orden -> pago_error = $error;
                    $orden -> save();
                    Session::forget('orden_id');
                    return redirect()->back()->with('message',$error);
                }
            }else{
                $orden -> status = 3;
                $orden -> pago_error = $er;
                $orden -> save();
                //Session::forget('orden_id');
                return redirect()->back()->with('message',$er);
            }
        }else{

            return redirect()->back()->with('message','La session ha expirado');
        }

    }

    public function getOrderOxxo($id){
        Conekta::setApiKey(env('CONEKTA_SK', 'key_DiRAqecfbC4rHk3xa4cGTQ'));
        Conekta::setApiVersion('2.0.0');
        $order = Order::find($id);
        //dd($order);
        return view('pages.compra.view_order', ['data' => $order]);
    }

    public function getOrderOxxoObj($id){
        Conekta::setApiKey(env('CONEKTA_SK', 'key_DiRAqecfbC4rHk3xa4cGTQ'));
        Conekta::setApiVersion('2.0.0');
        return Order::find($id);
    }

    public function webhook(){
        $body = @file_get_contents('php://input');
        $data = json_decode($body);
        Mail::to('luisjcaamal@gmail.com') -> send(new test_webhook($data));

        if ($data -> type == 'order.paid'){
            $item_number = $data -> data -> object -> metadata -> id_orden;
            $orden = Orden::find($item_number);
            $orden -> status = 2;
            $orden -> pago_hora = date('Y-m-d H:i:s');
            $orden -> save();
            if($orden -> descuento > 0){
                $cupon = Cupon::where('titulo', $orden -> cupon)->first();
                $cupon -> usos = $cupon -> usos + 1;
                $cupon -> save();
            }
            $data = [
                'orden' => $orden,
                'evento' => Evento::find($orden -> evento_id),
                'horario' => EventoHorario::find($orden -> horario_id)
            ];
            Mail::to($orden->correo)->send(new PagoCompletado($data));
            Mail::to('murmurante.reservaciones@gmail.com')->send(new PagoCompletado($data, true));
        }else if($data -> type == 'order.expired'){
            $item_number = $data -> data -> object -> metadata -> id_orden;
            $orden = Orden::find($item_number);
            $orden -> status = 5;
            $orden -> pago_hora = date('Y-m-d H:i:s');
            $orden -> save();
        }


        return response()->json("Orden actualizada.", 200);
    }
}
