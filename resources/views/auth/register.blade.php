@extends('madre')
  @section('contenido')
  <br>


  
  <h1><strong><center>Crear Nueva Cuenta</center></strong></h1>
<br>
    <form action="{{route('registrar.new')}}" method="post">
        {{ csrf_field() }}


        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">Nombre de usuario:</label>
            <input type="text" maxlength="100" id="name" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
            style="height: 40px;" required onkeydown="nameocultar()"
                   value="{{ old('name') }}" placeholder="Ingrese su nombre de usuario" autofocus>
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>

            <script>
                function nameocultar(){
                    var x = document.getElementById("errorname");
                    x.style.display = "none";
                    document.getElementById("name").className =document.getElementById("name").className.replace( /(?:^|\s)is-invalid(?!\S)/g , '' );
                }
            </script>

                @if($errors->has('name'))
                    <div class="invalid-feedback" id="errorname" style="margin-left: 31%;">
                        <strong>Nombre de usuario ya existe</strong>
                    </div>
                @endif
        </div>


        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">Placa:</label>
            <input type="number" name="placa" id="placa" class="form-control {{ $errors->has('placa') ? 'is-invalid' : '' }}" onkeydown="placaocular();"
                   value="{{ old('placa') }}" required placeholder="Ingrese el número de placa" autofocus maxlength="5" minlength="4" style="height: 40px;"
                   oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <div class="input-group-append"  style="margin-right: 20%;height: 40px;">
                <div class="input-group-text" >
                    <span class="fa fa-th-large"></span>
                </div>
            </div>

            <script>
                function placaocular(){
                    var x = document.getElementById("errorplaca");
                    x.style.display = "none";
                    document.getElementById("placa").className =document.getElementById("placa").className.replace( /(?:^|\s)is-invalid(?!\S)/g , '' )
                }
            </script>

            @if($errors->has('placa'))
            <div class="invalid-feedback" id="errorplaca" style="margin-left: 31%;">
                @if($errors->first('placa')=== 'validation.unique')
                    <strong>Valor en uso</strong>
                @else
                    <strong>Dato incorrecto debe de ser un numero de  4 a 5 digitos</strong>
                @endif
            </div>
            @endif
        </div>


        <div class="input-group mb-3">
        <label style="float: left; left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">Teléfono:</label>
          <input required style="float: left;width: 19%;" type="tel"  class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" name="telefono"
          id="telefono" maxlength="8"  value="{{ old('telefono') }}"  pattern="^[9|8|3|2]\d{7}$"
                 title="Ingrese un numero telefónico valido que inicie con 2,3,7,8 o 9 y que contenga 8 digitos"
                 placeholder="Ingrese su número de teléfono" onkeydown="telefonoocultar();"
          oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text">
                    <span class="fa fa-phone"></span>
                </div>
            </div>

            <script>
                function telefonoocultar(){
                    var x = document.getElementById("telefonoerror");
                    x.style.display = "none";
                    document.getElementById("telefono").className =document.getElementById("telefono").className.replace( /(?:^|\s)is-invalid(?!\S)/g , '' )
                }
            </script>

            @if($errors->has('telefono'))
            <div class="invalid-feedback" id="telefonoerror" style="margin-left: 31%;">
                @if($errors->first('telefono')=== 'validation.unique')
                    <strong>Valor en uso</strong>
                @else
                    <strong>Dato incorrecto debe de ser un teléfono válido</strong>
                @endif
            </div>
            @endif
        </div>


        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">Correo electrónico:</label>
            <input type="email" name="email" pattern="^[a-zA-Z0-9.!#$%&+/=?^_`{|}~]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" style="height: 40px;"
                   value="{{ old('email') }}" id="email" placeholder="Ingrese su correo electrónico" required
                   title="por favor ingrese un correo valido" onkeydown="correoocultar()">
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>

            <script>
                function correoocultar(){
                    var x = document.getElementById("errorcorreo");
                    x.style.display = "none";
                    document.getElementById("email").className =document.getElementById("email").className.replace( /(?:^|\s)is-invalid(?!\S)/g , '' )
                }
            </script>

            @if($errors->has('email'))
            <div class="invalid-feedback" id="errorcorreo" style="margin-left: 31%;">
                @if($errors->first('email')=== 'validation.unique')
                    <strong>Valor en uso</strong>
                @else
                    <strong>Dato incorrecto</strong>
                @endif
            </div>
            @endif

        </div>


        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">Contraseña:</label>
            <input  maxlength="100" type="password" name="password" required id="pass" onkeydown="passwordocultar()"
                   class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }} contraseña" style="height: 40px;"
                   placeholder="Ingrese su contraseña">
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text" >
                    <span class="fas fa-lock"></span>
                </div>
                <span id="confi"></span>
            </div>

            <script>
                function passwordocultar(){
                    var x = document.getElementById("passworderror");
                    x.style.display = "none";
                    document.getElementById("pass").className =document.getElementById("pass").className.replace( /(?:^|\s)is-invalid(?!\S)/g , '' )
                }
            </script>

            @if($errors->has('password'))
            <div class="invalid-feedback" id="passworderror" style="margin-left: 31%;">
                <strong>Contraseña no coincide</strong>
            </div>
            @endif
        </div>


        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">Confirmar Contraseña:</label>
            <input type="password" name="password_confirmation" required id="password_confirmation" onkeydown="confirmocultar()" onkeyup="coincide()"
                   class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }} contraseña" style="height: 40px;"
                   placeholder="{{ __('adminlte::adminlte.retype_password') }}">
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>

            <script>
                function coincide(){
                    var y = document.getElementById("confircoincide");
                    y.style.display = "none";

                    var c1 = document.getElementById("pass") .value; 
                    var c2 = document.getElementById("password_confirmation") .value;                  

                    if(c1 != c2){
                        y.style.display = "block";
                    }
                    
                }

                function confirmocultar(){
                    var x = document.getElementById("confirmerror");
                    x.style.display = "none";
                    document.getElementById("password_confirmation").className =document.getElementById("password_confirmation").className.replace( /(?:^|\s)is-invalid(?!\S)/g , '' )
                }
            </script>

            <div class="invalid-feedback" id="confircoincide" style="display: none; margin-left: 32%">
                <strong>Contrase no coinciden</strong>
            </div>

            @if($errors->has('password_confirmation'))
                <div class="invalid-feedback" id="confirmerror">
                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                </div>
            @endif
        </div>

            <div style="margin-top:2%; margin-left: 13%;">
            <input style="margin-left:20px;" type="checkbox" id="mostrar_contraseña"
                                        title="clic para mostrar contraseña" />
                                    &nbsp;&nbsp;<strong>Mostrar Contraseñas</strong>
        </div>
        

        <h4><center>Preguntas de Seguridad</center></h4>

        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">
            Nombre de su madre:</label>
            <input type="text" name="pregunta1" required value="{{old('pregunta1')}}"
                   class="form-control" style="height: 40px;" id="pregunta1" pattern="[A-Za-z\s]{1,15}"
                   title="por favor ingrese solo letras"
                   placeholder="Ingrese el nombre de su madre">
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>

        <div class="input-group mb-3">
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 18%;height: 40px;margin-left: 15%;" for="">
            Ciudad donde creció:</label>
            <input type="text" name="pregunta2" required value="{{old('pregunta2')}}"
                   class="form-control" style="height: 40px;" id="pregunta2" pattern="[A-Za-z\s]{1,15}"
                   title="por favor ingrese solo letras"
                   placeholder="Ingrese la ciudad donde creció">
            <div class="input-group-append" style="margin-right: 20%;height: 40px;">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>



        {{-- Register button --}}
        <button style="float: right;width: 32%; margin-right: 20%;" data-toggle="modal" data-target="#crearuser" class="btn btn-success"
        type="button">
            <span class="fas fa-user-plus"></span>
            Registrarse
        </button>

