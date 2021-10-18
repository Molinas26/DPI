<?php

namespace App\Http\Middleware;
use DB;
use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class questioncheck
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

        if($request->pregunta1 == null && $request->pregunta2 == null){
            $dato1 = "";
            $dato2 = "";
        }else{
            $dato1 = Crypt::decryptString($request->pregunta1);
            $dato2 = Crypt::decryptString($request->pregunta2);
        }

        //realizamos una consulta para recuperar las respuestas de seguridad
        $dat = DB::table('preguntasseguridads')
        ->select('pregunta1', 'pregunta2')
        ->where('id_user', '=', $request->id);

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
        if(Hash::check($dato1, $p1)){
            //validamos la pregunta 2 si esta correcta cambio de vista si no mensaje de error
            if(Hash::check($dato2, $p2)){
                //cambio de vista
                return $next($request);
            }else{
                return redirect()->route('preguntas.preguntas',['id'=>$request->id])->with('mensaje2', 'Pregunta incorrecta');
            }
        }else{
            return redirect()->route('preguntas.preguntas',['id'=>$request->id])->with('mensaje1', 'Pregunta incorecta');
        }

    }
}
