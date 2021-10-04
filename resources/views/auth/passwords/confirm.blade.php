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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>


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

        <form style="
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;" method="POST" action="{{ route('password.confirm') }}"
            class="lockscreen-credentials @if(!config('adminlte.usermenu_image'))ml-0 @endif">
            @csrf


            <div class="input-group">
                <input id="password" type="password" name="password" minlength="8" maxlength="20"
                    autocomplete="current-password"
                    class="form-control contraseña @error('password') is-invalid @enderror"
                    placeholder="Ingrese contraseña" required autofocus>
                <div class="input-group-append">
                    <button type="submit" class="btn">
                        <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                </div>
            </div>
            <br>

        </form>
        <a style="margin-left: 17%;" type="button" href="/" class="btn btn-primary  ">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
            </svg></a>

        <input style="margin-left:20px;" type="checkbox" id="mostrar_contraseña" title="clic para mostrar contraseña" />
        &nbsp;&nbsp;<strong>Mostrar Contraseña</strong>

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
