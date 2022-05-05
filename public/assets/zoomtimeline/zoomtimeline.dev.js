// -- ZoomTimeline
// @version 0.90
// @this is not free software
// -- ZoomTimeline @copyright -- http://digitalzoomstudio.net


"use strict";

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};
if(window.jQuery==undefined){
    alert("dzstabs.js -> jQuery is not defined or improperly declared ( must be included at the start of the head tag ), you need jQuery for this plugin");
}
jQuery.fn.outerHTML = function(e) {
    return e
        ? this.before(e).remove()
        : jQuery("<p>").append(this.eq(0).clone()).html();
};

window.dzsztm_self_options = {};



window.dzsshuffle_currTarget = null;
window.dzsshuffle_finaltext = '';
window.dzsshuffle_finaltext_arr = '';
window.dzsshuffle_temp_arr = '';

function shuffleText(_arg, finaltext, pargs){

    //console.info(_arg);



    var margs = {
        fps: 20
    }

    if(pargs){
        margs = jQuery.extend(margs,pargs);
    }



    //console.info(_arg);
    if(_arg && window.dzsshuffle_currTarget){
        //console.info(window.dzsshuffle_currTarget, _arg.get(0), _arg.get(0) == window.dzsshuffle_currTarget.get(0));
    }

    if(window.dzsshuffle_currTarget && _arg.get(0) != window.dzsshuffle_currTarget.get(0)){

        window.dzsshuffle_currTarget.text(window.dzsshuffle_finaltext);
        window.dzsshuffle_currTarget.data('terminate-now','on');

        _arg.data('terminate-now','off');

    }


    //console.warn(finaltext, window.dzsshuffle_finaltext);
    if(finaltext!=window.dzsshuffle_finaltext){


        //console.warn(finaltext);

        var initialText = _arg.text();



        //console.warn("YES");
        window.dzsshuffle_finaltext = finaltext;
        var finaltext_arr = finaltext.split("");
        window.dzsshuffle_finaltext_arr = finaltext_arr;

        window.dzsshuffle_temp_arr = initialText.split("");




        _arg.data('current_k', 0);
        _arg.data('current_k_try', 0);




    }

    //console.info(window.dzsshuffle_temp_arr);




    if( !(_arg.data('current_k')) || isNaN(_arg.data('current_k')) ){
        _arg.data('current_k', 0);
    }

    //console.info(Number(_arg.data('current_k')), window.dzsshuffle_finaltext_arr.length)
    if( ( (Number(_arg.data('current_k'))) >=  window.dzsshuffle_finaltext_arr.length ) || _arg.data('terminate-now')=='on'){

        //console.log(Number(_arg.data('current_k')), window.dzsshuffle_finaltext_arr.length, _arg.data('terminate-now'))

        _arg.text(window.dzsshuffle_finaltext);
        //console.error("RETURN");
        return false;
    }


    if( (Number(_arg.data('current_k_try'))) == 1){

        for(var i2 = _arg.data('current_k')+1;i2<window.dzsshuffle_finaltext_arr.length;i2++){

            window.dzsshuffle_temp_arr[i2] = randomChar();


        }
    }

    if( !(_arg.data('finaltext')) ){
        _arg.data('finaltext', window.dzsshuffle_finaltext);
    }


    var i = _arg.data('current_k');

    //console.info(temptext_arr, finaltext_arr);





    var temp_type = '';

    var ch = window.dzsshuffle_finaltext_arr[i];

    if(ch == " "){
        temp_type = "space";
    }
    else if(/[a-z]/.test(ch)){
        temp_type = "lowerLetter";
    }
    else if(/[A-Z]/.test(ch)){
        temp_type = "upperLetter";
    }
    else {
        temp_type = "symbol";
    }


    //console.warn(_arg.data('current_k_try'));


    setTimeout(function(){

        var aux = randomChar(temp_type);

        if(_arg.data('current_k_try')>4){
            aux = window.dzsshuffle_finaltext_arr[i];
        }

        //console.info(aux, window.dzsshuffle_finaltext_arr[i]);
        window.dzsshuffle_temp_arr[_arg.data('current_k')] = aux;
        _arg.text(window.dzsshuffle_temp_arr.join(""));

        if(aux==window.dzsshuffle_finaltext_arr[i] || temp_type=='space'){
            _arg.data('current_k', Number(_arg.data('current_k'))+1);
            _arg.data('current_k_try', 0);


            shuffleText(_arg,window.dzsshuffle_finaltext,margs);
        }else{

            shuffleText(_arg,window.dzsshuffle_finaltext,margs);
            _arg.data('current_k_try', Number(_arg.data('current_k_try'))+1);
        }
    },30)



}


