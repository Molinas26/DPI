<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>DPI</title>
        

    <link href="{{ asset('css/bos.css') }}" rel="stylesheet">
    <script src="{{ asset('js/query.js') }}"></script>

</head>

<body>

    <div style="position: absolute; height: 100%; width: 100%;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-evenly;background-image: url('./img/fond.png');
                        background-repeat: no-repeat;
                        background-attachment: fixed;
                        background-size: cover;"
        id="div2">

        <div style="margin-left: 45%;width: 30%; height: 100%;position: absolute;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-evenly;">
            <button style="width: 50%;" class="btn btn-warning" id="moareas">Iniciar Sesión</button>
        </div>


    </div>



    <div class="areas" display: flex; style="width: 30%; height: 100%;position: absolute;
                        background:linear-gradient(20deg, rgb(21, 32, 192), rgb(65, 206, 225),
                        rgb(70, 0, 128));
                        display: flex;
                        flex-direction: column;
                        justify-content: space-evenly;">


        @php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
        @php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )
        @php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url',
        'password/reset') )

        @if (config('adminlte.use_route_url', false))
        @php( $login_url = $login_url ? route($login_url) : '' )
        @php( $register_url = $register_url ? route($register_url) : '' )
        @php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
        @else
        @php( $login_url = $login_url ? url($login_url) : '' )
        @php( $register_url = $register_url ? url($register_url) : '' )
        @php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
        @endif

        @section('auth_header', __('adminlte::adminlte.login_message'))

        @section('auth_body')
        <h2>
            <center>Inicio de Sesión</center>
        </h2>
        <h3>
            <center>UDIC N°. 7 </center>
        </h3>


        <center><img src="./img/DPI.gif" alt="Logo.png" width="160px" height="160px"></center>



        <form action="{{ $login_url }}" method="post">
            {{ csrf_field() }}

            {{-- Email field --}}
            <center><label for="" class="col-form-label" style="font-size: 20px;">Correo electrónico:</label></center>
            <div class="input-group mb-3" style="margin-left: 10%;margin-right: 10%;width: 80%;">
                <input pattern="^[a-zA-Z0-9.!#$%&+/=?^_`{|}~]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$" type="email"
                    name="email" class="form-control form-control-user {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    value="{{ old('email') }}" placeholder="Ingrese su correo electrónico" autofocus autocomplete="off">
                @if($errors->has('email'))
                <div class="invalid-feedback">
                    <strong>Correo incorrecto</strong>
                </div>
                @endif
            </div>

            {{-- Password field --}}
            <center><label for="" class="col-form-label" style="font-size: 20px;">Contraseña:</label></center>
            <div class="input-group mb-3">
                <input type="password" id="contraseña" maxlength="100" name="password"
                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    placeholder="Ingrese su contraseña" autocomplete="off"
                    style="margin-left: 10%;margin-right: 10%;width: 80%;">
                @if($errors->has('password'))
                <div class="invalid-feedback" style="margin-left: 10%;">
                    <strong>Contraseña incorrecta</strong>
                </div>
                @endif
                <div style="margin-top:5%; margin-left: 5%;">
                    <input style="margin-left:20px;" type="checkbox" id="mostrar_contraseña"
                        title="clic para mostrar contraseña" />
                    &nbsp;&nbsp;<strong>Mostrar Contraseña</strong>
                </div>
                <br><br>
                <a href="recuperar1" style="margin-left: 10%;">
                    <strong>¿Olvidaste tu contraseña?</strong></a>
            </div>

            <style>
            a {
                color: #000000;
            }

            a:hover {
                color: rgb(255, 255, 255);
            }
            </style>

            <br>
            {{-- Login field --}}
            <div class="row">
                <div style="width: 96%;margin-left: 2%;">
                    <button style="border-radius: 30%; width: 40%; margin-left: 30%; " type=submit
                        class="btn btn-outline-warning" style="margin-left: 10%;margin-right: 10%;width: 80%;">
                        <span class="fas fa-sign-in-alt"></span>
                        Acceder
                    </button>
                </div>
            </div>

        </form>


    </div>
</body>

@if( $errors->has('email') || $errors->has('password') )
@else
<script>
// ocultar formulario login
$(document).ready(function(e) {
    $(".areas").hide();
    $("#moareas").click(function(e) {
        $('.areas').toggle(500);

        e.preventDefault();
    });
});

$(document).ready(function() {

    var height = $(window).height();

    $('#div2').height(height);
});
</script>
@endif

<script>
//mostrar contraseña
$(document).ready(function() {
    $('#mostrar_contraseña').click(function() {
        if ($('#mostrar_contraseña').is(':checked')) {
            $('#contraseña').attr('type', 'text');
        } else {
            $('#contraseña').attr('type', 'password');
        }
    });
});
</script>

</html>