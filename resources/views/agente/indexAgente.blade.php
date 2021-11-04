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
<?php
$tit = "";

if($aux != "Principal"){
    $tit="de ".$aux;
}
?>
<h2 class="text-center text-dark font-italic font-weight-bold"> Listado de Agentes {{$tit}}</h2>
<br>

<!--Filtro-->
<div>
    <br>
    <!--Mandamos el texto que escriben en el filtro al controlador-->
    <form action="{{$all}}agentes" method="GET">
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

                <a style="width: 48%;" type="button" href='agentes' class="btn btn-danger">
                <i class="fas fa-trash"></i> Limpiar
                </a>
            </div>
        </div>
    </form>
</div>

</div>
<br><br><br>
<div class="">
    <a style="float: left; width: 20%; height: 50px; margin-left: 1.5%;" type="button" class="btn btn-info" data-toggle="modal" data-target="#createAgente" >
        <p style="font-size: 20px; color: white;">
            <i class="fas fa-user-plus"></i> <strong >Nuevo Agente</strong>
        </p>
    </a>

    <a style="float: right; width: 20%; height: 50px; margin-right: 1.5%;" type="button" class="btn btn-danger" href='/agentesdesactivado'>
        <p style="font-size: 20px;">
            <i class="fas fa-users-slash"></i> <strong>Agentes Desactivados</strong>
        </p>
    </a>

</div>
<br><br><br>
<div>
    <a type="submit" class=" border btn btn-outline-dark  btn-lg ml-3" href='#' id="moareas">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stack"
            viewBox="0 0 16 16">
            <path
                d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.598.598 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.598.598 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.598.598 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535L7.733.063z" />
            <path
                d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.598.598 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.659z" />
        </svg>
        {{$aux}}
    </a>
    <a type="button" href="/agentes" id="Principal" class="btn btn-dark areas">Principal</a>
    <a type="button" href="/Cagentes" id="Comunes" class="btn btn-dark areas">Delitos Comunes</a>
    <a type="button" href="/Pagentes" id="Propiedad" class="btn btn-dark areas">Delitos Contra la Propiedad</a>
    <a type="button" href="/Vagentes" id="Vida" class="btn btn-dark areas">Delitos Contra la Vida</a>
    <script>
    $("#{{$ult}}").removeClass("areas");
    $("#{{$ult}}").hide();
    </script>

    <!--Boton que nos envia a la parte de delitos desactivados-->
    <!--<label style="float: right;">Agentes inactivos</label>-->
</div>
</div>


