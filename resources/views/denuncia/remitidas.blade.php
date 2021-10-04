@extends('madre')
@section('contenido')

<!--Mensajes de error-->
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>
            {{$error}}
        </li>
        @endforeach
    </ul>
</div>
@endif

<!--Mensaje de confirmacion de creacion-->
@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif
<!--Mensaje de confirmacion de edicion-->
@if(session('aviso'))
<div class="alert alert-warning">
    {{session('aviso')}}
</div>
@endif
<!--Mensaje de desactivacion de delito-->
@if(session('alerta'))
<div class="alert alert-danger">
    {{session('alerta')}}
</div>
@endif



<br>
<!--Titulo-->
<h2 class="azul" style="text-align: center;"><strong>INFORMES REMITIDOS A FISCALÍA</strong></h2>
<br>

<div>
    <br>

    <br>
    <!--Mandamos el texto que escriben en el filtro al controlador-->
    <form action="remitir" method="GET">
    <div id="searc" style="width: 100%;">
            <div style="float: left;width:80%;">
                <input type="text" class="form-control target" name="texto"
                    placeholder="Escriba aquí para buscar" value="{{$texto}}">
            </div>

            <div style="float: left;padding-left: 1%;width: 20%;">
                <!--Los botones necesarios para el uso del filtro-->
                <button style="width: 48%;" type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i> Buscar
                </button>

                <a style="width: 48%;" type="button" href='remitir' class="btn btn-danger">
                <i class="fas fa-trash"></i> Limpiar
                </a>
            </div>
        </div>
</div>

</br></br></br>

<a href='/denuncias' style="float: left; width: 20%; height: 50px; " type="button" class="btn btn-success">
<p style="font-size: 20px;">
    <i class="fas fa-file-signature"></i> <strong>Denuncia</strong>
</p>
</a>


<style>
table thead tr th {
    text-align: center;
}
</style>

<div style="font-size:18px;float:right;">

    <label>
        Mostrar informes:
        <select id="mySelect" name="tiempo" onchange="this.form.submit()">
            <option style="display: none;" value="{{$an}}">{{$lin}}</option>
            <option value="E">Hoy</option>
            <option value="D">Última semana</option>
            <option value="C">Último mes</option>
            <option value="B">Último año</option>
            <option value="A">Todos</option>
        </select>
    </label>
</div>

<br><br><br>

<!--Selecccionar el numero de delitos a mostrar por pagina-->
<div style="font-size:18px;float:left;">
    <label>
        Mostrar
        <select id="mySelect" name="paginacion" onchange="this.form.submit()">
            <option style="display: none;">{{$num}}</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="150">150</option>
            <option value="200">200</option>
        </select>
        informes remitidos
    </label>
</div>
</form>
<!--Final del seleccionar el numero de delito a mostrar por pagina-->
<!--Inicio de Paginacion-->
<div style="float:right;">
    {{$denuncias->links()}}
</div>
<!--Final de paginacion-->
<br>

<!--Guardamos el numero seleccionado en el select anterior y lo enviamos al controlador-->
<!--Guardamos el numero seleccionado en el select anterior y lo enviamos al controlador-->
<script>
function cambio() {
    var x = document.getElementById("mySelect").value;
    window.location.href = "{{$an}}remitir" + x;
}

function cambio2() {
    var x = document.getElementById("mySelect2").value;
    window.location.href = x + "remitir{{$num}}";
}
</script>

<br>
<?php $valor = 0; $un =0;?>

<?php $un = $denuncias2?>

@foreach($denuncias as $den)
<?php $valor = $valor+1?>
@endforeach

@if($texto != null)
<label for="" class="col-form-label">Exiten {{$un}} coincidencias con la busqueda {{$texto}}:</label>
@endif

