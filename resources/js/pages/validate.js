import alertify from 'alertifyjs/build/alertify.min';
var _notification_center = {
    'general' : {
        0 : 'Ha ocurrido un error intentelo más tarde.',
        1 : 'Registro completado.',
        2: "Registro eliminado correctamente"
    },
    'customer' : {
        1 : 'Este correo ya existe intente con otro.',
        2 : 'Ha ocurrido un error intentelo más tarde.',
        3 : 'Registro completado.',
        4 : 'Datos editados correctamente.',
        5 : 'Tu sesión ha expirado.',
    },
    'validate' : {
        'pass' : 'Las contraseña no coinciden.',
        'terms' : 'Acepte los términos y condiciones para continuar.',
        'general' : 'Los campos marcados en rojo son obligatorios.',
        'captcha' : 'Favor de validar el reCaptcha'
    },
    'login' : {
        0 : 'El correo no existe.',
        1 : 'La contraseña es incorrecta.',
        3 : 'Por favor, ingrese una contraseña.',
        4 : 'El correo es inválido.',
        5: 'Bienvenido'
    },
    'orden' : {
        0 : 'Tu sesión ha expirado, inicia sesion de nuevo.',
        1 : 'Ocurrio un problema, intentalo más tarde.',
        2 : 'Orden creada correctamente',
        3 : 'Completa los datos fiscales para poder continuar.',
        4 : 'Selecciona un metodo de pago para continuar.',
        5 : 'Pago en proceso.',
        6 : 'No se pudo detectar el indentificador de la orden.',
        1001 : 'Esta orden ha sido procesada.',
        1006 : 'Esta orden ha sido pagada',
        3001 : 'La tarjeta fue declinada.',
        3002 : 'La tarjeta ha expirado.',
        3003 : 'La tarjeta no tiene fondos suficientes.',
        3004 : 'La tarjeta ha sido identificada como una tarjeta robada.',
        3005 : 'La tarjeta ha sido rechazada por el sistema antifraudes.',
        3006 : 'La operación no está permitida para este cliente o esta transacción.',
        3007 : 'La tarjeta fue declinada.',
        3008 : 'La tarjeta no es soportada en transacciones en línea.',
        3009 : 'La tarjeta fue reportada como perdida.',
        3010 : 'El banco ha restringido la tarjeta.',
        3011 : 'El banco ha solicitado que la tarjeta sea retenida. Contacte al banco.',
        3012 : 'Se requiere solicitar al banco autorización para realizar este pago.'
    },
    'status' : {
        0 : 'Elemento Desactivado',
        1 : 'Elemento Activado'
    },
    'vehiculo' : {
        0 : 'Error al crear el vehiculo',
        1 : 'Completa los campos en rojo para poder continuar',
        2 : 'Auto creado correctamente',
        3 : 'Orden guardado'
    },
    'cupon' : {
        0 : 'Código inválido o expirado.',
        1 : 'Tu sesión ha expirado.',
        2 : 'Ya haz usado este cupón.',
        3 : 'Limite del cupon superado.',
        4 : 'Cupón aplicado correctamente.'
    },
    'favoritos': {
        0: 'Eliminado de favoritos',
        1: 'Agregado a favoritos'
    },
    'rating' :{
        0: '!Gracias por tu calificación¡',
        1: 'Ocurrió un error, inténtalo más tarde',
    }
}

function serverNotification(success, msg){
    success ? alertify.success(msg).dismissOthers() : alertify.error(msg).dismissOthers()
}

function simpleNotification(msg){
    alertify.error(msg).dismissOthers();
}

function notification(seccion, code, status){
    if (status === 'error')
        alertify.error(_notification_center[seccion][code]).dismissOthers();
    else if (status === 'success')
        alertify.success(_notification_center[seccion][code]).dismissOthers();
}


