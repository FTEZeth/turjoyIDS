
@extends('layouts.app')

@section('content')

<div class="mx-auto p-10 text-center" style="background-color: #FFFFFF;">
    @if (True)
        <h1 class="text-4xl font-semibold mb-4 text-blue-600">Haga su reserva ahora!</h1>

        <!-- Dropdowns -->
        <div class="flex items-center space-x-4 w-full">
            <!-- Dropdown for Origin -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/autobus-escolar.png" alt="Origin icon" class="w-6 h-6 self-center">
                <select id="origins" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option selected value="">Seleccione Origen</option>
                </select>
            </div>

            <!-- Dropdown for Destination -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/destino.png" alt="Destination icon" class="w-6 h-6 self-center">
                <select id="destinations" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option selected value="">Seleccione Destino</option>
                </select>
            </div>

            <!-- Dropdown for Date - might need to change to another form type -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/calendar-days.png" alt="Date icon" class="w-6 h-6 self-center">
                <input type="date" id="dateSelector" min="2023-01-01" max="2023-12-31" class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
            </div>

            <!-- Dropdown for Seats -->
            <div class="flex items-center space-x-2 flex-1">
                <img src="images/asiento.png" alt="Seat icon" class="w-6 h-6 self-center">
                <select id="seatSelector" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    <option selected value="">Seleccione Asientos</option>
                </select>
            </div>

            <button id="createReservation" class="flex-initial h-10 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" style="background-color: #2ECC71;">
                Hacer Reserva
            </button>
        </div>

        <h1 class="text-2xl font-bold mt-12" style="color: #0A74DA">Hiciste una Reserva?</h1>

        <!-- Section for code entry -->
        <div class="mt-10 flex items-center justify-center w-full">
            <h2 class="text-2xl font-semibold mr-4" style="color: #0A74DA">Ingrese un código de reserva:</h2>

            <!-- Form -->
            <form id="searchReservationForm" class="flex items-center">
                <input type="text" class="p-2 border rounded text-gray-700 bg-white placeholder-gray-300 flex-grow" placeholder="Ingrese Código de reserva">
                <button type="submit" class="ml-4 p-2 text-white rounded font-semibold" style="background-color: #2ECC71;">Buscar Reserva</button>
            </form>
        </div>
    @else
        <p>Mensaje de error.</p>
    @endif

</div>

@endsection
@section('js')
<script src="{{ asset('assets/index.js') }}"></script>
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
<!--</scrip>-->


