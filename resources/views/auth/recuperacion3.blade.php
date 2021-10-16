<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>DPI</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

</head>

<body>

<div style="position: absolute; height: 100%; width: 100%;
                        display: flex;
                        flex-direction: column;
                        justify-content: space-evenly;background-image: url('../img/fond.png');
                        background-repeat: no-repeat;
                        background-attachment: fixed;
                        background-size: cover;"
        id="div2">


    </div>




    <div display: flex; style="width: 50%; height: 50%; margin-top: 12.5%; margin-left: 25%; position: absolute;
     background:linear-gradient(20deg, rgb(21, 32, 192), rgb(65, 206, 225), 
     rgb(70, 0, 128));
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;">

        <h2>
            <center>Cambio contraseña</center>
        </h2>

        <form method="post" action="">
            @csrf
            <div class="form-group">
                <br>
                <label for="" style="float: left; margin-left: 5%;width: 30%; line-height: 220%">Nueva
                    Contraseña:</label>
                <input required type="password" class="form-control form-control-user" name="con1" id="con1"
                    maxlength="100" style="float: left;width: 60%;margin-right: 5%" minlength="8">
                <br>
            </div>

            <div class="form-group">
                <br>
                <label for="" style="float: left; margin-left: 5%;width: 30%; line-height: 220%">Confirmar
                    Contraseña:</label>
                <input required type="password" class="form-control form-control-user" name="con2" id="con2"
                    maxlength="100" style="float: left;width: 60%;margin-right: 5%" minlength="8">
                @if(session('mensaje'))
                <div style="color: red;margin-left: 27%;">
                    {{session('mensaje')}}
                </div>
                @else
                <br><br>
                @endif
            </div>

            <div class="form-group">
                <button style="float: right; margin-right: 5%;" type="submit" class="btn btn-success">
                    Siguiente
                </button>

                <a href="javascript:history.back();" type="button"
                    style="float: left; margin-left: 5%;" class="btn btn-danger">
                    Volver
                </a>

                <a href="/" type="button" style="float: left; margin-left: 28%;" class="btn btn-warning">
                    Cancelar
                </a>
            </div>
        </form>

    </div>
</body>

</html>