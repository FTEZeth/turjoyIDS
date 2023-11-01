@extends('layouts.app')

@section('title')
    Menu del administrador
@endsection

@section('content')
    <div class="flex flex-col items-center justify-center h-screen">
        <h1 class="text-lg; text-100xl; font-bold" style="color: #0474DA; margin-bottom: 60px; font-size: 60px;">Bienvenido(a)
            nuevamente Administrador
        </h1>
        <div class="bg-gray-200 p-6 mx-auto rounded-lg lg:w-1/4" style="background-color: #eaeaea">
            <div class="text-white hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
                style="background-color: #0474DA; margin-bottom: 20px;" href="#">Cargar Rutas</div>
            <div class="text-white hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
                style="background-color: #0474DA; margin-bottom: 20px;" href="#">Realizar Reserva</div>
            <div class="text-white hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
                style="background-color: #0474DA; margin-bottom: 20px;" href="#">Buscar Reserva</div>
            <div class="text-white hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark.bg-emerald-600 dark.hover:bg-emerald-700 dark.focus:ring-emerald-800"
                style="background-color: #0474DA;" href="#">Ver Reporte de Reserva</div>
        </div>

        <div class="mt-12 mx-auto">
            <a class="px-6 py-3 bg-red-500 hover:bg-red-700 transition-all text-white font-semibold rounded-lg"
                style="background-color: #FF6B6B" href="{{ route('home') }}">Volver</a>
        </div>
    </div>
@endsection
