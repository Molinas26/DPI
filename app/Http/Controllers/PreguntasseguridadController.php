<?php

namespace App\Http\Controllers;

use App\preguntasseguridad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PreguntasseguridadController extends Controller
{

    //creamos una funcion para que nos reedireccione a la ventana donde ingresan el correo para recuperarlo
    public function correo()
    {
        return view('auth/recuperacion1');//vista
    }


    //verificaremos si el correo es correcto
    public function seguridad(Request $request)
    {

        //recuperamos el correo ingresado
        $correo = $request->input('email');

        //realizamos la consulta
        $dat = DB::table('users')
        ->where('email', '=', $correo);

        $dat = $dat->get();

        //creamos una variable para guardar el id del perfil al que corresponde el correo
        $id=0;

        //pasamos en un foreach aun que solo es un valor al ser el resultado de una consulta pasa como array
        foreach($dat as $d){
            $id = $d->id;
        }

        //determinamos si la variable cambio su valor osea habia un perfil con ese correo
        if($id>0){
            //si lo hay pasa a la siguiente vista
            return redirect()->route('preguntas.preguntas',['id'=>$id]);
        }else{
            //si no recarga la vista con el mensaje de error
            return redirect()->route('preguntas.correo')->with('mensaje', 'Correo no existe');
        }
        
    }


    //funcion que nos envia a donde estan las preguntas de seguridad
    public function preguntas($id)
    {
        return view('auth/recuperacion2');
    }


    //funcion para verificar las preguntas
    public function revision(Request $request, $id)
    {
        //recuperamos los valores ingresados
        $pre1 = $request->input('pre1');
        $pre2 = $request->input('pre2');

        //realizamos una consulta para recuperar las respuestas de seguridad
        $dat = DB::table('preguntasseguridads')
        ->select('pregunta1', 'pregunta2')
        ->where('id_user', '=', $id);

        $dat = $dat->get();

        //creamos variables para asignar dichos valores
        $p1=0;
        $p2=0;

        //pasan a un foreach que aun que solo es un dato al ser el resultado de una consulta lo toma como array
        foreach($dat as $d){
            $p1 = $d->pregunta1;
            $p2 = $d->pregunta2;
        }

        //validamos la pregunta 1 si la pregunta 1 esta buena pasa a la siguiente si no se envia mensaje de error
        if(Hash::check($pre1, $p1)){
            //validamos la pregunta 2 si esta correcta cambio de vista si no mensaje de error
            if(Hash::check($pre2, $p2)){
                //cambio de vista
                return redirect()->route('preguntas.cambio',['id'=>$id]);
            }else{
                return redirect()->route('preguntas.preguntas',['id'=>$id])->with('mensaje2', 'Pregunta incorrecta');
            }
        }else{
            return redirect()->route('preguntas.preguntas',['id'=>$id])->with('mensaje1', 'Pregunta incorecta');
        }

    }


    //pasamos a la vista cambio de contraseña 
    public function cambio($id)
    {
        return view('auth/recuperacion3')->with('id', $id);;
    }


    //funcion donde se realiza el cambio
    public function confirmar(Request $request, $id)
    {
        //recuperamos los valores ingresados
        $clave = $request->input('con1');
        $clave2 = $request->input('con2');

        //llamamos al modelo para guardar datos
        $pass = User::findOrFail($id);

        //verificamos que las contraseña fue escrita 2 veces bien
        if($clave === $clave2){

            //guardamos la contraseña encriptada
            $pass -> password = Hash::make($clave);

            //guardamos el cambio
            $creado = $pass->save();

            //retornamos a welcome o login
            return redirect()->route('welcome');

        }else{
            //si no estan bien escrita mensaje de error
            return redirect()->route('preguntas.cambio',['id'=>$id])->with('mensaje', 'Contraseña no coinciden');
        }

    }

}