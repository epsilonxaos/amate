// import 'owl.carousel';
import Swiper from 'swiper/bundle';

// $('.owl-carousel').owlCarousel({
//     center: true,
//     items: 1,
//     loop: true,
//     margin: 30,
//     nav: true,
//     responsive:{
//         600:{
//             items: 2
//         }
//     }
// });

if(EVENTO_VIEW_DETAIL) {
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('select[name=dia]').trigger('change');
    
        $('select[name=dia]').on('change', function(){
            getHours();
            showData();
        });
    
        $('select[name=horario]').on('change', function(){
            showData();
        });
    })
    
    function getHours(){
        let _evento_id = $('input[name=evento_id]').val(),
            _select_day = $('select[name=dia]').find('option:selected').val(),
            _select_hour = $('select[name=horario]');
        $.post(PATH+'get/hour', {id : _evento_id, day : _select_day }, function(data){
            if(data.success){
                _select_hour.empty();
                _select_hour.append('<option data-id="0" value="">Selecciona el horario de la función</option>');
                $(data.data).each(function(i,e){
                    _select_hour.append('<option '+e.disabled+' data-id="'+e.id+'" value="'+e.hora+'">'+e.hora+'</option>');
                })
            }
        }, 'json');
    }
    function showData(){
        let _select_day = $('select[name=dia]').find('option:selected'),
            _select_horario = $('select[name=horario]').find('option:selected'),
            _id_horario = $('select[name=horario]').find('option:selected').data('id'),
            _boletos = $('input[name=boletos]');
        $('input[name=horario_id]').val(_id_horario);
        $('#s_day').text(_select_day.text())
        $('#s_hour').text(_select_horario.text())
        $('#s_boletos').text(_boletos.val());
    }
} else {
    const swiperSlide = new Swiper('#swiperSlide', {
        pagination: {
            el: '.swiper-pagination',
            clickable: true
        },
    });

    const swiperComentarios = new Swiper('#swipercomentarios', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
}
