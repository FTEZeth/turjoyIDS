
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

<div class="bg-white py-20 text-center", style="background-color: #EAEAEA">
    <h2 class="text-blue-500 text-4xl" style="color: #0A74DA">¿Hiciste una reserva?</h2>
    <div class="flex justify-center mt-8 space-x-4">
        <input type="text" placeholder="ej. ABCD01" class="border border-gray-400 p-2">
        <button class="bg-orange-500 text-white px-4 py-2 rounded" style="background-color: #FF6B6B  ">Botón</button>
    </div>
</div>
@endsection

