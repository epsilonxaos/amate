@extends('layouts.app')
@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/pago.css')}}">
@endpush
@section('contenido')
    <section class="pagos pt-5 pb-5">
        <div class="container">
            <h3 class="text-center titulo"> Introducción a la Apnea </h3>
            <h4 class="text-center mb-5">Selecciona la fecha  y cantidad de boletos </h4>

            <div class="row">
                <div class="col-12">
                    {{-- Cantidad de boletos --}}
                    <div class="form-group">
                        <input class="custom-radio radio-validate" type="radio" id="boletoPersonal" name="boletoPersonal" checked value="personal">
                        <label for="boletoPersonal" class="dorado font-weight-bold">
                            <span style="margin-top: -6px;"></span> Boleto Personal - $400.00 MXN
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="" class="dorado font-weight-bold">Cantidad de boletos</label>
                        <input type="number" class="form-control" name="boletos" value="1" style="max-width: 80px">
                    </div>

                    {{-- Cupon --}}
                    <div class="input-group cupon mb-4 rounded-0">
                        <input type="text" class="form-control in" placeholder="Escribir cupón de descuento" aria-label="Escribir cupón de descuento" aria-describedby="button-addon2">
                        <div class="input-group-append rounded-0">
                            <button class="btn btn-gold" type="button" id="button-addon2">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informacion de compra --}}
            <div class="card border-0 rounded-0 mb-5">
                <div class="card-body border-0 rounded-0 pt-4 pb-4">
                    <div class="row justify-content-center no-gutter">
                        <div class="col-12 col-md-11 col-lg-10">
                            <p class="mb-0"><span class="font-weight-bold">Dureción Experiencia:</span> 7 horas</p>
                            <p class="mb-0"><span class="font-weight-bold">Hora y Punto de salida:</span> 09:00 am</p>
                            <p class="mb-0"><span class="font-weight-bold">Lugar de Salida:</span> Hotel Cigno</p>
                            <p class="mb-5"><span class="font-weight-bold">Idiomas:</span> Inglés, Español</p>
                            
                            <p><span class="font-weight-bold">Número de boletos:</span> 1</p>
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
                                        <td>$400.00 MXN</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Comision de venta en linea</td>
                                        <td>$17.50 MXN</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Descuento</td>
                                        <td>-- MXN</td>
                                    </tr>
                                    <tr class="pt-5">
                                        <td class="font-weight-bold">Total</td>
                                        <td>$417.50 MXN</td>
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
                    <label for="" class="dorado font-weight-bold">Información del comprador</label>
                </div>
                <div class="col-12 form-group">
                    <input type="text" class="form-control in" placeholder="Nombre">
                </div>
                <div class="col-12 form-group">
                    <input type="text" class="form-control in" placeholder="Correo">
                </div>
                <div class="col-12 form-group">
                    <input type="text" class="form-control in" placeholder="Celular">
                </div>
                <div class="col-12 form-group">
                    <textarea class="form-control tx" placeholder="Comentarios" name="" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="col-12 form-group">
                    <input type="text" class="form-control in" placeholder="En que hotel estas hopedado?">
                </div>
                <div class="col-12 form-group">
                    <label for="" class="grey">Favor de escribir el número de talla de las aletas / accesorios de todos los participantes al evento</label>
                    <textarea class="form-control tx" placeholder="Ejemplo: Talla Mediana o 32..." name="" id="" cols="30" rows="5"></textarea>
                </div>
                <div class="col-12 form-group">
                    <label for="" class="grey">Favor de escribir el las alergías de los participantes a algun alimento</label>
                    <textarea class="form-control tx" placeholder="Ejemplo:  Alergia a los mariscos..." name="" id="" cols="30" rows="5"></textarea>
                </div>
            </div>

            {{-- Forma de pago --}}
            <label for="" class="dorado font-weight-bold mb-3">Información del comprador</label>
            <div class="card border-0 rounded-0 mb-5">
                <div class="card-footer border-0 rounded-0 pt-4 pb-4">
                    <div class="row no-gutter">
                        <div class="col-12 col-sm-4 col-md-6 col-lg-4">
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
                        <div class="col-12 col-sm-4 col-md-6 col-lg-4">
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
            </div>

            <div class="text-center">
                <button class="btn btn-gold" style="box-shadow: 0px 4px 30px rgba(252, 69, 0, 0.5);">PAGAR</button>
            </div>
        </div>
    </section>
@endsection