function randomChar(type){
    var pool = "";


    if(typeof type=="undefined"){

        var aux = Math.random()*3;

        aux = Math.floor(aux);

        //console.info(aux);

        if(aux==0){
            type = 'lowerLetter';
        }

        if(aux==1){
            type = 'upperLetter';
        }

        if(aux==2){
            type = 'symbol';
        }
    }

    //console.info(type);

    if (type == "lowerLetter"){
        pool = "abcdefghijklmnopqrstuvwxyz0123456789";
    }
    else if (type == "upperLetter"){
        pool = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    }
    else if (type == "symbol"){
        pool = ",.?/\\(^)![]{}*&^%$#'\"";
    }


    var arr = pool.split('');
    return arr[Math.floor(Math.random()*arr.length)];
}

(function($) {


    $.fn.prependOnce = function(arg, argfind) {
        var _t = $(this) // It's your element


//        console.info(argfind);
        if(typeof(argfind) =='undefined'){
            var regex = new RegExp('class="(.*?)"');
            var auxarr = regex.exec(arg);


            if(typeof auxarr[1] !='undefined'){
                argfind = '.'+auxarr[1];
            }
        }


        // we compromise chaining for returning the success
        if(_t.children(argfind).length<1){
            _t.prepend(arg);
            return true;
        }else{
            return false;
        }
    };
    $.fn.appendOnce = function(arg, argfind) {
        var _t = $(this) // It's your element


        if(typeof(argfind) =='undefined'){
            var regex = new RegExp('class="(.*?)"');
            var auxarr = regex.exec(arg);


            if(typeof auxarr[1] !='undefined'){
                argfind = '.'+auxarr[1];
            }
        }
//        console.info(_t, _t.children(argfind).length, argfind);
        if(_t.children(argfind).length<1){
            _t.append(arg);
            return true;
        }else{
            return false;
        }
    };


    $.fn.zoomtimeline = function(o) {

        //==default options
        var defaults = {
            design_skin : 'skin-default' // -- skin-default, skin-boxed, skin-melbourne or skin-blue
            , settings_mode : 'mode-default' // -- skin-default, skin-boxed, skin-melbourne or skin-blue
            , design_transition : 'default' // default, fade or slide
            , design_tabsposition : 'top' // -- set top, right, bottom or left
            , design_tabswidth : 'default' // -- set the tabs width for position left or right, if tabs position top or bottom and this is set to fullwidth, then the tabs will cover all the width
            , design_maxwidth : '4000'
            ,settings_makeFunctional: false
            ,settings_appendWholeContent: false // -- take the whole tab content and append it into the dzs tabs, this makes complex scripts like sliders still work inside of tabs
            ,toggle_breakpoint: '320' //  -- a number at which bellow the tabs will trasform to toggles
            ,toggle_type: 'accordion' // -- normally, the  toggles act like accordions, but they can act like traditional toggles if this is set to toggle
            ,refresh_tab_height: '0' // -- normally, the  toggles act like accordions, but they can act like traditional toggles if this is set to toggle
            ,outer_menu: null // -- normally, the  toggles act like accordions, but they can act like traditional toggles if this is set to toggle



            ,settings_isotope_settings: {
                getSortData: {
                    number: function ($elem) {
                        return parseInt($($elem).attr('data-sort'), 10);
                    }
                }

                , itemSelector: '.isotope-item'
                , sortBy: 'number'
                ,layoutMode: 'packery'
                //,percentPosition: true
                ,masonry: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: '.grid-sizer'
                }
                // -- packery does not sort whel percent Position
                ,packery: {
                    // use outer width of grid-sizer for columnWidth
                    columnWidth: 1
                }
            } // -- the default isotope settings

        };

//        console.info(this, o);

        if(typeof o =='undefined'){
            if(typeof $(this).attr('data-options')!='undefined'  && $(this).attr('data-options')!=''){
                var aux = $(this).attr('data-options');
                aux = 'window.dzsztm_self_options = ' + aux;
                eval(aux);
                o = $.extend({}, window.dzsztm_self_options);
                window.dzsztm_self_options = $.extend({},{});
            }
        }
        o = $.extend(defaults, o);
        this.each( function(){
            var cthis = $(this)
                , cclass = ''
                ,cid = ''
                ;
            var nrChildren ;
            var currNr=-1
                ,currNrEx=-1
                ;
            var mem_children = [];
            var _detailsContainer = null
                ,_yearlist = null
                ,_cachY = null
                ,_items = null
                ,_c
                ,_carg
                ;
            var i=0;
            var ww
                ,wh
                ,tw
                ,conw = 0 // -- the container width
                ,targeth
                ,padding_content = 20
                ;

            var currNr = -1
                , tempNr = -1
                ;

            var imgs_tobe_loaded = 0;
            var busy_transition=false;
            var handled = false; //describes if all loaded function has been called


            var proportions_arr = []
                ,pos_proportions_arr = []
                ,mode_slider_ttw = 0
                ;

            var preloading_nrtotalimages = 0
                ,preloading_nrtotalimagesloaded = 0
                ;

            var animation_slide_vars = {
                'duration' : 300
                ,'queue' : false
            }





            init();
            function init(){

                if(handled==true || cthis.hasClass('dzsztm-loaded') || cthis.hasClass('inited')){
                    reinit();
                    return;
                }



                if(typeof(cthis.attr('class')) == 'string'){
                    cclass = cthis.attr('class');
                }else{
                    cclass=cthis.get(0).className;
                }




                cid = cthis.attr('id');
                if(typeof cid=='undefined' || cid==''){
                    var auxnr = 0;
                    var temps = 'dzs-tabs'+auxnr;

                    while($('#'+temps).length>0){
                        auxnr++;
                        temps = 'dzs-tabs'+auxnr;
                    }

                    cid = temps;
                    cthis.attr('id', cid);
                }



                if(cclass.indexOf('skin-')==-1){
                    cthis.addClass(o.design_skin);
                }

                if(cthis.hasClass('skin-default')){
                    o.design_skin = 'skin-default';
                }

                if(cclass.indexOf('mode-')==-1){
                    cthis.addClass(o.settings_mode);
                }

                if(cthis.hasClass('mode-default')){
                    o.settings_mode = 'mode-default';
                }
                if(cthis.hasClass('mode-oncenter')){
                    o.settings_mode = 'mode-oncenter';
                }
                if(cthis.hasClass('mode-slider')){
                    o.settings_mode = 'mode-slider';
                }
                if(cthis.hasClass('mode-slider-variation')){
                    o.settings_mode = 'mode-slider-variation';
                }
                if(cthis.hasClass('mode-yearslist')){
                    o.settings_mode = 'mode-yearslist';
                }
                if(cthis.hasClass('mode-blackwhite')){
                    o.settings_mode = 'mode-blackwhite';
                }
                if(cthis.hasClass('mode-masonry')){
                    o.settings_mode = 'mode-masonry';
                }



                if(o.design_transition=='default'){
                    o.design_transition='fade';
                }

                if(o.design_tabswidth=='default'){
                    if(o.design_tabsposition=='left' || o.design_tabsposition=='right'){
                        o.design_tabswidth = 'auto';
                    }else{
                        o.design_tabswidth = 'auto';
                    }

                }

                //console.info(o.settings_mode);

                if(o.settings_mode=='mode-slider'){
                    if(window.dzsscr_init){

                    }else{
                        console.info(o.settings_mode+' zoomtimeline - scroller must be inited for this mode');

                        return false;
                    }
                }

                if(o.settings_mode=='mode-slider-variation'){
                    if(window.dzsscr_init){

                    }else{
                        console.info(o.settings_mode+' zoomtimeline - scroller must be inited for this mode');

                        return false;
                    }
                }




                _items = cthis.children('.items');



                if(o.settings_mode=='mode-slider'){
                    cthis.append('<div class="scroller-con skin_cerc auto-height" style="height: auto" data-options=\'{ enable_easing : "on" }\'><div class="inner inner-for-horizontal"></div></div>');
                    cthis.append('<div class="sc-descriptions"><div class="sc-descriptions-content"></div></div>');
                }

                if(o.settings_mode=='mode-slider-variation'){
                    cthis.append('<div class="sc-descriptions"><div class="sc-descriptions-content"></div></div>');
                    cthis.append('<div class="scroller-con skin_luna auto-height" style="height: auto" data-options=\'{ enable_easing : "on" }\'><div class="inner inner-for-horizontal"></div></div>');
                }

                if(o.settings_mode=='mode-yearslist'){
                    cthis.append('<div class="yearlist-con"><div class="yearlist-container"><div class="yearlist-line"></div><div class="yearlist"></div></div></div>');
                    cthis.append('<div class="details-container"><div class="diamond-arrow-left"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve"> <style type="text/css"> <![CDATA[ .st0{fill:#EEEEEE;} .st1{fill:#222222;} ]]> </style> <g id="Layer_1"> </g> <g id="Layer_2"> <rect x="8.787" y="8.787" transform="matrix(0.7071 0.7071 -0.7071 0.7071 30.0006 -12.4271)" class="st1" width="42.427" height="42.426"/> </g> <g id="Layer_3"> <g> <path class="st0" d="M17.154,31.003c0,0.129,0.028,0.257,0.078,0.379c0.048,0.119,0.121,0.225,0.208,0.315 c0.002,0.005,0.005,0.007,0.007,0.012l6.012,6.012c0.391,0.392,1.025,0.392,1.416,0c0.392-0.389,0.392-1.026,0-1.417l-4.3-4.302 h19.624c0.552,0,1.002-0.449,1.002-1.003c0-0.553-0.45-1.001-1.002-1.001H20.575l4.3-4.301c0.392-0.391,0.392-1.026,0-1.416 c-0.391-0.392-1.025-0.392-1.416,0l-6.012,6.011c-0.002,0.002-0.005,0.008-0.007,0.011c-0.087,0.09-0.16,0.196-0.208,0.314 c-0.052,0.123-0.078,0.253-0.078,0.382l0,0C17.154,31.002,17.154,31.002,17.154,31.003z"/> </g> </g> </svg></div><div class="diamond-arrow-right"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="60px" height="60px" viewBox="0 0 60 60" style="enable-background:new 0 0 60 60;" xml:space="preserve"> <style type="text/css"> <![CDATA[ .st0{fill:#EEEEEE;} .st1{fill:#222222;} ]]> </style> <g id="Layer_1"> </g> <g id="Layer_2"> <rect x="8.787" y="8.787" transform="matrix(0.7071 0.7071 -0.7071 0.7071 30.0006 -12.4271)" class="st1" width="42.427" height="42.426"/> </g> <g id="Layer_3"> <g> <path class="st0" d="M41.201,29.998c0-0.129-0.028-0.257-0.078-0.379c-0.048-0.12-0.121-0.226-0.209-0.316 c-0.002-0.005-0.005-0.007-0.007-0.012l-6.023-6.023c-0.392-0.393-1.027-0.393-1.419,0c-0.393,0.389-0.393,1.028,0,1.419 l4.309,4.311H18.109c-0.553,0-1.004,0.45-1.004,1.006c0,0.554,0.451,1.003,1.004,1.003h19.664l-4.309,4.31 c-0.393,0.391-0.393,1.028,0,1.418c0.392,0.393,1.027,0.393,1.419,0l6.023-6.022c0.002-0.002,0.005-0.008,0.007-0.011 c0.088-0.09,0.161-0.196,0.209-0.315c0.052-0.123,0.078-0.253,0.078-0.382l0,0C41.201,29.999,41.201,29.999,41.201,29.998z"/> </g> </g> </svg> </div></div>');


                    _detailsContainer = cthis.children('.details-container');
                    _yearlist = cthis.find('.yearlist').eq(0);

                }







                reinit();






                $(window).bind('resize', handle_resize);
                handle_resize();


                var delay = 200;
                if(o.settings_mode=='mode-yearslist'){
                    delay = 500;
                    gotoItem(0);


                    cthis.find('.diamond-arrow-left,.diamond-arrow-right').bind('click',handle_click);

                }
                if(o.settings_mode=='mode-slider-variation'){
                    delay = 200;
                    gotoItem(0);

                    setTimeout(function(){
                        //gotoItem(1);
                    },1500)


                }
                setTimeout(function(){
                    cthis.addClass('ztm-ready');
                }, delay)

                cthis.addClass('inited');

            }

            function reinit(){

                var i2 = 0;
                if(_items){
                    _items.children('.ztm-item:not(.inited)').each(function(){
                        var _t = $(this);

                        if(o.settings_mode == 'mode-default'){
                            if(_t.children('.hex-icon').length==0){
                                _t.prepend('<div class="hex-icon"><i class="the-icon fa fa-music"></i></div>');
                            }
                        }
                        if(o.settings_mode == 'mode-oncenter'){



                            if(_t.children('.center').length==0){
                                _t.append('<div class="clear"></div>');
                            }
                            if(_t.children('.the-image-con').length==0){

                                if(_t.attr('data-image')){

                                    _t.children('.ztm-content').eq(0).before('<div class="the-image-con"><div class="the-image" style="background-image: url('+_t.attr('data-image')+');"></div></div>');
                                }else{
                                    _t.addClass('no-image');
                                }
                            }
                        }

                        //console.info(o.settings_mode, cthis.find('.inner-for-horizontal'));
                        if(o.settings_mode=='mode-slider'){

                            //console.info(_t);
                            //cthis.find('.inner-for-horizontal').append('<img src="'+_t.attr('data-image')+'"/>');
                            //cthis.find('.inner-for-horizontal').append('<img src="'+_t.attr('data-image')+'"/>');

                            var auxw_str = '260px';

                            //console.log(_t.find('.ztm-content').css('width'));
                            if(_t.find('.ztm-content').css('width') && _t.find('.ztm-content').css('width')!='0px' && _t.find('.ztm-content').css('width')!='auto'){
                                auxw_str = _t.find('.ztm-content').css('width');
                            }
                            var cont = '';




                            cont+='<div style="width: '+auxw_str+';" class="the-item">';

                            cont+='<div class="the-bg"></div><div class="the-after"></div>';


                            if(_t.attr('data-image')){

                                cont+='<div class="feature-image" style="background-image: url('+_t.attr('data-image')+'); "></div>';
                            }


                            cont+='<div class="hex-desc">'+_t.find('.hex-desc').html()+'</div>';

                            cont+='<div class="the-content">'+_t.find('.ztm-content').html()+'</div></div>';

                            if(i2%2==0){

                                cthis.find('.inner-for-horizontal').append(cont);
                            }else{

                                cthis.find('.sc-descriptions-content').append(cont);
                            }

                            // -- tbc


                            if(_t.attr('data-image')){
                                imgs_tobe_loaded++;
                            }
                        }
                        if(o.settings_mode=='mode-slider-variation'){

                            //console.info(_t);
                            cthis.find('.inner-for-horizontal').append('<img src="'+_t.attr('data-image')+'"/>');

                            // -- tbc
                            var auxw_str = '300px';

                            cthis.find('.sc-descriptions-content').append('<div style="width: '+auxw_str+';" class="sc-description"><div class="the-bg"></div><div class="the-after"></div><div class="the-content">'+_t.find('.ztm-content').html()+'</div></div>');

                            if(_t.attr('data-image')){
                                imgs_tobe_loaded++;
                            }
                        }

                        if(o.settings_mode=='mode-blackwhite'){
                            if(_t.children('.image-con').length==0){

                                var ind = _t.parent().children().index(_t);

                                if(ind%2==1){

                                    _t.append('<div class="image-con"><img class="fullwidth" src="'+_t.attr('data-image')+'"/></div>');
                                }else{

                                    _t.prepend('<div class="image-con"><img class="fullwidth" src="'+_t.attr('data-image')+'"/></div>');
                                }
                            }

                        }


                        if(o.settings_mode=='mode-masonry'){
                            _t.addClass('isotope-item');
                            _t.attr('data-sort', (i2+1)*10);
                            _t.wrapInner('<div class="ztm-item--inner"></div>');
                            if(_t.children('.ztm-item--inner').eq(0).children('.image-con').length==0){


                                _t.children('.ztm-item--inner').append('<div class="image-con"><img class="fullwidth" src="'+_t.attr('data-image')+'"/></div>');

                            }
                            if(_t.children('.ztm-item--inner').children('.hex-desc-con').length==1){
                                _t.children('.ztm-item--inner').children('.ztm-content').append(_t.children('.ztm-item--inner').children('.hex-desc-con'))
                            }
                            if(_t.attr('data-image')){
                                imgs_tobe_loaded++;
                            }else{

                                if(_t.children('.ztm-item--inner').children('.image-con').length>0){


                                    imgs_tobe_loaded++;
                                }
                            }

                        }

                        if(o.settings_mode=='mode-yearslist'){
                            cthis.find('.yearlist').append('<div class="year"><span class="the-year">'+_t.find('.hex-desc').html()+'</span></div>');

                            //<div class="detail-image" style="background-image: url('+_t.attr('data-image')+');"></div>
                            cthis.find('.details-container').append('<div class="detail"><div class="float-left detail-image-con" style=""><img class="detail-image" src="'+_t.attr('data-image')+'"/><div class="detail-image-shadow-con"><div class="detail-image-shadow-left"></div><div class="detail-image-shadow-right"></div></div></div><div class="overflow-it detail-excerpt">'+_t.find('.ztm-content').html()+'</div></div>');
                        }

                        _t.addClass('inited');

                        i2++;
                    });

                    //console.info(imgs_tobe_loaded);

                    _items.children('.ztm-item').each(function() {
                        var _t = $(this);
                        if (o.settings_mode == 'mode-slider-variation') {
                            var img = new Image();

                            img.onload = loadedImage;

                            img.src=_t.attr('data-image');




                        }
                        if (o.settings_mode == 'mode-masonry') {

                            var thesrc = '';
                            if(_t.attr('data-image')){

                                thesrc = _t.attr('data-image');
                            }else{

                                if(_t.children('.ztm-item--inner').children('.image-con').length>0){


                                    thesrc = _t.children('.ztm-item--inner').children('.image-con').find('img').eq(0).attr('src');
                                }
                            }


                            var img = new Image();

                            img.onload = loadedImage;

                            img.src=thesrc;




                        }

                    });





                    if (o.settings_mode == 'mode-slider') {

                        var args = {
                            settings_skin:'skin_cerc',
                            settings_replacewheelxwithy:'on',
                            settings_refreshonresize:"on"
                            ,force_onlyx : 'on'
                            ,settings_disableSpecialIosFeatures: 'off'
                            ,secondCon : cthis.find('.sc-descriptions-content').eq(0)
                            ,enable_easing : "on"
                            ,enable_easing_for_second_con : "on"
                            ,easing_duration: 10
                        };

                        //console.log(cthis.find('.sc-descriptions-content').eq(0));

                        //console.info(args);
                        window.dzsscr_init(cthis.children('.scroller-con'),args);
                    }

                    if (o.settings_mode == 'mode-slider-variation') {
                        calculate_dims({

                            'calculate_year_position': false
                        });
                    }
                    if (o.settings_mode == 'mode-masonry') {

                        if(imgs_tobe_loaded==0){
                            reinit_finished_loading_image();
                        }
                    }


                    if (o.settings_mode == 'mode-yearslist') {
                        cthis.find('.year').unbind('click');
                        cthis.find('.year').bind('click', handle_click);
                    }


                }



            }

            function reinit_finished_loading_image(){

                //console.info('reinit_finished_loading_image()');

                // -- for mode-slider-variation for now


                var args = {
                    settings_replacewheelxwithy:'off',
                    settings_refreshonresize:"on"
                    ,force_onlyx : 'on'
                    ,settings_disableSpecialIosFeatures: 'off'
                    ,secondCon : cthis.find('.sc-descriptions-content').eq(0)
                    ,enable_easing : "on"
                    ,enable_easing_for_second_con : "on"
                    ,easing_duration: 7
                    ,extra_html_scrollbarx: '<span class="the-year">'+cthis.find('.hex-desc').eq(0).text()+'</span>'
                };



                //console.log(cthis.find('.sc-descriptions-content').eq(0), cthis.find('.hex-desc').eq(0).text());

                window.dzsscr_init(cthis.children('.scroller-con'),args);


                var _c2 = cthis.find('.inner').eq(0);
                mode_slider_ttw = _c2.width();

                var i2 = 0;
                var auxer = 0;
                var newauxer = 0;
                var ind = 0;
                _c2.children().each(function(){
                    var _t = $(this);
                    //console.info(_t, mode_slider_ttw);


                    if (o.settings_mode == 'mode-slider-variation') {

                        proportions_arr[i2] = _t.width() / mode_slider_ttw;


                        pos_proportions_arr[i2] = auxer;

                        i2++;


                        newauxer = newauxer+ _t.width() / mode_slider_ttw;

                        //console.info(auxer, newauxer);

                        //var aux = parseInt(( (auxer+newauxer)/2 * 100 ),10);
                        var aux = parseInt(( (auxer) * 100 )+5,10);

                        //console.info(,_t.find('.hex-desc'));
                        //cthis.find('.scrollbar > .scrollbarx').before('<div class="hexa-mark-con" style="left: '+aux+'%"><div class="hexa-mark"></div><div class="hexa-content"><span>'+_items.children().eq(ind).find('.hex-desc').html()+'</span></div></div>');
                        cthis.find('.scrollbar > .scrollbarx').before('<div class="hexa-mark-con" style="left: '+aux+'%"><div class="hexa-inshow">'+_items.children().eq(ind).find('.hex-desc').html()+'</div></div>');

                        auxer=newauxer;
                    }

                    ind++;

                });

                //console.info(proportions_arr, pos_proportions_arr);


                //console.info(o.settings_mode);
                if (o.settings_mode == 'mode-slider-variation') {
                    if (cthis.children('.scroller-con').eq(0).get(0) && cthis.children('.scroller-con').eq(0).get(0).api_set_action_animate_scrollbar_end) {
                        cthis.children('.scroller-con').eq(0).get(0).api_set_action_animate_scrollbar_end(mode_slider_animate_scrollbar_end);
                    }




                    cthis.find('.hexa-mark-con').unbind('click');
                    cthis.find('.hexa-mark-con').bind('click',handle_click);
                }
                if (o.settings_mode == 'mode-masonry') {

                    var args = {};
                    args = $.extend(args, o.settings_isotope_settings);


                    args.transitionDuration = '0s';
                    //console.info(args);

                    _items.isotope(args);

                    setTimeout(function(){
                        args.transitionDuration = '0.3s';
                        //console.info(args);
                        _items.isotope(args);

                        cthis.addClass('dzszfl-ready-for-transitions');
                    },2000);
                }


                cthis.addClass('reinited-finished-loading-all-images');
            }

            function mode_slider_animate_scrollbar_end(args){


                //console.info(args)

                var perc = -args.viewIndexX / (args.comWidth - args.totalWidth);

                var tempNr = closest(perc, pos_proportions_arr);

                if(tempNr!=currNr){
                    gotoItem(tempNr);
                }
            }


            function closest (num, arr) {
                var curr = 0;
                var diff = Math.abs (num - arr[curr]);
                for (var val = 0; val < arr.length; val++) {
                    var newdiff = Math.abs (num - arr[val]);

                    if (newdiff < diff) {
                        diff = newdiff;
                        curr = val;
                    }

                    //console.info(arr[val], num, diff)
                }
                //console.warn(curr);
                return curr;
            }

            function loadedImage(e){
                imgs_tobe_loaded--;
                //console.info('loadedImage', e,this, imgs_tobe_loaded);



                if(imgs_tobe_loaded<=0){
                    reinit_finished_loading_image();
                }
            }
            function handleLoaded(){
            }


            function handle_click(e){
                var _t = $(this);
                var ind = 0;


                if(e.type=='click'){
                    //console.info(_t);

                    if(_t.hasClass('year')){
                        ind = _t.parent().children().index(_t);

                        //console.info(ind);

                        gotoItem(ind);
                    }
                    if(_t.hasClass('diamond-arrow-left')){
                        goto_item_prev();
                    }
                    if(_t.hasClass('diamond-arrow-right')){
                        goto_item_next();
                    }
                    if(_t.hasClass('hexa-mark-con')){


                        //console.info(_t);

                        if(cthis.children('.scroller-con').get(0) && cthis.children('.scroller-con').get(0).fn_scrollx_to){

                            //console.info(_t.get(0).style.left,parseInt(_t.get(0).style.left,10));
                            cthis.children('.scroller-con').get(0).fn_scrollx_to(parseInt(_t.get(0).style.left,10)/ 100);
                        }

                        return false;
                    }
                }
            }


            function handle_menuclick(e){


            }

            function handle_resize(e){

                ww = $(window).width()
                tw = cthis.width();

                conw = tw;

                if(o.settings_mode == 'mode-yearslist'){
                    if(_yearlist && _yearlist.parent()){
                        conw = _yearlist.parent().width();
                    }
                }


                //console.info(tw,conw,_yearlist.parent(),_yearlist);



                if(tw<900){
                    cthis.addClass('under-900');
                }else{
                    cthis.removeClass('under-900');

                }


                if(tw<600){
                    cthis.addClass('under-600');
                }else{
                    cthis.removeClass('under-600');

                }
                if(tw<400){
                    cthis.addClass('under-400');
                }else{
                    cthis.removeClass('under-400');

                }

                calculate_dims();
                //cthis.addClass('under-400');
                //cthis.addClass('under-600');
            }

            function calculate_dims_for_tab_height(){

            }

            function calculate_dims(pargs){



                var margs = {

                    'calculate_year_position' : true
                };

                if(pargs){
                    margs = $.extend(margs,pargs);
                }


                if(o.settings_mode=='mode-yearslist'){
                    if(margs.calculate_year_position){
                        if(_cachY && _yearlist){
                            //console.info(_cachY,tw,conw);


                            var ind = _cachY.parent().children().index(_cachY);


                            var aux = ( conw / 2 - _cachY.width() / 2)  - ind*_cachY.width();

                            _yearlist.css({
                                'left' : aux
                            })
                        }
                    }
                }
                if (o.settings_mode == 'mode-slider-variation') {

                    var _c2 = cthis.find('.sc-descriptions-content').eq(0);

                    _c2.children('.sc-description').each(function() {
                        var _t = $(this);
                        //console.info(_t);

                        _t.children('.the-after,.the-bg').height(_c2.height());
                    });
                }



            }


            function goto_item_prev(){


                tempNr = currNr;
                tempNr--;
                if(tempNr<0){
                    tempNr = _items.children('.ztm-item').length-1;
                }
                gotoItem(tempNr);
            }
            function goto_item_next(){

                tempNr = currNr;
                tempNr++;
                if(tempNr>=_items.children('.ztm-item').length){
                    tempNr = 0;
                }
                gotoItem(tempNr);

            }


            function gotoItem(arg, pargs){


                var _cach = null;
                var _currArg = null;
                var forward = true;

                if(currNr<arg){

                }else{
                    forward=false;
                }

                if(o.settings_mode=='mode-yearslist'){


                    _cachY = cthis.find('.yearlist > .year').eq(arg);

                    cthis.find('.yearlist > .year').removeClass('active');
                    _cachY.addClass('active');


                    if(currNr>-1){

                        _currArg =  _detailsContainer.children('.detail').eq(currNr);


                        if(forward){



                            _currArg.css({
                                'left' : '0%'
                                ,'opacity':1
                            })

                            _currArg.animate({
                                'left' : '-100%'
                                ,'opacity':0
                            },{
                                queue:false
                                ,duration: 300
                                ,complete: function(){


                                    $(this).removeClass('active');
                                }
                            })
                        }else{

                            _currArg.css({
                                'left' : '0%'
                                ,'opacity':1
                            });

                            _currArg.animate({
                                'left' : '100%'
                                ,'opacity':0
                            },{
                                queue:false
                                ,duration: 300
                                ,complete: function(){


                                    $(this).removeClass('active');
                                }
                            })
                        }

                        console.info(_currArg.outerHeight())
                        _detailsContainer.css('height', _currArg.outerHeight());
                    }

                    // -- end currNr


                    if(_detailsContainer){
                        _cach =  _detailsContainer.children('.detail').eq(arg);

                        console.info(_cach);
                        if(forward){

                            _cach.css({
                                'left' : '100%'
                                ,'opacity':0
                            })


                        }else{

                            _cach.css({
                                'left' : '-100%'
                                ,'opacity':0
                            })


                        }


                        _cach.animate({
                            'left' : '0%'
                            ,'opacity':1
                        },{
                            queue:false
                            ,duration: 300
                            ,complete: function(){


                                $(this).addClass('active');
                            }
                        });

                        console.info(_cach.outerHeight())
                        setTimeout(function(){

                            _detailsContainer.css('height', _cach.outerHeight());

                            setTimeout(function(){

                                _detailsContainer.css('height', 'auto');
                            },300)
                        },100)
                    }

                    if(_yearlist){
                        //console.info(_cachY);

                        calculate_dims({

                            'calculate_year_position' : true
                        });


                    }


                }


                //console.info(o.settings_mode);
                if(o.settings_mode=='mode-slider-variation'){

                    //console.info(o.settings_mode);

                    cthis.find('.sc-descriptions-content').children().removeClass('active');
                    _cach = cthis.find('.sc-descriptions-content').children().eq(arg);
                    //console.info(_cach, cthis.find('.hex-desc').eq(arg).text());


                    if(arg>-1){
                        shuffleText(cthis.find('.scrollbarx .the-year').eq(0), cthis.find('.hex-desc').eq(arg).text())

                    }

                    _cach.addClass('active');





                }

                currNr = arg;

            }
            return this;
        })
    }
    window.dzsztm_init = function(selector, settings) {
        if(typeof(settings)!="undefined" && typeof(settings.init_each)!="undefined" && settings.init_each==true ){
            var element_count = 0;
            for (var e in settings) { element_count++; }
            if(element_count==1){
                settings = undefined;
            }

            $(selector).each(function(){
                var _t = $(this);
                _t.zoomtimeline(settings)
            });
        }else{
            $(selector).zoomtimeline(settings);
        }

    };
})(jQuery);


