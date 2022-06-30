<nav class="menu-movil d-lg-none">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-8">
                <a href="{{route('front.eventos')}}">
                    <img src="{{asset('img/logo-header.svg')}}" alt="{{env('APP_NAME')}}" class="logo">
                </a>
            </div>
            <div class="col-4 text-right">
                <div class="menu menu-3 mt-2" id="btn-menu-toggle">
                    <span></span>
                </div>
            </div>
        </div>
    </div>

    <div class="sidebar-left">
        <ul class="menu-list">
            <li class="{{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">Experiencias</a></li>
            <li class="text-center"><a href="{{route('front.eventos')}}?calendario=1">Calendario</a></li>
            <li class="text-center"><a href="">Galería</a></li>
            <li class="text-center"><a href="">Arma tu experiencia</a></li>
            <li class="text-center"><a href="">About Us</a></li>
            <li class="text-center"><a href="">Contacto</a></li>
            {{-- <li class="text-center"><a href="">Idioma</a></li> --}}
            {{-- <li class="text-center">
                <a href="#" class="btn btn-gold" style="min-width: 197px">Reservar</a>
            </li> --}}
            <li class="text-center">
                <a class="btn btn-white" href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a>
            </li>
            {{-- <li class="text-uppercase text-center"><a href="">Inicio</a></li>
            <li class="text-uppercase text-center"><a href="">Torneos</a></li>
            <li class="text-uppercase {{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">Eventos</a></li> --}}
            {{-- <li class="text-uppercase"><a href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a></li> --}}
        </ul>
    </div>
</nav>

{{-- @php
    if(request()->is('/') || request()->is('concursos') || request()->is('eventos')){
        $tema = '';
        $tema_btn = 'btn-blanco-negro-invert';
        $logo = 'logo-blanco.png';
    }elseif (request()->is('nosotros/los_murmurantes/*')) {
        $tema = 'tema-negro';
        $tema_btn = 'btn-blanco-negro-invert';
        $logo = 'logo-blanco.png';
    }else {
        $tema = 'tema-blanco';
        $tema_btn = 'btn-blanco-negro';
        $logo = 'logo-negro.png';
    }
@endphp --}}

<nav class="menu-escritorio d-none d-lg-block">
    <div class="container-fluid w15">
        <div class="row align-items-center">
            <div class="col-md-2 pr-0">
                <a href="{{route('front.eventos')}}">
                    <img src="{{asset('img/logo-header.svg')}}" alt="{{env('APP_NAME')}}" class="logo">
                </a>
            </div>
            <div class="col-md-8">
                <ul class="menu">
                    <li class="{{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">Experiencias</a></li>
                    <li class="text-center"><a href="{{route('front.eventos')}}?calendario=1">Calendario</a></li>
                    <li class="text-center"><a href="">Galería</a></li>
                    <li class="text-center"><a href="">Arma tu experiencia</a></li>
                    <li class="text-center"><a href="">About Us</a></li>
                    <li class="text-center"><a href="">Contacto</a></li>
                    
                    {{-- <li class=""><a href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a></li> --}}
                    {{--<li class="text-uppercase text-center {{(request() -> is('/')) ? 'active' : ''}}"><a href="{{route('front.inicio')}}">Inicio</a></li>
                    <li class="text-uppercase text-center {{(request() -> is('nosotros*')) ? 'active' : ''}}">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Nosotros
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('front.nosotros.quienes_somos')}}">¿QUIÉNES SOMOS?</a>
                                <a class="dropdown-item" href="{{route('front.nosotros.mumurantes')}}">Los murmurantes</a>
                                <a class="dropdown-item" href="{{route('front.nosotros.reconocimientos')}}">Reconocimientos</a>
                                <a class="dropdown-item" href="{{route('front.nosotros.aliados_culturales')}}">Aliados Culturales</a>
                            </div>
                        </div>
                    </li>
                    <li class="text-uppercase text-center {{(request() -> is('laboratorio*')) ? 'active' : ''}}">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Laboratorio
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('front.laboratorio.laboratorio')}}">Laboratorio</a>
                                <a class="dropdown-item" href="{{route('front.laboratorio.talleres')}}">Talleres</a>
                            </div>
                        </div>
                    </li>
                    <li class="text-uppercase text-center {{(request() -> is('artes*')) ? 'active' : ''}}">
                        <div class="dropdown dos-lineas">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Artes<br>Escénicas
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('front.artes.piezas')}}">Piezas Escénicas</a>
                                <a class="dropdown-item" href="{{route('front.artes.giras')}}">Giras</a>
                            </div>
                        </div>
                    </li>
                    <li class="text-uppercase text-center {{(request() -> is('cine*')) ? 'active' : ''}}">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cine
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('front.cine.documentales')}}">Documentales</a>
                                <a class="dropdown-item" href="{{route('front.cine.cineclub')}}">El cineclub de la méxico</a>
                            </div>
                        </div>
                    </li>
                    <li class="text-uppercase text-center {{(request() -> is('concursos*')) ? 'active' : ''}}"><a href="{{route('front.concursos')}}">Concursos</a></li>
                    <li class="text-uppercase text-center {{(request() -> is('blog*')) ? 'active' : ''}}"><a href="{{route('front.blog')}}">Blog</a></li>
                    <li class="text-uppercase text-center {{(request() -> is('contacto')) ? 'active' : ''}}"><a href="{{route('front.contacto')}}">Contacto</a></li>
                    <li><a href="{{route('front.eventos')}}" class="btn {{$tema_btn}} text-uppercase">Eventos</a></li>--}}
                </ul>
            </div>
            <div class="col-md-2 text-right">
                <a style="width: max-content" class="btn btn-white btn-sm" href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a>
                {{-- <div style="max-width: min-content" class="ml-auto mr-0">
                    <a href="#" class="btn btn-gold w-100 btn-sm mb-2">Reservar</a>
                </div> --}}
            </div>
        </div>
    </div>
</nav>