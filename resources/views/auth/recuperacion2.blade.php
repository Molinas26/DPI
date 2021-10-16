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
                        justify-content: space-evenly;
                        background-image: url('../img/fond.png');
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
            <center>Preguntas de Seguridad</center>
        </h2>

        <form method="post" action="">
            @csrf
            <div class="form-group">
                <label for="" style="float: left; margin-left: 5%;width: 30%; line-height: 220%">Nombre de la
                    madre:</label>
                <input required type="text" class="form-control form-control-user" name="pre1" id="pre1" maxlength="100"
                    value="{{ old('pre1') }}" style="float: left;width: 60%;margin-right: 5%">
                @if(session('mensaje1'))
                <div style="color: red;margin-left: 27%;">
                    {{session('mensaje1')}}
                </div>
                @else
                <br><br>
                @endif
            </div>

            <div class="form-group">
                <label for="" style="float: left; margin-left: 5%;width: 30%; line-height: 220%">Ciudad donde
                    creció:</label>
                <input required type="text" class="form-control form-control-user" name="pre2" id="pre2" maxlength="100"
                    value="{{ old('pre2') }}" style="float: left;width: 60%;margin-right: 5%">
                @if(session('mensaje2'))
                <div style="color: red;margin-left: 27%;">
                    {{session('mensaje2')}}
                </div>
                @else
                <br><br>
                @endif
            </div>

            <div class="form-group">
                <button style="float: right; margin-right: 5%;" type="submit" class="btn btn-success">
                    Siguiente
                </button>

                <a href="{{route('preguntas.correo')}}" type="button" style="float: left; margin-left: 5%;"
                    class="btn btn-danger">
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