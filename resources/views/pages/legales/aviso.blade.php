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

            <h2 class="titulo mb-3">{{(App::getLocale() == 'en') ? 'Privacy Policy' : 'Aviso de privacidad'}}</h2>

            @if (App::getLocale() == 'en')
                <p>Amate Experiences, with address at Calle 1H x 8 y 12 #142, México Nte., 98127, Mérida, Yucatán, México and internet portal casaamate.com, is responsible for the use and protection of your personal data, and In this regard, we inform you of the following:</p>
        
                <p class="font-weight-bold mb-0">For what purposes will we use your personal data?</p>
                <p>The personal data we collect from you will be used for the following purposes that are necessary for the service you request:</p>
        
                <p>Provision of any requested service</p>
        
                <p class="font-weight-bold mb-0">What personal data will we use for these purposes?</p>
                <p>To carry out the purposes described in this privacy notice, we will use the following personal data:</p>
        
                <p class="mb-0">Identification and contact data</p>
                <p>Bank details</p>
        
                <p class="font-weight-bold mb-0">With whom do we share your personal information and for what purposes?</p>
                <p>We inform you that your personal data is shared with the following people, companies, organizations or authorities other than us, for the following purposes:</p>
        
                <p>guide, driver, instructor and any other person involved in the requested experience, by providing a better service. Bank details will not be shared or saved.</p>

                <p class="font-weight-bold mb-0">How can you access, rectify or cancel your personal data, or oppose its use or exercise the revocation of consent?</p>
                <p>You have the right to know what personal data we have about you, what we use them for and the conditions of use we give them (Access). Also, it is your right
                    request the correction of your personal information in case it is out of date, inaccurate or incomplete (Rectification); that we remove it from our records or
                    databases when you consider that it is not being used properly (Cancellation); as well as oppose the use of your personal data for purposes
                    specific (Opposition). These rights are known as ARCO rights.</p>
        
                <p>To exercise any of the ARCO rights, you must send a request via email to amatexperiencia@gmail.com and it must contain:</p>
        
                <ul>
                    <li> <p class="mb-1">Full name of the holder.</p> </li>
                    <li> <p class="mb-1">Address.</p> </li>
                    <li> <p class="mb-1">Phone.</p> </li>
                    <li> <p class="mb-1">Email used on this website.</p> </li>
                    <li> <p class="mb-1">Copy of an official identification attached.</p> </li>
                    <li> <p class="mb-1">Issue «ARCO Rights»</p> </li>
                </ul>
        
                <p>Description of the object of the writing, which may be, but not limited to, the following: Revocation of consent to process your data
                    personal; and/or Notification of the improper use of the processing of your personal data; and/or Exercise your ARCO Rights, with a clear and precise description of the data to
                    Access, Rectify, Cancel or Oppose. In case of Rectification of personal data, you must indicate the exact modification and attach the supporting documentation; it is
                    important in case of revocation of consent, that you take into account that not in all cases we will be able to attend to your request or terminate the use immediately,
                    since it is possible that due to some legal obligation we require to continue treating your personal data. Also, you should consider that for certain purposes, the revocation
                    of your consent will imply that we cannot continue providing the service you requested, or the conclusion of your relationship with us.</p>
        
                <p class="mb-0">In how many days will we respond to your request?</p>
                <p>20 days</p>
        
                <p class="mb-0">By what means will we communicate the response to your request?</p>
                <p>To the same email from which the request was sent.</p>
        
                <p class="font-weight-bold mb-0">Use of tracking technologies on our website</p>
                <p>We inform you that on our website we use cookies, web beacons or other technologies, through which it is possible to monitor your behavior
                    as an internet user, as well as to provide you with a better service and experience when browsing our page. The personal data we obtain from these technologies
                    tracking are as follows:</p>

                    <p>Session identifiers, username and passwords</p>
    
                <p>These cookies, web beacons and other technologies can be disabled. To learn how to do this, consult the help menu of your browser. Note that,
                    If you disable cookies, you may not be able to access certain personalized features on our website.</p>
        
                <p class="font-weight-bold mb-0">How can you find out about changes to this privacy notice?</p>
                <p>This privacy notice may undergo modifications, changes or updates derived from new legal requirements; of our own needs
                    the products or services we offer; of our privacy practices; Changes in our business model, or other causes. We are committed to
                    keep this privacy notice updated about the changes it may suffer and you can always consult the updates that exist on the website
                    casaamate.com.</p>
        
                <p class="font-weight-bold mb-0">Last update of this privacy notice: 04/27/2022.</p>
            @else
                <p>Amate Experiences, con domicilio en Calle 1H x 8 y 12 #142, México Nte., 98127, Mérida, Yucatán, México y portal de internet casaamate.com, es el responsable del uso y protección de sus datos personales, y al respecto le informamos lo siguiente:</p>
        
                <p class="font-weight-bold mb-0">¿Para qué fines utilizaremos sus datos personales?</p>
                <p>Los datos personales que recabamos de usted, los utilizaremos para las siguientes nalidades que son necesarias para el servicio que solicita:</p>
        
                <p>Prestación de cualquier servicio solicitado</p>
        
                <p class="font-weight-bold mb-0">¿Qué datos personales utilizaremos para estos fines?</p>
                <p>Para llevar a cabo las nalidades descritas en el presente aviso de privacidad, utilizaremos los siguientes datos personales:</p>
        
                <p class="mb-0">Datos de identicación y contacto</p>
                <p>Datos bancarios</p>
        
                <p class="font-weight-bold mb-0">¿Con quién compartimos su información personal y para qué fines?</p>
                <p>Le informamos que sus datos personales son compartidos con las siguientes personas, empresas, organizaciones o autoridades distintas a nosotros, para los siguientes fines:</p>
        
                <p>guía, chofer, instructor y cualquier otra persona involucrada en la experiencia solicitada, al brindar un mejor servicio. Los datos bancarios no serán compartidos ni guardados.</p>
        
                <p class="font-weight-bold mb-0">¿Cómo puede acceder, rectificar o cancelar sus datos personales, u oponerse a su uso o ejercer la revocación de consentimiento?</p>
                <p>Usted tiene derecho a conocer qué datos personales tenemos de usted, para qué los utilizamos y las condiciones del uso que les damos (Acceso). Asimismo, es su derecho
                    solicitar la corrección de su información personal en caso de que esté desactualizada, sea inexacta o incompleta (Recticación); que la eliminemos de nuestros registros o
                    bases de datos cuando considere que la misma no está siendo utilizada adecuadamente (Cancelación); así como oponerse al uso de sus datos personales para fines
                    específicos (Oposición). Estos derechos se conocen como derechos ARCO.</p>
        
                <p>Para el ejercicio de cualquiera de los derechos ARCO, debe enviar una petición vía correo electrónico a amatexperiencia@gmail.com y deberá contener:</p>
        
                <ul>
                    <li> <p class="mb-1">Nombre completo del titular.</p> </li>
                    <li> <p class="mb-1">Domicilio.</p> </li>
                    <li> <p class="mb-1">Teléfono.</p> </li>
                    <li> <p class="mb-1">Correo electrónico usado en este sitio web.</p> </li>
                    <li> <p class="mb-1">Copia de una identificación oficial adjunta.</p> </li>
                    <li> <p class="mb-1">Asunto «Derechos ARCO»</p> </li>
                </ul>
        
                <p>Descripción el objeto del escrito, los cuales pueden ser de manera enunciativa más no limitativa los siguientes: Revocación del consentimiento para tratar sus datos
                    personales; y/o Notificación del uso indebido del tratamiento de sus datos personales; y/o Ejercitar sus Derechos ARCO, con una descripción clara y precisa de los datos a
                    Acceder, Rectificar, Cancelar o bien, Oponerse. En caso de Rectificación de datos personales, deberá indicar la modificación exacta y anexar la documentación soporte; es
                    importante en caso de revocación del consentimiento, que tenga en cuenta que no en todos los casos podremos atender su solicitud o concluir el uso de forma inmediata,
                    ya que es posible que por alguna obligación legal requiramos seguir tratando sus datos personales. Asimismo, usted deberá considerar que para ciertos fines, la revocación
                    de su consentimiento implicará que no le podamos seguir prestando el servicio que nos solicitó, o la conclusión de su relación con nosotros.</p>
        
                <p class="mb-0">¿En cuántos días le daremos respuesta a su solicitud?</p>
                <p>20 días</p>
        
                <p class="mb-0">¿Por qué medio le comunicaremos la respuesta a su solicitud?</p>
                <p>Al mismo correo electrónico de donde se envío la petición.</p>
        
                <p class="font-weight-bold mb-0">El uso de tecnologías de rastreo en nuestro portal de internet</p>
                <p>Le informamos que en nuestra página de internet utilizamos cookies, web beacons u otras tecnologías, a través de las cuales es posible monitorear su comportamiento
                    como usuario de internet, así como brindarle un mejor servicio y experiencia al navegar en nuestra página. Los datos personales que obtenemos de estas tecnologías de
                    rastreo son los siguientes:</p>
        
                <p>Identificadores, nombre de usuario y contraseñas de sesión</p>
        
                <p>Estas cookies, web beacons y otras tecnologías pueden ser deshabilitadas. Para conocer cómo hacerlo, consulte el menú de ayuda de su navegador. Tenga en cuenta que,
                    en caso de desactivar las cookies, es posible que no pueda acceder a ciertas funciones personalizadas en nuestros sitio web.</p>
        
                <p class="font-weight-bold mb-0">¿Cómo puede conocer los cambios en este aviso de privacidad?</p>
                <p>El presente aviso de privacidad puede sufrir modificaciones, cambios o actualizaciones derivadas de nuevos requerimientos legales; de nuestras propias necesidades por
                    los productos o servicios que ofrecemos; de nuestras prácticas de privacidad; de cambios en nuestro modelo de negocio, o por otras causas. Nos comprometemos a
                    mantener actualizado este aviso de privacidad sobre los cambios que pueda sufrir y siempre podrá consultar las actualizaciones que existan en el sitio web
                    casaamate.com.</p>
        
                <p class="font-weight-bold mb-0">Última actualización de este aviso de privacidad: 27/04/2022.</p>
            @endif
        </div>
    </div>
@endsection

@push('js')
@endpush