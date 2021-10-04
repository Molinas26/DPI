<?php

namespace App\Http\Controllers;

use App\Denuncia;
use App\crimen;
use App\agente;
use App\crimendenuncia;
use App\denunciante;
use App\ofendido;
use App\sospechoso;
use App\departamento;
use App\municipio;
use App\seguimiento;
use App\nacionalidad;
use App\civil;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DenunciaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $num = $request->get('paginacion');
        $an = $request->get('tiempo');
        //recuperamos el valor del numero de paginacion poniendo valor por defecto
        if($num == null){
            $num = 25;
        }

        if($an == null){
            $an = 'A';
        }

        //recuperamos la fecha actual para un calculo
        $fecha_actual = date("Ymd");
        $fecha_mostrar = $fecha_actual;
        $lin;

        /*procedemos a crear un switch para determinar la opcion seleccionada en el mostrar por fecha representada por la variable $an
        dependiendo de su valor*/
        switch($an){
            //si selecciono todos se deben de mostrar todos dependiendo de esta fecha
            case 'A':
                $fecha_mostrar= "00000101";
                $lin = "Todas";
            break;
            //si selecciono del ultimo año entonces a la fecha actual le restamos un año
            case 'B':
                $fecha_mostrar = date("Ymd",strtotime($fecha_actual."- 1 year"));
                $lin = "Ultimo año";
            break;
            //si selecciono del ultimo mes a la fecha actual le restamos un mes
            case 'C':
                $fecha_mostrar = date("Ymd",strtotime($fecha_actual."- 1 month"));
                $lin = "Ultimo mes";
            break;
            //si selecciono la ultima semana recuperamos la fecha actual menos un mes
            case 'D':
                $fecha_mostrar = date("Ymd",strtotime($fecha_actual."- 1 week"));
                $lin = "Ultima semana";
            break;
            //si selecciono la fecha de hoy pues la fecha actual
            case 'E':
                $fecha_mostrar = $fecha_actual;
                $lin = "Hoy";
            break;
        }

        //recuperamos el texto del filtro
        $texto = trim($request->get('texto'));

        //recuperamos el texto del select por estado
        $mos = trim($request->get('mySelect3'));

        //si la variable anterior es nula o no existe es todas por defecto
        if($mos == null){
            $mos = "Todas";
        }

        //si se selecciono todas entonces la variable $m que es la que va en la consulta esta vacia si no le asignamos el valor
        if($mos == "Todas"){
            $m = "";
        }else{
            $m = $mos;
        }



        //realiazamos otra consulta eloquent para determinar todos los factores que ocupamos
        $denuncias= DB::table('view_denuncias')
            ->select('id','codigo', 'nombres', 'apellidos', 'fecha_denuncia', 'telefono',
                'fecha_vencimiento','dias_faltantes', 'resultado')
            ->where('fecha_denuncia', '>', $fecha_mostrar)
            ->where('estado', 'like', '%'.$m.'%')
            ->where('remitida', 0)
            //funcion para el buscador
            ->where(function($query) use ($texto){
                $query->orwhere('codigo','like','%'.$texto.'%')
                ->orwhere('nombres','like','%'.$texto.'%')
                ->orwhere('apellidos','like','%'.$texto.'%')
                ->orwhere('telefono','like','%'.$texto.'%');
            })
            //las opciones de order
            ->orderBy('estado', 'DESC')
            ->orderBy('resultado', 'ASC')
            ->orderBy('fecha_denuncia', 'ASC')
            ->paginate($num);

            //realizamos una consulta de cantidad
            $den= DB::table('view_denuncias')
            ->where('estado', 'like', '%'.$m.'%')
            ->where('remitida', 0)
            //funcion para el buscador
            ->where(function($query) use ($texto){
                $query->orwhere('codigo','like','%'.$texto.'%')
                ->orwhere('nombres','like','%'.$texto.'%')
                ->orwhere('apellidos','like','%'.$texto.'%')
                ->orwhere('telefono','like','%'.$texto.'%');
            });

            $den = $den->get();

        $denuncias2 = count($den);

        //retornamos a la vista
        return view('denuncia/denuncia')//vista
            ->with('denuncias', $denuncias)->with('texto', $texto)->with('num', $num)
            ->with('denuncias2', $denuncias2)->with('lin', $lin)->with('an', $an)->with('mos', $mos);// va la ruta y variable creada
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //funcion create
    public function create()
    {

        //como aqui necesitamos que seleccione crimenes, agentes, departamentos y municipios los llamamos a todos
        $crimenes = crimen::all();
        $agentes = agente::all();
        $departamento = departamento::all();
        $municipio = municipio::all();
        $nacionalidad = nacionalidad::all();
        $civil = civil::all();

        //retornamos a la vista
        return view('denuncia/createdenuncia')//vista
            ->with('crimenes',$crimenes)->with('agentes',$agentes)
            ->with('departamento',$departamento)->with('municipio',$municipio)
            ->with('nacionalidad',$nacionalidad)->with('civil',$civil);// va la ruta y variable creada

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //crear los datos
    public function store(Request $request)
    {

        //hacemos las validaciones
        $rules = [
            'codigo'=> 'required|string|max:10|unique:denuncias',
            'fechareport' => 'required',
            'agente'=> 'required|exists:agentes,id',
            'delitos'=>'required|exists:crimens,id',
            'nacionalidad' => 'exists:nacionalidads,id',
            'identidad_denunciante'=>'required|string|min:1|max:50',
            'edad'=>'required',
            'estadocivil'=>'required|exists:civils,id',
            'nacionalidad_ofendido' => 'exists:nacionalidads,id',
            'identidad_ofendido'=>'required|string|min:1|max:50',
            'telefono'=>'required|numeric|digits:8',
            'departamento_ofendido'=> 'exists:departamentos,id',
            'municipio_ofendido'=> 'exists:municipios,id',
            'sector_ofendido'=>'required',
            'horainicio'=>'required',
            'sector_sospechoso'=>'required',
            'departamento_sospechoso'=> 'exists:departamentos,id',
            'municipio_sospechoso'=> 'exists:municipios,id',
            'tomada' => 'required',
        ];
        //creamos los mensajes de error
        $messages = [
            'codigo.required' => 'El campo codigo es obligatorio',
            'codigo.integer' => 'el campo codigo debe de ser numerico',
            'codigo.numeric' => 'El campo codigo en denuncia debe de ser numeros',
            'codigo.unique' => 'El campo codigo en denuncia debe de ser unico',
            'fechareport' => 'El campo Fecha y hora de reporte es obligatorio',
            'agente.required' => 'El campo agente es obligatorio',
            'agente.exists' => 'El agente seleccionado no es valido',
            'delitos.required' => 'El campo delitos es obligatorio',
            'delitos.exists' => 'Los delitos seleccionados no son validos',
            'nacionalidad.exists' => 'La nacionalidad del denunciante seleccionada no es valida',
            'identidad_denunciante.required' => 'El campo identidad denunciante es obligatorio',
            'identidad_denunciante.max' => 'El campo identidad en denunciante supera el limite',
            'identidad_denunciante.min' => 'El campo identidad en denunciante limita el limite',
            'edad.required' => 'El campo edad es obligatorio',
            'estadocivil.required' => 'El campo estado civil es obligatorio',
            'estadocivil.exists' => 'El estado civil seleccionado no es valido',
            'nacionalidad_ofendido.exists' => 'La nacionalidad del ofendido seleccionada no es valida',
            'identidad_ofendido.required' => 'El campo identidad en ofendido es obligatorio',
            'identidad_ofendido.max' => 'El campo identidad en ofendido supera el limite',
            'identidad_ofendido.min' => 'El campo identidad en ofendido limita el limite',
            'telefono.required' => 'El campo teléfono es obligatorio',
            'telefono.numeric' => 'El campo teléfono debe ser numerico',
            'telefono.digits' => 'El campo teléfono es es mayor o menor a lo solicitado',
            'departamento_ofendido.exists' => 'El departamento del ofendido seleccionada no es valida',
            'municipio_ofendido.exists' => 'El municipio del ofendido seleccionada no es valida',
            'sector ofendido.required' => 'El campo sector ofendido es obligatorio',
            'horainicio.required' => 'El campo hora inicio es obligatorio',
            'sector_sospechoso.required' => 'El campo sector sospechoso es obligatorio',
            'tomada.required' => 'El campo tomada es obligatorio',
            'departamento_sospechoso.exists' => 'El departamento del sospechoso seleccionada no es valida',
            'municipio_sospechoso.exists' => 'El municipio del sospechoso seleccionada no es valida',
        ];
        //enviamos los errores si los hay
        $this->validate($request, $rules, $messages);

        //creacion de los datos del ofendido
        $nuevoOfendido = new ofendido();

        //validamos si el checxbox idem esta activo
        $dat = $request->input('idem');

        //si esta activo en ofendido guardamos los mismos datos de denunciante
        if($dat === true){
            $nuevoOfendido->nacionalidad_ofendido = $request->input('nacionalidad');
            $nuevoOfendido->DNI_ofendido = $request->input('identidad_denunciante');
            $nuevoOfendido->nombre_ofendido = $request->input('nombre_denunciante');
        }else{
            //caso contrario guardar los datos del ofendido
            $nuevoOfendido->nacionalidad_ofendido = $request->input('nacionalidad_ofendido');
            $nuevoOfendido->DNI_ofendido = $request->input('identidad_ofendido');
            $nuevoOfendido->nombre_ofendido = $request->input('nombre_ofendido');
        }

        //los datos restantes de ofendido que no se copian con index
        $nuevoOfendido->telefono_ofendido = $request->input('telefono');
        $nuevoOfendido->departamento_ofendido = $request->input('departamento_ofendido');
        $nuevoOfendido->municipio_ofendido = $request->input('municipio_ofendido');
        $nuevoOfendido->sector_ofendido = $request->input('sector_ofendido');

        //guardamos los datos del ofendido
        $creado4 = $nuevoOfendido->save();

        //creacion de los datos del sospechoso
        $nuevoSospechoso = new sospechoso();

        //guardamos los datos del sospechoso
        $nuevoSospechoso->fecha_inicio = $request->input('horainicio');
        $nuevoSospechoso->caracteristica = $request->input('caracteristica');
        $nuevoSospechoso->departamento_sospechoso = $request->input('departamento_sospechoso');
        $nuevoSospechoso->municipio_sospechoso = $request->input('municipio_sospechoso');
        $nuevoSospechoso->sector_sospechoso = $request->input('sector_sospechoso');

        //realizamos el almacenamiento de esos datos
        $creado5 = $nuevoSospechoso->save();

        //creacion de los datos del denunciante
        $nuevoDenunciante = new denunciante();

        //guardamos los datos generales del denunciante
        $nuevoDenunciante->nacionalidad = $request->input('nacionalidad');
        $nuevoDenunciante->DNI = $request->input('identidad_denunciante');
        $nuevoDenunciante->edad = $request->input('edad');
        $nuevoDenunciante->estado_civil = $request->input('estadocivil');
        $nuevoDenunciante->nombre = $request->input('nombre_denunciante');

        //almacenamos esos datos
        $creado3 = $nuevoDenunciante->save();

        //creacion de la denuncia
        $nuevaDenuncia= new Denuncia();

        //guardamos la fecha de la denuncia
        $fecha_den = $request->input('fechareport');

        //guardamos los datos del formulario general de denuncia y los id necesarios
        $nuevaDenuncia->id_denunciante = $nuevoDenunciante->id;
        $nuevaDenuncia->id_sospechoso = $nuevoSospechoso->id;
        $nuevaDenuncia->id_ofendido = $nuevoOfendido->id;
        $nuevaDenuncia->codigo = $request->input('codigo');
        $nuevaDenuncia->id_agente = $request->input('agente');
        $nuevaDenuncia->fecha_denuncia = $fecha_den;
        $nuevaDenuncia->fecha_alternativa = $fecha_den;
        $nuevaDenuncia->tomador_denuncia = $request->input('tomada');

        //guardamos todos los datos
        $creado = $nuevaDenuncia->save();

        //recuperar el dato de los crimenes convirtiendolos en un array
        $crist = explode (',', $request->input('delitos'));

        //guardar los datos de los crimenes en un foreach
        foreach($crist as $ed){
            $nuevoCri = new crimendenuncia();
            $nuevoCri->id_crimen =  $ed;
            $nuevoCri->id_denuncia =  $nuevaDenuncia->id;
            $creado2 = $nuevoCri->save();
        }

        if ($creado && $creado2 && $creado3 && $creado4 && $creado5) {
            //si los datos fueron validados llamamos a la funcion de seguimiento

            //incrementamos el valor de denuncia en los agentes
            $agente = agente::findOrFail($nuevaDenuncia->id_agente);

            $agente->delitos += 1;

            //guardamos el dato
            $creado = $agente->save();

            //retornamos a la funcion que nos reedirecciona a seguimiento
            return $this->seguim($nuevaDenuncia->id);
        } else {
            //si no se crearon todos se eliminan los creados para no duplicar datos
            ofendido::destroy($nuevoOfendido->id);
            sospechoso::destroy($nuevoSospechoso->id);
            denunciante::destroy($nuevoDenunciante->id);
            Denuncia::destroy($nuevaDenuncia->id);

        }

    }

    public function seguim($id){

        //creamos un array con los datos de tarea
        $tar = array(
            'Individualizar plenamente a la víctima',
            'Tomar declaración de ofendido',
            'Tomar declaración de testigos',
            'Realizar inspección ocular',
            'Decomiso de documentos',
            'Decomiso de vehículos',
            'Decomiso de teléfonos celulares',
            'Solicitar antecedentes de la víctima',
            'Individualizar al sospechoso',
            'Solicitar antecedentes del sospechoso',
            'Solicitar información balística',
            'Autorización de la víctima',
            'Solicitar padrones fotogáficos',
            'Reconocimientos fotográfico',
            'Levantamiento de CDR',
            'Solicitud de vaciados e intervenciones telefónicos',
            'Solicitud de tracto sucesivo',
            'Solicitud de evaluación médica',
            'Solicitud de ampliación y reconstrucción de accidentes de tránsito',
            'Solicitar cotización de costos por daños o lesiones',
            'Embalar evidencia'
        );

        //creamos los datos del seguimiento con el id de la denuncia
        foreach($tar as $t){
            //llamamos al modelo seguimiento
            $nuevoSeguimiento = new seguimiento();

            //creamos las tareas con su id correspondiente
            $nuevoSeguimiento->tarea = $t;
            $nuevoSeguimiento->id_denuncia = $id;

            //guardamos los datoos
            $cread = $nuevoSeguimiento->save();
        }

        //mandamos a llamar a la ruta que nos reedireccionara a la vista seguimiento
        return redirect()->route('denuncia.index',['id'=>$id, 'den'=>'A']);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    //funcion para ver
    public function show($id)
    {

        $denuncia= DB::table('agentes')
        ->select('area', 'fecha_denuncia', 'placa', 'rango', 'nombres', 'apellidos', 'denuncias.codigo AS codigo',
        'tomador_denuncia','g.nacionalidad as nacionalidad', 'dni', 'edad', 'c.civil as estado_civil', 'nombre','caracteristica',
        'departamento_sospechoso', 'municipio_sospechoso','sector_sospechoso', 'f.nacionalidad as nacionalidad_ofendido',
        'dni_ofendido', 'telefono_ofendido', 'nombre_ofendido', 'departamento_ofendido','municipio_ofendido',
        'sector_ofendido', 'a.nombredepartamento AS depto_sospechoso', 'b.nombredepartamento AS depto_ofendido',
        'fecha_inicio', 'd.nombremunicipio AS municipio_sospechoso', 'e.nombremunicipio AS municipio_ofendido')
        ->join('denuncias','agentes.id','=','denuncias.id_agente')
        ->join('denunciantes', 'denuncias.id_denunciante', '=' ,'denunciantes.id')
        ->join('sospechosos', 'sospechosos.id' ,'=' ,'denunciantes.id')
        ->join('ofendidos', 'ofendidos.id', '=' ,'denunciantes.id')
        ->join('departamentos as a', 'a.id', '=' ,'sospechosos.departamento_sospechoso')
        ->join('departamentos as b', 'b.id', '=', 'ofendidos.departamento_ofendido')
        ->join('civils as c', 'c.id', '=' ,'denunciantes.estado_civil')
        ->join('municipios as d', 'd.id', '=', 'sospechosos.municipio_sospechoso')
        ->join('municipios as e', 'e.id', '=' ,'ofendidos.municipio_ofendido')
        ->join('nacionalidads as f', 'f.id', '=' ,'ofendidos.nacionalidad_ofendido')
        ->join('nacionalidads as g', 'g.id', '=' ,'denunciantes.nacionalidad')
        ->where('denuncias.id', '=', $id);

        $denuncia = $denuncia->get();

        //realizamos una consulta extra para mostrar los crimenes de esa denuncia que pueden ser varios
        $crimenes=DB::table('crimendenuncias')
        ->select('denuncias.id', 'codigo', 'crimendenuncias.id', 'crimens.delito')
        ->join('denuncias' , 'denuncias.id' ,'=' ,'crimendenuncias.id_denuncia')
        ->join('crimens' , 'crimendenuncias.id_crimen','=', 'crimens.id')
        ->where('denuncias.id', '=', $id);

        $crimenes = $crimenes->get();

        //llamamos a la vista
        return view('denuncia/detalledenuncia')->with('denuncia', $denuncia)
        ->with('crimenes', $crimenes);
    }

}
