import Swiper from 'swiper/bundle';

if(EVENTO_VIEW_DETAIL) {
    const swiperSlide = new Swiper('#swiperSlide', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        autoplay: true,
        speed: 1500
    });

    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('select[name=dia]').trigger('change');

        function updateInfoHorario() {
            let fechaID = $("#dia").val();
            let horarioID = $("#horario").val();

            let info = EHORARIOS.find(x => x.id == fechaID);
            let hora = info['horas_list'].find(x => x.id == horarioID);

            $('#horario_id').val(hora.id);
        }
    
        $('select[name=dia]').on('change', function(){
            let fechaID = $(this).val();
            let hr = $("#horario")

            let info = EHORARIOS.find(x => x.id == fechaID);
            hr.empty();
            info['horas_list'].forEach((item, idx) => {
                hr.append(`<option value="${item.id}" ${idx == 0 ? 'selected' : ''}>${item.hora}</option>`);
            });

            updateInfoHorario();
        });
    
        $('select[name=horario]').on('change', function(){
            updateInfoHorario();
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
        autoplay: {
            delay: 6000,
            disableOnInteraction: false
        },
        speed: 1500
    });

    const swiperComentarios = new Swiper('#swipercomentarios', {
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
}
