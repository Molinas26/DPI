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
<h2 class="azul" style="text-align: center;"><strong>DENUNCIAS</strong></h2>
<br>

<div>
    <br>

    <br>
    <!--Mandamos el texto que escriben en el filtro al controlador-->
    <form action="denuncias" method="GET">
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

                <a style="width: 48%;" type="button" href='denuncias' class="btn btn-danger">
                <i class="fas fa-trash"></i> Limpiar
                </a>
            </div>
        </div>

</div>

</br></br></br>

<div>
    <a href='/denuncianuevo' style="float: left; width: 20%; height: 50px; " type="button" class="btn btn-info" >
        <p style="font-size: 20px;">
            <i class="fas fa-file-medical"></i> <strong>Nueva Denuncia</strong>
        </p>
    </a>

    <a href='/remitir' style="float: right; width: 27%; height: 50px; " type="button" class="btn btn-warning" >
        <p style="font-size: 20px; color: white;">
            <i class="fas fa-file-medical"></i> <strong>Casos remitidos a Fiscalia</strong>
        </p>
    </a>
</div>

</br></br><br>



<style>
table thead tr th {
    text-align: center;
}
</style>

<div style="font-size:18px;float:left;">

    <label style="float: left;">
        Tiempo de denuncias a mostrar
        <select  id="mySelect" name="tiempo" onchange="this.form.submit()">
            <option style="display: none;" value="{{$an}}">{{$lin}}</option>
            <option value="E">Hoy</option>
            <option value="D">Última semana</option>
            <option value="C">Último mes</option>
            <option value="B">Último año</option>
            <option value="A">Todas</option>
        </select>
    </label>
</div>


<div style="font-size:18px;float:right;">
    <label>
        Estado de la denuncia
        <select id="mySelect3" name="mySelect3" onchange="this.form.submit()">
            <option style="display: none;" value="{{$mos}}">{{$mos}}</option>
            <option value="Todas">Todas</option>
            <option value="Retrasada">Retrasadas</option>
            <option value="Pendiente">Pendientes</option>
            <option value="Completado">Completadas</option>
        </select>
    </label>
</div>

<br><br>

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
        delitos
    </label>
</div>
<!--Final del seleccionar el numero de delito a mostrar por pagina-->
<br>
</form>
<!--Inicio de Paginacion-->
<div style="float:right;">
    {{$denuncias->links()}}
</div>
<!--Final de paginacion-->

<?php $valor = 0; $un =0;?>
<?php $un = $denuncias2?>
@foreach($denuncias as $den)
<?php $valor = $valor+1?>
@endforeach
<br>
@if($texto != null)
<label for="" class="col-form-label">Exiten {{$un}} coincidencias con la busqueda {{$texto}}:</label>
@endif

