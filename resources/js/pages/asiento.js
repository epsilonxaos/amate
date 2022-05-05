import * as validate from './validate';
global.$ = global.jQuery = require('jquery');
require('jquery-countdown');


$(function(){
    let _time = $('[data-countdown]').data('countdown');

    $('#getting-started').countdown(_time, function(event) {
        $(this).html(event.strftime('%M:%S'));
    }).on('finish.countdown', function(){
        window.location.href=PATH+'sesion/expirada';
    });

    listAsientos();

    $(document).on('click', '.batch', function(){
        $(this).toggleClass('on');
    })

    $('.continuar').on('click', function(){
        continuar();
    })
});

function listAsientos(){
    $(_asientos).each(function(i, e){
       let _asiento = $('#'+e.rel_id);
       if(parseInt(e.status) == 2){
           _asiento.addClass('batch_reserved');
       }else{
           if(parseInt(e.status) == 1){
               _asiento.addClass('batch');
               _asiento.addClass('batch_enabled');
               _asiento.attr('data-id', e.id);
               _asiento.attr('data-precio', e.precio);
           }else{
               _asiento.addClass('batch_disabled')
           }
       }
    });
}

function continuar(){
    let _asientos_selected = [],
        _asientos_precios = [];
    $('.batch.on').each(function(){
        var _id = $(this).attr('data-id'),
            _precio = $(this).attr('data-precio');
        _asientos_selected.push(_id);
        _asientos_precios.push(_precio);
    })
    console.log(_asientos_selected.length);
    if(_asientos_selected.length > 0){
        $('input[name="asientos_selected"]').val(_asientos_selected.toString())
        $('input[name="asientos_precio"]').val(_asientos_precios.toString())
        $('#form-asientos').submit();
    }else{
        console.log('entre');
        validate.simpleNotification('Selecciona un asiento para poder continuar');
    }
}

