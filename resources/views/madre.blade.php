@extends('adminlte::page')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>UDIC N° 7</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="{{ asset('css/estylo.css') }}" rel="stylesheet">
    <link href="{{asset('css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/app.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


    <!--Enlace Graficos-->



    <link href="{{ asset('css/bos.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/query.js') }}"></script>

    <script src="{{ asset('js/todo.js') }}"></script>
</head>

<body>


    @yield('contenido')
    <br>
</body>

@section('footer')
<strong> <i>Copyright© 2021 Asignatura: IA-189 - UNAH-TEC, Danlí, El Paraíso, Honduras, C.A.</i> </strong>
@stop

</html>
@stop