<!--Tabla para mostrar los delitos-->
<table id="myTable" class="table table-bordered">
    <thead class="table-dark">
        <tr class="text-center">
            <th onclick="sortTable(0, 'int')" style="width: 10%;">Código</th>
            <th onclick="sortTable(1, 'str')" style="width: 16%;">Agente</th>
            <th onclick="sortTable(2, 'int')" style="width: 10%;">Teléfono</th>
            <th style="width: 8%;">Fecha</th>
            <th style="width: 8%;">Detalles</th>
            <th style="width: 8%;">Acción</th>
            <th style="width: 18%;">Progreso</th>
            <th style="width: 22%;">Estado</th>
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
            <td>
                @if($den->resultado < 100) <a class="btn btn-info"
                    href="{{route('seguimiento.index',['id'=>$den->id, 'den'=>'B'])}}" style="width: 100%;">
                    <i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;seguimiento
                    </a>
                    @else
                    <button class="btn btn-warning" style="width: 100%; color: #fff;" href='#' data-toggle="modal"
                        data-target="#remitir-{{$den->id}}">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        &nbsp;&nbsp;Remitir informe a fiscalía
                    </button>

                    <!--Modal de creacion de delito-->
                    <div class="modal fade" id="remitir-{{$den->id}}" data-keyboard="false" data-backdrop="static"
                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header"
                                    style="background-image: linear-gradient(to left,  #4d55c4,#0b15a7);color:white;">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Remitir informe a fiscalía</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form method="GET" action="remitir{{$den->id}}">
                                        <?php
                    $fecha = date("Y-m-d");
                    ?>
                                        <div class="form-group">
                                            <label for="delito" class="col-form-label">Fecha de remisión:</label>
                                            <input required type="datetime-local" class="form-control form-control-user"
                                                max="{{$fecha}}T23:59:59" min="2000-01-01T00:00:00"
                                                name="fecha_remision" id="fecha_remision">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <!--Boton Guardar-->
                                    <a style="color: #fff;" class="btn btn-primary" id="save" data-toggle="modal"
                                        data-target="#confi">
                                        Guardar
                                    </a>

                                    <!--modal de confirmacion de remision de delito-->



                                    <div class="modal" id="confi" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                    style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                                                    <h5 class="modal-title">Confirmación</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Desea enviar el informe de la denuncia No. {{$den->codigo}} a
                                                        informes remitidos a fiscalía?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Guardar</button>

                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Volver</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--final del modal creacion de delito-->

                                    <button type="reset" class="btn btn-success">
                                        Limpiar
                                    </button>

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--Final del modal añadir-->



                    @endif
            </td>

            <td>
                <?php
            $prog = number_format(($den->resultado),2);
            ?>
                @if($prog < 34)
                    <?php $s = "bg-danger"?>
                @elseif(($prog < 67))
                    <?php $s = "bg-warning"?>
                @else
                    <?php $s = "bg-success"?>
                @endif
                <div class="progress" style="height: 30px;">
                    <div id="{{$den->id}}" class="progress-bar {{$s}} progress-bar-striped active" role="progressbar"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                        <strong style="color: black;">{{$prog}}%</strong>
                    </div>
                </div>

            </td>

            <style>
            .men {
                font-size: 13px;
            }
            </style>


            <td class="text-center">

                @if($prog == 100)
                <p class="men alert alert-success" style="height: 40px;">Completado</p>
                @else
                    @if($den->dias_faltantes == null)
                    <p class="men alert alert-secondary" style="height: 40px;">De vacaciones</p>
                    @else
                        @if($den->dias_faltantes < 0) <p class="men  alert alert-danger" style="height: 40px;">Días de retraso:
                            {{$den->dias_faltantes * -1}} </p>
                        @else
                            @if($den->dias_faltantes < 5) <p class="men  alert alert-warning" style="height: 40px;">Días
                                faltantes: {{$den->dias_faltantes}} </p>
                            @else
                                <p class="men  alert alert-primary" style="height: 40px;">Días faltantes:{{$den->dias_faltantes}}</p>
                            @endif
                        @endif
                    @endif
                @endif
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

    <!--Conteo de cuantos datos se muestra-->

    @foreach($denuncias as $den)
        <script>
            var progreso{{$den->id}} = 0;
            var progreso{{$den->id}} = ({{$den->resultado}});
            var idIterval = setInterval(function(){

            $('#{{$den->id}}').css('width', progreso{{$den->id}} + '%');

            //Si llegó a 100 elimino el interval
            if(progreso == 100){
                clearInterval(idIterval);
            }
            },1000);
        </script>
    @endforeach


    <script>
function sortTable(n,type) {
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
        if ((type=="str" && x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) ||
        (type=="int" && parseFloat(x.innerHTML) > parseFloat(y.innerHTML))) {

          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if ((type=="str" && x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) || (type=="int" && parseFloat(x.innerHTML) < parseFloat(y.innerHTML))) {

          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {

      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;

      switchcount ++;
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

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}

</style>

<script src= "https://code.highcharts.com/highcharts.js"></script>
<p><strong>Se muestran {{$valor}} denuncias de {{$un}}</strong> </p>

@stop