<!--Modal de creacion de Agente-->
<div class="modal fade" id="createAgente" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-image: linear-gradient(to left,  #4d55c4,#0b15a7);color:white;">
                <h5 class="modal-title" id="exampleModalLabel">
                    Agregar Agente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                </button>
            </div>

            <form method="post" action="">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label form="area">Área:</label>
                        <select class="form-control form-control-user" name="area" id="area">
                            <option style="display:none" value="">Seleccione el área</option>
                            @foreach($areas as $area)
                            <option value="{{$area->id}}">{{$area->area}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="placa" class="col-form-label">Placa:</label>
                        <input required type="number" class="form-control form-control-user" name="placa" id="placa"
                            placeholder="Ingrese la placa del agente" minlength="4" maxlength="5"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>

                    <div class="form-group">
                        <label form="rango">Rango:</label>
                        <select class="form-control form-control-user" name="rango" id="rango">
                            <option style="display:none" value="">Seleccione el rango</option>
                            @foreach($rangos as $rango)
                            <option value="{{$rango->id}}">{{$rango->rango}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombres" class="col-form-label">Nombre:</label>
                        <input type="text" onkeypress="return soloLetras(event)" onblur="limpia()" require
                            placeholder="Ingrese el nombre del Agente" maxlength="50" id="nombres" name="nombres" class="form-control
                        form-control-user">
                    </div>

                    <div class="form-group">
                        <label for="apellidos" maxlength="50" class="col-form-label"> Apellido:</label>
                        <input type="text" placeholder="Ingrese el apellido del agente" require id="apellidos"
                            name="apellidos" onkeypress="return soloLetras(event)" onblur="limpia()"
                            class="form-control form-control-user">
                    </div>

                    <div class="form-group">
                        <label for="telefono" class="col-form-label">Teléfono:</label>
                        <input type="tel" require placeholder="Ingrese el teléfono del agente" maxlength="8"
                            id="telefono" name="telefono" class="form-control form-control-user" onload="ValidarTell()"
                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                            pattern="^[9|8|7|3|2]\d{7}$"
                            title="Ingrese un numero telefónico valido que inicie con 2,3,7,8 o 9">

                    </div>

                </div>
                <div class="modal-footer">
                    <!--Boton Guardar-->
                    <button type="button" class="btn btn-primary" id="save" data-toggle="modal" data-target="#crearage">
                        Guardar
                    </button>

                    <button type="reset" class="btn btn-success">
                        Limpiar
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>

        </div>
    </div>
</div>
<!--Final del modal añadir-->
                    <!--modal de confirmacion de creacion de Agente-->
                    <div class="modal" id="crearage" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header"
                                    style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                                    <h5 class="modal-title">Registrar Agente</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Desea registrar el agente?</p>
                                </div>
                                <div class="modal-footer">
                                    <button  type="submit" id="btn-save" name="btnsave" 
                                        class="btn btn-primary ">Guardar</button>

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--final del modal creacion de Agente-->
                    </form>


<br>

<?php $valor = 0;?>
@foreach($agentes as $age)
<?php $valor = $valor+1?>
@endforeach

@if($texto != null)
<label style="margin-left: 2%;" for="" class="col-form-label">Exiten {{$valor}} coincidencias con la busqueda {{$texto}}:</label>
@endif




<!--Tabla para mostrar los delitos-->
<table class="table table-bordered mytableAgentes" id="data_table"
    style="margin-left: 2%; margin-right: 2%; width: 96%;">
    <thead class="table-dark">
        <tr class="text-center">
            <th style="width: 4%;">Placa</th>
            <th style="width: 14%;">Nombre</th>
            <th style="width: 14%;">Apellido</th>
            <th style="width: 20%;">Área</th>
            <th style="width: 10%;">Detalle</th>
            <th style="width: 10%;">Editar</th>
            <th style="width: 15%;">Acción</th>
            <th style="width: 15%;">Estado</th>
        </tr>
    </thead>
    <tbody>

        @forelse($agentes as $age)
        <tr>
            <td>{{$age->placa}}</td>
            <td>{{$age->nombres}}</td>
            <td>{{$age->apellidos}}</td>
            <td>{{$age->areas}}</td>

            <!--Definimos el boton de Detalle-->

            <td>
                <a class="btn btn-success" style="width: 100%;" href="{{route('agentes.show',['id'=>$age->id])}}">
                    <i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;Detalles
                </a>
            </td>
            <!--Definimos el boton de Editar-->
            <td>
                <a class="btn btn-warning" data-toggle="modal" data-target="#editAgente-{{$age->id}}"
                    style="width: 100%;color: #fff;">
                    <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Editar
                </a>

                <!--Modal de editar el Agente-->
                <div class="modal fade" id="editAgente-{{$age->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #51bb51,#247919);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Editar Agente
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>

                            <form method="post" action="{{route('agente.update',['id'=> $age-> id])}}">
                                @csrf
                                @method('put')
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label form="area">Área:</label>
                                        <select class="form-control form-control-user" name="area" id="area">
                                            <option style="display:none" value="{{$age->area}}">{{$age->areas}}</option>
                                            @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->area}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="placa" class="col-for-label">Placa:</label>
                                        <input require type="number" class="form-control form-control-user" maxlength="5"
                                            name="placa" id="placa" value="{{$age->placa}}" autocomplete="off"
                                            placeholder="Ingrese la placa del Agente" onkeyup="validar()"
                                            onkeydown="validar()" minlength="4" maxlength="5"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    </div>


                                    <div class="form-group">
                                        <label form="rango">Rango:</label>
                                        <select class="form-control form-control-user" name="rango" id="rango">
                                            <option style="display:none" value="{{$age->rango}}">{{$age->rangos}}</option>
                                            @foreach($rangos as $rango)
                                            <option value="{{$rango->id}}">{{$rango->rango}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <label for="nombres" class="col-form-label">Nombre:</label>
                                        <input required type="text" class="form-control form-control-user"
                                            maxlength="50" name="nombres" id="nombres" value="{{$age->nombres}}"
                                            autocomplete="off" placeholder="Ingrese el nombre del agente"
                                            onkeydown="validar()" onkeyup="validar()" onkeypress="return soloLetras(event)" onblur="limpia()">
                                    </div>

                                    <div class="form-group">
                                        <label for="apellidos" class="col-form-label">Apellido:</label>
                                        <input type="text" require class="form-control form-control-user" maxlength="50"
                                            id="apellidos" name="apellidos" value="{{$age->apellidos}}"
                                            autocomplete="off" placeholder="Ingrese el apellido del agente"
                                            onkeyup="validar()" onkeydown="validar()"
                                             onkeypress="return soloLetras(event)" onblur="limpia()">
                                    </div>

                                    <div class="form-group">
                                        <label for="telefono" class="col-form-label">Teléfono</label>
                                        <input type="text" require autocomplete="off"
                                            class="form-control form-control-user" maxlength="8" id="telefono"
                                            name="telefono" value="{{$age->telefono}}"
                                            placeholder="Numero telefónico del agente" onkeydown="validar()"
                                            onkeyup="validar()" onload="ValidarTell()"
                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                    </div>


                                </div>

                                <div class="modal-footer">
                                    <!--Boton Actualizar-->
                                    <button type="button" class="btn btn-primary" id="btnActualizar" data-toggle="modal"
                                        data-target="#editage-{{$age->id}}">
                                        Actualizar
                                    </button>


                                    <button type="reset" class="btn btn-success">
                                        Restaurar
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                </div>

                        </div>
                    </div>
                </div>
                <!--Final del modal editar Agente-->
                                <!--Modal de confirmacion de edicion-->
                <div class="modal" id="editage-{{$age->id}}" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #57a986,#0edb83);color:black;">
                                <h5 class="modal-title">Editar Agente</h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>¿Desea guardar los cambios realizados al Agente?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="btn-save" name="btnsave"
                                    class="btn btn-primary">Aceptar</button>

                                <button type="button" class="btn btn-danger"
                                    data-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--final del modal de confirmacion de editar-->
                </form>
            </td>

            <td>
                @if($age->delitos == 0)
                <!--Boton desactivar-->
                <button style="width: 100%;" class="btn btn-danger" data-toggle="modal"
                    data-target="#deletmodal-{{$age->id}}">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>&nbsp;&nbsp;Desactivar
                </button>
                @else
                <a style="width: 100%;" class="btn btn-info" href="{{route('cambio.index',['id'=>$age->id])}}">
                    <i class="fa fa-undo" aria-hidden="true"></i>&nbsp;&nbsp;Reasignar Denuncias
                </a>

                @endif
                <!-- Modal para confirmar la desactivacion del Agente-->
                <div class="modal fade" id="deletmodal-{{$age->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #e46c5e,#c53c38);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Desactivar Agente
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Desea realmente desactivar el agente {{$age->nombres}} {{$age->apellidos}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <form method="post" action="{{route('agente.borrar',['id'=>$age->id])}}">

                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Desactivar" class="btn btn-danger">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <!--Final del modal de desactivar delito-->
            </td>

            <td>
                @if($age->vacaciones == 0)
                <button class="btn btn-success" data-toggle="modal" data-target="#actvacaciones-{{$age->id}}">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    &nbsp;&nbsp;Iniciar Vacaciones
                </button>

                <!--modal de confirmacion de dar vacaciones al Agente-->
                <div class="modal fade" id="actvacaciones-{{$age->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                                <h5 class="modal-title">Dar vacaciones al agente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>¿Desea darle vacaciones al agente {{$age->nombres}} {{$age->apellidos}}?</p>
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-success" href="{{route('vacaciones.dar',['id'=>$age->id])}}">
                                    Aceptar
                                </a>

                                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--final del modal dar vacaciones de Agente-->



                @else
                <button class="btn btn-danger" data-toggle="modal" data-target="#deletvacaciones-{{$age->id}}">
                    <i class="fa fa-pause" aria-hidden="true"></i>
                    &nbsp;&nbsp;Acabar Vacaciones
                </button>

                <!-- Modal para acabar vacaciones-->
                <div class="modal fade" id="deletvacaciones-{{$age->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #e46c5e,#c53c38);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Desactivar vacaciones
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Desea realmente acabar las vacaciones el agente {{$age->nombres}} {{$age->apellidos}}?
                            </div>
                            <div class="modal-footer">
                                <a class="btn btn-success" href="{{route('vacaciones.quitar',['id'=>$age->id])}}">
                                    Aceptar
                                </a>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!--Final del modal de desactivar delito-->


                @endif
            </td>

        </tr>
        @empty
        <tr>
            <th colspan="5">¡No hay Agentes!</th>
            <!--Si la tabla esta vacia mostramos el mensaje no hay Agentes-->
        </tr>

        @endforelse
        <!--fin del forelse-->
        </script>
    </tbody>
</table>
<!--Conteo de cuantos datos se muestra-->

<!--Final del conteo de datos que se muestran-->
<script>
//efecto boton de busqueda
$(document).ready(function(e) {

    $(".oculto").hide();

    $("#mostrar").click(function(e) {

        $('.oculto').toggle(500);

        e.preventDefault();
    });
});

//fin efecto de busqueda
function cambio() {
    var x = document.getElementById("mySelect").value;
    window.location.href = "agentes" + x;
}

//fin efecto de busqueda

$(document).ready(function() {
    $("#search").keyup(function() {
        _this = this;
        $.each($(".mytableAgentes tbody tr"), function() {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
});

// fin funcion filtro
$(document).ready(function(e) {
    $(".areas").hide();
    $("#moareas").click(function(e) {
        $('.areas').toggle(500);

        e.preventDefault();
    });
});

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for (var i in especiales) {
        if (key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if (letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}

function limpia() {
    var val = document.getElementById("miInput").value;
    var tam = val.length;
    for (i = 0; i < tam; i++) {
        if (!isNaN(val[i]))
            document.getElementById("miInput").value = '';
    }
}
</script>

<p style="margin-left: 20px"><strong>Se muestran {{$valor}} agentes</strong> </p>
@stop