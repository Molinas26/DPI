@extends('madre')
  @section('contenido')

  <script src="{{ asset('js/graf.js') }}"></script>



<br>
<html>
<head>
    <script type="text/javascript" src="./charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Month', 'Denuncias'],
          ['Enero',  {{$meses[1]}}],
          ['Febrero',  {{$meses[2]}}],
          ['Marzo',  {{$meses[3]}}],
          ['Abril',  {{$meses[4]}}],
          ['Mayo',  {{$meses[5]}}],
          ['Junio',  {{$meses[6]}}],
          ['Julio',  {{$meses[7]}}],
          ['Agosto',  {{$meses[8]}}],
          ['Septiembre',  {{$meses[9]}}],
          ['Octubre',  {{$meses[10]}}],
          ['Noviembre', {{$meses[11]}}],
          ['Diciembre',  {{$meses[12]}}],
        ]);

        var options = {
          backgroundColor: '#f5f6fa',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
</head>
<body >
  <h1><center><strong>Información gráfica de denuncias según el mes </strong>{{$mostrar}}</center></h1>
<br>
      <form action="graficosdenuncias" method="GET">
      <div>
        <label for="">Seleccione el año a mostrar: </label>
        <select id="selectanioinicio" name="selectanioinicio" onchange="this.form.submit()">
          <option value="{{$ai}}" style="display: none;">{{$ai}}</option>
          <?php $min= $amin?>
          @while($min <= $amax)
            <option value="{{$min}}">{{$min}}</option>
            <?php $min++?>
          @endwhile
        </select>
    </form>
    </div>


    <center><div id="curve_chart" style=" width: 100%; height: 400px; "></div></center>


</body>
</html>
@endsection
