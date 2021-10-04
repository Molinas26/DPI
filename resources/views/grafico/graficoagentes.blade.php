@extends('madre')
@section('contenido')

<br>
<html>

<head>
<link href="{{ asset('css/bos.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/animated.js') }}"></script>
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>
    <script type="text/javascript" src="./charts/loader.js"></script>


    <script type="text/javascript">
    google.charts.load("current", {
        packages: ["corechart"]
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Remitidas: {{$completado}}', {{$completado}}],
            ['Retrasadas: {{$retrasada}}', {{$retrasada}}],
            ['Pendientes: {{$pendiente}}', {{$pendiente}}],
        ]);

        var options = {
            pieHole: 0.4,
            backgroundColor: '#f5f6fa',
            height: '500px',
            width: '900px'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
    }
    </script>
</head>

<body>
    <br>
    <h1>
        <center><strong>GRÁFICO DE AGENTES: </strong>{{$mostrar}}</center>
    </h1>
    <!--Campo con los delitos asociados-->
    <div class="form-group">
        <form action="graficosagentes" method="GET">
            <label style="float: left;line-height: 25px;width: 7%;margin-left: 3%;" for="agentes">Agente:</label>
            <select style="float: right;width: 86%;margin-right: 2%;" id="selectcrimen" name="selectagente"
                class="mi-selector" data-show-subtext="true" data-live-search="true" onchange="this.form.submit()">
                <option value="{{$valor}}" style="display:none">{{$mostrar}}</option>
                @foreach($agentes as $agente)
                @if($agente->estado === 1)
                <option value="{{$agente->id}}">{{$agente->nombres}} {{$agente->apellidos}}: Activos</option>
                @endif
                @endforeach
                @foreach($agentes as $agente)
                @if($agente->estado === 0)
                <option value="{{$agente->id}}">{{$agente->nombres}} {{$agente->apellidos}}: Inactivos</option>
                @endif
                @endforeach
                <option value=" ">TODOS</option>
            </select>
    </div>

    <script>
    jQuery(document).ready(function($) {
        $(document).ready(function() {
            $('.mi-selector').select2();
        });
    });
    </script>

    <br><br>

    <div style="float: right;width: 25%; margin-right: 2%;">
        <h4>
            <center>Fecha Inicio</center>
        </h4><br>
        <label for="">Mes: </label>
        <select id="selectmesinicio" name="selectmesinicio" onchange="this.form.submit()">
            <option value="{{$mi}}" style="display: none;">{{$mesa}}</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
        &nbsp&nbsp&nbsp
        <label for="">año: </label>
        <select id="selectanioinicio" name="selectanioinicio" onchange="this.form.submit()">
            <option value="{{$ai}}" style="display: none;">{{$ai}}</option>
            <?php $min= $amin?>
            @while($min <= $amax) <option value="{{$min}}">{{$min}}</option>
                <?php $min++?>
                @endwhile
        </select>


        <br><br><br>
        <h4>
            <center>Fecha Final</center>
        </h4><br>
        <label for="">Mes: </label>
        <select id="selectmesfinal" name="selectmesfinal" onchange="this.form.submit()">
            <option value="{{$mf}}" style="display: none;">{{$mesf}}</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
        </select>
        &nbsp&nbsp&nbsp
        <label for="">año: </label>
        <select id="selectaniofinal" name="selectaniofinal" onchange="this.form.submit()">
            <option value="{{$af}}" style="display: none;">{{$af}}</option>
            <?php $max= $ai?>
            @while($max <= $amax) <option value="{{$max}}">{{$max}}</option>
                <?php $max++?>
                @endwhile
        </select>
        </form>
    </div>
    <div ng-controller="Controller" style="float: right; width: 73%;height: 400px;">
        <div id="piechart_3d" style="width: 100%; height: 100%; "></div>
    </div>

</body>

</html>
@endsection
