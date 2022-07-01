@extends('layouts.app')

@push('link')
    <link rel="stylesheet" href="{{asset('plugins/swiper/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{mix('css/pages/eventos.css')}}">
    <style>
        .font-weight-bold {
            color: #153D3C;
        }
    </style>
@endpush

@section('contenido')
    <div class="eventos-detalle pt-5">
        <div class="container">

            <h2 class="titulo mb-3">Aviso de privacidad</h2>
    
            <p>Amate Experiences, con domicilio en Calle 1H x 8 y 12 #142, México Nte., 98127, Mérida, Yucatán, México y portal de internet casaamate.com, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente:</p>
    
            <p class="font-weight-bold mb-0">¿Para qué fines utilizaremos sus datos personales?</p>
            <p>Los datos personales que recabamos de usted, los utilizaremos para las siguientes Rnalidades que son necesarias para el servicio que solicita:</p>
    
            <p>Prestación de cualquier servicio solicitado</p>
    
            <p class="font-weight-bold mb-0">¿Qué datos personales utilizaremos para estos fines?</p>
            <p>Para llevar a cabo las Rnalidades descritas en el presente aviso de privacidad, utilizaremos los siguientes datos personales:</p>
    
            <p class="mb-0">Datos de identiRcación y contacto</p>
            <p>Datos bancarios</p>
    
            <p class="font-weight-bold mb-0">¿Con quién compartimos su información personal y para qué fines?</p>
            <p>Le informamos que sus datos personales son compartidos con las siguientes personas, empresas, organizaciones o autoridades distintas a nosotros, para los siguientes fines:</p>
    
            <p>guía, chofer, instructor y cualquier otra persona involucrada en la experiencia solicitada, al Rn de brindar un mejor servicio. Los datos bancarios no serán compartidos ni guardados.</p>
    
            <p class="font-weight-bold mb-0">¿Cómo puede acceder, rectificar o cancelar sus datos personales, u oponerse a su uso o ejercer la revocación de consentimiento?</p>
            <p>Usted tiene derecho a conocer qué datos personales tenemos de usted, para qué los utilizamos y las condiciones del uso que les damos (Acceso). Asimismo, es su derecho
                solicitar la corrección de su información personal en caso de que esté desactualizada, sea inexacta o incompleta (RectiRcación); que la eliminemos de nuestros registros o
                bases de datos cuando considere que la misma no está siendo utilizada adecuadamente (Cancelación); así como oponerse al uso de sus datos personales para Rnes
                especíRcos (Oposición). Estos derechos se conocen como derechos ARCO.</p>
    
            <p>Para el ejercicio de cualquiera de los derechos ARCO, debe enviar una petición vía correo electrónico a amatexperiencia@gmail.com y deberá contener:</p>
    
            <ul>
                <li> <p class="mb-1">Nombre completo del titular.</p> </li>
                <li> <p class="mb-1">Domicilio.</p> </li>
                <li> <p class="mb-1">Teléfono.</p> </li>
                <li> <p class="mb-1">Correo electrónico usado en este sitio web.</p> </li>
                <li> <p class="mb-1">Copia de una identiRcación oRcial adjunta.</p> </li>
                <li> <p class="mb-1">Asunto «Derechos ARCO»</p> </li>
            </ul>
    
            <p>Descripción el objeto del escrito, los cuales pueden ser de manera enunciativa más no limitativa los siguientes: Revocación del consentimiento para tratar sus datos
                personales; y/o NotiRcación del uso indebido del tratamiento de sus datos personales; y/o Ejercitar sus Derechos ARCO, con una descripción clara y precisa de los datos a
                Acceder, RectiRcar, Cancelar o bien, Oponerse. En caso de RectiRcación de datos personales, deberá indicar la modiRcación exacta y anexar la documentación soporte; es
                importante en caso de revocación del consentimiento, que tenga en cuenta que no en todos los casos podremos atender su solicitud o concluir el uso de forma inmediata,
                ya que es posible que por alguna obligación legal requiramos seguir tratando sus datos personales. Asimismo, usted deberá considerar que para ciertos Rnes, la revocación
                de su consentimiento implicará que no le podamos seguir prestando el servicio que nos solicitó, o la conclusión de su relación con nosotros.</p>
    
            <p class="mb-0">¿En cuántos días le daremos respuesta a su solicitud?</p>
            <p>20 días</p>
    
            <p class="mb-0">¿Por qué medio le comunicaremos la respuesta a su solicitud?</p>
            <p>Al mismo correo electrónico de donde se envío la petición.</p>
    
            <p class="font-weight-bold mb-0">El uso de tecnologías de rastreo en nuestro portal de internet</p>
            <p>Le informamos que en nuestra página de internet utilizamos cookies, web beacons u otras tecnologías, a través de las cuales es posible monitorear su comportamiento
                como usuario de internet, así como brindarle un mejor servicio y experiencia al navegar en nuestra página. Los datos personales que obtenemos de estas tecnologías de
                rastreo son los siguientes:</p>
    
            <p>IdentiRcadores, nombre de usuario y contraseñas de sesión</p>
    
            <p>Estas cookies, web beacons y otras tecnologías pueden ser deshabilitadas. Para conocer cómo hacerlo, consulte el menú de ayuda de su navegador. Tenga en cuenta que,
                en caso de desactivar las cookies, es posible que no pueda acceder a ciertas funciones personalizadas en nuestros sitio web.</p>
    
            <p class="font-weight-bold mb-0">¿Cómo puede conocer los cambios en este aviso de privacidad?</p>
            <p>El presente aviso de privacidad puede sufrir modiRcaciones, cambios o actualizaciones derivadas de nuevos requerimientos legales; de nuestras propias necesidades por
                los productos o servicios que ofrecemos; de nuestras prácticas de privacidad; de cambios en nuestro modelo de negocio, o por otras causas. Nos comprometemos a
                mantener actualizado este aviso de privacidad sobre los cambios que pueda sufrir y siempre podrá consultar las actualizaciones que existan en el sitio web
                casaamate.com.</p>
    
            <p class="font-weight-bold mb-0">Última actualización de este aviso de privacidad: 27/04/2022.</p>
        </div>
    </div>
@endsection

@push('js')
@endpush