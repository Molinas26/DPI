@extends('madre')
@section('contenido')



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

    @keyframes pulse-animation {
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
<br>


<h1>
    <Center>Reasignar Denuncias</Center>
</h1>

<br><br>
<form method="post" action="{{route('cambio.update',['id'=>$idagente])}}">
    @csrf

    <div style="float: left; width: 100%;">
        <div style="float: left; width: 60%;">
            <label for="" style="float: left; width: 50%;line-height: 220%">Agente a reasignar denuncias seleccionadas:
            </label>
            <select style="float: left; height: 40px;width: 50%;" id="cambio_agente" name="cambio_agente">
                <option value=" ">Seleccione un agente</option>
                @foreach($agentes as $agente)
                @if($agente->estado == 1 && $agente->vacaciones == 0)
                @if($agente->id != $idagente)
                <option value="{{$agente->id}}">
                    {{$agente->nombres}} {{$agente->apellidos}}
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    Casos: {{$agente->delitos}}
                </option>
                @endif
                @endif
                @endforeach
            </select>
        </div>

        <div style="float: right; width: 40%;">

            <button style="float: right; margin-right: 2%; width: 45%;" class="btn btn-success">
                <i class="fa fa-file" aria-hidden="true"></i>
                &nbsp;&nbsp;Guardar
            </button>


            <a style="float: right; margin-right: 2%; width: 45%;" href="agentes" type="button" class="btn btn-danger">
                <i class="fa fa-reply" aria-hidden="true"></i>
                &nbsp;&nbsp;Regresar</a>

        </div>
    </div>

    <br><br>
    <!--Boton para Seleccionar todo-->
    <input class="chk-all-seleccion" data-toggle="toggle"
           data-on="Cambiar" data-off="No cambiar" data-onstyle="success" data-offstyle="danger"
           type="checkbox" />
    <label>Seleccionar todos:</label>

    <br><br>

    <table class="table table-bordered mytableAgentes table-striped" id="data_table">
        <thead class="table-dark">
            <tr class="text-center">
                <th style="width: 15%;">Seleccionar</th>
                <th style="width: 15%;">Codigo</th>
                <th style="width: 15%;">Fecha denuncia</th>
                <th style="width: 25%;">Dias faltantes</th>
                <th style="width: 30%;">Progreso</th>
            </tr>
        </thead>
        <tbody>
            @forelse($denuncias as $den)
            <tr class="tr-interesado">

                <td class="td-asistencia">

                    <input class="chk-asistencia switch switch--circle"
                           type="checkbox" name="{{$den->codigo}}">
                </td>

                <td>{{$den->codigo}}</td>
                <td>{{date("d/m/Y", strtotime($den->fecha_denuncia))}}</td>
                <td>
                    @if($den->dias_faltantes == null)
                    <p class="men alert alert-secondary" style="height: 40px;">De vacaciones</p>
                    @else
                    @if($den->dias_faltantes < 0) <p class="men  alert alert-danger" style="height: 40px;">Días de
                        retraso: {{$den->dias_faltantes * -1}} </p>
                        @else
                        @if($den->dias_faltantes < 5) <p class="men  alert alert-warning" style="height: 40px;">Días
                            faltantes: {{$den->dias_faltantes}} </p>
                            @else
                            <p class="men  alert alert-primary" style="height: 40px;">Días faltantes:
                                {{$den->dias_faltantes}}</p>
                            @endif
                            @endif
                            @endif
                </td>
                <td>

                    <?php
            $prog = number_format(($den->resultado),2);
            ?>
                    @if($prog < 34) <?php $s = "bg-danger"?> @elseif(($prog < 67)) <?php $s = "bg-warning"?> @else
                        <?php $s = "bg-success"?> @endif <div class="progress" style="height: 30px;">
                        <div id="{{$den->codigo}}" class="progress-bar {{$s}} progress-bar-striped active"
                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                            style="width: 0%;">
                            <strong style="color: black;">{{$prog}}%</strong>
                        </div>
                        </div>
                </td>
            </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</form>
<!--Conteo de cuantos datos se muestra-->

@foreach($denuncias as $den)
<script>
        var progreso{{$den->codigo}} = 0;
        var progreso{{$den->codigo}} = ({{$den->resultado}});
        var idIterval = setInterval(function(){

            $('#{{$den->codigo}}').css('width', progreso{{$den->codigo}} + '%');

            //Si llegó a 100 elimino el interval
            if(progreso == 100){
                clearInterval(idIterval);
            }
        },1000);
</script>

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
@endforeach

<link href="{{asset('css/bootstrap-toggle.min.css')}}" rel="stylesheet" />
<script src="{{asset('js/bootstrap-toggle.min.js')}}"></script>

@stop