function can_history_api() {
    return !!(window.history && history.pushState);
}
function is_ios() {
    return ((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1) || (navigator.platform.indexOf("iPad") != -1)
    );
}

function is_android() {    //return true;
    var ua = navigator.userAgent.toLowerCase();    return (ua.indexOf("android") > -1);
}

function is_ie() {
    if (navigator.appVersion.indexOf("MSIE") != -1) {
        return true;    }; return false;
}
;
function is_firefox() {
    if (navigator.userAgent.indexOf("Firefox") != -1) {        return true;    };
    return false;
}
;
function is_opera() {
    if (navigator.userAgent.indexOf("Opera") != -1) {        return true;    };
    return false;
}
;
function is_chrome() {
    return navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
}
;
function is_safari() {
    return navigator.userAgent.toLowerCase().indexOf('safari') > -1;
}
;
function version_ie() {
    return parseFloat(navigator.appVersion.split("MSIE")[1]);
}
;
function version_firefox() {
    if (/Firefox[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
        var aversion = new Number(RegExp.$1); return(aversion);
    }
    ;
}
;
function version_opera() {
    if (/Opera[\/\s](\d+\.\d+)/.test(navigator.userAgent)) {
        var aversion = new Number(RegExp.$1); return(aversion);
    }
    ;
}
;
function is_ie8() {
    if (is_ie() && version_ie() < 9) {  return true;  };
    return false;
}
function is_ie9() {
    if (is_ie() && version_ie() == 9) {
        return true;
    }
    return false;
}



function get_query_arg(purl, key){
    if(purl.indexOf(key+'=')>-1){
        //faconsole.log('testtt');
        var regexS = "[?&]"+key + "=.+";
        var regex = new RegExp(regexS);
        var regtest = regex.exec(purl);


        if(regtest != null){
            var splitterS = regtest[0];
            if(splitterS.indexOf('&')>-1){
                var aux = splitterS.split('&');
                splitterS = aux[1];
            }
            var splitter = splitterS.split('=');

            return splitter[1];

        }
    }
}


function add_query_arg(purl, key,value){
    key = encodeURIComponent(key); value = encodeURIComponent(value);

    //if(window.console) { console.info(key, value); };

    var s = purl;
    var pair = key+"="+value;

    var r = new RegExp("(&|\\?)"+key+"=[^\&]*");


    //console.info(pair);

    s = s.replace(r,"$1"+pair);
    //console.log(s, pair);
    var addition = '';
    if(s.indexOf(key + '=')>-1){


    }else{
        if(s.indexOf('?')>-1){
            addition = '&'+pair;
        }else{
            addition='?'+pair;
        }
        s+=addition;
    }

    //if value NaN we remove this field from the url
    if(value=='NaN'){
        var regex_attr = new RegExp('[\?|\&]'+key+'='+value);
        s=s.replace(regex_attr, '');
    }


    //if(!RegExp.$1) {s += (s.length>0 ? '&' : '?') + kvp;};

    return s;
}




jQuery(document).ready(function($){
    dzsztm_init('.zoomtimeline.auto-init', {init_each: true});
});