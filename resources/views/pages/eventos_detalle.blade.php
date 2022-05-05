@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
@endpush
@section('contenido')
    <section class="eventos">
        {{--<div class="eventos-galeria">
            <div class="container-fluid w15">
                <div class="owl-carousel owl-theme">
                    @foreach ($galeria as $gal)
                        <div class="item">
                            <div class="bg pointer" data-fancybox data-src="{{asset('storage/evento/galeria/'.$gal -> imagen)}}" style="background-image: url({{asset('storage/evento/galeria/'.$gal -> imagen)}})">
                                <img src="{{asset('img/nosotros/quienes_somos/mascara-galeria.png')}}" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>--}}
        <div class="container">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="eventos-portada">
                    <img src="{{asset('storage/evento/'.$evento->portada)}}" class="w-100" alt="">
                </div>
            </div>
        </div>
        <form action="{{$evento -> tipo == 0 ? route('front.eventos.boletos') : route('front.eventos.butacas')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="evento_id" value="{{$evento -> id}}">


            <div class="eventos-informacion-1">
                <div class="container text-center">
                    <h5 class="m30">{{$evento -> titulo}}</h5>
                    @if(count($horarios) > 1)
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Selecciona el día</label>
                                <select class="sl" name="dia" id="dia" required>
                                    <option value="">Selecciona el día</option>
                                    @foreach($horarios as $h)
                                    <option value="{{$h->fecha}}">{{\App\Http\Controllers\FrontController::ParseDate($h -> fecha)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Selecciona la hora</label>
                                <select class="sl"  name="horario" id="horario" required>
                                    <option value="">Selecciona el horario de la función</option>
                                </select>
                            </div>
                            <input type="hidden" name="horario_id" value="0">
                        </div>
                        <h4 class="mt-5" id="s_day">---</h4>
                        <p>{{$evento -> lugar}} | <span id="s_hour">--:--</span> hrs</p>
                    @else
                        <input type="hidden" name="horario_id" value="{{$horarios[0]->id}}">
                        <h4>{{\App\Http\Controllers\FrontController::ParseDate($horarios[0]->fecha)}}</h4>
                        <p>{{$evento -> lugar}} | {{date('H:i', strtotime($horarios[0] -> hora))}} hrs</p>
                    @endif
                        <div class="comprar text-center pt-2 pb-5">
                            {{--<a href="{{route('front.eventos.comprar', ['id' => $original_id, 'titulo' => $url_amigable])}}" class="btn btn-blanco-negro text-uppercase">Comprar boletos</a>--}}
                            <button class="btn btn-primary rounded-pill mt-2">Comprar Boleto</button>
                        </div>
                </div>
                <div class="container text-justify mt-5">


                    {!! $evento -> descripcion !!}

                    <div class="m30"></div>

                    <div class="card">
                        <div class="card-body">
                            {!! $evento -> descripcion_2 !!}
                            {{--<p><b>Dirección:</b> *Ariadna Medina  & David Avilés</p>
                            <p><b>Producción ejecutiva:</b> Ariadna Medina</p>
                            <p><b>Fotografía, edición y corrección de color:</b> David Avilés</p>
                            <p><b>Sonido:</b> Marilyn Fruto Domínguez</p>
                            <p><b>Testimonios:</b> Rosa Pinzón Frias, Fátima Santos Pacheco, Carlos Montero Ávila,</p>
                            <p>Irma Mexicano Hernández y Manuel Aldana Nic.</p>
                            <p>Fragmento de "El médico a la fuerza" de Moliere.</p>
                            <p><b>Lectura interpretada por:</b> *Ariadna Medina y Juan de Dios Rath / *Creadora escénica con trayectoria del Fonca 2019</p>
                            <br>
                            <p>**Proyecto apoyado por la Policía Municipal de Mérida, Yucatán y el proyecto Fortaseg en colaboración Yaxché A.C. Asociación Mexicana para la igualdad y el bienestar. </p>--}}
                        </div>
                    </div>
                </div>
                <div class="container text-center mt-5">
                    <p>Ubicación: {{$evento -> lugar}}</p>
                    <div id="mapa" class="mt-5"></div>
                </div>
            </div>

            <div class="comprar text-center pt-2 pb-5">
                <button class="btn btn-primary rounded-pill mt-2">Comprar Boleto</button>
                {{--<a href="{{route('front.eventos.comprar', ['id' => $original_id, 'titulo' => $url_amigable])}}" class="btn btn-blanco-negro text-uppercase">Comprar boletos</a>--}}
            </div>
        </form>
    </section>
@endsection

@push('js')
    <script src="{{mix('js/pages/eventos.js')}}"></script>
    <script type="text/javascript">
        var lat = {{$evento -> latitud}},
            lng = {{$evento -> longitud}};
    </script>
    <script src="{{asset('js/mapa.js')}}?v=5524"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuu1Q0hHmlO30h7YRDZ0mWYof-SM-edns&callback=initMap"></script>
@endpush
