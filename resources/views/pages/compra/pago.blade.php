@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
<section class="section pago">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5 text-center">
                <nav class="nav mb-5">
                    <a class="nav-link" href="#">PASO 1</a>
                    <a class="nav-link active" href="#">PASO 2 </a>
                </nav>
                <div class="countdown mb-5">
                    <h5 class="text-center">Tiempo restante para completar la compra:</h5>
                    <div class="text-center" data-countdown="{{\App\Http\Controllers\FrontController::sumMinutes($orden -> created_at)}}" id="getting-started"></div>
                </div>
            </div>
        </div>
        <form id="form_pago" action="" method="post">
            <div class="row justify-content-center">
                @if(session()->has('message'))
                    <div class="col-12 col-md-12">
                        <div class="alert alert-secondary" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    </div>
                @endif
                <input type="hidden" name="boletos" id="boletos" value="{{count($asientos)}}">
                <div class="col-lg-7 col-md-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5"><b>{{$evento -> titulo}}</b></h5>
                        <p class="card-text">
                            Día: {{\App\Http\Controllers\FrontController::ParseDate($horario -> fecha)}} <br>
                            Hora: {{$horario -> hora}} hrs <br>
                            Ubicacion: {{$evento -> lugar}} <br>
                            Número de boletos: {{count($asientos)}} <br>
                            Asientos: {{\App\Http\Controllers\FrontController::asientosToString($asientos)}}
                        </p>
                    </div>
                    <div class="card-footer">
                        <p>Subtotal <label class="float-right">$ <span id="s_subtotal">{{number_format($subtotal, 2)}}</span> MXN</label> </p>
                        <p>Descuento <label class="float-right" >-$ <span id="s_descuento">0.00</span> MXN</label></p>
                        <p>Total <label class="float-right">$ <span id="s_total">{{number_format($subtotal,2)}}</span> MXN</label></p>
                    </div>
                </div>

                <h3 class="mt-5 mb-4">Información del comprador</h3>
                <input type="text" class="form-control m15" placeholder="Nombre" name="nombre" id="nombre" required value="{{$orden -> nombre_completo}}">
                <input type="email" class="form-control m15" placeholder="Correo" name="email" id="email" required value="{{$orden -> correo}}">
                <input type="text" class="form-control m15" placeholder="Celular" name="pago_telefono" required id="pago_telefono" value="{{$orden -> telefono}}">
                <div class="row content-cupon">
                    <div class="col-lg-9 col-md-9 col-sm-12">
                        <input type="text" class="form-control" name="cupon" id="cupon" placeholder="Escribir cupón de descuento">
                        <input type="hidden" name="evento_titulo" value="{{$evento->titulo}}">
                        <input type="hidden" name="subtotal" value="{{$subtotal}}">
                        <input type="hidden" name="cupon_tipo" value="0">
                        <input type="hidden" name="cupon_valor" value="0">
                        <input type="hidden" name="descuento" value="0">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12">
                        <button type="button" class="btn btn-primary apply-cupon">Aplicar</button>
                    </div>
                </div>
                <hr>
                <h3 class="mt-5 mb-4">Metodo de compra</h3>
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-6 col-lg-4">
                        <div class="form-group">
                            <input class="custom-radio radio-validate" type="radio" id="metodo1" name="metodo" checked value="paypal">
                            <label for="metodo1">
                                <span></span> <img src="{{asset('img/paypal.png')}}" alt="Paypal">
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-6 col-lg-4">
                        <div class="form-group">
                            <input class="custom-radio" type="radio" id="metodo2" name="metodo" value="oxxo">
                            <label for="metodo2">
                                <span></span> <img src="{{asset('img/oxxo.png')}}" alt="Oxxo">
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4 col-md-6 col-lg-4">
                        <div class="form-group">
                            <input class="custom-radio" type="radio" id="metodo3" name="metodo" value="tarjeta">
                            <label for="metodo3">
                                <span></span> <img src="{{asset('img/tarjeta.png')}}" alt="Visa Mastercard">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row d-none" id="content_tarjeta">
                    <div class="col-12 m15">
                        <input type="text" class="in form-control" name="nombre_tarjeta" placeholder="Nombre en la tarjeta">
                    </div>
                    <div class="col-12 m15">
                        <input type="text" class="in form-control" name="numero_tarjeta" id="tarjeta_show" placeholder="Número en la tarjeta">
                    </div>
                    <div class="col-6 m15">
                        <input type="text" class="in form-control" name="mes_exp" id="mes_show" placeholder="Mes de expiración (MM)">
                    </div>
                    <div class="col-6 m15">
                        <input type="text" class="in form-control" name="anio_exp" id="anio_show" placeholder="Año de expiración (YYYY)">
                    </div>
                    <div class="col-12 m15">
                        <input type="text" class="in form-control" name="cvc" id="cvv_show_" placeholder="CVC">
                    </div>
                    <div class="col-12 m15 d-none" id="content-error-tarjeta">
                        <p class="text-red" style="color: red !important;" id="error-tarjeta">Error Tarjeta: alksdjkasjdlaksj</p>
                    </div>
                </div>
                <div class="col-12 comprar text-center mt-4">
                    {{--<a href="{{route('front.eventos.comprar', ['id' => $original_id, 'titulo' => $url_amigable])}}" class="btn btn-blanco-negro text-uppercase">Comprar boletos</a>--}}
                    <center>
                        <button type="button" data-route="{{route('front.pago.save')}}" class="btn btn-primary rounded-pill mt-2 do-pay">Finalizar</button>
                       {{-- <a href="{{route('front.eventos.pago.completado')}}" class="btn btn-primary rounded-pill mt-2">Continuar</a>--}}
                    </center>
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
<form id="paypal" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" style="display:none">
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="business" value="{{env('PAYPAL_ACCOUNT')}}" />
    <input type="hidden" name="lc" value="MX" />
    <input type="hidden" name="return" value="{{asset('')}}pago/completado/{{$orden -> folio}}" />
    <input type="hidden" name="item_name" value="Orden de Compra" />
    <input type="hidden" name="item_number" value="{{\Illuminate\Support\Facades\Session::get('orden_id')}}" id="item_number" />
    <input type="hidden" name="amount" value="{{$subtotal}}" id="precioFinal" />
    <input type="hidden" name="currency_code" value="MXN" />
    <input type="hidden" name="no_note" value="1" />
    <input type="hidden" name="no_shipping" value="1" />
    <input type="hidden" name="cpp_headerback_ color" value="#CCCCCC" />
    <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buy_buynowCC_LG.gif:NonHosted" />
    <input type="image" src="https://www.sandbox.paypal.com/es_XC/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!" />
