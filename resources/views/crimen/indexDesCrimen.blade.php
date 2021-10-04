@extends('madre')
@section('contenido')
@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif

<br>

<h2 class="azul" style="text-align: center;"><strong>Delitos Desactivados</strong></h2>
<br>

<div>
    <form action="{{route('crimendesactivado.indice')}}" method="GET">
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

                <a style="width: 48%;" type="button" href='crimenesdesactivado' class="btn btn-danger">
                <i class="fas fa-trash"></i> Limpiar
                </a>
            </div>
        </div>
</div>
<br>
<br>
<!--<label>Delitos activos</label>-->
<a style="float: left; width: 20%; height: 50px; " type="button" class="btn btn-success" 
    href='/crimenes'>
        <p style="font-size: 20px;">
            <i class="fas fa-plus-circle"></i> <strong>Delitos Activos</strong>
        </p>
    </a>
<br><br><br>

<div style="float:right;">
    {{$descrimen->links()}}
</div>
<div style="font-size:18px;">
    <label>
        Mostrar
        <select id="mySelect" name="paginacion" onchange="this.form.submit()">
            <option style="display: none;">{{$num}}</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        delitos
    </label>
</div>
</form>


<?php $valor = 0; $un =0;?>

<?php $un = $crimen2?>

@foreach($descrimen as $dcri)
<?php $valor = $valor+1?>
@endforeach

@if($texto != null)
<label for="" class="col-form-label">Exiten {{$un}} coincidencias con la busqueda {{$texto}}:</label>
@endif

<table class="table table-bordered" id="data_table">
    <thead class="table-dark">
        <tr class="text-center">
            <th>Delito</th>
            <th>Restaurar</th>
        </tr>
    </thead>
    <tbody>
        @forelse($descrimen as $dcri)
        <!--Definimos un forelse para recuperar los valores de cada proveedor-->
        <tr>
            <!--recuperamos los datos en el orden de los campos para ser mostrados-->
            <td>{{$dcri->delito}}</td>

            <!--Definimos el boton de Editar-->
            <td>
                <a data-toggle="modal" data-target="#deletmodal-{{$dcri->id}}" class="btn btn-success"
                    style="width: 100%;color: #fff;">
                    <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Activar
                </a>

                <!-- Modal -->
                <div class="modal fade" id="deletmodal-{{$dcri->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #51bb51,#247919);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel"> Activar Delito</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Desea restaurar el delito {{$dcri->delito}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <form method="post" action="{{route('crimendesactivado.borrar',['id'=>$dcri->id])}}">

                                    @csrf
                                    @method('delete')
                                    <input type="submit" value="Activar" class="btn btn-success">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </td>

            </td>

        </tr>
        @empty
        <tr>
            <th colspan="5">No hay crimenes</th>
            <!--Si la tabla esta vacia mostramos el mensaje no hay productos-->
        </tr>
        @endforelse
        <!--fin del forelse-->
        </script>
    </tbody>
</table>

<div style="float:right;">
    {{$descrimen->links()}}
</div>

<p><strong>Se muestran {{$valor}} delitos de {{$un}}</strong></p>



@stop