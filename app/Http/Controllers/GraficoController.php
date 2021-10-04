<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\crimen;
use App\agente;
use Illuminate\Support\Facades\DB;

class GraficoController extends Controller
{
    //
    public function crimenes(Request $request)
    {
        //recuperamos el valor de los select
        $valor = trim($request->get('selectcrimen'));
        $mi = trim($request->get('selectmesinicio'));
        $mf = trim($request->get('selectmesfinal'));
        $ai = trim($request->get('selectanioinicio'));
        $af = trim($request->get('selectaniofinal'));

        //realizamos una consulta para determinar el año mas bajo y mas alto de denuncias
        $sqla = 'SELECT 
        year(MIN(fecha_denuncia)) AS minimo, 
        year(MAX(fecha_denuncia)) AS maximo
        FROM view_denuncias;';
        $anios = DB::select($sqla);

        //guardamos los datos de la consulta anterior en unas variables
        foreach($anios as $a){
            $amin = $a->minimo;
            $amax = $a->maximo;
        }

        //si el select anio inicio no tiene valor le asignamos el anio maximo
        if($ai == ''){
            $ai = $amin;
        }

        //si el select anio final no tiene valor le asignamos el anio minimo
        if($af == ''){
            $af = $amax;
        }

        //si el año final es menor al de inicio corregir eso
        if($af < $ai){
            $af = $ai;
        }

        //si el select mes inicio no tiene valor le asignamos 1
        if($mi == ''){
            $mi = 1;
        }

        //si el select mes final no tiene valor le asignamos 12
        if($mf == ''){
            $mf = 12;
        }

        if($af == $ai && $mf < $mi){
            $mf = $mi;
        }

        //guardamos el nombre del mes para mes inicio para mostrarlos en un select
        switch($mi){
            case 1:
                $mesa = "Enero";
            break;
            case 2:
                $mesa = "Febrero";
            break;
            case 3:
                $mesa = "Marzo";
            break;
            case 4:
                $mesa = "Abril";
            break;
            case 5:
                $mesa = "Mayo";
            break;
            case 6:
                $mesa = "Junio";
            break;
            case 7:
                $mesa = "Julio";
            break;
            case 8:
                $mesa = "Agosto";
            break;
            case 9:
                $mesa = "Septiembre";
            break;
            case 10:
                $mesa = "Octubre";
            break;
            case 11:
                $mesa = "Noviembre";
            break;
            case 12:
                $mesa = "Diciembre";
            break;
        }

        //guardamos el nombre del mes para el mes final para mostrarlos en un select
        switch($mf){
            case 1:
                $mesf = "Enero";
                $df = 31;
            break;
            case 2:
                $mesf = "Febrero";
                $df = 28;
            break;
            case 3:
                $mesf = "Marzo";
                $df = 31;
            break;
            case 4:
                $mesf = "Abril";
                $df = 30;
            break;
            case 5:
                $mesf = "Mayo";
                $df = 31;
            break;
            case 6:
                $mesf = "Junio";
                $df = 30;
            break;
            case 7:
                $mesf = "Julio";
                $df = 31;
            break;
            case 8:
                $mesf = "Agosto";
                $df = 31;
            break;
            case 9:
                $mesf = "Septiembre";
                $df = 30;
            break;
            case 10:
                $mesf = "Octubre";
                $df = 31;
            break;
            case 11:
                $mesf = "Noviembre";
                $df = 30;
            break;
            case 12:
                $mesf = "Diciembre";
                $df = 31;
            break;
        }

        $mein = sprintf("%02d", $mi);
        $mefn = sprintf("%02d", $mf);
        $inicio = $ai.$mein.'01';
        $final = $af.$mefn.$df;

        //aqui pondremos el if para ver si selecciono algun delito 
        if($valor != ''){
            //si no selecciono se hacen consultas sin where con id

            //realizamos una consulta para saber las completadas

            $completado= DB::table('view_denuncias')
            ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
            ->where('remitida', '=', 1)
            ->where('id_crimen', '=', $valor)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $completado = $completado->get();

            $c = count($completado);


            //realizamos una consulta para saber las retrasadas
            $retrasadas= DB::table('view_denuncias')
            ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
            ->where('estado', '=', 'Retrasada')
            ->where('id_crimen', '=', $valor)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $retrasadas = $retrasadas->get();

            $r = count($retrasadas);


            //realizamos una consulta para saber las pendientes
            $pendientes= DB::table('view_denuncias')
            ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
            ->where('estado', '=', 'Pendiente')
            ->where('id_crimen', '=', $valor)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $pendientes = $pendientes->get();

            $p = count($pendientes);
            
        }else{
            //caso contrario si fue seleccionado un delito filtramos con el id de ese delito

            $completado= DB::table('view_denuncias')
            ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
            ->where('remitida', '=', 1)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $completado = $completado->get();

            $c = count($completado);


            //realizamos una consulta para saber las retrasadas
            $retrasadas= DB::table('view_denuncias')
            ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
            ->where('estado', '=', 'Retrasada')
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $retrasadas = $retrasadas->get();

            $r = count($retrasadas);


            //realizamos una consulta para saber las pendientes
            $pendientes= DB::table('view_denuncias')
            ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
            ->where('estado', '=', 'Pendiente')
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $pendientes = $pendientes->get();

            $p = count($pendientes);
        }

        if($valor == ''){
            $mostrar = 'TODOS';
        }else{
            //realizamos una consulta para saber las pendientes
            $dato = DB::table('crimens')
            ->where('id', '=', $valor);

            $dato = $dato->get();

            foreach($dato as $d){
                $mostrar = $d->delito;
            }
        }       
        
        $crimenes = crimen::all();
        return view('grafico/graficocrimenes')->with('crimenes',$crimenes)
        ->with('completado',$c)->with('retrasada',$r)->with('pendiente',$p)
        ->with('valor',$valor)->with('mostrar',$mostrar)->with('amax',$amax)->with('amin',$amin)
        ->with('mi',$mi)->with('mesa',$mesa)->with('ai',$ai)->with('mf',$mf)->with('mesf',$mesf)
        ->with('af',$af);
    }

