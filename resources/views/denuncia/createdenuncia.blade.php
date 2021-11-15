@extends('madre')
@section('contenido')
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
    <link href="{{ asset('css/bos.css') }}" rel="stylesheet">

    <script src="{{ asset('js/select2.min.js') }}"></script>

    <!--titulo de la pagina-->
    <h3 style="text-align: center;"><strong>Centro de Recepción de Denuncias</strong></h3>
    <h3 style="text-align: center;"><strong>Regional Local de Danlí</strong></h3>
    <h3 style="text-align: center;"><strong>Generales del Caso</strong></h3>
    <br>

    <?php
    $fecha = date("Y-m-d");
    ?>
    <?php $anio = date("Y");?>

    <!--Inicio de formulario con el metodo post-->
    <form method="post" action="">
    @csrf

    <!--Campo con el numero de denuncia-->
        <div class="form-group">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 10%;" for="ndenuncia">Denuncia
                N°:</label>
            <input style="float: left;width: 12%;" type="tex" min="0" class="form-control form-control-user"
                   name="codigo" id="codigo" maxlength="10" value="{{ old('codigo') }}" required
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>


        <!--Campo con la fecha de la denuncia-->
        <div class="form-group">
            <label style="float: left;margin-left: 2%;line-height: 220%;width: 18%;" for="fechareport">Fecha y hora del
                reporte:</label>
            <input style="float: left; width: 19%;" type="datetime-local" class="form-control form-control-user"
                   name="fechareport" id="fechareport" value="{{ old('fechareport') }}" max="{{$fecha}}T23:59:59"
                   min="2000-01-01T00:00:00" required>
        </div>

        <!--Campo seleccion de agentes-->
        <div class="form-group">
            <label style="float: left; margin-left: 2%;line-height: 220%;width: 14%;" for="agente">Seleccione
                agente:</label>
            <select style="float: left; width: 22%;height: 38px;" class=" " data-show-subtext="true" data-live-search="true"
                    name="agente" id="agente">
                <option style="display: none;" value="">Seleccione un agente</option>
                @foreach($agentes as $agente)
                    @if($agente->estado == 1 && $agente->vacaciones == 0)
                        <option value="{{$agente->id}}">
                            {{$agente->nombres}} {{$agente->apellidos}}
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Casos: {{$agente->delitos}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <br><br><br>
        <!--Campo con los delitos asociados-->
        <div class="form-group">
            <label style="float: left;line-height: 220%;width: 20%;" for="delasoc">Delitos asociados al caso:</label>
            <select onchange="prueba()" style="float: right;width: 79%;height:28px;margin-right: 2%;" id="selectcrimen"
                    class="mi-selector" data-show-subtext="true" data-live-search="true" multiple>
                @foreach($crimenes as $crimen)
                    <option value="{{$crimen->id}}">{{$crimen->delito}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="display: none;">
            <input type="text" id="delitos" name="delitos" class="form-control form-control-user">
        </div>


        <h4 style="text-align: center;"><strong>Denunciante</strong></h4>
        <div class="form-group">

            <!--Campo con la nacionalidad-->
            <div class="form-group">
                <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 10%;"
                       for="nacionalidad">Nacionalidad:</label>
                <select onchange="datden()" style="float: left;width: 11%; height: 38px;" class=" " name="nacionalidad"
                        id="nacionalidad">
                    @foreach($nacionalidad as $nac)
                        <option value="{{$nac->id}}">{{$nac->nacionalidad}}</option>
                    @endforeach
                </select>
            </div>

            <script>
                function datden() {
                    var dat = document.getElementById("nacionalidad").value;
                    if (dat == 2) {
                        document.getElementById("nac").innerHTML = "N° de pasaporte:";
                        document.getElementById("identidad_denunciante").setAttribute("minlength", "0");
                    } else {
                        document.getElementById("nac").innerHTML = "   N° de DNI:";
                        document.getElementById("identidad_denunciante").setAttribute("minlength", "0");
                        texto = document.getElementById("identidad_denunciante").value;
                        numeroCaracteres = texto.length;
                        if(numeroCaracteres>13){
                            document.getElementById("identidad_denunciante").value = "";
                        }
                    }
                }

                function guion1(){
                    var dat = document.getElementById("nacionalidad").value;
                    var caracter = document.getElementById("identidad_denunciante").value;
                    var cantidad = caracter.length;
                    if(dat == 1){
                        if(cantidad == 4 || cantidad == 9){
                            document.getElementById("identidad_denunciante").value = caracter+"-";
                        }else{

                        }
                    }
                }
            </script>

            <!--Campo con la identidad-->
            <div class="form-group" id="nacional">
                <label style="float: left; margin-left: 2%;line-height: 220%;width: 12%;" for="identidad" id="nac"> N° de
                    DNI:</label>
                <input required style="float: left;width: 19%;" type="text" class="form-control form-control-user"
                       name="identidad_denunciante" id="identidad_denunciante" maxlength="15"
                       required minlength="13" min="0" value="{{ old('identidad_denunciante') }}" onkeypress="guion1()">
            </div>

            <!--Campo con la edad-->
            <div class="form-group">
                <label style="float: left; margin-left: 2%;line-height: 220%;width: 4%;" for="edad">Edad:</label>
                <input require style="float: left;width: 7%;" type="number" class="form-control form-control-user"
                       name="edad" id="edad" maxlength="3" min="18" max="100"
                       oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                       value="{{ old('edad') }}" required>
            </div>

            <!--Campo con el estado civil-->
            <div class="form-group">
                <label style="float: left; margin-left: 2%;line-height: 220%;width: 9%;" for="estadocivil">Estado
                    civil:</label>
                <select style="float: right;width: 19%;height:30px;margin-right: 2%;" id="estadocivil" class=" "
                        data-show-subtext="true" data-live-search="true" name="estadocivil">
                    <option style="display: none;" value=" ">Seleccione el estado civil</option>
                    @foreach($civil as $civ)
                        <option value="{{$civ->id}}">{{$civ->civil}}</option>
                    @endforeach
                </select>
            </div>

            <!--Campo con el nombre-->
            <div class="form-group">
                <br><br><br>
                <input maxlength="100" require style="float: right;margin-right: 2%;line-height: 220%;width: 89%;"
                       type="text" class="form-control form-control-user" name="nombre_denunciante"
                       id="nombre_denunciante" value="{{ old('nombre_denunciante') }}"
                       pattern="[A-Za-z\s]{1,15}" title="por favor ingrese solo letras">
                <label style="margin-left: 0.5%;line-height: 220%;width: 8%;" for="nombre">Nombre :</label>
            </div>
        </div>



        <br>

        <h4 style="text-align: center;"><strong>Ofendido</strong></h4>
        <div class="form-group"></div>

        <!--Campo de IDEM-->
        <div class="form-group">
            <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 4%;" for="idem">IDEM </label>
            <input onclick="prueb()" style="float: left;" type="checkbox" name="idem" id="idem">
        </div>


        <script>
            function prueb() {
                var d = document.getElementById("idem").checked;
                var a = document.getElementById("nacionalidad").value;

                if (d == true) {
                    document.getElementById("nombre_ofendido").value = document.getElementById("nombre_denunciante").value;
                    document.getElementById("nombre_ofendido").setAttribute("readonly", true);

                    if (a == 2) {
                        $("#nacionalidad_ofendido option[value=2]").attr("selected", true);
                        datden2();
                    } else {
                        $("#nacionalidad_ofendido option[value=1]").attr("selected", true);
                        datden2();
                    }

                    document.getElementById("identidad_ofendido").value = document.getElementById("identidad_denunciante").value;
                    document.getElementById("identidad_ofendido").setAttribute("readonly", true);
                } else {
                    document.getElementById("identidad_ofendido").value = "";
                    document.getElementById("identidad_ofendido").removeAttribute("readonly");
                    document.getElementById("nombre_ofendido").value = "";
                    document.getElementById("nombre_ofendido").removeAttribute("readonly");
                    $("#nacionalidad_ofendido option[value=1]").attr("selected", true);
                    datden2();
                }

            }
        </script>

        <!--Campo con la nacionalidad-->
        <div class="form-group">
            <label style="float: left;margin-left: 5%;line-height: 220%;width: 10%;"
                   for="nacionalidad">Nacionalidad:</label>
            <select onchange="datden2()" style="float: left;width: 11%; height: 38px;" class=" "
                    name="nacionalidad_ofendido" id="nacionalidad_ofendido">
                @foreach($nacionalidad as $nac)
                    <option value="{{$nac->id}}">{{$nac->nacionalidad}}</option>
                @endforeach
            </select>
        </div>

        <script>
            function datden2() {
                var dat2 = document.getElementById("nacionalidad_ofendido").value;
                if (dat2 == 2) {
                    document.getElementById("nac2").innerHTML = "N° de pasaporte:";
                    document.getElementById("identidad_ofendido").setAttribute("minlength", "0");
                } else {
                    document.getElementById("nac2").innerHTML = "   N° de DNI:";
                    document.getElementById("identidad_ofendido").setAttribute("minlength", "0");
                    texto = document.getElementById("identidad_ofendido").value;
                    numeroCaracteres = texto.length;
                    if(numeroCaracteres>13){
                        document.getElementById("identidad_denunciante").value = "";
                    }
                }
            }

            function guion2(){
                var dat = document.getElementById("nacionalidad_ofendido").value;
                var caracter = document.getElementById("identidad_ofendido").value;
                var cantidad = caracter.length;
                if(dat == 1){
                    if(cantidad == 4 || cantidad == 9){
                        document.getElementById("identidad_ofendido").value = caracter+"-";
                    }else{

                    }
                }
            }
        </script>

        <!--Campo con la identidad-->
        <div class="form-group" id="nacional">
            <label style="float: left; margin-left: 2%;line-height: 220%;width: 12%;" for="identidad" id="nac2"> N° de
                DNI:</label>
            <input pattern="^[0-9-]+$" style="float: left;width: 22%;" type="text" class="form-control form-control-user"
                   name="identidad_ofendido" id="identidad_ofendido" maxlength="15"
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                   minlength="13" min="0" value="{{ old('identidad_ofendido') }}" required onkeypress="guion2()">
        </div>

        <!--Campo con el telefono-->
        <div class="form-group">
            <label style="float: left; margin-left: 2%;line-height: 220%;width: 8%;" for="telefono">Teléfono:</label>
            <input required style="float: left;width: 19%;" type="tel" class="form-control form-control-user"
                   name="telefono" id="telefono" maxlength="8" value="{{ old('telefono') }}" pattern="^[9|7|8|3|2]\d{7}$"
                   title="Ingrese un numero telefónico valido que inicie con 2,3,7,8 o 9"
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
        </div>

        <div class="form-group">
            <br><br><br>
            <input maxlength="100" required style="float: right;margin-right: 2%;line-height: 220%;width: 89%;" type="text"
                   class="form-control form-control-user" name="nombre_ofendido" id="nombre_ofendido"
                   value="{{ old('nombre_ofendido') }}">
            <label style="margin-left: 0.5%;line-height: 220%;width: 8%;" for="nombre" required>Nombre :</label>
        </div>
        <br>
        <h5>Dirección del ofendido</h5>
        <div class="form-group"></div>
        <!--Campo con el departamento-->
        <div class="form-group">
            <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 10%;height: 38px;"
                   for="departamento">Departamento:</label>
            <select onchange="cam()" style="float: left; width: 14%;margin-left: 1%;height: 38px;" class=" "
                    name="departamento_ofendido" id="departamento_ofendido">
                <option style="display: none;" value="7">El Paraíso</option>
                @foreach($departamento as $dep)
                    <option value="{{$dep->id}}">
                        {{$dep->nombredepartamento}}
                    </option>
                @endforeach
            </select>
        </div>

        <!--Funcion para municipios-->
        <script>
            function cam() {
                var select = document.getElementById("municipio_ofendido");
                var length = select.options.length;
                for (i = length - 1; i >= 0; i--) {
                    select.options[i] = null;
                }

                var sele = document.getElementById("departamento_ofendido").value;

                @foreach($municipio as $mun)
                if ({{$mun -> departamento}} == sele) {

                    var miSelect = document.getElementById("municipio_ofendido");

                    var miOption = document.createElement("option");

                    // Añadimos las propiedades value y label
                    miOption.setAttribute("value", "{{$mun->id}}");
                    miOption.setAttribute("label", "{{$mun->nombremunicipio}}");

                    // Añadimos el option al select
                    miSelect.appendChild(miOption);
                }
                /*
                 */
                @endforeach
            }
        </script>



        <!--Campo con el municipio-->
        <div class="form-group">
            <label style="float: left; margin-left: 1%;line-height: 220%;width: 7%;height: 38px;"
                   for="municipio">Municipio:</label>
            <select style="float: left; width: 17%;margin-left: 1%;height: 38px;" class=" " name="municipio_ofendido"
                    id="municipio_ofendido">
                <option value="93" style="display:none">Danlí</option>
                @foreach($municipio as $mun)
                    @if( $mun->departamento == 7)
                        <option value="{{$dep->id}}">
                            {{$mun->nombremunicipio}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!--Campo con el sector-->
        <div class="form-group">
            <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 5.5%;" for="sector">Sector:</label>
            <input maxlength="100" require style="float: left;width: 40%;" type="text"
                   class="form-control form-control-user" name="sector_ofendido" id="sector_ofendido"
                   value="{{ old('sector_ofendido') }}" required>
        </div>

        <br><br><br>
        <h4 style="text-align: center;"><strong>Sospechoso</strong></h4>
        <div class="form-group"></div>

        <!--Campo de Hora y fecha de incio-->
        <div class="form-group">
            <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 17%;" for="horainicio">Fecha y hora de
                inicio:</label>
            <input require style="float: left;width: 23%;" type="datetime-local" class="form-control form-control-user"
                   name="horainicio" id="horainicio" value="{{ old('horainicio') }}" required max="{{$fecha}}T23:59:59"
                   min="2000-01-01T00:00:00">
        </div>

        <!--Campo con la Caracteristicas del sospechoso-->
        <div class="form-group">
            <label style="float: left; margin-left: 5%;line-height: 220%;width: 12%;"
                   for="identidad3">Características:</label>

            <textarea style="float: left;width: 40%;" name="caracteristica" maxlength="255" id="caracteristica"
                      placeholder="Ingrese las características del sospechoso." type="text" cols="" rows="3"
                      class="form-control" >{{ old('caracteristica') }}</textarea>
        </div>
        <br><br><br><br>
        <h5>Dirección del sospechoso</h5>
        <div class="form-group"></div>
        <!--Campo con el departamento-->
        <div class="form-group">
            <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 10%;height: 38px;"
                   for="departamento">Departamento:</label>
            <select onchange="cam2();" style="float: left; width: 14%;margin-left: 1%;height: 38px;" class=" "
                    name="departamento_sospechoso" id="departamento_sospechoso">
                <option style="display: none;" value="7">El Paraíso</option>
                @foreach($departamento as $dep)
                    <option value="{{$dep->id}}">
                        {{$dep->nombredepartamento}}
                    </option>
                @endforeach
            </select>
        </div>

        <!--Funcion para municipios-->
        <script>
            function cam2() {
                var select = document.getElementById("municipio_sospechoso");
                var length = select.options.length;
                for (i = length - 1; i >= 0; i--) {
                    select.options[i] = null;
                }

                var sele = document.getElementById("departamento_sospechoso").value;

                @foreach($municipio as $mun)
                if ({{$mun->departamento}} == sele) {

                    var miSelect = document.getElementById("municipio_sospechoso");

                    var miOption = document.createElement("option");

                    // Añadimos las propiedades value y label
                    miOption.setAttribute("value", "{{$mun->id}}");
                    miOption.setAttribute("label", "{{$mun->nombremunicipio}}");

                    // Añadimos el option al select
                    miSelect.appendChild(miOption);
                }
                /*
                 */
                @endforeach
                
            }
        </script>


        <!--Campo con el municipio-->
        <div class="form-group">
            <label style="float: left; margin-left: 1%;line-height: 220%;width: 7%;height: 38px;"
                   for="municipio">Municipio:</label>
            <select style="float: left; width: 17%;margin-left: 1%;height: 38px;" class=" " name="municipio_sospechoso"
                    id="municipio_sospechoso">
                <option value="93" style="display:none">Danlí</option>
                @foreach($municipio as $mun)
                    @if( $mun->departamento == 7)
                        <option value="{{$dep->id}}">
                            {{$mun->nombremunicipio}}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <!--Campo con el sector-->
        <div class="form-group">
            <label maxlength="100" style="float: left;margin-left: 0.5%;line-height: 220%;width: 5.5%;"
                   for="sector">Sector:</label>
            <input require style="float: left;width: 40%;" type="text" class="form-control form-control-user"
                   name="sector_sospechoso" id="sector_sospechoso" value="{{ old('sector_sospechoso') }}" required>
        </div>

        <br><br><br><br>

        <!--Denuncia Tomada-->
        <div class="form-group">
            <label style="float: left;margin-left: 0.5%;line-height: 220%;width: 18%;" for="tomada">Denuncia tomada
                por:</label>
            <input maxlength="150" style="float: left;width: 80%;" type="text" class="form-control form-control-user"
                   name="tomada" id="tomada" value="{{ old('tomada') }}" required>
        </div>

        <?php
        setlocale(LC_ALL, 'es_ES');
        $anio = date("Y");
        $mes = date("m");
        $mes = DateTime::createFromFormat('!m', $mes);
        $mes = strftime('%B', $mes->getTimestamp());
        $dia = date("d");
        ?>


        <br><br>


        <!--Boton Guardar-->
        <button type="button" class="btn btn-success" id="save" data-toggle="modal" data-target="#crearden">
            Guardar
        </button>

        <div class="modal" id="crearden" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header"
                         style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                        <h5 class="modal-title">Registro de Denuncia</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="btn-border btn-outline-danger btn-lg">X</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Desea registrar la denuncia?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Guardar</button>

                        <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
                    </div>
                </div>
            </div>
        </div>

        <button type="reset" class="btn btn-warning">
            Limpiar
        </button>

        <a type="button" class="btn btn-danger" href="javascript: history.go(-1)">
            Volver
        </a>

    </form>





    <script>
        jQuery(document).ready(function($) {
            $(document).ready(function() {
                $('.mi-selector').select2();
            });
        });

        //De esta manera retornamos un arreglo con los campos seleccionados en crimenes//

        function prueba() {
            var select = $('#selectcrimen').val();

            document.getElementById('delitos').value = select;

        }
    </script>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>

    <br>

@stop
