@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
    <section class="pagos pt-5 pb-5">
        <div class="container">

            <h3 class="text-center titulo mb-3"> {{(App::getLocale() == 'en') ? $evento -> titulo_en : $evento -> titulo}} </h3>
            
            @if(session()->has('message'))
                <div class="col-12 col-md-12">
                    <div class="alert alert-secondary" role="alert">
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
            
            <h5 class="text-center">{{(App::getLocale() == 'en') ? 'Remaining time to complete the purchase' : 'Tiempo restante para completar la compra:'}}</h5>
            <p class="text-center text-dark font-weight-bold mb-5" data-countdown="{{\App\Http\Controllers\FrontController::sumMinutes($orden -> created_at)}}" id="getting-started"></p>

            <form action="" method="POST" id="form_pago">
                {{-- <h4 class="text-center mb-3">Selecciona la cantidad de boletos </h4> --}}
                <div class="row">
                    <div class="col-12">

                        {{-- Cantidad de boletos --}}
                        <div class="row">
                            <div class="col-12 col-md-6">
                                {{-- <label for="" class="dorado font-weight-bold mb-3">Selecciona el precio</label> --}}
                                @foreach ($precios as $idx => $item)
                                    <div class="form-group">
                                        <input class="custom-radio radio-validate" type="radio" id="precio_id-{{$idx}}" name="precio_id" data-precio="{{$item -> precio_final}}" {{$idx == 0 ? 'checked' : ''}} value="{{$item -> concepto}}">
                                        <label for="precio_id-{{$idx}}" class="dorado font-weight-bold">
                                            <span style="margin-top: -6px;"></span> {{(App::getLocale() == 'en') ? $item -> concepto_en : $item -> concepto}} - ${{number_format($item -> precio_final, 2)}} MXN
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="" class="dorado font-weight-bold mb-3">{{(App::getLocale() == 'en') ? 'Number of tickets' : 'Cantidad de boletos'}}</label>
                                    <input type="number" class="form-control" name="boletos" id="boletos" required min="1" max="100" value="1" style="max-width: 80px">
                                </div>
                            </div>
                        </div>
    
                        {{-- Cupon --}}
                        <div class="input-group cupon mb-4 rounded-0">
                            <input type="hidden" name="evento_titulo" value="{{$evento -> titulo}}">
                            <input type="hidden" name="subtotal" value="{{$precios[0] -> precio}}">
                            <input type="hidden" name="cupon_tipo" value="0">
                            <input type="hidden" name="cupon_valor" value="0">
                            <input type="hidden" name="descuento" value="0">
                            <input type="hidden" name="evento_tipo" value="{{$evento -> tipo}}">
                            <input type="hidden" name="precio_boleto" value="{{$precios[0] -> precio_final}}">
                            <input type="text" name="cupon" id="cupon" class="form-control in" placeholder="{{(App::getLocale() == 'en') ? 'Write discount coupon' : 'Escribir cup??n de descuento'}}" aria-label="Escribir cup??n de descuento" aria-describedby="button-addon2">
                            <div class="input-group-append rounded-0">
                                <button class="btn btn-gold apply-cupon" type="button" id="button-addon2">{{(App::getLocale() == 'en') ? 'Apply' : 'Aplicar'}}</button>
                            </div>
                        </div>
                    </div>
                </div>
    
                {{-- Informacion de compra --}}
                <div class="card border-0 rounded-0 mb-5">
                    <div class="card-body border-0 rounded-0 pt-4 pb-4">
                        <div class="row justify-content-center no-gutter">
                            <div class="col-12 col-md-11 col-lg-10">
                                <p class="mb-0"><span class="font-weight-bold">{{(App::getLocale() == 'en') ? 'Day' : 'D??a'}}: {{(App::getLocale() == 'en') ? \App\Helpers::dateComplete($horario -> fecha) : \App\Helpers::dateSpanishShort($horario -> fecha)}}</p>
                                <p class="mb-0"><span class="font-weight-bold">{{(App::getLocale() == 'en') ? 'Hour' : 'Hora'}}: {{$horario -> hora}} hrs</p>
                                <p class="mb-4"><span class="font-weight-bold">{{(App::getLocale() == 'en') ? 'Location' : 'Ubicacion'}}: {{$evento -> lugar}}</p>
                                
                                <p><span class="font-weight-bold">{{(App::getLocale() == 'en') ? 'Number of tickets' : 'N??mero de boletos'}}:</span> <span id="no_boletos">1</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-0 rounded-0 pt-4 pb-4">
                        <div class="row justify-content-center no-gutter">
                            <div class="col-12 col-md-11 col-lg-10">
                                <table class="w-100">
                                    <thead>
                                        <tr>
                                            <td class="font-weight-bold">Subtotal</td>
                                            <td>$<span id="s_subtotal">{{number_format($precios[0] -> precio_final, 2)}}</span> MXN</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="font-weight-bold">Comision de venta en linea</td>
                                            <td>$<span id="s_subtotal">{{number_format((($precios -> precio * $precios -> comision) / 100), 2)}} MXN</td>
                                        </tr> --}}
                                        <tr>
                                            <td class="font-weight-bold">{{(App::getLocale() == 'en') ? 'Discount' : 'Descuento'}}</td>
                                            <td>-$ <span id="s_descuento">0.00</span> MXN</td>
                                        </tr>
                                        <tr class="pt-5">
                                            <td class="font-weight-bold">Total</td>
                                            <td>$<span id="s_total">{{number_format($precios[0] -> precio_final, 2)}}</span> MXN</td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
    
                {{-- Informacion del comprador --}}
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="" class="dorado font-weight-bold">{{(App::getLocale() == 'en') ? 'Personal information' : 'Informaci??n del comprador'}}</label>
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" class="form-control in" placeholder="{{(App::getLocale() == 'en') ? 'Name' : 'Nombre'}}" name="nombre" id="nombre">
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" class="form-control in" placeholder="{{(App::getLocale() == 'en') ? 'Email' : 'Correo'}}" name="email" id="email">
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" class="form-control in" placeholder="{{(App::getLocale() == 'en') ? 'Phone' : 'Celular'}}" name="pago_telefono" id="pago_telefono">
                    </div>
                    <div class="col-12 form-group">
                        <textarea class="form-control tx" placeholder="{{(App::getLocale() == 'en') ? 'Message' : 'Comentarios'}}" name="comentarios" id="comentarios" cols="30" rows="5"></textarea>
                    </div>
                    <div class="col-12 form-group">
                        <input type="text" class="form-control in" placeholder="{{(App::getLocale() == 'en') ? 'Which hotel are you staying at?' : 'En que hotel estas hospedado?'}}" name="p_hospedado" id="p_hospedado">
                    </div>
                    <div class="col-12 form-group">
                        <label for="" class="grey">{{(App::getLocale() == 'en') ? 'Please specify fins and wetsuit size for every participant (freediving experience only)' : 'Favor de escribir el n??mero de talla de las aletas / accesorios de todos los participantes al evento'}} <img src="{{asset('images/interrogation-mark.png')}}" alt="Guia de ayuda" title="Guia de ayuda" data-toggle="modal" data-target="#mdSize" class="ml-3" style="cursor: help"></label>
                        <textarea class="form-control tx" placeholder="{{(App::getLocale() == 'en') ? 'Example: Fins: 36 EU, wetsuit: M woman???' : 'Ejemplo: Talla Mediana o 32...'}}" name="p_talla" id="p_talla" cols="30" rows="5"></textarea>
                    </div>
                    <div class="col-12 form-group">
                        <label for="" class="grey">{{(App::getLocale() == 'en') ? 'Please specify food restristricions and allergies for every participant' : 'Favor de escribir el las alerg??as de los participantes a algun alimento'}}</label>
                        <textarea class="form-control tx" placeholder="{{(App::getLocale() == 'en') ? 'Example: vegan, no seafood, lactose intolerant, none???' : 'Ejemplo:  Alergia a los mariscos...'}}" name="p_alergia" id="p_alergia" cols="30" rows="5"></textarea>
                    </div>
                </div>
    
                {{-- Forma de pago --}}
                <label for="" class="dorado font-weight-bold mb-3">{{(App::getLocale() == 'en') ? 'Purchase method' : 'Metodo de compra'}}</label>
                <div class="card border-0 rounded-0 mb-5">
                    <div class="card-footer border-0 rounded-0 pt-4 pb-4">
                        <div class="row no-gutter">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <input class="custom-radio radio-validate" type="radio" id="metodo1" name="metodo" checked value="paypal">
                                    <label for="metodo1">
                                        <span></span> <img src="{{asset('img/paypal.png')}}" alt="Paypal">
                                    </label>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-sm-4 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <input class="custom-radio" type="radio" id="metodo2" name="metodo" value="oxxo">
                                    <label for="metodo2">
                                        <span></span> <img src="{{asset('img/oxxo.png')}}" alt="Oxxo">
                                    </label>
                                </div>
                            </div> --}}
                            <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <input class="custom-radio" type="radio" id="metodo3" name="metodo" value="tarjeta">
                                    <label for="metodo3">
                                        <span></span> <img src="{{asset('img/tarjeta.png')}}" alt="Visa Mastercard">
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row d-none mb-5" id="content_tarjeta">
                    <div class="col-12 m15">
                        <input type="text" class="in form-control" name="nombre_tarjeta" placeholder="{{(App::getLocale() == 'en') ? 'Name on the card' : 'Nombre en la tarjeta'}}">
                    </div>
                    <div class="col-12 m15">
                        <input type="text" class="in form-control" name="numero_tarjeta" id="tarjeta_show" placeholder="{{(App::getLocale() == 'en') ? 'Number on the card' : 'N??mero en la tarjeta'}}">
                    </div>
                    <div class="col-6 m15">
                        <input type="text" class="in form-control" name="mes_exp" id="mes_show" placeholder="{{(App::getLocale() == 'en') ? 'Expiration month' : 'Mes de expiraci??n'}} (MM)">
                    </div>
                    <div class="col-6 m15">
                        <input type="text" class="in form-control" name="anio_exp" id="anio_show" placeholder="{{(App::getLocale() == 'en') ? 'Expiration year' : 'A??o de expiraci??n'}} (YYYY)">
                    </div>
                    <div class="col-12 m15">
                        <input type="text" class="in form-control" name="cvc" id="cvv_show_" placeholder="CVC">
                    </div>
                    <div class="col-12 m15 d-none" id="content-error-tarjeta">
                        <p class="text-red" style="color: red !important;" id="error-tarjeta">Error Tarjeta</p>
                    </div>
                </div>
    
                <div class="text-center">
                    <button type="button" class="btn btn-gold do-pay" data-route="{{route('front.pago.save')}}" style="box-shadow: 0px 4px 30px rgba(252, 69, 0, 0.5);">{{(App::getLocale() == 'en') ? 'PAY' : 'PAGAR'}}</button>
                </div>
            </form>
        </div>
    </section>

    @include('modals.mdInfoSize')


    <form id="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="display:none">
        <input type="hidden" name="cmd" value="_xclick" />
        <input type="hidden" name="business" value="{{env('PAYPAL_ACCOUNT')}}" />
        <input type="hidden" name="lc" value="MX" />
        <input type="hidden" name="return" value="{{asset('')}}pago/completado/{{$orden -> folio}}" />
        <input type="hidden" name="item_name" value="Orden de Compra" />
        <input type="hidden" name="item_number" value="{{\Illuminate\Support\Facades\Session::get('orden_id')}}" id="item_number" />
        <input type="hidden" name="amount" value="{{$precios[0] -> precio_final}}" id="precioFinal" />
        <input type="hidden" name="currency_code" value="MXN" />
        <input type="hidden" name="no_note" value="1" />
        <input type="hidden" name="no_shipping" value="1" />
        <input type="hidden" name="cpp_headerback_ color" value="#CCCCCC" />
        <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buy_buynowCC_LG.gif:NonHosted" />
        <input type="image" src="https://www.sandbox.paypal.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
    </form>
    <form action="{{route('front.conekta.payment')}}" method="POST" id="card-form" role="form" style="display:none">
        {{ csrf_field() }}
        <input type="hidden" name="amount" value="{{$precios[0] -> precio_final}}" />
        <span class="card-errors"></span>
        <div class="form-group">
            <label for="nombretarjetahabiente">Nombre del tarjetahabiente</label>
            <input type="text" class="form-control" id="nombretarjetahabiente" placeholder="Ej. Oscar Robles Torres" size="20" data-conekta="card[name]" />
        </div>
        <div class="form-group">
            <label for="tarjeta">N??mero de la tarjeta de cr??dito</label>
            <input type="text" class="form-control" id="tarjeta" placeholder="Ej. 87129873" size="20" data-conekta="card[number]" />
        </div>
        <div class="form-row">
            <label>
                <span>CVC</span>
                <input type="text" size="4" id="cvc" data-conekta="card[cvc]"/>
            </label>
        </div>
        <div class="form-row">
            <label>
                <span>Fecha de expiraci??n (MM/AAAA)</span>
                <input type="text" size="2" id="mes_exp" data-conekta="card[exp_month]"/>
            </label>
            <span>/</span>
            <input type="text" size="4" id="anio_exp" data-conekta="card[exp_year]"/>
        </div>
    </form>
    <form action="{{route('front.conekta.oxxo')}}" method="POST" id="oxxo-form" role="form" style="display:none">
        {{ csrf_field() }}
    </form>
    <form action="{{route('front.pago.free')}}" method="POST" id="free-form" role="form" style="display:none">
        {{ csrf_field() }}
    </form>
@endsection

@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
    <script type="text/javascript">
        // Conekta Public Key
        Conekta.setPublishableKey('{{env("CONEKTA_PK", "key_MBgeoNOzyC97divEQd1c6M8")}}');
        // ...

        $(function(){


            var conektaSuccessResponseHandler;
            conektaSuccessResponseHandler = function(token) {
                var $form;
                $form = $("#card-form");
                /* Inserta el token_id en la forma para que se env??e al servidor */
                $form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));
                /* and submit */
                $form.get(0).submit();
            };

            conektaErrorResponseHandler = function(token) {
                console.log(token);
                $("#content-error-tarjeta").removeClass('d-none');
                $("#error-tarjeta").text(token.message_to_purchaser);

            };

            $("#card-form").submit(function(event) {
                event.preventDefault();
                var $form;
                $form = $(this);
                /* Previene hacer submit m??s de una vez */
                //$form.find("button").prop("disabled", true);
                Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
                /* Previene que la informaci??n de la forma sea enviada al servidor */
                return false;
            });
        });
    </script>
    <script src="{{mix('js/pages/pagos.js')}}"></script>
@endpush