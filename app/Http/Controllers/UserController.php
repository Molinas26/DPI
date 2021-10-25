<?php

namespace App\Http\Controllers;

use App\User;
use App\preguntasseguridad;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //funcion para mostrar datos del usuario logiado
    public function profile()
    {
        $usuario = User::all();

        return view('auth/users')//vista
            ->with('usuario', $usuario);// va la ruta y variable creada
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    //reedirecciona a la parte de editar
    public function edit(User $user)
    {
        return view("auth/CambioClave");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */

     //funcion para actualizar contraseña
    public function update(Request $request, $id)
    {
        //recuperamos los datos si actualizan contraseña
        $clave = $request->input('password');
        $clave2 = $request->input('password_confirmation');
        $clave3 = $request->input('oldpassword');

        //recuperamos los datos originales
        $pass = User::findOrFail($id);

        //verificamos si la contraseña anterior es igual a la ingresda si no mensaje de error
        if(Hash::check($clave3, $pass->password)){

            //verificamos si la contraseña y confirmar contraseña son iguales si no mensaje de error
            if($clave === $clave2){
                //si lo son guardar contraseña encriptada
                $pass -> password = Hash::make($clave);

            $creado = $pass->save();

            //retornar a profile
            return $this->profile();
            }else{
                return redirect()->route('usuarios.edit',['id'=>$id])
                ->with('mensaje', 'Contraseña no coinciden');
            }

        }else{
            return redirect()->route('usuarios.edit',['id'=>$id])
                ->with('alerta1', 'Contraseña icorrecta');
                        
        }

    }

    //funcion para cambiar nombre
    public function name(Request $request, $id){
        $nam = User::findOrFail($id);

        $nam -> name = $request->input('nombre');

        $creado = $nam->save();

        return redirect()->route('users.profile');
    }

    //funcion para cambiar correo
    public function email(Request $request, $id){
        $nam = User::findOrFail($id);

        $nam -> email = $request->input('email');

        $creado = $nam->save();

        return redirect()->route('users.profile');
    }

    //funcion para cambiar placa
    public function placa(Request $request, $id){
        $nam = User::findOrFail($id);

        $nam -> placa = $request->input('placa');

        $creado = $nam->save();

        return redirect()->route('users.profile');
    }

    //funcion para cambiar telefono
    public function telefono(Request $request, $id){
        $nam = User::findOrFail($id);

        $nam -> telefono = $request->input('telefono');

        $creado = $nam->save();

        return redirect()->route('users.profile');
    }

    //funcion que me reedireccione a registro
    public function registrar(){
        return view("auth/register");
    }

    public function register(Request $request){

        //validaciones
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'placa' => ['required', 'string', 'min:4','max:5', 'unique:users'],
            'telefono' => ['required', 'string', 'min:8','max:8', 'unique:users'],
            'email' => ['required', 'string', 'email:filter', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //guardar datos de usuario
        $nuevoUser = new User();

        $nuevoUser->name = $request->input('name');
        $nuevoUser->email = $request->input('email');
        $nuevoUser->placa = $request->input('placa');
        $nuevoUser->telefono = $request->input('telefono');
        $nuevoUser->password = Hash::make($request->input('password'));

        $creado = $nuevoUser->save();

        //guardar preguntas de seguridad
        $seguridad = new preguntasseguridad();

        $seguridad->pregunta1 = Hash::make($request->input('pregunta1'));
        $seguridad->pregunta2 = Hash::make($request->input('pregunta2'));
        $seguridad->id_user = $nuevoUser->id;

        $creado = $seguridad->save();

        return redirect()->route('welcome');
    }


}