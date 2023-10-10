
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TurJoy</title>
    @vite('resources/css/app.css','resources/js/app.js')

</head>
<body>

    @section('content')
    <div style="height: 100vh; display: flex; align-items: center; justify-content: center; background-color: #F4F4F4;">
        <img src="{{ asset('images/FondoInterfazProximamente.png') }}" alt="Fondo Interfaz" style="width: 100%; height: 100%;">
    </div>
    @endsection

</body>
</html>
@endsection

