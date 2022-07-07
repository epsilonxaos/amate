@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{asset('plugins/swiper/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
    <style>
        .font-weight-bold {
            color: #153D3C;
        }

        input, textarea {
            border: none !important;
            box-shadow: none !important;
        }
    </style>
@endpush

@section('contenido')
    <div class="eventos-detalle pt-5" style="background-color: #F7F7F7">
        <div class="container-fluid" style="max-width: 1600px">

            <div class="wrapper position-relative">
                <img src="{{asset('img/contac.png')}}" alt="" class="w-100" style="height: 60vh; object-fit: cover">
            </div>
        </div>

        <div class="container pt-5">
            <h2 class="titulo mb-3 text-center">{{(App::getLocale() == 'en') ? 'Contact' : 'Contacto'}}</h2>
            <p class="text-center">
                <span class="font-weight-bold">Whatsapp</span> <a href="tel:+529995721178">999 572 1178</a> <br>
                <span class="font-weight-bold">Correo</span> <a href="mailto:amatexperiencia@gmail.com">amatexperiencia@gmail.com</a> <br>
                <span class="font-weight-bold">Instagram</span> <a href="https://www.instagram.com/amateexperiences/" target="_blank" rel="noopener noreferrer">@amateexperiences</a>
            </p>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <form action="" class="needs-validation" novalidate>
                        <div class="form-input mb-3">
                            <input type="text" name="nombre" id="nombre" placeholder="{{(App::getLocale() == 'en') ? 'Name' : 'Nombre'}} *" required class="form-control">
                        </div>
                        <div class="form-input mb-3">
                            <input type="email" name="correo" id="correo" placeholder="{{(App::getLocale() == 'en') ? 'E-mail' : 'Correo'}} *" required class="form-control">
                        </div>
                        <div class="form-input mb-3">
                            <input type="text" name="celular" id="celular" placeholder="{{(App::getLocale() == 'en') ? 'Phone' : 'Celular'}} *" required class="form-control">
                        </div>
                        <div class="form-input mb-3">
                            <textarea name="comentarios" id="comentarios" placeholder="{{(App::getLocale() == 'en') ? 'Message' : 'Comentarios'}}" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-gold px-4">{{(App::getLocale() == 'en') ? 'Send' : 'Enviar'}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
        'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
        })();
    </script>
@endpush