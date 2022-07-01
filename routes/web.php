<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::get('/', 'FrontController@eventos') -> name('eventos');
Route::name('front.') -> group(function(){
    Route::get('/aviso', 'FrontController@aviso') -> name('aviso');
    Route::get('/reservaciones', 'FrontController@reservaciones') -> name('reservaciones');
    Route::get('/faqs', 'FrontController@faqs') -> name('faqs');
    Route::get('/test', 'FrontController@test') -> name('test');



    Route::get('/eventos', 'FrontController@eventos') -> name('eventos');
    Route::get('/pago', 'FrontController@pago') -> name('pagos');
    Route::get('/eventos/detalle/{id}/{titulo}', 'FrontController@eventos_detalle') -> name('eventos.detalle');
    //Route::get('/eventos/detalle', 'FrontController@eventos_detalle') -> name('eventos.detalle');
    Route::post('eventos/butacas', 'FrontController@eventos_butacas')->name('eventos.butacas');

    Route::get('evento/{evento_id}/seleccion/butacas/{horario_id}', 'FrontController@eventos_butacas_view')->name('seleccion.lugares');
    Route::post('eventos/asignacion/lugares', 'FrontController@eventos_pago')->name('eventos.asignacion.lugares');
    Route::get('eventos/pago', 'FrontController@eventos_pago_view')->name('eventos.pago');
    Route::get('eventos/pago/completado/{id}', 'FrontController@eventos_pago_completado')->name('eventos.pago.completado');
    Route::get('eventos/pago/ticket/{id}', 'FrontController@eventos_pago_ticket')->name('eventos.pago.ticket');
    Route::get('eventos/pago/order/{id}', 'ConektaOxxo@getOrderOxxo')->name('eventos.order.oxxo');
    Route::get('sesion/expirada', 'FrontController@eventos_session_destroy')->name('eventos.session.destroy');
    Route::post('/get/hour', 'FrontController@getHourByDay')->name('pago.gethour');
    Route::post('/orden/save', 'FrontController@pagoSave')->name('pago.save');
    Route::post('/conekta/payment', 'ConektaTarjeta@payment')->name('conekta.payment');
    Route::post('/conekta/oxxo', 'ConektaOxxo@payment')->name('conekta.oxxo');
    Route::post('/free/payment', 'FrontController@freePayment')->name('pago.free');
    Route::post('/validar-cupon', 'CuponController@applyCupon')->name('evento.cupon');
    Route::get('/consultar/folio/{folio}', 'FrontController@consultarFolio')->name('consultar.folio');
    Route::get('/descargar/boleto/{orden_id}', 'FrontController@download')->name('boleto.download');
    //Vistas cuando solo se compran boletos
    Route::post('eventos/boletos', 'FrontController@eventos_pago_boletos')->name('eventos.boletos');
    Route::get('eventos/boletos/pago', 'FrontController@eventos_pago_boletos_view')->name('eventos.boletos.pago');
});

