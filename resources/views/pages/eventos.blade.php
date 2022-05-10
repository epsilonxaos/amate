@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{asset('plugins/swiper/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
@endpush

@section('contenido')
    <div class="section eventos">
        <div class="eventos-slide overflow-hidden position-relative">
            <div class="swiper" id="swiperSlide">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                  <!-- Slides -->
                  <div class="swiper-slide">
                      <img src="{{asset('img/slide01.jpg')}}" alt="Galeria">
                  </div>
                  <div class="swiper-slide">
                      <img src="{{asset('img/slide01.jpg')}}" alt="Galeria">
                  </div>
                  <div class="swiper-slide">
                      <img src="{{asset('img/slide01.jpg')}}" alt="Galeria">
                  </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>

            <div class="info text-center pl-3 pr-3 pl-md-5 pr-md-5">
                <h2 class="mb-4">Introducción a la Apnea</h2>
                <a href="#" class="btn btn-white fw-500">¡Quiero ir!</a>
            </div>
        </div>

        <div class="eventos-informacion position-relative p-0">

            <div class="bg-verde">
                <h2 class="titulo decoracion text-center d-flex align-items-center justify-content-center w-100 mb-4">EXPERIENCIAS</h2>
            </div>

            <div class="container-fluid w12 pt-4 pb-4" id="eventosContainer">
                <div class="text-center mb-4">
                    <button class="btn btn-gold" id="testBtn">Ver Calendario</button>
                </div>
                <div class="row">
                    @for ($i = 0; $i < 10; $i++)
                        <div class="col-12 col-md-4 col-lg-3 mb-3">
                            {{-- <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}"> --}}
                            <a href="#">
                                <div class="eventos-content">
                                    <img src="{{asset('img/slide01.jpg')}}" alt="Introducción a la apnea" class="cover">
                                    <div class="footer text-left p-3">
                                        <h5>Introducción a la apnea</h5>
                                        <h6 class="mb-1">Fecha: 29 Marzo 2022</h6>
                                        <small>Precio</small>
                                        <p class="font-weight-bold text-black mb-0">$400 MXN por persona</p>
                                        {{-- <a href="#" class="btn btn-primary rounded-pill mt-2">Vér Más</a> --}}
                                        {{-- <h5>{{$evento -> titulo}}</h5>
                                        <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}" class="btn btn-primary rounded-pill mt-2">Vér Más</a> --}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="row">
                @foreach($eventos as $evento)
                    <div class="col-12 col-md-4 col-lg-3 mb-3">
                        {{-- <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}"> --}}
                        <a href="#">
                            <div class="eventos-content">
                                <img src="{{asset('img/slide01.jpg')}}" alt="Introducción a la apnea" class="cover">
                                <div class="footer text-left p-3">
                                    <h5>Introducción a la apnea</h5>
                                    <h6 class="mb-1">Fecha: 29 Marzo 2022</h6>
                                    <small>Precio</small>
                                    <p class="font-weight-bold text-black mb-0">$400 MXN por persona</p>
                                    {{-- <a href="#" class="btn btn-primary rounded-pill mt-2">Vér Más</a> --}}
                                    {{-- <h5>{{$evento -> titulo}}</h5>
                                    <a href="{{route('front.eventos.detalle', [$evento -> id, $evento -> url_amigable])}}" class="btn btn-primary rounded-pill mt-2">Vér Más</a> --}}
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="row">
                {{ $eventos->links() }}
            </div>


            <div class="container-fluid w16 pt-4 position-relative fondo-verde d-none" id="CalendarioContainer">                

                <h5 class="text-center text-white font-weight-bold mb-4">Del 6 al 12 de Abril</h5>

                {{-- Calendario --}}
                <div class="bg-main">
                    <div class="calendar-week deco">
                        <div class="calendar-week-header d-flex">
                            <div class="calendar-week-title">
                                <h5>lun.<span>01</span></h5>
                            </div>
                            <div class="calendar-week-title">
                                <h5>mar.<span>02</span></h5>
                            </div>
                            <div class="calendar-week-title">
                                <h5>mie.<span>03</span></h5>
                            </div>
                            <div class="calendar-week-title">
                                <h5>jue.<span>04</span></h5>
                            </div>
                            <div class="calendar-week-title">
                                <h5>vie.<span>05</span></h5>
                            </div>
                            <div class="calendar-week-title">
                                <h5>sab.<span>06</span></h5>
                            </div>
                            <div class="calendar-week-title">
                                <h5>dom.<span>07</span></h5>
                            </div>
                        </div>
                        <div class="calendar-week-body d-flex">
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card off-time">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="rojo">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card off-time">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6>Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="azul">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="verde">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card full">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6>Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card off-time">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6>Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="verde">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card full">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="azul">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card off-time">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="rojo">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="rojo">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6>Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card full">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="verde">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="azul">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="rojo">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card full">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6>Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card full">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="azul">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="rojo">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                            <div class="calendar-week-pilar">
                                <div class="calendar-week-card">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="verde">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                                <div class="calendar-week-card full">
                                    <a href="{{url('reservar/clase/detalle')}}" class="d-block">
                                        <h6 class="verde">Classic Barre</h6>
                                        <p class="instructor">Caro</p>
                                        <p class="time">7:10 AM</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
            </div>

            <div class="bg-verde">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12 col-lg-3 col-xl-2 mb-4 text-center mb-lg-0 text-lg-left">
                            <h5 class="text-white font-weight-bold">Buscar por tipo de Evento</h5>
                        </div>
                        <div class="col-12 col-lg-9 col-xl-10">
                            <ul class="list-unstyled d-flex justify-content-between justify-content-sm-center justify-content-md-between">
                                <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-0.svg')}}" alt="Aventura"> <p>Aventura</p> </li>
                                <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-1.svg')}}" alt="Gastronomia"> <p>Gastronomia</p> </li>
                                <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-2.svg')}}" alt="Naturaleza"> <p>Naturaleza</p> </li>
                                <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-3.svg')}}" alt="Ciudad"> <p>Ciudad</p> </li>
                                <li class="card text-center align-items-center"> <img class="mb-2" src="{{asset('img/frame-4.svg')}}" alt="Wellness"> <p>Wellness</p> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="eventos-comentarios pt-5 pb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 col-md-10 col-lg-9">
                        <div class="swiper overflow-hidden" id="swipercomentarios">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide text-center text-white">
                                    Ad culpa sunt voluptate exercitation dolor veniam occaecat cupidatat officia cupidatat id et. Pariatur incididunt proident dolor ea elit nulla cillum quis ipsum. Nostrud culpa veniam ullamco fugiat id. <br><br>
                                    Eu ex cillum magna incididunt magna exercitation culpa ad ex commodo. Exercitation nulla officia ut elit enim excepteur Lorem Lorem ullamco esse. Mollit ea sit ex culpa Lorem commodo amet est tempor commodo tempor fugiat et. Deserunt incididunt ullamco ea tempor est Lorem veniam aute aliquip reprehenderit. Exercitation laborum incididunt deserunt eu deserunt quis. Dolor officia sit elit laboris sunt dolore cillum nisi nostrud eu.</div>
                                <div class="swiper-slide text-center text-white">
                                    Enim non ullamco labore consectetur esse. Id dolor esse aute anim. Consequat laborum ut cupidatat sunt cupidatat duis. Commodo do officia aliquip enim officia pariatur. Nulla pariatur ullamco quis consequat ullamco enim. <br><br>
                                    Irure anim do pariatur elit sunt adipisicing do aliquip nisi anim ut veniam consequat. Duis cupidatat esse incididunt dolore. Amet laborum esse minim deserunt anim in officia sint pariatur quis irure consectetur. Reprehenderit eiusmod enim est sit ut proident tempor quis reprehenderit ea tempor est.</div>
                                <div class="swiper-slide text-center text-white">
                                    Irure in quis do qui quis ullamco fugiat. Fugiat aliquip nisi nisi in ullamco est. Aute deserunt nostrud adipisicing quis enim laborum proident laborum laborum. <br><br>
                                    Magna enim nulla non excepteur aliqua sunt anim amet. Esse laborum duis aute dolore nulla ut amet enim commodo ad quis in. Nostrud ad anim dolor veniam ad sit consectetur labore.</div>
                            </div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const EVENTO_VIEW_DETAIL = false;
        document.getElementById('testBtn').addEventListener('click', function() {
            document.getElementById('eventosContainer').classList.toggle('d-none')
            document.getElementById('CalendarioContainer').classList.toggle('d-none')
        });
    </script>
    <script src="{{mix('js/pages/eventos.js')}}"></script>
@endpush