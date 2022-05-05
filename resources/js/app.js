require('./bootstrap');
global.$ = global.jQuery = require('jquery');
require('@fancyapps/fancybox');
document.addEventListener("DOMContentLoaded", function (event) {
    document.getElementById('btn-menu-toggle').addEventListener('click', function(){
        this.classList.toggle('active');
        document.querySelector('.sidebar-left').classList.toggle('active');
    }, false);

	setTimeout(() => {
        $('.loading').fadeOut(350);
        console.log('Ejecutar');
    }, 1500);
});

$('#enviar-suscripcion-footer').on('click', function(){
    let _folio = $('#modal_folio').val();
    if(_folio === '' || /^\s+$/.test(_folio)){
        $('#modal-error-folio').removeClass('d-none');
    }else{
        $('#modal-error-folio').addClass('d-none');
        window.location.href = PATH+'consultar/folio/'+_folio;
    }
})