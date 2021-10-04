<?php

namespace App\Http\Controllers;

use App\agente;
use App\area;
use App\rango;
use Illuminate\Http\Request;
use Illuminate\Queue\NullQueue;
use Illuminate\Support\Facades\DB;


class AgenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //index para agentes activos
    public function indexActivo(Request $request, $all= null)
    {
        // recuperamos variables
        $bus = "";
        $aux = "";
        $ult = "";

        //verificamos la variable opcional, dependiendo de esta variable se mostrara la categoria
        if($all == "V"){
            $bus = "Delitos Contra la Vida";
            $ult = "Vida";
        }else{
            if($all == "C"){
                $bus = "Delitos Comunes";
                $ult="Comunes";
            }else{
                if($all == "P"){
                    $bus = "Delitos Contra la Propiedad";
                    $ult="Propiedad";
                }
            }
        }

        //recuperamos el texto del filtro
        $texto = trim($request->get('texto'));

        //realizamos un if para determinar si se escogio o no una categoria
        if($bus == ""){
            //si no se escogio una categoria mostraremos una consulta sin filtro
            $agentes = DB::table('agentes')
            ->select('agentes.*','areas.area as areas', 'rangos.rango as rangos')
            ->join('areas', 'areas.id','=','agentes.area')
            ->join('rangos', 'rangos.id','=','agentes.rango')
            ->where('estado', 1)
            //funcion para el buscador
            ->where(function($query) use ($texto){
                $query
                ->orwhere('nombres','like','%'.$texto.'%')
                ->orwhere('placa','like','%'.$texto.'%')
                ->orwhere('apellidos','like','%'.$texto.'%')
                ->orwhere('rangos.rango','like','%'.$texto.'%')
                ->orwhere('areas.area','like','%'.$texto.'%');
            });

            //le asignamos valor a estas variables para retornar a la vista
                $aux = "Principal";
                $ult="Principal";

        }else{
            //si se escogio una categoria se hace una consulta para mostrar esa categoria
            $agentes = DB::table('agentes')
            ->select('agentes.*','areas.area as areas', 'rangos.rango as rangos')
            ->join('areas', 'areas.id','=','agentes.area')
            ->join('rangos', 'rangos.id','=','agentes.rango')
            ->where('estado', 1)
            ->where('areas.area', $bus)
            //funcion para el buscador
            ->where(function($query) use ($texto){
                $query
                ->orwhere('nombres','like','%'.$texto.'%')
                ->orwhere('placa','like','%'.$texto.'%')
                ->orwhere('apellidos','like','%'.$texto.'%')
                ->orwhere('rangos.rango','like','%'.$texto.'%')
                ->orwhere('areas.area','like','%'.$texto.'%');
            });

            $aux = $bus;
        }

        $agentes= $agentes->get();

        $areas = area::all();
        $rangos = rango::all();

        //retornamos valores a la vista
        return view('agente/indexAgente')//vista
            ->with('agentes', $agentes)->with('ult', $ult)->with('aux', $aux)
            ->with('texto', $texto)->with('all', $all)->with('areas', $areas)
            ->with('rangos', $rangos);// va la ruta y variable creada
    }


    //index para agentes desactivados
    public function indexDesactivo(Request $request)
    {
        $num = $request->get('paginacion');
        //recuperamos el valor del numero de paginacion
        if($num == null){
            $num = 10;
        }

        //recuperamos el valor del filtro
        $texto = trim($request->get('texto'));

        //ejecutamos la consulta de datos que se muestran en el filtro
        $ageDes= DB::table('agentes')
            ->select('agentes.*','areas.area as areas', 'rangos.rango as rangos')
            ->join('areas', 'areas.id','=','agentes.area')
            ->join('rangos', 'rangos.id','=','agentes.rango')
            ->where('estado','=','0')
            ->where(function($query) use ($texto){
                $query->orwhere('nombres','like','%'.$texto.'%')
                ->orwhere('apellidos','like','%'.$texto.'%')
                ->orwhere('rangos.rango','like','%'.$texto.'%')
                ->orwhere('placa','like','%'.$texto.'%');
            })->paginate($num);

        //ejecutamos la consulta contadora con filtro
        $ageD= DB::table('agentes')
        ->select('agentes.*','areas.area as areas', 'rangos.rango as rangos')
        ->join('areas', 'areas.id','=','agentes.area')
        ->join('rangos', 'rangos.id','=','agentes.rango')
        ->where('estado','=','0')
        ->where(function($query) use ($texto){
            $query->orwhere('nombres','like','%'.$texto.'%')
            ->orwhere('apellidos','like','%'.$texto.'%')
            ->orwhere('rangos.rango','like','%'.$texto.'%')
            ->orwhere('placa','like','%'.$texto.'%');
        });

        $ageD = $ageD->get();
   
        $ageDes2 = count($ageD);

        //retornamos valores a la vista
        return view('agente/indexAgentesDesactivados')
        ->with('ageDes',$ageDes)->with('texto',$texto)->with('num',$num) ->with('ageDes2',$ageDes2);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //metodo para la creacion de un nuevo agente
    public function store(Request $request)
    {
        //hacemos las validaciones
        //hacemos las validaciones
        $rules = [
            'area'=> 'required|exists:areas,id',
            'placa' => 'required|max:5|unique:agentes',
            'rango' => 'required|exists:rangos,id',
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required|numeric|digits:8|unique:agentes',

        ];

        //creamos los mensajes de error
        $messages = [
            'area.required' => 'El campo área es obligatorio',
            'area.exists' => 'El campo área es un dato no valido',
            'placa.numeric' => 'La placa no tiene los caracteres solicitados',
            'placa.max' => ' En Placa no ingreso los caracteres solicitados',
            'placa.min' => ' En Placa no ingreso los caracteres solicitados',
            'placa.unique' => 'El dato ingresado en placa ya esta en uso',
            'rango.required' => 'El campo rango es obligatorio',
            'rango.exists' => 'El campo rango es un dato no valido',
            'nombres.required' => 'El campo nombres es obligatorio',
            'apellidos.required' => 'El campo apellidos es obligatorio',
            'telefono.required' => 'El campo teléfono es obligatorio',
            'telefono.unique' => 'El dato ingresado en teléfono ya esta en uso',
            'telefono.digits' => 'El dato ingresado en telefono puede ser mayor o menor a lo solicitado' ,
            'telefono.numeric' => 'El dato ingresado en telefono no acepta numeros'
        ];

        //enviamos los errores si los hay
        $this->validate($request, $rules, $messages);

        //realizamos llamado al modelo para guardar los datos
        $nuevoAgente = new agente();

        //formulario en el cual se envian los datos respectivos
        $nuevoAgente->id = $request->input('id');
        $nuevoAgente->area =$request->input('area');
        $nuevoAgente->placa =$request->input('placa');
        $nuevoAgente->rango = $request->input('rango');
        $nuevoAgente->nombres = $request->input('nombres');
        $nuevoAgente->apellidos = $request->input('apellidos');
        $nuevoAgente->telefono = $request->input('telefono');

        //guardamos los datos
        $creado = $nuevoAgente->save();

        //hacemos un if si fue creado nos reedirecciona al index y muestra mensaje
        if ($creado) {
            return redirect()->route('agente.indice')
                ->with('mensaje', '¡El Agente fue registrado exitosamente!');
        } else {
            //retornar con un msj de error

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\agente  $agente
     * @return \Illuminate\Http\Response
     */

     //funcion para mostrar
    public function show($id)
    {
        //realizamos un llamado al metodo y que pase los datos con el id correspondiente
        $agentes = DB::table('agentes')
        ->select('agentes.*','areas.area as areas', 'rangos.rango as rangos')
        ->join('areas', 'areas.id','=','agentes.area')
        ->join('rangos', 'rangos.id','=','agentes.rango')
        ->where('agentes.id','=',$id)->get()->first();

        //hacemos un llamado a la vista
        return view('agente/showagente')->with('agentes', $agentes);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\agente  $agente
     * @return \Illuminate\Http\Response
     */
    //realizamos la actualizacion de datos
    public function update(Request $request, $id)
    {
        //hacemos  un llamado al modelo y que pase los datos del agente con ese id
        $agente = agente::findOrFail($id);

        //realizamos un if donde se determina si los datos fueron editados o no
        if($agente->area === $request->input('area') && $agente->placa === $request->input('placa' && $agente->rango === $request->input('rango' && $agente->nombres=== $request->input('nombres' && $agente->apellidos === $request->input('apellidos'
         && $agente->telefono === $request->input('telefono')))))){

            //si no se cambio nada retornamos al index normal sin mensaje
            return redirect()->route('agente.indice');

        }else
        {
            //hacemos las validaciones
            $rules = [
                'area'=> 'required|exists:areas,id',
                'placa' => 'required|max:5',
                'rango' => 'required|exists:rangos,id',
                'nombres' => 'required',
                'apellidos' => 'required',
                'telefono' => 'required|numeric|digits:8',
    
            ];
    
            //creamos los mensajes de error
            $messages = [
                'area.required' => 'El campo área es obligatorio',
                'area.exists' => 'El campo área es un dato no valido',
                'placa.numeric' => 'La placa no tiene los caracteres solicitados',
                'placa.max' => ' En Placa no ingreso los caracteres solicitados',
                'placa.min' => ' En Placa no ingreso los caracteres solicitados',
                'rango.required' => 'El campo rango es obligatorio',
                'rango.exists' => 'El campo rango es un dato no valido',
                'nombres.required' => 'El campo nombres es obligatorio',
                'apellidos.required' => 'El campo apellidos es obligatorio',
                'telefono.required' => 'El campo teléfono es obligatorio',
                'telefono.digits' => 'El dato ingresado en telefono puede ser mayor o menor a lo solicitado' ,
                'telefono.numeric' => 'El dato ingresado en telefono no acepta numeros'
            ];

            //enviamos los errores si los hay
            $this->validate($request, $rules, $messages);



            //formulario en el cual se envian los datos respectivos
            $agente->area = $request->input('area');
            $agente->rango = $request->input('rango');
            $agente->placa = $request->input('placa');
            $agente->nombres = $request->input('nombres');
            $agente->apellidos = $request->input('apellidos');
            $agente->telefono = $request->input('telefono');


            $creado = $agente->save(); //$variable creada

            //if si fue creado exitosamente con mensaje de confirmacion
            if ($creado) {
                return redirect()->route('agente.indice')
                    ->with('aviso', '¡Los datos del agente se modificaron exitosamente!');
            } else {
                //retornar con un msj de error
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\agente  $agente
     * @return \Illuminate\Http\Response
     */

     //funcion para desactivar a un agente
    public function desactivar($id)
    {
        //llamamos al modelo agente pasando por el id correspondiente
        $agente = agente::findOrFail($id);

        //cambiamos el estado del agente
        $agente->estado = 0;

        //guardamos el cambio
        $creado = $agente->save();

        //retornamos a la vista anterior
        return redirect()->back()->with('mensaje','¡Agente desactivado satisfactoriamente¡');

    }

    //funcion activar agente desactivado
    public function activar($id)
    {
        //llamamos al modelo agente pasando por el id correspondiente
        $agente = agente::findOrFail($id);

        //cambiamos el estado del agente
        $agente->estado = 1;

        //guardamos el cambio
        $creado = $agente->save();

        //retornamos a la vista anterior
        return redirect()->back()->with('mensaje','Agente activado exitosamente');


    }


    }