</form>
<form action="{{route('front.conekta.payment')}}" method="POST" id="card-form" role="form" style="display:none">
    {{ csrf_field() }}
    <input type="hidden" name="amount" value="{{$subtotal}}" />
    <span class="card-errors"></span>
    <div class="form-group">
        <label for="nombretarjetahabiente">Nombre del tarjetahabiente</label>
        <input type="text" class="form-control" id="nombretarjetahabiente" placeholder="Ej. Oscar Robles Torres" size="20" data-conekta="card[name]" />
    </div>
    <div class="form-group">
        <label for="tarjeta">Número de la tarjeta de crédito</label>
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
            <span>Fecha de expiración (MM/AAAA)</span>
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
    <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js"></script>
    <script type="text/javascript">
        // Conekta Public Key
        Conekta.setPublishableKey('{{env('CONEKTA_PK')}}');
        // ...

        $(function(){


            var conektaSuccessResponseHandler;
            conektaSuccessResponseHandler = function(token) {
                var $form;
                $form = $("#card-form");
                /* Inserta el token_id en la forma para que se envíe al servidor */
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
                /* Previene hacer submit más de una vez */
                //$form.find("button").prop("disabled", true);
                Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
                /* Previene que la información de la forma sea enviada al servidor */
                return false;
            });
        });
    </script>
    <script src="{{mix('js/pages/pagos.js')}}"></script>
@endpush