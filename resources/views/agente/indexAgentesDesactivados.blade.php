@extends('madre')
@section('contenido')
@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif

<br>

<h2 class="azul" style="text-align: center;"><strong>Agentes Desactivados</strong></h2>
<br>

<div>
    <form action="{{route('agentedesactivado.indice')}}" method="GET">
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

                <a style="width: 48%;" type="button" href='agentesdesactivado' class="btn btn-danger">
                <i class="fas fa-trash"></i> Limpiar
                </a>
            </div>
        </div>

</div>
<br>
<br>
<br>
<div class="form-inline">

<!--<label for="">Agentes activos</label>-->
<a style="float: left; width: 20%; height: 50px;" type="button" class="btn btn-success" href='/agentes'>
        <p style="font-size: 20px;">
            <i class="fas fa-users"></i> <strong>Agentes Activos</strong>
        </p>
    </a>
</div>
<br>
<a type="submit" class=" border btn btn-outline-dark  btn-lg ml-2" href='#' id="moareas">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stack"
        viewBox="0 0 16 16">
        <path
            d="m14.12 10.163 1.715.858c.22.11.22.424 0 .534L8.267 15.34a.598.598 0 0 1-.534 0L.165 11.555a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.66zM7.733.063a.598.598 0 0 1 .534 0l7.568 3.784a.3.3 0 0 1 0 .535L8.267 8.165a.598.598 0 0 1-.534 0L.165 4.382a.299.299 0 0 1 0-.535L7.733.063z" />
        <path
            d="m14.12 6.576 1.715.858c.22.11.22.424 0 .534l-7.568 3.784a.598.598 0 0 1-.534 0L.165 7.968a.299.299 0 0 1 0-.534l1.716-.858 5.317 2.659c.505.252 1.1.252 1.604 0l5.317-2.659z" />
    </svg>
    Principal
</a>
<a type="button" href="/Cagentes" id="Comunes" class="btn btn-dark areas">Delitos Comunes</a>
<a type="button" href="/Pagentes" id="Propiedad" class="btn btn-dark areas">Delitos Contra la Propiedad</a>
<a type="button" href="/Vagentes" id="Vida" class="btn btn-dark areas">Delitos Contra la Vida</a>
<div style="float:right;">
    {{$ageDes->links()}}
</div>
<div style="font-size:18px; float: right; margin-right: 2%;">
    <label>
        Mostrar
        <select id="mySelect" name="paginacion" onchange="this.form.submit()">
            <option style="display: none;">{{$num}}</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        Agentes
    </label>
</div>
</form>
<br><br>


<?php $valor = 0; $un =0;?>

<?php $un = $ageDes2?>

@foreach($ageDes as $ades)
<?php $valor = $valor+1?>
@endforeach

@if($texto != null)
<label for="" class="col-form-label">Exiten {{$un}} coincidencias con la busqueda {{$texto}}:</label>
@endif

<table class="table table-bordered mytableAgentedes " id="data_table">
    <thead class="table-dark">
        <tr class="text-center">
            <th>Placa</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Rango</th>
            <th>Detalle</th>
            <th>Restaurar</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
        @forelse($ageDes as $ades)
        <!--Definimos un forelse para recuperar los valores de cada proveedor-->
        <tr>
            <!--recuperamos los datos en el orden de los campos para ser mostrados-->
            <td>{{$ades->placa}}</td>
            <td>{{$ades->nombres}}</td>
            <td>{{$ades->apellidos}}</td>
            <td>{{$ades->rangos}}</td>
            <td>
                <a class="btn btn-warning" style="width: 100%;"
                    href="{{route('agentedesactivado.show',['id'=>$ades->id])}}">
                    <i class="fa fa-info" aria-hidden="true"></i>&nbsp;&nbsp;Detalles
                </a>
            </td>

            <!--Definimos el boton de Activar-->
            <td>
                <a class="btn btn-success" style="width: 100%;color: #fff;" data-toggle="modal"
                    data-target="#deletmodal-{{$ades->id}}">
                    <i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;Activar
                </a>

                <!-- Modal -->
                <div class="modal fade" id="deletmodal-{{$ades->id}}" data-keyboard="false" data-backdrop="static"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header"
                                style="background-image: linear-gradient(to left,  #51bb51,#247919);color:white;">
                                <h5 class="modal-title" id="exampleModalLabel"><svg width="1em" height="1em"
                                        viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
                                    </svg> Activar Agente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span class="btn-border btn-outline-danger btn-lg">X</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Desea restaurar el agente {{$ades->nombres}} {{$ades->apellidos}}?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> <svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                                    </svg> Cerrar</button>
                                <form method="post" action="{{route('agentedesactivado.borrar',['id'=>$ades->id])}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" value="Activar" class="btn btn-success"> <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                                            <path
                                                d="M13.485 1.431a1.473 1.473 0 0 1 2.104 2.062l-7.84 9.801a1.473 1.473 0 0 1-2.12.04L.431 8.138a1.473 1.473 0 0 1 2.084-2.083l4.111 4.112 6.82-8.69a.486.486 0 0 1 .04-.045z" />
                                        </svg> Activar</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </td>
            </td>
            <td>
                <h6 class="text-center text-danger font-italic font-weight-bold">Deshabilitado</h6>
            </td>
        </tr>
        @empty
        <tr>
            <th colspan="5">¡No hay agentes!</th>
            <!--Si la tabla esta vacia mostramos el mensaje no hay productos-->
        </tr>
        @endforelse
        <!--fin del forelse-->
        </script>
    </tbody>
</table>

<p><strong>Se muestran {{$valor}} Agentes de {{$un}}</strong></p>
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

$(document).ready(function() {
    $("#search").keyup(function() {
        _this = this;
        $.each($(".mytableAgentedes tbody tr"), function() {
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
</script>
@stop