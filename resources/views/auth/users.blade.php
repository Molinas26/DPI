@extends('madre')
@section('contenido')

<link href="{{ asset('css/bos.css') }}" rel="stylesheet">
    <script src="{{ asset('js/query.js') }}"></script>

@if(session('mensaje'))
<div class="alert alert-success">
    {{session('mensaje')}}
</div>
@endif
<!--Mensaje de confirmacion de edicion-->
@if(session('aviso'))
<div class="alert alert-warning">
    {{session('aviso')}}
</div>
@endif
<!--Mensaje de desactivacion de delito-->
@if(session('alerta'))
<div class="alert alert-danger">
    {{session('alerta')}}
</div>
@endif


@foreach($usuario as $users)
@if($users->id === Auth::user()->id)

<center>
    <h1><strong>Datos del Usuario</strong><br>{{$users->name}}</h1>
</center>

<br><br>
<div class="form-group">
    <form method="POST" action="{{route('users.name1',['id'=>$users->id])}}">
        @method('put')
        @csrf
        <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 15%;height: 40px;margin-left: 20%;"
            for="ndenuncia">Nombre completo:</label>
        <input style="float: left;width: 37%;" required type="text" class="form-control form-control-user" name="nombre"
            id="nombre" value="{{$users->name}}" disabled>

        <div style="float: left;margin-left: 1%;width: 10%; display: none;" id="divname">
            <button type="submit" class="btn-success" id="savname" name="savname"
                style="float: left; width: 50%; height: 40px;">
                <i class="fa fa-save" aria-hidden="true"></i>
            </button>

            <button type="reset" class="btn-danger" id="eliname" name="eliname"
                style="float: left; width: 50%; height: 40px;" onclick="desname();">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>
            </button>
            <br><br><br>
        </div>

        <script>
        function habname() {
            document.getElementById('nombre').disabled = false;
            document.getElementById('editname').style.display = 'none';
            document.getElementById('divname').style.display = 'block';
        }

        function desname() {
            document.getElementById('nombre').disabled = true;
            document.getElementById('editname').style.display = 'block';
            document.getElementById('divname').style.display = 'none';
        }
        </script>
    </form>
    <div id="editmane" style="float: left; margin-left: 1%; width: 5%;">
        <button id="editname" class="btn-warning" style="height: 40px; width: 100%;" onclick="habname()">
            <i class="fa fa-paint-brush" aria-hidden="true"></i>
        </button>
        <br><br>
    </div>
