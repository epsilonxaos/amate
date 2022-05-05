import * as validate from './validate';
global.$ = global.jQuery = require('jquery');
require('jquery-countdown');
import inputmask from 'inputmask/dist/inputmask';

$(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let _time = $('[data-countdown]').data('countdown');

    $('#getting-started').countdown(_time, function(event) {
        $(this).html(event.strftime('%M:%S'));
    }).on('finish.countdown', function(){
        window.location.href=PATH+'sesion/expirada';
    });

    $('input[name=metodo]').on('change', function(){
       let selected = $('input[name=metodo]:checked').val();
       if(selected == 'tarjeta'){
           $('#content_tarjeta').removeClass('d-none');
           $('#content_tarjeta').find('input').each(function(i,e){
              $(e).prop('required', true);
           });
       }else{
           $('#content_tarjeta').addClass('d-none');
           $('#content_tarjeta').find('input').each(function(i,e){
               $(e).prop('required', false);
           });
       }
    });

    $('input[name=precio_id]').trigger('change');

    $('input[name=precio_id]').on('change', function(){
        calcTotal();
    })

    $('input[name=boletos]').on('keyup', function(){
        calcTotal()
    })
    $('input[name=boletos]').on('change', function(){
        calcTotal()
    })

    $('.do-pay').on('click', function(){
        pay(this);
    })

    $('input[name=nombre_tarjeta]').focusout(function(){
        copyForm();
    })
    $('input[name=numero_tarjeta]').focusout(function(){
        copyForm();
    })
    $('input[name=mes_exp]').focusout(function(){
        copyForm();
    })
    $('input[name=anio_exp]').focusout(function(){
        copyForm();
    })
    $('input[name=cvc]').focusout(function(){
        copyForm();
    })

    $('.apply-cupon').on('click', function(){
       validarCupon();
    });
    var telefono = document.getElementById('pago_telefono');
    var tarjeta = document.getElementById('tarjeta_show');
    var mes = document.getElementById('mes_show');
    var anio = document.getElementById('anio_show');
    inputmask('9999999999').mask(telefono);
    inputmask('9999999999999999').mask(tarjeta);
    inputmask('99').mask(mes);
    inputmask('9999').mask(anio);


})

function copyForm(){
    let _nombre = $('input[name=nombre_tarjeta]').val(),
        _numero = $('input[name=numero_tarjeta]').val(),
        _mes = $('input[name=mes_exp]').val(),
        _anio = $('input[name=anio_exp]').val(),
        _cvv = $('input[name=cvc]').val();

    $('#nombretarjetahabiente').val(_nombre),
    $('#tarjeta').val(_numero),
    $('#mes_exp').val(_mes),
    $('#anio_exp').val(_anio),
    $('#cvc').val(_cvv);

}


function validarCupon(){
    let _cupon = $('input[name=cupon]').val();
    $.post(PATH+'validar-cupon', {cupon : _cupon}, function(data){
        if(data.success){
            $('input[name=cupon_tipo]').val(data.cupon.tipo);
            $('input[name=cupon_valor]').val(data.cupon.descuento);
            calcTotal();
            validate.serverNotification(true, data.msg);
        }else{
            $('input[name=cupon_tipo]').val(0);
            $('input[name=cupon_valor]').val(0);
            calcTotal();
            validate.serverNotification(false, data.msg);
        }
    },'json')
}


function calcTotal(){
    let _subtotal           = $('input[name=subtotal]').val(),
        _valor_descuento    = $('input[name=cupon_valor]').val(),
        _tipo_descuento     = $('input[name=cupon_tipo]').val(),
        _descuento          = 0,
        _descuento_aplicado = 0,
        _total              = 0,
        _evento_tipo        = $('input[name="evento_tipo"]').val();


    if(parseInt(_evento_tipo) == 0 ){
        var _precio_check = $('input[name=precio_id]:checked'),
            _valor_precio = _precio_check.data('precio'),
            _cantidad = $('input[name=boletos]').val();
        _subtotal = parseFloat(_valor_precio) * parseFloat(_cantidad);
        $('#no_boletos').text(_cantidad);
        $('input[name=precio_boleto]').val(_valor_precio);
    }

    if(parseFloat(_valor_descuento) > 0){
        if(parseInt(_tipo_descuento) == 2){
            _descuento_aplicado = (parseFloat(_valor_descuento) * parseFloat(_subtotal)) / 100;
            $('input[name=descuento]').val(_descuento_aplicado);
        }else{
            _descuento_aplicado = _valor_descuento
            $('input[name=descuento]').val(_descuento_aplicado);
        }
    }else{
        $('input[name=descuento]').val(0);
    }
    _descuento = $('input[name=descuento]').val();
    _total = parseFloat(_descuento) <= parseFloat(_subtotal) ? parseFloat(_subtotal)  - parseFloat(_descuento) : 0;

    $('#s_subtotal').text(monedaChange(_subtotal));
    $('#s_descuento').text(monedaChange(_descuento));
    $('#s_total').text(monedaChange(_total));
    $('input[name=amount]').val(_total);

}