    public function agentes(Request $request)
    {
        //recuperamos el valor de los select
        $valor = trim($request->get('selectagente'));
        $mi = trim($request->get('selectmesinicio'));
        $mf = trim($request->get('selectmesfinal'));
        $ai = trim($request->get('selectanioinicio'));
        $af = trim($request->get('selectaniofinal'));

        //realizamos una consulta para determinar el año mas bajo y mas alto de denuncias
        $sqla = 'SELECT 
        year(MIN(fecha_denuncia)) AS minimo, 
        year(MAX(fecha_denuncia)) AS maximo
        FROM view_denuncias;';
        $anios = DB::select($sqla);

        //guardamos los datos de la consulta anterior en unas variables
        foreach($anios as $a){
            $amin = $a->minimo;
            $amax = $a->maximo;
        }

        //si el select anio inicio no tiene valor le asignamos el anio maximo
        if($ai == ''){
            $ai = $amin;
        }

        //si el select anio final no tiene valor le asignamos el anio minimo
        if($af == ''){
            $af = $amax;
        }

        //si el año final es menor al de inicio corregir eso
        if($af < $ai){
            $af = $ai;
        }

        //si el select mes inicio no tiene valor le asignamos 1
        if($mi == ''){
            $mi = 1;
        }

        //si el select mes final no tiene valor le asignamos 12
        if($mf == ''){
            $mf = 12;
        }

        if($af == $ai && $mf < $mi){
            $mf = $mi;
        }

        //guardamos el nombre del mes para mes inicio para mostrarlos en un select
        switch($mi){
            case 1:
                $mesa = "Enero";
            break;
            case 2:
                $mesa = "Febrero";
            break;
            case 3:
                $mesa = "Marzo";
            break;
            case 4:
                $mesa = "Abril";
            break;
            case 5:
                $mesa = "Mayo";
            break;
            case 6:
                $mesa = "Junio";
            break;
            case 7:
                $mesa = "Julio";
            break;
            case 8:
                $mesa = "Agosto";
            break;
            case 9:
                $mesa = "Septiembre";
            break;
            case 10:
                $mesa = "Octubre";
            break;
            case 11:
                $mesa = "Noviembre";
            break;
            case 12:
                $mesa = "Diciembre";
            break;
        }

        //guardamos el nombre del mes para el mes final para mostrarlos en un select
        switch($mf){
            case 1:
                $mesf = "Enero";
                $df = 31;
            break;
            case 2:
                $mesf = "Febrero";
                $df = 28;
            break;
            case 3:
                $mesf = "Marzo";
                $df = 31;
            break;
            case 4:
                $mesf = "Abril";
                $df = 30;
            break;
            case 5:
                $mesf = "Mayo";
                $df = 31;
            break;
            case 6:
                $mesf = "Junio";
                $df = 30;
            break;
            case 7:
                $mesf = "Julio";
                $df = 31;
            break;
            case 8:
                $mesf = "Agosto";
                $df = 31;
            break;
            case 9:
                $mesf = "Septiembre";
                $df = 30;
            break;
            case 10:
                $mesf = "Octubre";
                $df = 31;
            break;
            case 11:
                $mesf = "Noviembre";
                $df = 30;
            break;
            case 12:
                $mesf = "Diciembre";
                $df = 31;
            break;
        }

        $mein = sprintf("%02d", $mi);
        $mefn = sprintf("%02d", $mf);
        $inicio = $ai.$mein.'01';
        $final = $af.$mefn.$df;

        //aqui pondremos el if para ver si selecciono algun delito 
        if($valor != ''){
            //si no selecciono se hacen consultas sin where con id
            
            //realizamos una consulta para saber las completadas

            $completado= DB::table('view_denuncias')
            ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
            ->where('remitida', '=', 1)
            ->where('id_agente', '=', $valor)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $completado = $completado->get();

            $c = count($completado);


            //realizamos una consulta para saber las retrasadas
            $retrasadas= DB::table('view_denuncias')
            ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
            ->where('view_denuncias.estado', '=', 'Retrasada')
            ->where('id_agente', '=', $valor)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $retrasadas = $retrasadas->get();

            $r = count($retrasadas);


            //realizamos una consulta para saber las pendientes
            $pendientes= DB::table('view_denuncias')
            ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
            ->where('view_denuncias.estado', '=', 'Pendiente')
            ->where('id_agente', '=', $valor)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $pendientes = $pendientes->get();

            $p = count($pendientes);
            
            
        }else{
            //caso contrario si fue seleccionado un delito filtramos con el id de ese delito

            //realizamos una consulta para saber las completadas

            $completado= DB::table('view_denuncias')
            ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
            ->where('remitida', '=', 1)
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $completado = $completado->get();

            $c = count($completado);


            //realizamos una consulta para saber las retrasadas
            $retrasadas= DB::table('view_denuncias')
            ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
            ->where('view_denuncias.estado', '=', 'Retrasada')
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $retrasadas = $retrasadas->get();

            $r = count($retrasadas);


            //realizamos una consulta para saber las pendientes
            $pendientes= DB::table('view_denuncias')
            ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
            ->where('view_denuncias.estado', '=', 'Pendiente')
            ->whereBetween('fecha_denuncia', [$inicio, $final]);

            $pendientes = $pendientes->get();

            $p = count($pendientes);
        }

        if($valor == ''){
            $mostrar = 'TODOS';
        }else{
            //realizamos una consulta para saber las pendientes
            $sql = 'SELECT *
            FROM agentes
            WHERE id = '.$valor.';';
            $dato = DB::select($sql);

            foreach($dato as $d){
                $mostrar = $d->nombres." ".$d->apellidos;
            }
        }       
        
        $agentes = agente::all();
        return view('grafico/graficoagentes')->with('agentes',$agentes)
        ->with('completado',$c)->with('retrasada',$r)->with('pendiente',$p)
        ->with('valor',$valor)->with('mostrar',$mostrar)->with('amax',$amax)->with('amin',$amin)
        ->with('mi',$mi)->with('mesa',$mesa)->with('ai',$ai)->with('mf',$mf)->with('mesf',$mesf)
        ->with('af',$af);
    }

