@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{ asset('plugins/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ mix('css/pages/eventos.css') }}">
@endpush
@section('contenido')
    <section class="eventos">
        <div class="eventos-galeria pt-3">
            <div class="container-fluid w15">
                <div class="swiper-container" id="swiperSlide">
                    <div class="swiper-wrapper">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="swiper-slide">
                                <img src="{{ asset('img/slide01.jpg') }}" alt="galeria">
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
        </div>


        <div class="eventos-detalle pt-5">
            <div class="container-fluid w12">
                <div class="row">
                    <div class="col-12 text-center mb-5">
                        <h2 class="titulo mb-3">Introducción a la Apnea</h2>
                        <p class="mb-4">Prepárate a descubrir el mágico mundo subacuático a través de una experiencia inolvidable con un
                            instructor de apnea certificado</p>
                        <button class="btn btn-gold">¡Quiero ir!</button>
                    </div>
                    <div class="col-12 col-md-6">
                        <p class="date mb-0">27 Marzo 2022</p>
                        <p class="date">Mérida | 09:00 am</p>
                        <div class="information-extra">
                            <p>En esta experiencia, un instructor certificado te enseñara los fundamentos básicos del buceo
                                libre (apnea) en donde descubrirás habilidades naturales de respiración para sentirte cómodo
                                bajo el agua y tener una mágica conexión con tu ser y el mundo subacuático de un majestuoso
                                cenote cristalino</p>
                            <p><strong>Duración Experiencia</strong>: 7 horas</p>
                            <p><strong>Hora y Punto de salida:</strong> 09:00 am</p>
                            <p><strong>Lugar de Salida</strong>: Hotel Cigno</p>
                            <p><strong>Idiomas:</strong> Inglés, Español</p>
                            <p><strong><br></strong></p>
                            <p><strong>Número de personas:</strong> 4 Máximo<br></p>
                            <p><strong>Costo: </strong>$400 MXN por persona</p>
                            <p><span style="font-weight: 700;">Incluye:</span><br></p>
                            <p>
                            <ul>
                                <li>Transporte</li>
                                <li>Refrigerios, comida y bebida no alcoholica</li>
                                <li>Equipo de apnea (wetsuit, máscara, snorkel, aletas, lanyard)</li>
                                <li>Entrada al cenote</li>
                                <li>Clase de introducción a la apnea por instructor certificado Molchanovs</li>
                                <li>Ejercicios en seco de respiración y relajación</li>
                            </ul>
                            </p>
                            <p><br></p>
                            <p><strong>No incluye:</strong></p>
                            <p>
                            <ul>
                                <li>Certificación de Apnea</li>
                                <li>Propina</li>
                            </ul>
                            </p>
                            <p><strong><br></strong></p>
                            <p><strong>Que llevar:</strong><br>
                            <ul>
                                <li>Traje de baño cómodo para usar bajo el traje de neopreno</li>
                                <li>Toalla</li>
                                <li>Sandalias</li>
                            </ul>
                            </p>
                            <p><strong><br></strong></p>
                            <p><strong>Políticas:</strong></p>
                            <p>
                            <ul>
                                <li>Toda reserva queda sujeta a disponibilidad</li>
                                <li>En caso de que el cliente no se presente o realice la experiencia esta no será
                                    reembolsable</li>
                                <li>Se requiere el pago total para realizar una reserva</li>
                                <li>Cancelaciones deben realizarse con 48 hrs. de anticipación&nbsp;</li>
                                <li>Cancelaciones realizadas con menos de 48 hrs. no serán reembolsables.</li>
                            </ul>
                            </p>
                            <p><br></p>
                            <p><strong>Requísitos:</strong></p>
                            <p>
                            <ul>
                                <li>Saber nadar</li>
                                <li>Edad mínima 18 años</li>
                            </ul>
                            </p>

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <img class="mb-2 w-100" src="https://images.pexels.com/photos/3046637/pexels-photo-3046637.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" alt="">
                        <img class="mb-2 w-100" src="https://images.pexels.com/photos/37542/divers-scuba-reef-underwater-37542.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                        <img class="mb-2 w-100" src="https://images.pexels.com/photos/3098971/pexels-photo-3098971.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" alt="">
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="container">
            <div class="col-12 col-md-8 offset-md-2">
                <div class="eventos-portada">
                    <img src="{{asset('storage/evento/'.$evento->portada)}}" class="w-100" alt="">
                </div>
            </div>
        </div> --}}
        {{-- <form action="{{$evento -> tipo == 0 ? route('front.eventos.boletos') : route('front.eventos.butacas')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="evento_id" value="{{$evento -> id}}">


            <div class="eventos-informacion-1">
                <div class="container text-center">
                    <h5 class="m30">{{$evento -> titulo}}</h5>
                    @if (count($horarios) > 1)
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Selecciona el día</label>
                                <select class="sl" name="dia" id="dia" required>
                                    <option value="">Selecciona el día</option>
                                    @foreach ($horarios as $h)
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
                            <button class="btn btn-primary rounded-pill mt-2">Comprar Boleto</button>
                        </div>
                </div>
                <div class="container text-justify mt-5">


                    {!! $evento -> descripcion !!}

                    <div class="m30"></div>

                    <div class="card">
                        <div class="card-body">
                            {!! $evento -> descripcion_2 !!}
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
            </div>
        </form> --}}
    </section>
@endsection

@push('js')
    <script type="text/javascript">
        const EVENTO_VIEW_DETAIL = true;
    </script>
    <script src="{{ mix('js/pages/eventos.js') }}"></script>
@endpush
