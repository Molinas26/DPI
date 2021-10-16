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
                        justify-content: space-evenly;background-image: url('./img/fond.png');
                        background-repeat: no-repeat;
                        background-attachment: fixed;
                        background-size: cover;"
        id="div2">



    </div>



    <div display: flex; style="width: 50%; height: 40%; margin-top: 15%; margin-left: 25%; position: absolute;
     background:linear-gradient(20deg, rgb(21, 32, 192), rgb(65, 206, 225), 
     rgb(70, 0, 128));
    display: flex;
    flex-direction: column;
    justify-content: space-evenly;">

        <h2>
            <center>Recuperar contraseña</center>
        </h2>

        <form method="post" action="">
            @csrf
            <div class="form-group">
                <br>
                <label for="" style="float: left; margin-left: 5%;width: 30%; line-height: 220%">Correo
                    electrónico:</label>
                <input required type="email" pattern="^[a-zA-Z0-9.!#$%&+/=?^_`{|}~]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)$"
                    class="form-control form-control-user" name="email" id="email" maxlength="100"
                    value="{{ old('email') }}" style="float: left;width: 60%;margin-right: 5%">
                <br><br>
                @if(session('mensaje'))
                <div style="color: red;margin-left: 27%;">
                    {{session('mensaje')}}
                </div>
                @endif
                <br>
            </div>

            <div class="form-group">
                <button style="float: right; margin-right: 5%; margin-top: 1%;" type="submit" class="btn btn-success">
                    Siguiente
                </button>

                <a href="/" style="float: left; margin-left: 5%; margin-top: 1%;" class="btn btn-danger">
                    Volver
                </a>
            </div>
        </form>

    </div>
</body>



</html>