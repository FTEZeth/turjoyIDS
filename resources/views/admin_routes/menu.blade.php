@extends('layouts.app')

@section('title')
    Menu del administrador
@endsection

@section('content')
    <div class="flex items-center justify-center h-screen">
        <h1 style="color: #0474DA;">>Bienvenido(a) nuevamente Administrador</h1>
        <div class="bg-gray-200 p-6 mx-auto rounded-lg lg:w-1/4" style="background-color: #eaeaea">
            <a class="font-bold text-2xl text-center text-blue-500 uppercase mb-4" style="color: #0474DA;"
                href="#">Cargar Rutas</a>
            <a class="font-bold text-2xl text-center text-blue-500 uppercase mb-4" style="color: #0474DA;"
                href="#">Realizar Reserva
            </a>
            <a class="font-bold text-2xl text-center text-blue-500 uppercase mb-4" style="color: #0474DA;"
                href="#">Buscar Reserva
            </a>
            <a class="font-bold text-2xl text-center text-blue-500 uppercase mb-4" style="color: #0474DA;"
                href="#">Ver Reporte de Reserva
            </a>
        </div>

        <div class="mb-12 mx-auto">
            <a class="px-6 py-3 bg-red-500 hover:bg-red-700 transition-all text-white font-semibold rounded-lg",
                style="background-color: #FF6B6B" href="{{ route('logout') }}">Cerrar sesion </a>
        </div>
    </div>
@endsection
