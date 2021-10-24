@extends('adminlte::master')

@section('adminlte_css')
@yield('css')
@stop

@section('classes_body', 'lockscreen')

@php( $password_reset_url = View::getSection('password_reset_url') ?? config('adminlte.password_reset_url',
'password/reset') )
@php( $dashboard_url = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home') )

@if (config('adminlte.use_route_url', false))
@php( $password_reset_url = $password_reset_url ? route($password_reset_url) : '' )
@php( $dashboard_url = $dashboard_url ? route($dashboard_url) : '' )
@else
@php( $password_reset_url = $password_reset_url ? url($password_reset_url) : '' )
@php( $dashboard_url = $dashboard_url ? url($dashboard_url) : '' )
@endif


@section('body')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<link href="{{ asset('css/bos.css') }}" rel="stylesheet">
    <script src="{{ asset('js/query.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>


<div style="position: absolute; height: 100%; width: 100%;
display: flex;
flex-direction: column;
justify-content: space-evenly;  background:linear-gradient(#fff);"
    id="div2">



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <div style="margin-top: 2%;" class="lockscreen-wrapper">

        {{-- Lockscreen logo --}}
        <div class="lockscreen-logo">
            <a href="{{ $dashboard_url }}">
                <img src="{{ asset(config('adminlte.logo_img')) }}" height="50">
                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
            </a>
        </div>

        {{-- Lockscreen user name --}}
        <div class="lockscreen-name">
            <strong> Usuario {{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }} Ingrese su
                contraseña para acceder a este apartado</strong>
        </div>
        <br>

        <form style="margin-left: 0px;
            display: flex;
            flex-direction: column;" method="POST" action="{{ route('password.confirm') }}"
            class="lockscreen-credentials @if(!config('adminlte.usermenu_image'))ml-0 @endif">
            @csrf


            <div class="input-group" style="width: 500px;">
                <label for="" style="float: left; width: 35%;line-height: 35px;">Ingrese su contraseña:</label>
                <input style="float: left; width: 45%;" id="password" type="password" name="password" minlength="8" maxlength="20"
                    autocomplete="current-password"
                    class="form-control contraseña @error('password') is-invalid @enderror"
                    placeholder="Ingrese contraseña" required autofocus>
            </div>
            <br>
            
        <div style="float: left; width: 50%;">
            <input style="margin-left:20px; float: left;" type="checkbox" id="mostrar_contraseña" title="clic para mostrar contraseña" />
            <strong style=" float: left;margin-left: 5px;">Mostrar Contraseña</strong>
        </div>
            <br>
        <div style="width: 100%;">
            <button style="float: left;width: 80px; height: 50px;" type="submit" class=" btn-primary">
                Entrar
            </button>

            <a style="float: right;width: 80px; height: 50px;line-height: 50px;" type="button" href="/" class=" btn-danger">
                <center>
                    Cancelar
                </center>
            </a>
        </div>

        </form>

            <br><br>

    </div>

    {{-- Password error alert --}}
    @error('password')
    <div class="alert alert-danger" role="alert" style="margin-left: 25%; margin-right: 25%; text-align: center;
        ">
        <div class="lockscreen-subitem text-center" role="alert">
            <b class="text-dark"> contraseña incorrecta <strong class="text-danger">cuidado area restringida</strong>
            </b>
        </div>
    </div>

    @enderror

</div>
</div>

<script>
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

@stop

@section('adminlte_js')
@stack('js')
@yield('js')

@stop
