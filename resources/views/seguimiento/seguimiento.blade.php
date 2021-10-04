@extends('madre')
  @section('contenido')


      <br>

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

        <style>

            /*SWITCH*/
            :root {
                --color-title: #C8553D;
                --color-off: #dc3545;
                --color-on: #28a745;
                --color-gray: #EDEDED;
                --color-hover: #fff;
                --transition-time: 0.4s;
                --scale-size: scale(1.1);
                --switch-width: 60px;
                --switch-height: 25px;
            }

            .switch {
                -webkit-appearance: none;
                display: block;
                position: relative;
                width: var(--switch-width);
                height: var(--switch-height);
                background: var(--color-off);
                box-shadow: inset 0 0 5px rgba(0,0,0,.2);
                outline: none;
                transition: var(--transition-time);
                cursor: pointer;
            }

            .switch:before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: calc(var(--switch-width)/2);
                height: var(--switch-height);
                transform: var(--scale-size);
                box-shadow: 0 2px 15px rgba(0,0,0,.2);
                background: var(--color-gray);
                transition: var(--transition-time);
            }

            .switch:checked {
                background: var(--color-on);
            }

            .switch:hover:before {
                background: var(--color-hover);
                transition: var(--transition-time);
            }

            .switch:checked:before {
                left: 50%;
            }

            .switch--circle {
                border-radius: 50px;
            }

            .switch--circle:before {
                border-radius: 50%;
            }

            @@keyframes pulse-animation {
                 100% {
                     transform: scale(1.2);
                 }
             }

            /*CONTENEDOR*/
            .container {
                max-width: 1300px;
            }

            /*TABLA*/
            label {
                margin-bottom: 0;
            }

            .th-asistencia {
                width: 20%;
            }

            .td-asistencia {
                display: flex;
                justify-content: space-evenly;
            }

            .asistencia_Inter {
                display: none;
            }

            .td-seleccion {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 50px;
            }
        </style>



<h1 class="text-center font-italic font-weight-bold">Seguimiento de la Denuncia</h1>

@if($den == 'A')
<div class="alert alert-primary" role="alert">
<div class=" text-danger">
<h6 class="text-center font-italic font-weight-bold">Una vez guardada la denuncia puede proceder a chequear <br>
 las tareas
ya relizadas, caso contrario guarde el seguimiento <br> con  el botón ubicado en la parte superior derecha de la tabla. </h6>
</div>
</div>
@endif
@if($den == 'B')
<div class="alert alert-primary" role="alert">
<div class=" text-danger">
<h6 class="text-center font-italic font-weight-bold">Esta sección esta diseñada para poder chequear todas <br>
 las tareas
relizadas, caso contrario guarde el seguimiento <br> en  el botón en la parte superior derecha de la tabla. </h6>
</div>
</div>
@endif

<br><br>

    <div class="form-group">

    <script>
        //funcion para agregar la opcion de nueva tarea y oculta el boton
        function newtare(){
            document.getElementById("revelar").style.display = 'inline';
            document.getElementById("agg").style.display = 'none';
        }

        //funcion para ocultar la opcion de nueva tarea y agregar el boton
        function cantare(){
            document.getElementById("agg").style.display = 'inline';
            document.getElementById("revelar").style.display = 'none';
        }
    </script>

    <!--Seccion para agregar nueva tarea el cual siempre esta oculto-->
    <div style="display: none;" id="revelar">
        <form method="post" action="{{route('seguimiento.store',['id'=> $id, 'den'=> $den])}}">
            @csrf
            <input required type="text" class="form-control form-control-user" maxlength="150" style="width: 74%; float: left;"
            name="segui" id="segui" placeholder="Ingrese la tarea">

            <button class="btn btn-success" style="width: 12%; margin-left: 1.5%;">
            <i class="fas fa-save"></i> Guardar
            </button>

            <button onclick="cantare()" class="btn btn-danger" style="width: 12%;">
            <i class="fas fa-times-circle"></i> Cancelar
            </button>

        </form>
        <br>
    </div>
<br>

    <button onclick="newtare()" id="agg"  style="float: left;height: 40px; width: 14%;"" class="btn btn-success">
        <i class="fas fa-plus-circle"></i> Nueva Tarea
    </button>


      <form method="post" action="{{route('seguimiento.update',['id'=> $id, 'den'=> $den])}}">
        @csrf
        @method('put')


    <button type="button" data-toggle="modal" data-target="#crearseg" style="float: right;height: 40px; width: 14%;"" class="btn btn-info">
        <i class="fas fa-save"></i> Guardar
    </button>


