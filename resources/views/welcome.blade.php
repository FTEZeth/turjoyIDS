
@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TurJoy</title>
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body style="background-color: #FFFFFF">
    <div class="mx-auto p-10 text-center">
        <h1 class="text-4xl font-semibold mb-4 text-blue-600">¡Reserva tu pasaje ahora!</h1>
        <div class="mx-auto p-4 text-center">
        </div>
        <!-- Dropdowns -->
        <div class="flex items-center space-x-4 w-full">

            <!-- Dropdown for Origen -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/autobus-escolar.png" alt="Ícono de origen" class="w-6 h-6 self-center">
                <select id="origen" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>Origen</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>
            </div>

            <!-- Dropdown for Destino -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/destino.png" alt="Ícono de destino" class="w-6 h-6 self-center">
                <select id="destino" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>Destino</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>
            </div>

            <!-- Dropdown para Fecha, quizas haya que cambiar a otro tipo de form -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/calendar-days.png" alt="Ícono de fecha" class="w-6 h-6 self-center">
                <input type="date" id="datePicker" min="2023-01-01" max="2023-12-31" class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            </div>


            <!-- Dropdown for Asientos -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/asiento.png" alt="Ícono de asiento" class="w-6 h-6 self-center">
                <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option>Asientos</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                </select>
            </div>

            <button id="crear-reserva" class="flex-initial h-10 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="background-color: #2ECC71;">
                Realizar Reserva
            </button>

        </div>
        <h1 class="text-2xl font-bold  mt-12" style="color: #0A74DA">¿Hiciste una reserva?</h1>

        <!-- Sección para ingreso de código -->
        <div class="mt-10 flex items-center justify-center w-full">
            <!-- Ingresa un código de reserva -->
            <h2 class="text-2xl font-semibold mr-4" style="color: #0A74DA">Ingresa un código de reserva:</h2>

            <!-- Formulario -->
            <form id="buscar-reserva-form" class="flex items-center">
                <input type="text" class="p-2 border rounded text-gray-700 bg-white placeholder-gray-300 flex-grow" style="background-color: #FFFFFF;" placeholder="Ingrese código de Reserva">
                <button type="submit" class="ml-4 p-2 text-white rounded font-semibold" style="background-color: #2ECC71;">Buscar Reserva</button>
            </form>

        </div>
    </div>
</body>



</html>
@endsection
<!--<script>--><!--fragmento codigo para obtener los id de date-->
    <!-- Obtiene el valor del elemento input con id 'datePicker'. Esta fecha está en formato "YYYY-MM-DD". -->
    <!--let selectedDate = document.getElementById('datePicker').value;-->

    <!-- Verifica si el usuario ha seleccionado una fecha (es decir, el valor no está vacío). -->
    <!--if (selectedDate) {-->

        <!-- Divide la fecha seleccionada en un array que contiene [Año, Mes, Día]. -->
        <!-- Ejemplo: "2023-03-15" se convierte en ["2023", "03", "15"]. -->
        <!--let dateParts = selectedDate.split('-');-->

        <!-- Extrae y almacena el mes y el día de la fecha seleccionada. -->
        <!--let month = dateParts[1];  Mes, ej.: "03" para marzo. -->
        <!--let day = dateParts[2];    Día, ej.: "15" para el día 15 del mes. -->

        <!-- Muestra en consola el mes y el día seleccionados. -->
        <!--console.log('Selected Month:', month);-->
        <!--console.log('Selected Day:', day);-->
    <!--}-->
<!--</script>-->


