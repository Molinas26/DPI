<?php

namespace App\Http\Controllers;

use App\seguimiento;
use App\agente;
use App\Denuncia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguimientoController extends Controller
{

    //funcion para retornar solo los seguimientos de la denuncia necesaria
    public function seguim($id){
        //retorna los seguimientos de la consulta con su id correspondiente
        $seguimiento = DB::table('seguimientos')
        ->where('id_denuncia', '=', $id);

        $seguimiento = $seguimiento->get();
        //retorna los id
        return $seguimiento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request, $id, $den)
    {
        //recuperamos el valor de la funcion
        $seguimiento= $this->seguim($id);

        //recuperamos el agente asignado de la funcion
        $asignado = $this->asignado($id);

        //enviamos los agentes por si lo necesitan
        $agentes = agente::all();

        //retornamos este valor a la vista
        return view('seguimiento/seguimiento')//vista
        ->with('seguimiento',$seguimiento)->with('id',$id)->with('den',$den)->with('agentes',$agentes)->with('asignado',$asignado);
    }

    //recuperamos al agente asignado a la denuncia
    public function asignado($id){

        $asignado=DB::table('agentes')
        ->select('agentes.id AS id', 'nombres', 'apellidos')
        ->join('denuncias' ,'denuncias.id_agente', '=', 'agentes.id')
        ->where('denuncias.id', '=', $id);

        $asignado=$asignado->get();

        return $asignado;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     //crear nueva tarea de seguimiento
    public function store(Request $request, $id, $den)
    {
        //llamamos al modelo
        $nuevoSeguimiento = new seguimiento();

        //recuperamos el valor del input y lo guardamos con id
        $nuevoSeguimiento->tarea =  $request->input('segui');
        $nuevoSeguimiento->id_denuncia = $id; 

        //almacenamos el dato
        $creado = $nuevoSeguimiento->save();

        //verificamos si se creo
        if ($creado) {
            //retornamos con mensaje
            return redirect()->route('seguimiento.index',['id'=>$id, 'den'=>$den])
                ->with('mensaje', '¡Seguimiento agregado !');
        } else {
            //retornar con un msj de error

        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */
    //funcion actualizar
    public function update(Request $request, $id, $den)
    {
        //recuperamos todos los seguimientos
        $seguimiento= seguimiento::All();

        //aplicamos un foreach
        foreach($seguimiento as $segui){
            //verificamos que seguimientos corresponden a dicha denuncia con id
            if($segui->id_denuncia == $id){

                //recuperamos si el checxbox esta o no actuvo
                $dat =  $request->input($segui->id);

                //verificamos si lo esta y cambiamos el valor
                if($dat == true){
                    $segui->estado = true;
                }else{
                    $segui->estado = false;
                }
                //guardamos el dato
                $creado = $segui->save(); //$variable creada                
            }
        }

        //recuperamos el agente asignado
        $asignado = $this->asignado($id);

        //cambiamos por si cambiaron de agente
        $agen = $request->input('cambio_agente');

        //verificamos si se selecciono el cambio de agete
        if($agen != null){
            //recuperamos los datos de la denuncia actual
            $denunciaedit = Denuncia::findOrFail($id);
            //recuperamos los datos del agente
            $agentes = agente::findOrFail($denunciaedit->id_agente);
            //restamos al agente
            $agentes->delitos -= 1;
            //guardamos dato
            $creado2 = $agentes->save();
            //cambiamos el agente
            $denunciaedit->id_agente = $agen;
            //guardamos dato
            $creado = $denunciaedit->save();
            //volvemos a recuperar agente
            $agente = agente::findOrFail($agen);
            //aumentamos 1 al nuevo agente
            $agente->delitos += 1;        
            //guardamos datos    
            $creado = $agente->save();


            $fecha_actual = date("Y-m-d");

            $denuncias = Denuncia::all();
    
            foreach($denuncias as $den){

                if($den->id == $id){
                    if($den->pausado == 1){
                        if($den->dias_faltantes == null){
                            $den->fecha_alternativa = $fecha_actual;
                            $creado = $den->save();
                        }   
                    }             
                }

                if($den->id == $id){
                    if($den->pausado == 1){
                        if($den->id_agente == $agen){
                            $den->pausado = 0;
                        }
                    }
                }

            }

        }else{
            
        }

        //recuperamos la fecha actual para un calculo
        /*
        */

        //realizamos consulta por el porcentaje de seguimiento de esta denuncia
        $s = DB::table('view_denuncias')
        ->select('resultado')
        ->where('id', '=', $id);

        $s = $s->get();

        //pasa a foreach porque el unico valor pasa como array
        foreach($s as $d){
            //si llego a  100% se resta uno al agente
            if($d->resultado >= 99.99){
                $agente = agente::findOrFail($agen);
                $agente->delitos -= 1;            
                $creado = $agente->save();

            }
        }


        //verificamos de donde vino si de creacion A o de edicion B y de esa manera mandamos el mensaje
        if($den == 'A'){
            return redirect()->route('denuncia.index')->with('mensaje','¡Denuncia creada satisfactoriamente!');
        }else{
        
            return redirect()->route('denuncia.index')->with('aviso','¡Seguimiento editado satisfactoriamente!');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\seguimiento  $seguimiento
     * @return \Illuminate\Http\Response
     */

     //destruir un seguimiento
    public function destroy($den, $i, $id)
    {
        seguimiento::destroy($i);

        return redirect()->route('seguimiento.index',['id'=>$id, 'den'=>$den])->with('alerta','¡Tarea eliminada satisfactoriamente!');
    }
}