Route::prefix('/admin')->group(function(){
    Route::get('/', 'AdminController@unauthenticated')->name('panel.admins.unauthenticated');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showAdminLinkRequestForm')->name('panel.admins.password.reset');
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendAdminResetLinkEmail')->name('panel.admins.password.email');
    Route::post('/login', 'AdminController@login')->name('panel.admins.login');
    Route::post('/logout', 'AdminController@logout')->name('panel.admins.logout');

    //Administradores
    Route::prefix('/cuentas')->middleware('auth:admin')->group(function(){
        Route::prefix('/usuarios')->group(function(){
            Route::get('/', 'AdminController@index')->name('panel.admins.index');
            Route::get('/nuevo', 'AdminController@create')->name('panel.admins.create');
            Route::post('/store', 'AdminController@store')->name('panel.admins.store');
            Route::get('/editar/{id}', 'AdminController@edit')->name('panel.admins.edit');
            Route::put('/update/{id}', 'AdminController@update')->name('panel.admins.update');
            Route::get('/password/editar/{id}', 'AdminController@editPassword')->name('panel.admins.edit.password');
            Route::put('/password/update/{id}', 'AdminController@updatePassword')->name('panel.admins.update.password');
            Route::delete('/destroy/{id}', 'AdminController@destroy')->name('panel.admins.destroy');
        });
        Route::prefix('/roles')->group(function(){
            Route::get('/', 'RoleController@index')->name('panel.roles.index');
            Route::get('/nuevo', 'RoleController@create')->name('panel.roles.create');
            Route::get('/editar/{id}', 'RoleController@edit')->name('panel.roles.edit');
            Route::post('/store', 'RoleController@store')->name('panel.roles.store');
            Route::put('/update/{id}', 'RoleController@update')->name('panel.roles.update');
            Route::delete('/destroy/{id}', 'RoleController@destroy')->name('panel.roles.destroy');
        });
    });
    //Settings
    Route::prefix('/configuracion')->middleware('auth')->group(function(){
        Route::get('/editar/seo', 'SettingController@edit')->name('panel.settings.seo');
        Route::get('/editar/seo/facebook', 'SettingController@facebook')->name('panel.settings.seo.facebook');
        Route::get('/editar/seo/analytics', 'SettingController@analytic')->name('panel.settings.seo.analytic');
        Route::put('/editar/seo', 'SettingController@update')->name('panel.settings.seo.update');
    });

    //Direcciones
    Route::post('/store/image', 'ImageController@store')->name('images.store');
    Route::get('/storage/list', 'ImageController@show')->name('images.show');

    //Documentales
    Route::prefix('/documental')->middleware('auth:admin')->group(function(){
        Route::get('/', 'DocumentalController@index')->name('panel.documental.list');
        Route::get('/nuevo', 'DocumentalController@create')->name('panel.documental.add');
        Route::put('/status/{id}', 'DocumentalController@changeStatus')->name('panel.documental.status');
        Route::post('/store', 'DocumentalController@store')->name('panel.documental.store');
        Route::get('/editar/{id}', 'DocumentalController@edit')->name('panel.documental.edit');
        Route::put('/update/{id}', 'DocumentalController@update')->name('panel.documental.update');
        Route::delete('/destroy/{id}', 'DocumentalController@destroy')->name('panel.documental.destroy');
    });

    Route::prefix('/evento')->middleware('auth:admin')->group(function(){
        Route::get('/', 'EventoController@index')->name('panel.evento.list');
        Route::get('/nuevo', 'EventoController@create')->name('panel.evento.add');
        Route::put('/status/{id}', 'EventoController@changeStatus')->name('panel.evento.status');
        Route::put('/destacar/{id}', 'EventoController@changeDestacar')->name('panel.evento.destacar');
        Route::put('/status/horario/{id}', 'EventoController@changeStatusHorario')->name('panel.evento.status.horario');
        Route::post('/store', 'EventoController@store')->name('panel.evento.store');
        Route::post('/asignar-precios', 'EventoController@addPrecioPerAsiento')->name('panel.evento.asignar.precio');
        Route::get('/editar/{id}', 'EventoController@edit')->name('panel.evento.edit');
        Route::get('/exportar/{id}', 'EventoController@export')->name('panel.evento.export');
        Route::get('/lugares/{id}', 'EventoController@lugares')->name('panel.evento.lugares');
        Route::post('/lugares/importar/{evento_id}', 'EventoController@import')->name('panel.evento.lugares.import');
        Route::put('/update/{id}', 'EventoController@update')->name('panel.evento.update');
        Route::delete('/destroy/{id}', 'EventoController@destroy')->name('panel.evento.destroy');
        Route::delete('/destroy/galeria/{id}', 'EventoController@destroyGaleria')->name('panel.evento.galeria.destroy');
        Route::delete('/destroy/precio/{id}', 'EventoController@destroyPrecio')->name('panel.evento.precio.destroy');
    });
    Route::prefix('/cupon')->middleware('auth:admin')->group(function(){
        Route::get('/', 'CuponController@index')->name('panel.cupon.list');
        Route::get('/nuevo', 'CuponController@create')->name('panel.cupon.add');
        Route::put('/status/{id}', 'CuponController@changeStatus')->name('panel.cupon.status');
        Route::post('/store', 'CuponController@store')->name('panel.cupon.store');
        Route::get('/editar/{id}', 'CuponController@edit')->name('panel.cupon.edit');
        Route::put('/update/{id}', 'CuponController@update')->name('panel.cupon.update');
        Route::delete('/destroy/{id}', 'CuponController@destroy')->name('panel.cupon.destroy');
    });
    Route::prefix('/orden')->middleware('auth:admin')->group(function(){
        Route::get('/', 'OrdenController@index')->name('panel.orden.list');
        Route::get('/crear', 'OrdenController@crear')->name('panel.orden.crear');
        Route::get('/editar/{id}', 'OrdenController@edit')->name('panel.orden.edit');
        Route::get('/descargar/boleto/{orden_id}', 'OrdenController@download')->name('panel.orden.download');
        Route::get('/descargar/boleto/preview/{orden_id}', 'OrdenController@download_view')->name('panel.orden.download.preview');
        Route::post('/validar-cupon', 'CuponController@applyCupon')->name('evento.cupon');
        Route::post('/store', 'OrdenController@store')->name('panel.orden.store');
    });

});
