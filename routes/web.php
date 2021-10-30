<?php

use Illuminate\Support\Facades\Route;

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

//rutas para recuperar contraseña
Route::get('recuperar1','PreguntasseguridadController@correo')->name('preguntas.correo');
Route::post('recuperar1','PreguntasseguridadController@seguridad')->name('preguntas.seguridad');

Route::get('twrw5345/{id}','PreguntasseguridadController@preguntas')
->name('preguntas.preguntas')
->where('id' ,'[0-9]+')
->middleware('email');

Route::post('twrw5345/{id}','PreguntasseguridadController@revision')
->name('preguntas.revision')
->where('id' ,'[0-9]+');

Route::get('rrtr5457/{id}','PreguntasseguridadController@cambio')
->name('preguntas.cambio')
->where('id' ,'[0-9]+')
->middleware('question');

Route::post('rrtr5457/{id}','PreguntasseguridadController@confirmar')
->name('preguntas.confirmar')
->where('id' ,'[0-9]+');


//validar logiado o no
Route::middleware("auth")
    ->group(function () {

        Route::get('acerca', function(){
            return view('Acercade');
        });

        Route::get('/','GraficoController@welcome')->name('welcome');

		        //ruta para ver graficos
        Route::get('graficoscrimen','GraficoController@crimenes')->name('grafico.crimen');
	
        //ruta para ver agente
        Route::get('graficosagentes','GraficoController@agentes')->name('grafico.agente');

        //ruta para ver denuncias por mes
        Route::get('graficosdenuncias','GraficoController@denuncias')->name('grafico.denuncia');

        //ruta para cambiar nombre de usuario
        Route::get('usuario/{id}/name','UserController@nam')->name('users.name1') -> where('id' ,'[0-9]+');
        Route::put('usuario/{id}/name','UserController@name')->name('users.name2') -> where('id' ,'[0-9]+');

        //ruta para cambiar  correo de usuario
        Route::put('usuario/{id}/email','UserController@email')->name('users.email2') -> where('id' ,'[0-9]+');
        Route::get('usuario/{id}/email','UserController@ema')->name('users.email1') -> where('id' ,'[0-9]+');

        //ruta para cambiar placa de usuario
        Route::get('usuario/{id}/placa','UserController@pla')->name('users.placa1') -> where('id' ,'[0-9]+');
        Route::put('usuario/{id}/placa','UserController@placa')->name('users.placa2') -> where('id' ,'[0-9]+');

        //ruta para cambiar telefono de usuario
        Route::get('usuario/{id}/telefono','UserController@tele')->name('users.telefono1') -> where('id' ,'[0-9]+');
        Route::put('usuario/{id}/telefono','UserController@telefono')->name('users.telefono2') -> where('id' ,'[0-9]+');

        //ruta para reedireccionar a perfil
        Route::get('usuario','UserController@profile')->name('users.profile');
        
        //ruta editar contraseña
        Route::get('usuario{id}editar','UserController@edit') ->name('usuarios.edit')
        ->where('id','[0-9]+');
        Route::put('usuario{id}editar', 'UserController@update')
        ->name('usuario.update')->where('id','[0-9]+');


        //index crimen
        Route::get('crimenes','CrimenController@indexActivo')-> name('crimen.indice');

        //creacion de crimen
        Route::post('crimenes','CrimenController@store') ->name('crimen.store');

        //editar crimen
        Route::put('crimenes/{id}/editar','CrimenController@update')->name('crimen.update') -> where('id' ,'[0-9]+');

        //desactivar crimen
        Route::delete('crimenes/{id}/borrar','CrimenController@desactivar') ->name('crimen.borrar')->where('id','[0-9]+');

        //index crimen desactivado
        Route::get('crimenesdesactivado','CrimenController@indexDesactivado')-> name('crimendesactivado.indice');

        //activar crimen
        Route::delete('crimenesdesactivado/{id}/borrar','CrimenController@activar') ->name('crimendesactivado.borrar')->where('id','[0-9]+');

        //index agente
        Route::get('agentes/','AgenteController@indexActivo')-> name('agentes.indice');
        Route::get('{all?}agentes','AgenteController@indexActivo')-> name('agente.indice') -> where('all' ,'[C, P, V]');

        //crear agente
        Route::post('{all?}agentes','AgenteController@store') ->name('agente.store') -> where('all' ,'[C, P, V]');
        Route::post('agentes','AgenteController@store') ->name('agente.store');

        //ver agente
        Route::get('agentes{id}','AgenteController@show')->name('agentes.show')->where('id','[0-9]+');

        //editar agente
        Route::put('agentes/{id}/editar','AgenteController@update')->name('agente.update') -> where('id' ,'[0-9]+');

        //desactivar agente
        Route::delete('agentes/{id}/borrar','AgenteController@desactivar') ->name('agente.borrar')->where('id','[0-9]+');

        //agente desactivado index
        Route::get('agentesdesactivado','AgenteController@indexDesactivo')-> name('agentedesactivado.indice');

        //ver agente desactivado
        Route::get('agentesdesactivado{id}', 'AgenteController@show')->name('agentedesactivado.show')->where('id','[0-9]+');

        //activar agente
        Route::delete('agentesdesactivado/{id}/borrar','AgenteController@activar') ->name('agentedesactivado.borrar')->where('id','[0-9]+');

        //denuncias listado
        Route::get('denuncias','DenunciaController@index')->name('denuncia.index');
        ;

        //nueva denuncia
        Route::get('denuncianuevo','DenunciaController@create')-> name('denuncias.create');
        Route::post('denuncianuevo','DenunciaController@store')-> name('denuncias.store');

        //ver detalles denuncia
        Route::get('denuncias{id}','DenunciaController@show')->name('denuncia.show')->where('id','[0-9]+');

        //seguimiento index
        Route::get('{id}seguimientos{den}','seguimientoController@index')-> name('seguimiento.index')->where('id','[0-9]+')->where('den','[A,B]');

        //nueva tarea seguimiento
        Route::post('{id}seguimientos{den}','seguimientoController@store')-> name('seguimiento.store')->where('id','[0-9]+')->where('den','[A,B]');
        Route::put('{id}seguimientos{den}', 'seguimientoController@update')->name('seguimiento.update')->where('id','[0-9]+')->where('den','[A,B]');

        //borrar seguimiento
        Route::delete('{den}seguimientos/{i}/borrar{id}','seguimientoController@destroy') ->name('seguimiento.borrar')
        ->where('id','[0-9]+')->where('den','[A,B]')->where('i','[0-9]+');

        //crear usuario
        Route::get('registrar','UserController@registrar')->name('registrar.new')->middleware('password.required');
        Route::post('registrar','UserController@register')->name('registrar.nuevo');

        //rutas para reasignar denuncias
        Route::get('reasignar{id}','CambioController@index')-> name('cambio.index')->where('id','[0-9]+');
        Route::post('reasignar{id}', 'CambioController@update')->name('cambio.update')->where('id','[0-9]+');

        //dar vacaciones
        Route::get('darvacaciones{id}', 'CambioController@darvacaciones')->name('vacaciones.dar')->where('id','[0-9]+');
        //dar vacaciones
        Route::get('quitvacaciones{id}', 'CambioController@quitvacaciones')->name('vacaciones.quitar')->where('id','[0-9]+');

        //remitir a fiscalia
        Route::get('remitir{id}', 'RemitirController@enviar')->name('remitir.enviar')->where('id','[0-9]+');

        //ver fiscalia{an}denuncias{num?}
        Route::get('remitir', 'RemitirController@ver')->name('remitir.ver');

        //remitir a fiscalia
        Route::get('orden{id}', 'RemitirController@orden')->name('remitir.orden')->where('id','[0-9]+');

        //salir del sistema
        Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('salir');  

    });


Auth::routes();



Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');