function validateAnyForm(_idForm){
    var _valid = true,
        _notification = $('#'+_idForm).find('input[name=notification]').val();//Agregar este campo en los formularios para notificar
    let _notify = typeof _notification !== 'undefined' ? _notification : 'true';

    // Validar Textarea
    $('#'+_idForm).find('textarea').each(function(){
        var _textarea = $(this);
        var _name = _textarea.attr('name');
        var _dataValid = _textarea.attr('required');
        var _valueText = _textarea.val();
        var _dataTextArea = _textarea.attr('data-text');
        var _placeholder = _textarea.attr('placeholder');

        if(typeof _dataValid !== "undefined"){
            if(_valueText === '' || /^\s+$/.test(_valueText)){
                _valid = false;
                _textarea.addClass('is_invalid').removeClass('is_valid');
            }else {
                _textarea.removeClass('is_invalid').addClass('is_valid');
            }
        }
    });

    // Validar select
    $('#'+_idForm).find('select').each(function(){
        var _select= $(this);
        var _dataValid = _select.attr('required');
        var _valueText = _select.val();

        if(typeof _dataValid !== "undefined"){
            if(_valueText === '0' || _valueText == '' ){
                _valid = false;
                console.log('here');
                _select.addClass('is_invalid').removeClass('is_valid');
            }else {
                console.log('no here');
                _select.removeClass('is_invalid').addClass('is_valid');
            }
        }
    });

    // Validando Inputs
    $('#'+_idForm).find('input').each(function(){
        var _input = $(this);
        var _type = _input.attr('type');
        var _value = _input.val();
        var _dataValid = _input.attr('required');

        // Tipo: Numero
        if(_type == 'number' && typeof _dataValid !== "undefined"){
            if(_value === '' || /^\s+$/.test(_value)){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else{
                _input.removeClass('is_invalid').addClass('is_valid');
            }
        }

        // Tipo: File
        if(_type == 'file' && typeof _dataValid !== "undefined"){
            if(_value === '' || /^\s+$/.test(_value)){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else{
                _input.removeClass('is_invalid').addClass('is_valid');
            }
        }

        // Tipo: Texto
        if(_type == 'text' && typeof _dataValid !== "undefined"){
            if(_value === '' || /^\s+$/.test(_value)){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else{
                _input.removeClass('is_invalid').addClass('is_valid');
            }
        }

        // Tipo: Email
        if(_type == 'email' && typeof _dataValid !== "undefined"){
            if(_value.length == 0 || /^\s+$/.test(_value)){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else if(!validarEmail(_value)){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else{
                _input.removeClass('is_invalid').addClass('is_valid');
            }
        }

        // Tipo: Telefono
        if(_type == 'phone' && typeof _dataValid !== "undefined"){
            if(_value.length === 0 ){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else if(_value.length < 7){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else{
                _input.removeClass('is_invalid').addClass('is_valid');
            }
        }

        // Tipo: Checkbox
        if(_type == 'checkbox' && typeof _dataValid !== "undefined"){
            if(!$(this).is(':checked')){
                _valid = false;
                _input.addClass('is_invalid').removeClass('is_valid');
            }else{
                _input.removeClass('is_invalid').addClass('is_valid');
            }
        }

    });

    // Validando grupo de radios buttons
    $('#'+_idForm).find('.radio-validate').each(function(){
        let radio = $(this).attr('name');
        let radio_valid = $('input[name='+radio+']');
        if(!radio_valid.is(':checked')){
            _valid = false;
            radio_valid.next().addClass('is_invalid').removeClass('is_valid');
        }else{
            radio_valid.next().removeClass('is_invalid').addClass('is_valid');
        }
    });

    // Mandar mensaje de error si es falso
    if(!_valid){
        if(_notify == 'true')
            $('#'+_idForm).addClass('was-validated'); 
            notification("validate", "general", "error");
    }

    return _valid;
}

/*$(function(){
    let _form_to_validate = $('.validate-fields');
    if(_form_to_validate.length > 0){
        if(validateAnyForm('form-formularios')){
            $('#show-alert').addClass('hidden');
        }else{
            $('#show-alert').removeClass('hidden');
        }
    }
})*/

/*$('[data-phone=true]').each(function () {
    $(this).mask('(000) 000-0000');
});

$('[data-money="true"]').each(function () {
    $(this).mask('000,000,000.00', {reverse: true});
})

$('[data-year]').each(function(){
    $(this).mask('0000');
});

$('[data-number]').each(function(){
    $(this).mask('000,000,000', {reverse: true});
});

$('[data-cp]').each(function(){
    $(this).mask('00000', {reverse: true});
});*/


function validarEmail(_email) {
    var _exp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/
    if(!_exp.test(_email) )
        return false;
    else
        return true;
}

export {validateAnyForm, serverNotification, simpleNotification};
