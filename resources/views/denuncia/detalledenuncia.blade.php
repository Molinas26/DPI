@extends('madre')
@section('contenido')

@foreach($denuncia as $denuncias)
<br>
<h1 class="text-center font-italic font-weight-bold">UDIC-No.7</h1>

</br>
<h2 class="text-center text-bold"> Detalles sobre: {{$denuncias->codigo}} </h2>

<div class=" text-center">
</div>

<br>
<br>

<table class="table table-light table-hover table-success ml-2 target">
    <tbody>

        <tr style="text-align:center;font-size: 18px;">
            <th colspan="2"><strong> Generalidades de la Denuncia: <strong></th>
        </tr>

        <tr>
            <th scope="row">Código:</th>
            <td>{{$denuncias->codigo}}</td>
        </tr>

        <tr>
            <th scope="row">Fecha denuncia:</th>
            <td>{{date("d/m/Y", strtotime($denuncias->fecha_denuncia))}}</td>
        </tr>

        <tr>
            <?php $fecha_vencimiento = date("d/m/Y",strtotime($denuncias->fecha_denuncia."+ 30 days"));?>
            <th scope="row">Fecha vencimiento:</th>
            <td>{{$fecha_vencimiento}}</td>
        </tr>

        <tr>
            <th scope="row">Tomada por:</th>
            <td>{{$denuncias->tomador_denuncia}}</td>
        </tr>

        <tr style="text-align:center;font-size: 18px;">
            <th colspan="2"><strong> Delitos Asociados: <strong></th>
        </tr>

        <tr>
            @foreach($crimenes as $cri)
        <tr>
            <td colspan="2">{{$cri->delito}}</td>
        </tr>
        @endforeach
        </tr>


        <tr style="text-align:center;font-size: 18px;">
            <th colspan="2"><strong> Generalidades del Agente: <strong></th>
        </tr>
        <tr>
            <th scope="row">Placa:</th>
            <td>{{$denuncias->placa}}</td>
        </tr>

        <tr>
            <th scope="row">Nombre:</th>
            <td>{{$denuncias->nombres}} {{$denuncias->apellidos}}</td>
        </tr>

        <tr style="text-align:center;font-size: 18px;">
            <th colspan="2"><strong> Generalidades del Denunciante: <strong></th>
        </tr>

        <tr>
            <th scope="row">Nacionalidad:</th>
            <td>{{$denuncias->nacionalidad}}</td>
        </tr>

        <tr>
            <th scope="row">DNI/Pasaporte:</th>
            <td>{{$denuncias->dni}}</td>
        </tr>

        <tr>
            <th scope="row">Nombre:</th>
            <td>{{$denuncias->nombre}}</td>
        </tr>

        <tr>
            <th scope="row">Edad:</th>
            <td>{{$denuncias->edad}}</td>
        </tr>

        <tr>
            <th scope="row">Estado civil:</th>
            <td>{{$denuncias->estado_civil}}</td>
        </tr>

        <tr style="text-align:center;font-size: 18px;">
            <th colspan="2"><strong> Generalidades del Ofendido: <strong></th>
        </tr>

        <tr>
            <th scope="row">Nacionalidad:</th>
            <td>{{$denuncias->nacionalidad_ofendido}}</td>
        </tr>

        <tr>
            <th scope="row">DNI/Pasaporte:</th>
            <td>{{$denuncias->dni_ofendido}}</td>
        </tr>

        <tr>
            <th scope="row">Nombre:</th>
            <td>{{$denuncias->nombre_ofendido}}</td>
        </tr>

        <tr>
            <th scope="row">Teléfono:</th>
            <td>{{$denuncias->telefono_ofendido}}</td>
        </tr>

        <tr>
            <th scope="row">Departamento:</th>
            <td>{{$denuncias->depto_ofendido}}</td>
        </tr>

        <tr>
            <th scope="row">Municipio:</th>
            <td>{{$denuncias->municipio_ofendido}}</td>
        </tr>

        <tr>
            <th scope="row">Sector:</th>
            <td>{{$denuncias->sector_ofendido}}</td>
        </tr>
        <tr style="text-align:center;font-size: 18px;">
            <th colspan="2"><strong> Generalidades del Sospechoso: <strong></th>
        </tr>

        <tr>
            <th scope="row">Fecha inicio:</th>
            <td>{{$denuncias->fecha_inicio}}</td>
        </tr>

        <tr>
            <th scope="row">Caracteristicas:</th>
            <td>{{$denuncias->caracteristica}}</td>
        </tr>


        <tr>
            <th scope="row">Departamento:</th>
            <td>{{$denuncias->depto_sospechoso}}</td>
        </tr>

        <tr>
            <th scope="row">Municipio:</th>
            <td>{{$denuncias->municipio_sospechoso}}</td>
        </tr>

        <tr>
            <th scope="row">Sector:</th>
            <td>{{$denuncias->sector_sospechoso}}</td>
        </tr </tbody>
</table>
<br>
<a type="button" class="btn-primary btn-lg ml-2" href="javascript: history.go(-1)" style="text-decoration:none">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
        <path
            d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
    </svg>
    Regresar
</a>
<br><br>

@endforeach
@stop
