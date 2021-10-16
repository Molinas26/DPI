<?php

namespace App\Http\Middleware;
use DB;
use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class emailcheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $correo = Crypt::decryptString($request->correo);

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




        if($request->correo != "" && $request->id == $id){
            return $next($request);
        }else{
            return redirect()->route('preguntas.correo');
        }
    }
}