    public function denuncias(Request $request)
    {

        //realizamos una consulta para determinar el año mas bajo y mas alto de denuncias
        $sqla = 'SELECT 
        year(MIN(fecha_denuncia)) AS minimo, 
        year(MAX(fecha_denuncia)) AS maximo
        FROM view_denuncias;';
        $anios = DB::select($sqla);

        //guardamos los datos de la consulta anterior en unas variables
        foreach($anios as $a){
            $amin = $a->minimo;
            $amax = $a->maximo;
        }

        //si el select anio inicio no tiene valor le asignamos el anio maximo
            

        $valor = trim($request->get('selectanioinicio'));

        if($valor == ''){
            $valor = $amax;

        }

        $mostrar = $valor;
        $ai = $valor;

        //SELECT COUNT(*) FROM denuncias WHERE MONTH(fecha_denuncia) = 8 AND YEAR(fecha_denuncia) = 2021;

        $meses = array();

        for($i = 1; $i<=12; $i++){
            $tot=DB::table('denuncias')
            ->whereMonth('fecha_denuncia', '=', $i)
            ->whereYear('fecha_denuncia', '=', $ai);

            $tot = $tot->get();

            $tot = count($tot);

            $meses[$i] = $tot;
            
        }

        return view('grafico/graficodenuncias')->with('mostrar',$mostrar)
        ->with('amax',$amax)->with('amin',$amin)->with('ai',$ai)->with('meses',$meses);
    }

    
    public function welcome(Request $request)
    {

        //caso contrario si fue seleccionado un delito filtramos con el id de ese delito

        $completado= DB::table('view_denuncias')
        ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
        ->where('remitida', '=', 1);

        $completado = $completado->get();

        $c = count($completado);


        //realizamos una consulta para saber las retrasadas
        $retrasadas= DB::table('view_denuncias')
        ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
        ->where('estado', '=', 'Retrasada');

        $retrasadas = $retrasadas->get();

        $r = count($retrasadas);


        //realizamos una consulta para saber las pendientes
        $pendientes= DB::table('view_denuncias')
        ->join('crimendenuncias', 'crimendenuncias.id_denuncia', '=', 'view_denuncias.id')
        ->where('estado', '=', 'Pendiente');

        $pendientes = $pendientes->get();

        $p = count($pendientes);

        $completado= DB::table('view_denuncias')
        ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
        ->where('remitida', '=', 1);

        $completado = $completado->get();

        $c2 = count($completado);


        //realizamos una consulta para saber las retrasadas
        $retrasadas= DB::table('view_denuncias')
        ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
        ->where('view_denuncias.estado', '=', 'Retrasada');

        $retrasadas = $retrasadas->get();

        $r2 = count($retrasadas);


        //realizamos una consulta para saber las pendientes
        $pendientes= DB::table('view_denuncias')
        ->join('agentes', 'agentes.id', '=', 'view_denuncias.id_agente')
        ->where('view_denuncias.estado', '=', 'Pendiente');

        $pendientes = $pendientes->get();

        $p2 = count($pendientes);

            $meses = array();

            $ai = date("Y");

            for($i = 1; $i<=12; $i++){
                $tot=DB::table('denuncias')
                ->whereMonth('fecha_denuncia', '=', $i)
                ->whereYear('fecha_denuncia', '=', $ai);
    
                $tot = $tot->get();
    
                $tot = count($tot);
    
                $meses[$i] = $tot;
                
            }
        
         $agentes= DB::table('agentes')
        ->where('estado','=','1')
        ->paginate(3);
        
        return view('welcome')->with('agentes',$agentes)->with('meses',$meses)
        ->with('completadoA',$c)->with('retrasadaA',$r)->with('pendienteA',$p)
        ->with('completadoB',$c2)->with('retrasadaB',$r2)->with('pendienteB',$p2);
    }

}