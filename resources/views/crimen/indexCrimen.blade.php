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
<h2 class="azul" style="text-align: center;"><strong>Catálogo de Delitos</strong></h2>
<br>

<div>

    <br>
    <!--Mandamos el texto que escriben en el filtro al controlador-->
    <form action="{{route('crimen.indice')}}" method="GET">
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

                <a style="width: 48%;" type="button" href='crimenes' class="btn btn-danger">
                <i class="fas fa-trash"></i> Limpiar
                </a>
            </div>
        </div>

</div>

<br><br><br>
<!--boton añadir delito-->
<a href='#' data-toggle="modal" data-target="#createCrimen" class="btn btn-info"
style="float: left; width: 20%; height: 50px;">
    <p style="font-size: 20px; color: white;">
        <i class="fas fa-plus-circle"></i> <strong >Nuevo Delito</strong>
    </p>
</a>
<!--Boton que nos envia a la parte de delitos desactivados-->

    <!--<label style="float:right;">Delitos inactivos</label>-->
    <a style="float: right; width: 20%; height: 50px; " type="button" class="btn btn-danger" 
    href='/crimenesdesactivado'>
        <p style="font-size: 20px;">
            <i class="fas fa-minus-circle"></i> <strong>Delitos Inactivos</strong>
        </p>
    </a>

<br><br><br>
<!--Inicio de Paginacion-->
<div style="float:right;">
    {{$crimen->links()}}
</div>
<!--Final de paginacion-->

<!--Selecccionar el numero de delitos a mostrar por pagina-->
<div style="font-size:18px;">
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
</form>


<!--Modal de creacion de delito-->
<div class="modal fade" id="createCrimen" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-image: linear-gradient(to left,  #4d55c4,#0b15a7);color:white;">
                <h5 class="modal-title" id="exampleModalLabel">
                    Agregar Delito</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                </button>
            </div>

            <form method="post" action="">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <label for="delito" class="col-form-label">Delito:</label>
                        <input required type="text" class="form-control form-control-user" maxlength="150" name="delito"
                            id="delito" placeholder="Ingrese el nombre del delito">
                    </div>

                </div>
                <div class="modal-footer">
                    <!--Boton Guardar-->
                    <button type="button" class="btn btn-primary" id="save" data-toggle="modal" data-target="#creardel">
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

                    <!--modal de confirmacion de creacion de delito-->
                    <div class="modal" id="creardel" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header"
                                    style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                                    <h5 class="modal-title">Guardar Delito</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>¿Desea crear el Delito?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" id="btn-save" name="btnsave"
                                        class="btn btn-primary">Guardar</button>

                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--final del modal creacion de delito-->
                    </form>

<?php $valor = 0; $un =0;?>

<?php $un = $crimen2?>

@foreach($crimen as $cri)
<?php $valor = $valor+1?>
@endforeach

@if($texto != null)
<label for="" class="col-form-label">Exiten {{$un}} coincidencias con la busqueda {{$texto}}:</label>
@endif
<!--Tabla para mostrar los delitos-->
<table class="table table-bordered" id="data_table">
    <thead class="table-dark">
        <tr class="text-center">
            <th>Delito</th>
            <th>Editar</th>
            <th>Desactivar</th>
        </tr>
    </thead>
    <tbody>

        @forelse($crimen as $cri)

        <tr>
            <td>{{$cri->delito}}</td>
            <!--Definimos el boton de Editar-->
            <td>
                <a class="btn btn-warning" href="javascript:void(0)" id="edit-customer" data-toggle="modal"
                    data-target="#editCrimen-{{$cri->id}}" style="width: 100%;color: #fff;">
                    <i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Editar
                </a>

                <!--Modal de editar el delito-->
                <div class="modal fade" id="editCrimen-{{$cri->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #51bb51,#247919);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Editar Delito
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>

                            <form method="post" action="{{route('crimen.update',['id'=> $cri-> id])}}">
                                @csrf
                                @method('put')
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="delito" class="col-form-label">Delito:</label>
                                        <input required type="text" class="form-control form-control-user"
                                            maxlength="150" name="delito" id="delito" value="{{$cri->delito}}"
                                            autocomplete="off" placeholder="Ingrese el nombre del delito">
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <!--Boton Actualizar-->
                                    <button type="button" class="btn btn-primary" id="btnActualizar" data-toggle="modal"
                                        data-target="#editdel-{{$cri->id}}">
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
                <!--Final del modal editar delito-->

                                    <!--Modal de confirmacion de edicion-->
                                    <div class="modal" id="editdel-{{$cri->id}}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                    style="background-image: linear-gradient(to left,  #57a986,#0edb83);color:black;">
                                                    <h5 class="modal-title">Editar Delito</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Desea editar el Delito?</p>
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
                <!--Boton desactivar-->

                <a data-toggle="modal" data-target="#deletmodal-{{$cri->id}}" style="width: 100%; color: #fff"
                    class="btn btn-danger">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>&nbsp;&nbsp;Desactivar
                </a>

                <!-- Modal para confirmar la desactivacion del delito-->
                <div class="modal fade" id="deletmodal-{{$cri->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #e46c5e,#c53c38);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel">
                                    Desactivar Delito
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Desea realmente eliminar el delito {{$cri->delito}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <form method="post" action="{{route('crimen.borrar',['id'=>$cri->id])}}">

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

        </tr>
        @empty
        <tr>
            <th colspan="5">No hay crimenes</th>
            <!--Si la tabla esta vacia mostramos el mensaje no hay crimenes-->
        </tr>
        @endforelse
        <!--fin del forelse-->
        </script>
    </tbody>
</table>
<!--Conteo de cuantos datos se muestra-->


<div style="float:right;">
    {{$crimen->links()}}
</div>
<p><strong>Se muestran {{$valor}} delitos de {{$un}}</strong> </p>
<!--Final del conteo de datos que se muestran-->


@stop