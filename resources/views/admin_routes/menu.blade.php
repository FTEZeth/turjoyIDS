@extends('layouts.app')

<body class="bg-gray-200 p-6">
    <div class="bg-white rounded-lg shadow-lg p-4 max-w-xs mx-auto">
        <h1 class="text-xl font-semibold text-center mb-4">Bienvenidx administratorx</h1>
        <div class="space-y-4">
            <a class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 transition duration-200", href="{{ route('upload') }}">Cargar Rutas</a>
            <button class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-green-600 transition duration-200">Realizar Reserva</button>
            <button class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-yellow-600 transition duration-200">Buscar Reserva</button>
            <button class="w-full bg-blue-500 text-white py-2 px-4 py-2 px-4 rounded-md hover:bg-red-600 transition duration-200">Ver reporte de reserva</button>
            <a class="w-full bg-blue-500 text-white py-2 px-4 py-2 px-4 rounded-md hover:bg-red-600 transition duration-200", style="background-color: #FF6B6B"
                href="{{ route('home') }}">Volver </a>        </div>

    </div>

</body>
</html>
