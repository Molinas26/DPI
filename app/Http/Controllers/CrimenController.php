<?php

namespace App\Http\Controllers;

use App\crimen;
use App\crimendesactivados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CrimenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //index para crimen activo
    public function indexActivo(Request $request)
    {
        $num = $request->get('paginacion');
        //recuperamos el valor del numero de paginacion poniendo valor por defecto
        if($num == null){
            $num = 50;
        }

        //recuperamos el valor del filtro
        $texto = trim($request->get('texto'));

        //ejecutamos la consulta contadora con filtro
        $sql = 'SELECT COUNT(*) AS total FROM crimens WHERE delito like "%'.$texto.'%" and estado=1;';
        $crimen2 = DB::select($sql);

        //ejecutamos la consulta de datos que se muestran en el filtro
            $crimen= DB::table('crimens')
            ->select('id','delito')
            ->where('delito','like','%'.$texto.'%')
            ->where('estado','=','1')
            ->paginate($num);
            //retornamos valores a la vista

            $cri= DB::table('crimens')
            ->select('id','delito')
            ->where('delito','like','%'.$texto.'%')
            ->where('estado','=','1');
        
        $cri = $cri->get();
   
        $crimen2 = count($cri);
        return view('crimen/indexCrimen')
        ->with('crimen',$crimen)->with('crimen2',$crimen2)->with('texto',$texto)->with('num',$num);
        
    }

    //index para crimen desactivo
    public function indexDesactivado(Request $request)
    {
        $num = $request->get('paginacion');
        //recuperamos el valor del numero de paginacion poniendo valor por defecto
        if($num == null){
            $num = 10;
        }
        //recuperamos el valor del filtro
        $texto = trim($request->get('texto'));

        //ejecutamos la consulta contadora con filtro
        $sql = 'SELECT COUNT(*) AS total FROM crimens WHERE delito like "%'.$texto.'%" and estado=0;';
        $crimen2 = DB::select($sql);

        //ejecutamos la consulta de datos que se muestran en el filtro
        $descrimen= DB::table('crimens')
            ->select('id','delito')
            ->where('delito','like','%'.$texto.'%')
            ->where('estado','=','0')
            ->paginate($num);
            //retornamos valores a la vista
        $cri= DB::table('crimens')
        ->select('id','delito')
        ->where('delito','like','%'.$texto.'%')
        ->where('estado','=','0');
        
        $cri = $cri->get();
   
        $crimen2 = count($cri);
        return view('crimen/indexDesCrimen')
        ->with('descrimen',$descrimen)->with('crimen2',$crimen2)->with('texto',$texto)->with('num',$num);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //metodo para la creacion de un nuevo delito
    public function store(Request $request)
    {

        //hacemos las validaciones
        $rules = [
            'delito' => 'required|string|min:1|max:150|unique:crimens'
        ];

        //creamos los mensajes de error
        $messages = [
            'delito.required' => 'El campo delito es obligatorio',
            'delito.unique' => 'El dato ingresado en delito ya esta en uso',
            'delito.max' => 'tiene mas caracteres del solicitado',
        ];

        //enviamos los errores si los hay
        $this->validate($request, $rules, $messages);

        //realizamos llamado al modelo para guardar los datos
        $nuevoCrimen = new crimen();

        //formulario en el cual se envian los datos respectivos
        $nuevoCrimen->id = $request->input('id');
        $nuevoCrimen->delito = $request->input('delito');

        //guardamos los datos
        $creado = $nuevoCrimen->save();

        //hacemos un if si fue creado nos reedirecciona al index y muestra mensaje
        if ($creado) {
            return redirect()->route('crimen.indice')
                ->with('mensaje', '¡El Delito fue creado exitosamente!');
        } else {
            //retornar con un msj de error

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\crimen  $crimen
     * @return \Illuminate\Http\Response
     */
    //realizamos la actualizacion de datos
    public function update(Request $request, $id)
    {
        //hacemos  un llamado al modelo y que pase los datos del delito con ese id
        $crimen = crimen::findOrFail($id);

        //realizamos un if donde se determina si los datos fueron editados o no
        if($crimen->delito === $request->input('delito')){

            //si no se cambio nada retornamos al index normal sin mensaje
            return redirect()->route('crimen.indice');

        }else {        
            //hacemos las validaciones
            $rules = [
                'delito' => 'required|string|min:1|max:150'
            ];

            //creamos los mensajes de error
            $messages = [
                'delito.required' => 'El campo delito es obligatorio',
                'delito.max' => 'tiene mas caracteres del solicitado',
            ];
    
            //enviamos los errores si los hay
            $this->validate($request, $rules, $messages);

        
        //formulario en el cual se envian los datos respectivos
        $crimen->delito = $request->input('delito');

        $creado = $crimen->save(); //$variable creada

        //if si fue creado exitosamente con mensaje de confirmacion
        if ($creado) {
            return redirect()->route('crimen.indice')
                ->with('aviso', '¡El delito fue modificado exitosamente!');
        } else {
            //retornar con un msj de error
        }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\crimen  $crimen
     * @return \Illuminate\Http\Response
     */
    //funcion para desactivar a un delito
    public function desactivar($id)
    {

        //llamamos al modelo crimen pasando por el id correspondiente
        $crimen = crimen::findOrFail($id);

        //cambiamos el estado del delito
        $crimen->estado = 0;

        //guardamos el cambio
        $creado =$crimen->save();

        //recuperamos el nombre del delito
        $men = $crimen->delito;

        //retornamos a la vista anterior con un mensaje
        return redirect()->back()->with('alerta',$men.' desactivado satisfactoriamente');
        
    }

    //funcion para activar a un delito
    public function activar($id)
    {
        //llamamos al modelo crimen pasando por el id correspondiente
        $crimen = crimen::findOrFail($id);

        //cambiamos el estado del delito
        $crimen->estado = 1;

        //guardamos el cambio
        $creado =$crimen->save();

        //recuperamos el nombre del delito
        $men = $crimen->delito;

        //retornamos a la vista anterior con un mensaje
        return redirect()->back()->with('mensaje',$men.' activado exitosamente');
        
    }

}