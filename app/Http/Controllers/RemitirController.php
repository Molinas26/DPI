<?php


namespace App\Http\Controllers;

use App\Denuncia;
use App\catalogo_accion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemitirController extends Controller
{
    public function enviar(Request $request, $id){

        $denuncias = Denuncia::findOrFail($id);

        $denuncias->remitida = 1;
        $denuncias->fecha_remitido = $request->input('fecha_remision');

        $creado = $denuncias->save();

        return redirect()->route('denuncia.index',['an'=>'A'])
        ->with('mensaje', '¡Informe remitioa con exito!');//vista

    }


    public function ver(Request $request){

        //recuperamos el valor de la paginacion
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
                $lin = "Todos";
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
            $mos = "Todos";
        }

        //si se selecciono todas entonces la variable $m que es la que va en la consulta esta vacia si no le asignamos el valor
        if($mos == "Todos"){
            $m = "";
        }else{
            $m = $mos;
        }

        //realizamos una consulta de cantidad
        $denuncias2= DB::table('view_denuncias')
        ->where('fecha_denuncia', '>', $fecha_mostrar)
        ->where('remitida', 1)
        //funcion para el buscador
        ->where(function($query) use ($texto){
            $query->orwhere('codigo','like','%'.$texto.'%')
            ->orwhere('nombres','like','%'.$texto.'%')
            ->orwhere('apellidos','like','%'.$texto.'%')
            ->orwhere('telefono','like','%'.$texto.'%');
        });

        $denuncias2 = $denuncias2->get();
        $denuncias2 = count($denuncias2);

        //realiazamos otra consulta eloquent para determinar todos los factores que ocupamos
        $denuncias= DB::table('view_denuncias')
        ->select('id','codigo', 'nombres', 'apellidos', 'fecha_denuncia', 'telefono',
            'fecha_vencimiento', 'fecha_remitido', 'accion', 'acci')
        ->where('fecha_denuncia', '>', $fecha_mostrar)
        ->where('remitida', 1)
        //funcion para el buscador
        ->where(function($query) use ($texto){
            $query->orwhere('codigo','like','%'.$texto.'%')
            ->orwhere('nombres','like','%'.$texto.'%')
            ->orwhere('apellidos','like','%'.$texto.'%')
            ->orwhere('telefono','like','%'.$texto.'%');
        })
        //las opciones de order
        ->orderBy('fecha_denuncia', 'ASC')
        ->paginate($num);


        $acciones = catalogo_accion::all();

        //retornamos a la vista
        return view('denuncia/remitidas')//vista
        ->with('denuncias', $denuncias)->with('texto', $texto)->with('num', $num)
        ->with('denuncias2', $denuncias2)->with('lin', $lin)->with('an', $an)
        ->with('mos', $mos)->with('acciones', $acciones);// va la ruta y variable creada

    }

    public function orden(Request $request, $id){

        $denuncias = Denuncia::findOrFail($id);

        $denuncias->accion = $request->input('orden');

        $creado = $denuncias->save();

        return redirect()->route('remitir.ver',['an'=>'A'])
        ->with('mensaje', '¡Orden asignada con exito!');//vista

    }
}