</div>
<br>
<div class="form-group">
    <form method="POST" action="{{route('users.email1',['id'=>$users->id])}}">
        @method('put')
        @csrf
        <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 15%;height: 40px;margin-left: 20%;"
            for="ndenuncia">Correo electrónico:</label>
        <input style="float: left;width: 37%;" required type="email" class="form-control form-control-user" name="email"
            id="email" value="{{$users->email}}" disabled>

        <div style="float: left;margin-left: 1%;width: 10%; display: none;" id="divemail">
            <button type="submit" class="btn-success" style="float: left; width: 50%; height: 40px;">
                <i class="fa fa-save" aria-hidden="true"></i>
            </button>

            <button type="reset" class="btn-danger" style="float: left; width: 50%; height: 40px;"
                onclick="desemail();">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>
            </button>
            <br><br><br>
        </div>

        <script>
        function habemail() {
            document.getElementById('email').disabled = false;
            document.getElementById('editemail').style.display = 'none';
            document.getElementById('divemail').style.display = 'block';
        }

        function desemail() {
            document.getElementById('email').disabled = true;
            document.getElementById('editemail').style.display = 'block';
            document.getElementById('divemail').style.display = 'none';
        }
        </script>
    </form>

    <div id="editemail" style="float: left; margin-left: 1%; width: 5%;">
        <button class="btn-warning" style="height: 40px; width: 100%;" onclick="habemail()">
            <i class="fa fa-paint-brush" aria-hidden="true"></i>
        </button>
        <br><br>

    </div>

    <br>

    <div class="form-group">
        <form method="POST" action="{{route('users.placa1',['id'=>$users->id])}}">
            @method('put')
            @csrf
            <label style="float: left;padding-right: 0.5%;line-height: 220%;width: 15%;height: 40px;margin-left: 20%;"
                for="ndenuncia">Placa:</label>
            <input style="float: left;width: 37%;" type="number" required class="form-control form-control-user"
                name="placa" id="placa" minlength="4" maxlength="5" value="{{$users->placa}}"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                disabled>

            <div style="float: left;margin-left: 1%;width: 10%; display: none;" id="divplaca">
                <button type="submit" class="btn-success" style="float: left; width: 50%; height: 40px;">
                    <i class="fa fa-save" aria-hidden="true"></i>
                </button>

                <button type="reset" class="btn-danger" style="float: left; width: 50%; height: 40px;"
                    onclick="desplaca();">
                    <i class="fa fa-paint-brush" aria-hidden="true"></i>
                </button>
                <br><br><br>
            </div>

            <script>
            function habplaca() {
                document.getElementById('placa').disabled = false;
                document.getElementById('editplaca').style.display = 'none';
                document.getElementById('divplaca').style.display = 'block';
            }

            function desplaca() {
                document.getElementById('placa').disabled = true;
                document.getElementById('editplaca').style.display = 'block';
                document.getElementById('divplaca').style.display = 'none';
            }
            </script>
        </form>

        <div id="editplaca" style="float: left; margin-left: 1%; width: 5%;">
            <button class="btn-warning" style="height: 40px; width: 100%;" onclick="habplaca()">
                <i class="fa fa-paint-brush" aria-hidden="true"></i>
            </button>
            <br><br>


        </div>

        <br>

        <div class="form-group">
            <form method="POST" action="{{route('users.telefono1',['id'=>$users->id])}}">
                @method('put')
                @csrf
                <label
                    style="float: left;padding-right: 0.5%;line-height: 220%;width: 15%;height: 40px;margin-left: 20%;"
                    for="ndenuncia">Teléfono:</label>
                <input style="float: left;width: 37%;" type="tel" required class="form-control form-control-user"
                    maxlength="8" pattern="^[9|7|8|3|2]\d{7}$" name="telefono" id="telefono"
                    value="{{$users->telefono}}" disabled>


                <div style="float: left;margin-left: 1%;width: 10%; display: none;" id="divtelefono">
                    <button type="submit" class="btn-success" style="float: left; width: 50%; height: 40px;">
                        <i class="fa fa-save" aria-hidden="true"></i>
                    </button>

                    <button type="reset" class="btn-danger" style="float: left; width: 50%; height: 40px;"
                        onclick="destelefono();">
                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </button>
                    <br><br><br>
                </div>

                <script>
                function habtelefono() {
                    document.getElementById('telefono').disabled = false;
                    document.getElementById('edittelefono').style.display = 'none';
                    document.getElementById('divtelefono').style.display = 'block';
                }

                function destelefono() {
                    document.getElementById('telefono').disabled = true;
                    document.getElementById('edittelefono').style.display = 'block';
                    document.getElementById('divtelefono').style.display = 'none';
                }
                </script>
            </form>

            <div id="edittelefono" style="float: left; margin-left: 1%; width: 5%;">
                <button class="btn-warning" style="height: 40px; width: 100%;" onclick="habtelefono()">
                    <i class="fa fa-paint-brush" aria-hidden="true"></i>
                </button>
                <br><br>


            </div>


            <br>
            <div class="form-group">

                <label
                    style="float: left;padding-right: 0.5%;line-height: 220%;width: 15%;height: 40px;margin-left: 20%;"
                    for="ndenuncia">Contraseña:</label>
                <input style="float: left;width: 37%;" type="password" class="form-control form-control-user"
                    name="password" id="password" maxlength="6" value="{{$users->password}}" disabled>
                <a href="{{route('usuarios.edit',['id'=>$users->id])}}">
                    <button type="button" class="btn-warning"
                        style="margin-left: 1%; width: 5%; height: 40px;margin-right: 21%;">

                        <i class="fa fa-paint-brush" aria-hidden="true"></i>
                    </button>
                </a>
            </div>

            @endif
            @endforeach
            <br><br>
            <a type="button" class="btn btn-danger" href="home">
                Inicio
            </a>

            @stop