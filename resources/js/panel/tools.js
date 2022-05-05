import flatpickr from "flatpickr";
import mexico from "flatpickr/dist/l10n/es.js";

import selectpicker from 'bootstrap-select';
import * as validate from "../pages/validate";
import Swal from "sweetalert2";

$(function(){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if($('[type=date]').length > 0){
        initFlatPickr();
    }

    $('#evento_id').on('change', function(){
        getEvento();
    });

    $('#horario_id').on('change', function(){
        var _option = $(this).find('option:selected');
        $('#evento_dia').text(_option.data('fecha'));
        $('#evento_hora').text(_option.data('hora'));
    })
    $('#precio_id').on('change', function(){
        calcTotales();
    });
    $('#no_boletos').on('keyup', function(){
        calcTotales();
    })
    $('#no_boletos').on('change', function(){
        calcTotales();
    })
    $('.apply-cupon').on('click', function(){
        validarCupon();
    });

})



function initFlatPickr(){
    let _init_day = flatpickr('[type=date]', {
        locale: 'es',
        altInput: true,
        dateFormat: "Y-m-d",
    });
}

function initFlatPickrHour(){
    let _init_day = flatpickr('[type=hour]', {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
}

function render(props) {
    return function(tok, i) {
        return (i % 2) ? props[tok] : tok;
    };
}

var tmp_id = 0;
function addElement(template, content, options){
    options = eval(options);
    var items = [{
        id: tmp_id,
        objeto: JSON.stringify(options)
    }];
    if(options && Object.keys(options).length > 0){
        for(var i in options){
            opt = options[i];
            console.log(opt.element);
            items[0][opt.element] = opt.value;
        }
    }

    var itemTpl = $('script[data-template="'+template+'"]').text().split(/\{(.+?)\}/g);
    $('#'+content).append(items.map(function(item) {
        return itemTpl.map(render(item)).join('');
    }));
    tmp_id++;
}

$('.add-desc').on('click', function(){
    addElement('add_text', 'content-descripcion', '');
    $(document).find('[rel="summer"]').each(function(i,e){
        let _id = $(e).attr('id');
        initSummer(_id);
    });
})

$('.add-horario').on('click', function(){
    addElement('add_horario', 'content-horario', '');
    initFlatPickr();
    initFlatPickrHour();
})

$('.add-precio').on('click', function(){
    addElement('add_precio', 'content-precio', '');
});


function getEvento(){
    var _evento = $('#evento_id').find('option:selected').data('evento'),
        _select_horario = $('#horario_id'),
        _select_precio = $('#precio_id');
    if(typeof _evento != 'undefined'){
        $(_evento).each(function(i,e){

            _select_horario.empty();
            $(e.horarios).each(function(i, h){
               _select_horario.append('<option data-fecha="'+h.fecha+'" data-hora="'+h.hora+'" value="'+h.id+'">'+h.fecha+' '+h.hora+'</option>')
            });
            _select_horario.trigger('change');

            _select_precio.empty();
            $(e.precios).each(function(i, p){
                _select_precio.append('<option data-precio="'+p.precio_final+'" value="'+p.id+'">'+p.concepto+' $'+parseFloat(p.precio_final).toFixed(2)+'</option>')
            });
            _select_precio.trigger('change');
            $('#evento_titulo').text(e.titulo);
            $('input[name=evento_titulo]').val(e.titulo);
            $('#evento_ubicacion').text(e.lugar);
        });
    }
}


function validarCupon(){
    let _cupon = $('input[name=cupon]').val();
    $.post(PATH+'admin/orden/validar-cupon', {cupon : _cupon}, function(data){
        if(data.success){
            $('input[name=cupon_tipo]').val(data.cupon.tipo);
            $('input[name=cupon_valor]').val(data.cupon.descuento);
            calcTotales();
            validate.serverNotification(true, data.msg);
            Swal.fire('Correcto!', data.msg, 'success');
        }else{
            $('input[name=cupon_tipo]').val(0);
            $('input[name=cupon_valor]').val(0);
            calcTotales();
            Swal.fire('Ups!', data.msg, 'error');
        }
    },'json')
}

function calcTotales(){
    var _select_precio = $('#precio_id').find('option:selected'),
        _no_boletos = $('#no_boletos').val(),
        _valor_descuento    = $('input[name=cupon_valor]').val(),
        _tipo_descuento     = $('input[name=cupon_tipo]').val(),
        _descuento_aplicado = 0,
        _subtotal = parseFloat(_select_precio.data('precio')) * parseFloat(_no_boletos);

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
    var _descuento = $('input[name=descuento]').val();
    var _total = parseFloat(_descuento) <= parseFloat(_subtotal) ? parseFloat(_subtotal)  - parseFloat(_descuento) : 0;

    $('#s_subtotal').text(parseFloat(_subtotal).toFixed(2));
    $('#s_descuento').text(parseFloat(_descuento).toFixed(2));
    $('#s_total').text(parseFloat(_total).toFixed(2));
    $('input[name="subtotal"]').val(parseFloat(_select_precio.data('precio')).toFixed(2));

}
