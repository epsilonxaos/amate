$(function(){
    $(document).find('[rel="summer"]').each(function(i,e){
        let _id = $(e).attr('id');
        console.log(_id);
        initSummer(_id);
    });

    $(document).on('keyup', '.calc-comision', function(){
        calcularTotal(this);
    })
    $('.calc-comision').trigger('keyup');
})

function initSummer(id){
    $('#'+id).summernote();
}

function calcularTotal(el){
    var origin = $(el).data('origin'),
        id = $(el).data('id');

    var _upd = origin == 'upd' ? 'upd-' : '';
    var _costo = $('#precio-costo-'+_upd+id).val(),
        _porcentaje = $('#precio-comision-'+_upd+id).val(),
        _calc = (parseFloat(_costo) * parseFloat(_porcentaje)) / 100,
        _total = parseFloat(_costo) + parseFloat(_calc);

    $('#precio-final-'+_upd+id).text(parseFloat(_total).toFixed(2));

}