/*function calcTotal(){
    let _precio = $('input[name=donativo]:checked').val(),
        _boletos = $('input[name=boletos]').val(),
        _valor_descuento = $('input[name=cupon_valor]').val(),
        _tipo_descuento = $('input[name=cupon_tipo]').val();

    let _subtotal = 0,
        _descuento = 0,
        _descuento_aplicado = 0,
        _total = 0;
    if($('input[name=donativo]').is(':checked')) {
        _subtotal = parseFloat(_boletos) > 0 && _boletos != '' ? parseFloat(_precio) * parseFloat(_boletos) : 0;
        if(parseFloat(_valor_descuento) > 0){
            if(parseInt(_tipo_descuento) == 2){
                _descuento_aplicado = (parseFloat(_valor_descuento) * parseFloat(_subtotal)) / 100;
                $('input[name=descuento]').val(_descuento_aplicado);
            }else{
                _descuento_aplicado = _valor_descuento
                $('input[name=descuento]').val(_descuento_aplicado);
            }
        }else{
            $('input[name=descuento]').val(0);
        }
        _descuento = $('input[name=descuento]').val();
        _total = parseFloat(_descuento) <= parseFloat(_subtotal) ? parseFloat(_subtotal)  - parseFloat(_descuento) : 0;
    }

    $('#s_subtotal').text(monedaChange(_subtotal));
    $('#s_descuento').text(monedaChange(_descuento));
    $('#s_total').text(monedaChange(_total));
    $('input[name=amount]').val(_total);
}*/

function pay(btn){
    let _url = $(btn).data('route');
    if(validate.validateAnyForm('form_pago')){
        saveForm('form_pago', _url, btn, function(data){
            console.log(data);
            if(data.success){
                payMethod()
            }else{
                validate.serverNotification(false, data.msg);
            }
        });
    }
}

function saveForm(id,url, btn, cb){
    let _form = $('#'+id);
    $(btn).prop('disabled', true);
    $.post(url, _form.serialize(), function(data){
        $(btn).prop('disabled', false);
        cb(data);
    }, 'json');
}

function payMethod(){
    let _method_pay = $('input[name=metodo]:checked').val(),
        _total = $('input[name=amount]').val();
    if(parseFloat(_total) > 0){
        if(_method_pay == 'paypal'){
            $('#paypal').submit();
        }else if(_method_pay == 'oxxo'){
            $('#oxxo-form').submit();
        }else{
            $('#card-form').submit();
        }
    }else{
        $('#free-form').submit();
    }
}

function monedaChange (cantidad = 0, cif = 3, dec = 2) {
    // tomamos el valor que tiene el input
    let inputNum = cantidad;
    // Lo convertimos en texto
    inputNum = inputNum.toString()
    // separamos en un array los valores antes y después del punto
    inputNum = inputNum.split('.')

    let decim='';
    // evaluamos si existen decimales
    if (!Boolean(inputNum[1])) {
        decim = '00';
    }else{
        for (let i = 0; i < dec; i++) {
            if (Boolean(inputNum[1][i])) {
                decim = decim + inputNum[1][i];
            }else{
                decim = decim + '0';
            }
        }
    }

    let separados;
    // se calcula la longitud de la cadena
    if (inputNum[0].length > cif) {
        let uno = inputNum[0].length % cif
        if (uno === 0) {
            separados = []
        } else {
            separados = [inputNum[0].substring(0, uno)]
        }
        let posiciones = parseInt(inputNum[0].length / cif)
        for (let i = 0; i < posiciones; i++) {
            let pos = ((i * cif) + uno)
            separados.push(inputNum[0].substring(pos, (pos + 3)))
        }
    } else {
        separados = [inputNum[0]]
    }



    return separados.join(',') + '.' + decim;
};

export {saveForm}