<!--Inicio modal-->
            <div class="modal" id="crearuser"tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header"style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                    <h5 class="modal-title">Registro de Usuario</h5>
                    <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>¿Desea registrar al nuevo usuario?</p>
                </div>
                <div class="modal-footer">
                <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">Guardar</button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Volver</button>
                </div>
                </div>
            </div>
            </div>
<!--final modal-->



        <a style="float: right;width: 32%; margin-right: 1%;" type="button" class="btn btn-danger" href="/home">
            <span class="fa fa-reply"></span>
            Inicio
        </a>

    </form>
    <script>

$('#pass').keyup(function(e) {
     var fuerte = new RegExp("^(?=.{10,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
     var medio = new RegExp("^(?=.{9,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
     var debil = new RegExp("(?=.{8,}).*", "g");
     if (false == debil.test($(this).val())) {
             $('#confi').html('Más caracteres.');
             
             
     } else if (fuerte.test($(this).val())) {
             $('#confi').className = 'ok';
             $('#confi').html('Fuerte! contraseña muy segura');
             $(function(){
        $('#confi').css('background', '#c3c3c1');
      })
     } else if (medio.test($(this).val())) {
             $('#confi').className = 'alert';
             $('#confi').html('Media! puede asegurar mas su contraseña');
             $(function(){
        $('#confi').css('background', 'yellow');
      })
     } else {
             $('#confi').className = 'error';
             $('#confi').html('débil! asegure mas su contraseña');
             $(function(){
        $('#confi').css('background', '#fe0000');
      })
     }
     return true;
});


//mostrar contraseña
$(document).ready(function() {
    $('#mostrar_contraseña').click(function() {
        if ($('#mostrar_contraseña').is(':checked')) {
            $('.contraseña').attr('type', 'text');
        } else {
            $('.contraseña').attr('type', 'password');
        }
    });
});
</script>
<br><br>
@stop