<!--Tabla para mostrar los delitos-->
<table id="myTable" class="table table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th onclick="sortTable(0, 'int')" style="width: 10%;">Código</th>
            <th onclick="sortTable(1, 'str')" style="width: 15%;">Agente</th>
            <th onclick="sortTable(2, 'int')" style="width: 10%;">Teléfono</th>
            <th style="width: 15%;">Fecha Denuncia</th>
            <th style="width: 8%;">Detalles</th>
            <th style="width: 15%;">Fecha Recepcion</th>
            <th style="width: 15%;">Orden Asignada</th>
            <th style="width: 14%;">Asignar Orden</th>
        </tr>
    </thead>
    <tbody>

        @forelse($denuncias as $den)
        <tr>
            <td>{{$den->codigo}}</td>
            <td>{{$den->nombres}} {{$den->apellidos}}</td>
            <td>{{$den->telefono}}</td>
            <td>{{date("d/m/Y", strtotime($den->fecha_denuncia))}}</td>

            <td class="text-center">
                <a class="btn btn-success" href="{{route('denuncia.show',['id'=>$den->id])}}" style="width: 100%;">
                    <i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;Detalles
                </a>

            </td>

            <td>{{date("d/m/Y h:m", strtotime($den->fecha_remitido))}}</td>

            <td>
                {{$den -> accion}}
            <td>
                <button class="btn btn-primary btn" style="width:100%;" data-toggle="modal"
                    data-target="#dialogNewMessage-{{$den->id}}">
                    <i class="fas fa-plus-circle mr-1"></i>Orden
                </button>

                <div class="modal" id="dialogNewMessage-{{$den->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">

                        <div class="modal-content">
                            <div class="modal-header" style="background-image: linear-gradient(to left,  #62d2af,#43b9d5);
                                         color:white;">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Orden emitida por la fiscalía</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>

                            <form method="GET" action="orden{{$den->id}}">
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label form="orden">Orden:</label>
                                        <select class="form-control form-control-user" name="orden" id="orden">
                                            @if($den -> accion == 1)
                                                <option style="display:none" value="1">Selecione la acción a tomar:</option>
                                            @else
                                                <option style="display:none" value="{{$den -> acci}}">{{$den -> accion}}</option>
                                            @endif
                                            @foreach($acciones as $accion)
                                                @if($accion->id>1)
                                                    <option value="{{$accion->id}}">{{$accion->accion}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <!--Boton Guardar-->
                                    <button type="button" class="btn btn-primary" id="save" data-toggle="modal"
                                        data-target="#crearage-{{$den->id}}">
                                        Guardar
                                    </button>

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                </div>


                        </div>
                    </div>
                </div>
                <!--Final del modal añadir-->

                <!--modal de confirmacion de Orden-->
                <div class="modal" id="crearage-{{$den->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                                <h5 class="modal-title">Orden emitida por fisicalía</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>¿Desea guardar la orden?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btn-save" name="btnsave"
                                    class="btn btn-primary">Guardar</button>

                                <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
                                    <!--final del modal orden remitida por fiscalía-->
            </form>
            </td>

            </td>

        </tr>
        @empty
        <tr>
            <th colspan="5">¡No hay denuncias registradas!</th>
            <!--Si la tabla esta vacia mostramos el mensaje no hay crimenes-->
        </tr>
        @endforelse
        <!--fin del forelse-->
    </tbody>
</table>


<script>
function sortTable(n, type) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

    table = document.getElementById("myTable");
    switching = true;

    dir = "asc";

    while (switching) {

        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {

            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir == "asc") {
                if ((type == "str" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
                    (type == "int" && parseFloat(x.innerHTML) > parseFloat(y.innerHTML))) {

                    shouldSwitch = true;
                    break;
                }
            } else if (dir == "desc") {
                if ((type == "str" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) || (type == "int" &&
                        parseFloat(x.innerHTML) < parseFloat(y.innerHTML))) {

                    shouldSwitch = true;
                    break;
                }
            }
        }
        if (shouldSwitch) {

            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;

            switchcount++;
        } else {

            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}
</script>

<style>
table {
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th {
    cursor: pointer;
}

th,td {
    text-align: left;
    padding: 16px;
}

tr:nth-child(even) {
    background-color: #f2f2f2
}
</style>

<script src="https://code.highcharts.com/highcharts.js"></script>
<p><strong>Se muestran {{$valor}} informes de {{$un}}</strong> </p>

@stop
