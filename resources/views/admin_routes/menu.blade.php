@extends('layouts.app')

@section('title')
    Menu del administrador
@endsection

@section('content')
    <div class="mx-auto p-10 text-center">
        <h1 class="text-4xl font-semibold mb-4 text-blue-600" style="color #0474DA">Bienvenido(a) nuevamente Administrador
        </h1>
        <div class="bg-gray-200 p-6 mx-auto rounded-lg lg:w-1/4" style="background-color: #eaeaea">
            <a class="text-white hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
                style="background-color: #0474DA; margin-bottom: 20px; display: block;" href="{{ route('upload') }}">Cargar
                Rutas</a>

            <a class="text-white hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark.bg-emerald-600 dark.hover:bg-emerald-700 dark.focus:ring-emerald-800"
                style="background-color: #0474DA; display: block;" href="{{ route('reservationReport') }}">Ver Reporte de
                Reserva</a>
        </div>

        <div class="mt-8 mx-auto">
            <a class="px-6 py-3 bg-red-500 hover:bg-red-700 transition-all text-white font-semibold rounded-lg"
                style="background-color: #FF6B6B" href="{{ route('home') }}">Volver</a>
        </div>
    </div>
@endsection
