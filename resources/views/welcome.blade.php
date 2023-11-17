@extends('layouts.app')
@section('content')

    <div class="mx-auto p-10 text-center" style="background-color: #FFFFFF;">
        @if ($countRoutes)
            <h1 class="text-4xl font-semibold mb-4 text-blue-600">Haga su reserva ahora!</h1>
            <form id="form" name="form" action="{{ route('reservationStore') }}" method="POST">
                @csrf
                <!-- Dropdowns -->
                <div class="flex items-center space-x-4 w-full">
                    <!-- Dropdown for Origin -->
                    <div class="flex items-center space-x-2 flex-1">
                        <img src="images/autobus-escolar.png" alt="Origin icon" class="w-6 h-6 self-center">
                        <select id="origins" name="origins"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option selected value="">Seleccione Origen</option>
                        </select>
                    </div>

                    <!-- Dropdown for Destination -->
                    <div class="flex items-center space-x-2 flex-1">
                        <img src="images/destino.png" alt="Destination icon" class="w-6 h-6 self-center">
                        <select id="destinations" name="destinations"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option selected value="">Seleccione Destino</option>
                        </select>
                    </div>

                    <!-- Dropdown for Date -->
                    <div class="flex items-center space-x-2 flex-1">
                        <img src="images/calendar-days.png" alt="Date icon" class="w-6 h-6 self-center">
                        <input type="date" id="date" name="date" min="{{ date('Y-m-d', strtotime('+0 day')) }}"
                            max="2023-12-31"
                            class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Dropdown for Seats -->
                    <div class="flex items-center space-x-2 flex-1">
                        <img src="images/asiento.png" alt="Seat icon" class="w-6 h-6 self-center">
                        <select id="seats" name="seats"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option selected value="">Seleccione Asientos</option>
                        </select>
                    </div>

                    <input id="baseRate" name="baseRate" value="" hidden>
                    <input id="routeId" name="routeId" value="" hidden>

                    <button id="createReservation" name="createReservation"
                        class="flex-initial h-10 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        style="background-color: #2ECC71;" type="submit">
                        Hacer Reserva
                    </button>
                </div>
            </form>
        @else
            <div id="alert-additional-content-1" style="background-color: #ff8a80"
                class="w-3/12 p-4 mb-4 text-white border border-white rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <div class="flex items-center">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium">por el momento no es posible realizar reservas, intente más tarde</h3>
                </div>
            </div>
        @endif

        <h1 class="text-2xl font-bold mt-12" style="color: #0A74DA">Hiciste una Reserva?</h1>

        <!-- Section for code entry -->
        <div class="mt-10 flex items-center justify-center w-full">
            <h2 class="text-2xl font-semibold mr-4" style="color: #0A74DA">Ingrese un código de reserva:</h2>


            <form id="searchReservationForm" class="flex items-center" action="{{ route('searchReservation') }}" method="GET">
                @php
                    $searchedCode = session('searchedCode');
                    // Limpiar el código almacenado en la sesión después de mostrarlo
                    session()->forget('searchedCode');
                @endphp
                @if ($searchedCode)
                    <script>
                        @if ($searchedCode)
                            document.addEventListener('DOMContentLoaded', function () {
                                Swal.fire({
                                    title: 'Error',
                                    text: 'La reserva {{ $searchedCode }} no existe en sistema',
                                    icon: 'error',
                                    confirmButtonColor: '#ff8a80',
                                    confirmButtonText: 'Volver a intentar',
                                });
                            });
                        @endif
                    </script>

                @endif

                <input type="text" name="code"
                    class="p-2 border rounded text-gray-700 bg-white placeholder-gray-300 flex-grow"
                    placeholder="Ingrese Código de reserva">
                <button type="submit" class="ml-4 p-2 text-white rounded font-semibold"
                    style="background-color: #2ECC71;">Buscar Reserva</button>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/index.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Aqui va nuestro script de sweetalert
        const button = document.getElementById("createReservation");
        const form = document.getElementById("form");

        button.addEventListener('click', (e) => {
            // Informacion Reserva
            const selectedOrigin = document.getElementById('origins').value;
            const selectedDestination = document.getElementById('destinations').value;

            const datePicker = document.getElementById('date').value;
            const selectedSeat = document.getElementById('seats').value;
            const fecha = new Date(datePicker);
            fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset());
            const dateFormatted = fecha.toLocaleDateString('es-CL', { year: 'numeric', month: '2-digit', day: '2-digit' })

            const baseRate = document.getElementById('baseRate').value;

            console.log(dateFormatted);
            console.log(fecha);
            console.log(form);

            e.preventDefault();

            if (selectedOrigin && selectedDestination && datePicker && selectedSeat && baseRate) {
                Swal.fire({
                    title: "¿Desea continuar?",
                    text: "El total de la reserva entre " + selectedOrigin + " y " + selectedDestination +
                        " para el día " + dateFormatted + " es de " + "$" + (baseRate * selectedSeat) +
                        ` (${selectedSeat} Asientos)`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#2ECC71",
                    cancelButtonColor: "#ff8a80",
                    confirmButtonText: "Confirmar",
                    cancelButtonText: "Volver",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
@endsection
