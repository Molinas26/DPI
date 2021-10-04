@extends('madre')
@section('contenido')


<div class="" style="width: 100%;height: 100%;">
    <div class="">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <h1>
                        <center>
                            Actualización de Contraseña
                        </center>
                    </h1>
                </div>

                <div class="card-body">
                    <div>

                        </form>
                        <form method="POST" action="{{route('usuarios.edit',['id'=>Auth::user()->id])}}">
                            @method('put')
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña
                                    anterior</label>

                                <div class="col-md-6">
                                    <input id="oldpassword" maxlength="100" placeholder="Ingrese su contraseña"
                                        type="password" minlength="8" class="form-control contraseña "
                                        name="oldpassword" required autocomplete="new-password">

                                    @if(session('alerta1'))
                                    <div style="color: red;">
                                        Contraseña incorrecta
                                    </div>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Nueva
                                    contraseña</label>

                                <div class="col-md-6">
                                    <input id="password" maxlength="100" placeholder="Ingrese su nueva contraseña"
                                        type="password" minlength="8"
                                        class="form-control @error('password') is-invalid @enderror pass contraseña"
                                        name="password" required autocomplete="new-password">
                                        <span id="confi"></span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar
                                    contraseña</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" maxlength="100" minlength="8"
                                        placeholder="Confirme su contraseña" type="password"
                                        class="form-control contraseña " name="password_confirmation" required
                                        autocomplete="new-password">



                                    @if(session('mensaje'))
                                    <div style="color: red;">
                                        Contraseña no coincide
                                    </div>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#cambclav">
                                        Actualizar
                                    </button>

                                    <div class="modal" id="cambclav" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                    style="background-image: linear-gradient(to left,  #30bfea,#87ddf6);color:black;">
                                                    <h5 class="modal-title">Cambio de contraseña</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span class="btn-border btn-outline-danger btn-lg">X</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Desea cambiar la contraseña?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" id="btn-save" name="btnsave"
                                                        class="btn btn-primary">Guardar</button>

                                                    <button type="button" class="btn btn-danger"
                                                        data-dismiss="modal">Volver</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <a class="btn btn-primary" type=button href="usuario">Regresar</a>

                                    <input style="margin-left:20px;" type="checkbox" id="mostrar_contraseña"
                                        title="clic para mostrar contraseña" />
                                    &nbsp;&nbsp;<strong>Mostrar Contraseñas</strong>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
 
$('.pass').keyup(function(e) {
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
   
    @endsection