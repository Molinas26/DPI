  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@extends('madre')
  @section('contenido')



<br><br>
      <div  style="width: 100%;">
        <!-- Small boxes (Stat box) -->
        <div >
            <a href="crimenes" style="width: 22%;  float: left;text-decoration:none">
                <div >
                    <div class="small-box bg-info">
                    <div class="inner">
                        <br>
                        <h3>Delitos</h3>
                        <br>
                    </div>
                    <div class="icon">
                        <i class="ion ion-folder"></i>
                    </div>
                </div>
            </a>
          <!-- ./col -->
          <a href="agentes" style="width: 22%; margin-left: 4%; float: left;text-decoration:none">
            <div>
                <div class="small-box bg-success">
                <div class="inner">
                    <br>
                    <h3>Agente</h3>
                    <br>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
            </div>
        </a>
          <!-- ./col -->
          <a href="denuncias" style="width: 22%; margin-left: 4%; float: left; text-decoration:none">
            <div>
                <div class="small-box bg-warning">
                <div class="inner">
                    <br>
                    <h3 style="color: white;">Denuncias</h3>
                    <br>
                </div>
                <div class="icon">
                    <i class="fa fa-book"></i>
                </div>
            </div>
        </a>
          <!-- ./col -->
          <a href="remitir" style="width: 22%; margin-left: 4%; float: left; text-decoration:none">
            <div>
                <div class="small-box bg-primary">
                <div class="inner">

                    <h3>Informes</h3>
                    <h3>Remitidos</h3>

                </div>
                <div class="icon">
                    <i class="fas fa-balance-scale-right"></i>
                </div>
            </div>
        </a>
          <!-- ./col -->
        </div>

        <br><br>

        <div style="width: 49%;float: left;">
            <!-- LINE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Todos los delitos</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <!--Inicio de grafico-->
                  <script type="text/javascript" src="./charts/loader.js"></script>
                <script type="text/javascript">
                  google.charts.load("current", {packages:["corechart"]});
                  google.charts.setOnLoadCallback(drawChart);
                  function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                      ['Task', 'Hours per Day'],
                      ['Remitidas: {{$completadoA}}',{{$completadoA}}],
                      ['Retrasadas: {{$retrasadaA}}',{{$retrasadaA}}],
                      ['Pendientes: {{$pendienteA}}',{{$pendienteA}}],
                    ]);

                    var options = {
                      is3D: true,
                    };

                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                  }
                </script>
                <div id="piechart_3d" style="width: 450px; height: 250px; "></div>
                <!--Fin del grafico-->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

            <div style="width: 49%;float: left; margin-left: 2%;">
                <!-- LINE CHART -->
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Todos los agentes</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">

                  <script type="text/javascript">
                    google.charts.load("current", {packages:["corechart"]});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                      var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Remitidas: {{$completadoB}}',{{$completadoB}}],
                        ['Retrasadas: {{$retrasadaB}}',{{$retrasadaB}}],
                        ['Pendientes: {{$pendienteB}}',{{$pendienteB}}],
                      ]);

                      var options = {
                        pieHole: 0.4,
                      };

                      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                      chart.draw(data, options);
                    }
                  </script>
                      <div id="piechart" style="width: 450px; height: 250px; "></div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <div style="width: 49%;float: left; height: 250px;">
                <!-- LINE CHART -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Listado de los agentes activos</h3>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                      <table  class="table">
                        <thead>
                          <th>Placa</th>
                          <th>Nombre Completo</th>
                          <th>Telefono</th>
                        </thead>
                        <tbody>
                          @foreach($agentes as $agente)

                              <tr>
                                <td>{{$agente->placa}}</td>
                                <td>{{$agente->nombres}} {{$agente->apellidos}}</td>
                                <td>{{$agente->telefono}}</td>
                              </tr>

                          @endforeach
                        </tbody>
                      </table>
                  </div>
                  {{$agentes->links()}}
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

                <div style="width: 49%;float: left; margin-left: 2%;">
                    <!-- LINE CHART -->
                    <div class="card card-warning">
                      <div class="card-header">
                        <h3 class="card-title">Delitos por mes del año actual</h3>
                        <div class="card-tools">
                          <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                          </button>
                        </div>
                      </div>
                      <div class="card-body">
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
                              curveType: 'function',
                              legend: { position: 'bottom' }
                            };

                            var chart = new google.visualization.AreaChart(document.getElementById('curve_chart'));

                            chart.draw(data, options);
                          }
                        </script>

                        <center><div id="curve_chart" style=" width: 100%; height: 250px; "></div></center>
                      </div>
                    </div>
                </div>
@endsection