@if($den == 'B')
    <a class="btn-primary btn-lg ml-2" href="javascript: history.go(-1)"
    style="text-align: center; float: right;margin-right: 7%; height: 40px; width: 14%; text-decoration: none;">
        <p style="line-height: 15px;">
            <i class="fas fa-undo-alt"></i> Regresar
        </p>
    </a>


    <select style="float: right;margin-right: 7%;height: 40px;width: 25%;" id="cambio_agente" name="cambio_agente">
        @foreach($asignado as $asig)
            <option value="{{$asig->id}}" style="display: none;">{{$asig->nombres}} {{$asig->apellidos}}</option>
        @endforeach
        @foreach($agentes as $agente)
        @if($agente->estado == 1 && $agente->vacaciones == 0)
        <option value="{{$agente->id}}">
            {{$agente->nombres}} {{$agente->apellidos}}
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Casos: {{$agente->delitos}}
        </option>
        @endif
      @endforeach
    </select>

      <label for="" style="float: right;margin-right: 2%;height: 40px;line-height: 35px;">Agente Asignado:</label>
@endif

        <!--Inicio de Modal-->

        <div class="modal" id="crearseg"tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header"style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                    <h5 class="modal-title">Registro de Seguimiento de la denuncia</h5>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea guardar el seguimiento?</p>
                </div>
                <div class="modal-footer">
                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Guardar</button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
                </div>
                </div>
            </div>
          </div>

          <!--Final de Modal-->

        <br><br>

      <!--Boton para Seleccionar todoo-->
          <label style="alignment: right">Seleccionar todos:</label>
      <input class="chk-all-seleccion" data-toggle="toggle" style="alignment: right"
             data-on="Cambiar" data-off="No cambiar" data-onstyle="success" data-offstyle="danger"
             type="checkbox" />


      <br><br>


     <!--Definimos la creacion de la tabla donde se veran los proveedores-->
    <table id="mytable5" class="table table-bordered table-light" id="b">

    <!--utilizamos un estilo personalizado mediante css para darle realse a la tabla-->
    <style>

   #b{
       border-collapse:separate;
       border: solid #ccc 1px;
       border-radius: 25px;
     }


   th{
       text-align: center;
   }
    </style>
    <!--fin del estilo-->

     <br>
        <thead class="table-dark">
        <!--Definimos los campos de la tabla-->
        <tr>
            <th scope="col">Tarea</th>
            <th scope="col">Realizar</th>
            <th scope="col">Borrar</th>

            <!--Los campos han sido definidos-->
        </tr>
        </thead>
        <tbody>
        @forelse($seguimiento as $segui)<!--Definimos un forelse para recuperar los valores de cada proveedor-->
            <tr>
            <!--recuperamos los datos en el orden de los campos para ser mostrados-->
                <td>{{$segui->tarea}}</td>

                    <td style="text-align: center" class="td-asistencia">


                        @if($segui->estado === 1)
                            <input class="chk-asistencia switch switch--circle"
                                   type="checkbox" name="{{$segui->id}}" checked>

                        @else
                            <input class="chk-asistencia switch switch--circle"
                                   type="checkbox" name="{{$segui->id}}">
                        @endif






                </td>

            </form>
                    <td style="text-align: center">
                    @if($segui->estado === 0)
                        <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletmodal-{{$segui->id}}">
                            <strong style="color: white;"><i class="far fa-trash-alt"></i> Eliminar</strong>
                        </a>
                    @endif

                    <!--Inicio modal-->
                    <div class="modal fade" id="deletmodal-{{$segui->id}}"  data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header" style="background-image: linear-gradient(to left,  #e46c5e,#c53c38);color:white;">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                        Eliminar Tarea
                                    </h5>
                                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    ¿Desea realmente eliminar la tarea {{$segui->tarea}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <form method="post" action="{{route('seguimiento.borrar',['den'=>$den, 'i'=>$segui->id, 'id'=>$id])}}">
                                        @csrf
                                        @method('delete')
                                        <input type="submit" value="Eliminar" class="btn btn-danger">
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!---Final modal-->
                    </td>
            </tr>
        @empty
            <tr>
                <th scope="row">No hay Datos</th><!--Si la tabla esta vacia mostramos el mensaje no hay productos-->
            </tr>
        @endforelse<!--fin del forelse-->
        </script>
        </tbody>
    </table>

    <link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet"/>
    <script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>
        <script>
            /*SELECCIONAR Y DESELECIONAR CADA CHECKBOX*/
            $(document).on('change', '.chk-seleccion', function () {

                if ($(this).is(':checked')) {
                    $(this).parent().parent().css("background","#FFE0B2");
                }
                else {
                    $(this).parent().parent().css("background", "");
                }
            });

            /*SELECCIONAR Y DESELECIONAR TODOS LOS CHECKBOXES*/
            $(".chk-all-seleccion").on("change", function () {
                if ($(this).is(":checked")) {
                    $(".chk-asistencia").each(function (index, element) {
                        $(element).prop("checked", true);
                        if ($(element).is(':checked')) {
                            $(element).parent().parent().css("background", "#FFE0B2");
                        }
                    });
                }
                else {
                    $(".chk-asistencia").each(function (index, element) {
                        $(element).prop("checked", false);
                        $(element).parent().parent().css("background", "");
                    });
                }
            });
        </script>


        @stop
