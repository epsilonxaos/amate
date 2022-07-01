<footer>
    <div class="ft-telefonos pt-5 pb-5 d-none">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 text-center text-white mb-4 mb-sm-0">
                    <img src="{{asset('img/61.png')}}" alt="61" class="mb-3">
                    <p class="mb-0">Lets get in touch</p>
                    <p class="mb-0">+52 (999) 2712813</p>
                    <p class="mb-0">61@casaamate.mx</p>
                </div>
                <div class="col-12 col-sm-6 text-center text-white">
                    <img src="{{asset('img/62.png')}}" alt="62" class="mb-3">
                    <p class="mb-0">Lets get in touch</p>
                    <p class="mb-0">+52 (999) 2712813</p>
                    <p class="mb-0">62@casaamate.mx</p>
                </div>
            </div>
        </div>
    </div>

    <div class="ft-redes-sociales pt-4 pb-4 bg-white">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <img src="{{asset('img/logo-footer.png')}}" alt="Casa Amate" class="mb-4">
                    <div class="d-block">
                        <a href="#" target="_blank" rel="noopener noreferrer"><img src="{{asset('img/twitter.png')}}" alt="Twitter"></a>
                        <a href="#" target="_blank" rel="noopener noreferrer"><img class="ml-3" src="{{asset('img/facebook.png')}}" alt="Facebook"></a>
                        <a href="#" target="_blank" rel="noopener noreferrer"><img class="ml-3" src="{{asset('img/googleplus.png')}}" alt="Google Plus"></a>
                    </div>
                </div>
                <div class="col-12">
                    <ul class="list-unstyled d-md-flex justify-content-md-center text-center">
                        <li class="mb-2 mb-md-0"><a href="{{route('front.aviso')}}">Aviso de privacidad</a></li>
                        <li class="mb-2 mb-md-0 ml-md-3 ml-lg-5"><a href="{{route('front.reservaciones')}}">Reservaciones</a></li>
                        <li class="mb-2 mb-md-0 ml-md-3 ml-lg-5"><a href="{{route('front.reservaciones')}}?cancelaciones=1">Cancelaciones</a></li>
                        <li class="mb-2 mb-md-0 ml-md-3 ml-lg-5"><a href="{{route('front.faqs')}}">FAQs</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="ft-copy pt-3 pb-3 text-center">
        <p class="mb-0">© {{Date('Y')}}. Casa Amate</p>
    </div>
</footer>