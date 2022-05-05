<nav class="menu-movil d-lg-none">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-8">
                <a href="{{route('front.eventos')}}">
                    <img src="{{asset('img/menu/logo.svg')}}" alt="E-Stom" class="logo">
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
            <li class="text-uppercase text-center"><a href="">Inicio</a></li>
            <li class="text-uppercase text-center"><a href="">Torneos</a></li>
            <li class="text-uppercase {{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">Eventos</a></li>
            <li class="text-uppercase"><a href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a></li>
            {{--<li class="text-uppercase {{(request() -> is('nosotros*')) ? 'active' : ''}}">
                <a data-toggle="collapse" href="#menu-nosotros" role="button" aria-expanded="false" aria-controls="menu-nosotros">
                    Nosotros
                </a>
                <div class="collapse" id="menu-nosotros">
                    <a class="d-block" href="{{route('front.nosotros.quienes_somos')}}">¿QUIÉNES SOMOS?</a>
                    <a class="d-block" href="{{route('front.nosotros.mumurantes')}}">Los murmurantes</a>
                    <a class="d-block" href="{{route('front.nosotros.reconocimientos')}}">Reconocimientos</a>
                    <a class="d-block" href="{{route('front.nosotros.aliados_culturales')}}">Aliados Culturales</a>
                </div>
            </li>
            <li class="text-uppercase {{(request() -> is('laboratorio*')) ? 'active' : ''}}">
                <a data-toggle="collapse" href="#menu-lab" role="button" aria-expanded="false" aria-controls="menu-lab">
                    Laboratorio
                </a>
                <div class="collapse" id="menu-lab">
                    <a class="d-block" href="{{route('front.laboratorio.laboratorio')}}">Laboratorio</a>
                    <a class="d-block" href="{{route('front.laboratorio.talleres')}}">Talleres</a>
                </div>
            </li>
            <li class="text-uppercase {{(request() -> is('artes*')) ? 'active' : ''}}">
                <a data-toggle="collapse" href="#menu-artes" role="button" aria-expanded="false" aria-controls="menu-artes">
                    Artes Escénicas
                </a>
                <div class="collapse" id="menu-artes">
                    <a class="d-block" href="{{route('front.artes.piezas')}}">Piezas Escénicas</a>
                    <a class="d-block" href="{{route('front.artes.giras')}}">Giras</a>
                </div>
            </li>
            <li class="text-uppercase {{(request() -> is('cine*')) ? 'active' : ''}}">
                <div class="dropdown">
                    <a data-toggle="collapse" href="#menu-cine" role="button" aria-expanded="false" aria-controls="menu-cine">
                        Cine
                    </a>
                    <div class="collapse" id="menu-cine">
                        <a class="d-block" href="{{route('front.cine.documentales')}}">Documentales</a>
                        <a class="d-block" href="{{route('front.cine.cineclub')}}">El cineclubde la méxico</a>
                    </div>
                </div>
            </li>
            <li class="text-uppercase {{(request() -> is('concursos*')) ? 'active' : ''}}"><a href="{{route('front.concursos')}}">Concursos</a></li>
            <li class="text-uppercase {{(request() -> is('blog*')) ? 'active' : ''}}"><a href="{{route('front.blog')}}">Blog</a></li>
            <li class="text-uppercase {{(request() -> is('contacto')) ? 'active' : ''}} mb-3"><a href="{{route('front.contacto')}}">Contacto</a></li>
            <li style="padding-left: 15px"><a href="{{route('front.eventos')}}" class="btn btn-blanco-negro text-uppercase">Eventos</a></li>--}}
        </ul>
    </div>
</nav>

@php
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
@endphp

<nav class="menu-escritorio d-none d-lg-block {{$tema}}">
    <div class="container-fluid w15">
        <div class="row align-items-center">
            <div class="col-md-2 pr-0">
                <a href="{{route('front.eventos')}}">
                    <img src="{{asset('img/menu/logo.svg')}}" alt="E-Stom" class="logo">
                </a>
            </div>
            <div class="col-md-10">
                <ul class="menu">
                    <li class="text-uppercase text-center"><a href="">Inicio</a></li>
                    <li class="text-uppercase text-center"><a href="">Torneos</a></li>
                    <li class="text-uppercase {{(request() -> is('eventos*')) ? 'active' : ''}} text-center"><a href="{{route('front.eventos')}}">Eventos</a></li>
                    <li class="text-uppercase"><a href="#mdSuscripcion" data-toggle="modal">Consultar reservación</a></li>
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
        </div>
    </div>
</nav>