<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Denuncia;
use App\agente;
use Illuminate\Support\Facades\DB;

class CambioController extends Controller
{

    public function consulta($id){
        //realiazamos otra consulta eloquent para determinar todos los factores que ocupamos
        $denuncias= DB::table('view_denuncias')
        ->select('id_agente', 'codigo', 'fecha_denuncia', 'dias_faltantes', 'resultado')
        ->where('id_agente','=',$id)
        ->where('resultado','<',100)
        ->orderBy('fecha_denuncia', 'asc');

        $denuncias = $denuncias->get();

        return $denuncias;
    }


    public function index($id)
    {
        $agentes = agente::all();

        $denuncias= $this->consulta($id);

        foreach($denuncias as $age){
            $idagente = $age->id_agente;
        }

        return view('agente/reasignar')->with('denuncias', $denuncias)->with('agentes',$agentes)
        ->with('idagente',$idagente);
    }

    
    public function update(Request $request, $id)
    {
        $agenteasignado = $request->input('cambio_agente');

        if($agenteasignado != null){
            $denuncias = Denuncia::all();
        $agentes = agente::all();

        $age1 = 0;

        $fecha_actual = date("Y-m-d");
        foreach($denuncias as $den){
            if($den->id_agente == $id){
                //recuperamos si el checxbox esta o no actuvo
                $dat =  $request->input($den->codigo);

                //verificamos si lo esta y cambiamos el valor
                if($dat == true){
                    $den->id_agente = $agenteasignado;
                    $age1++;
            
                    if($den->dias_faltantes == null){
                        $den->fecha_alternativa = $fecha_actual;
                    }                



                }else{
                    $den->id_agente = $id;
                }

                //guardamos el dato
                $creado = $den->save(); //$variable creada  
            }
        }

        foreach($agentes as $age){
            if($age->id == $id){
                $age->delitos = $age->delitos-$age1;
            }

            if($age->id == $agenteasignado){
                $age->delitos = $age->delitos+$age1;
            }
            $creado = $age->save();
        }

        return redirect()->route('agente.indice')
                ->with('mensaje', '¡Las denuncias fueron reasignadas!');
    
        }else{
            return redirect()->route('agente.indice')
                ->with('aviso', '¡No se realizaron cambios!');
        }

    }

    public function darvacaciones(Request $request, $id){

        $agentes = agente::all();
        $denuncias = Denuncia::all();

        foreach($agentes as $age){
            if($age->id == $id){
                $age->vacaciones = 1;
                $creado = $age->save();
            }
        }

        foreach($denuncias as $den){
            if($den->id_agente == $id){
                $den->pausado = 1;
                $creado = $den->save();
            }
        }

        //DB::raw('DATEDIFF(ml.sent_pst_date,$cur_date->format("Y-m-d")','=','30')
        /*$sql = "SELECT , id_agente, DATEDIFF(DATE_ADD(fecha_alternativa,INTERVAL dias DAY), 
        NOW()) AS dias
        FROM denuncias;";*/

        $dias= DB::table('denuncias')
        ->select('denuncias.id', DB::raw('DATEDIFF(DATE_ADD(fecha_alternativa,INTERVAL dias DAY), 
        NOW()) AS dias'));

        $dias = $dias->get();

        $denuncias = Denuncia::all();

        foreach($denuncias as $den){
            if($den->id_agente == $id){
                $den->fecha_alternativa = null;
                foreach($dias as $d){
                    if($den->id == $d->id){
                        $den->dias = $d->dias;
                    }
                }
                $creado = $den->save();
            }
        }

        return redirect()->route('agentes.indice');

    }

    public function quitvacaciones(Request $request, $id){

        //recuperamos la fecha actual para un calculo
        $fecha_actual = date("Y-m-d");

        $agentes = agente::all();

        foreach($agentes as $age){
            if($age->id == $id){
                $age->vacaciones = 0;
                $creado = $age->save();
            }
        }

        $denuncias = Denuncia::all();

        foreach($denuncias as $den){
            if($den->pausado == 1){
                if($den->id_agente == $id){
                    $den->fecha_alternativa = $fecha_actual;
                    $creado = $den->save();
                }
            }
        }

        $denuncias = Denuncia::all();

        foreach($denuncias as $den){
            if($den->id_agente == $id){
                $den->pausado = 0;
                $creado = $den->save();
            }
        }

        return redirect()->route('agentes.indice');

    }


}