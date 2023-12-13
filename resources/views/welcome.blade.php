@extends('layouts.app')
@section('content')
    <div class="mx-auto p-10 text-center" style="background-color: #FFFFFF;">
        @if ($countRoutes)
            <h1 class="text-4xl font-semibold mb-4 text-blue-600">Haga su reserva ahora</h1>
            <form id="form" name="form" action="{{ route('reservationStore') }}" method="POST">
                @csrf
                <!-- Dropdowns -->
                <div class="flex items-center space-x-4 w-full">
                    <!-- Dropdown for Origin -->
                    <div class="flex items-center space-x-2 flex-1" data-tooltip="Seleccione ciudad de origen"
                        data-flow="bottom">
                        <img src="images/autobus-escolar.png" alt="Origin icon" class="w-6 h-6 self-center">
                        <select id="origins" name="origins"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option selected value="">Seleccione Origen</option>
                        </select>
                    </div>

                    <!-- Dropdown for Paymethood -->

                    <div class="flex items-center space-x-2 flex-1" data-tooltip="Seleccione método de pago"
                        data-flow="bottom">
                        <img src="images/payment.png" alt="Payment icon" class="w-6 h-6 self-center">
                        <select id="paymentMethod" name="paymentMethod"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option selected value="">Seleccione medio de pago</option>
                            <option value="Transferencia">Transferencia</option>
                            <option value="Debito">Debito</option>
                            <option value="Credito">Credito</option>
                            <option value="Efectivo">Efectivo</option>
                        </select>
                    </div>
                    <!-- Dropdown for Destination -->
                    <div class="flex items-center space-x-2 flex-1" data-tooltip="Seleccione ciudad de destino"
                        data-flow="bottom">
                        <img src="images/destino.png" alt="Destination icon" class="w-6 h-6 self-center">
                        <select id="destinations" name="destinations"
                            class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                            <option selected value="">Seleccione Destino</option>
                        </select>
                    </div>

                    <!-- Dropdown for Date -->
                    <div class="flex items-center space-x-2 flex-1" data-tooltip="Seleccione fecha de la reserva"
                        data-flow="bottom">
                        <img src="images/calendar-days.png" alt="Date icon" class="w-6 h-6 self-center">
                        <input type="date" id="date" name="date" min="{{ date('Y-m-d', strtotime('+0 day')) }}"
                            max="2023-12-31"
                            class="block w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <!-- Dropdown for Seats -->
                    <div class="flex items-center space-x-2 flex-1" data-tooltip="Seleccione la cantidad de asientos"
                        data-flow="bottom">
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
                        style="background-color: #EAEAEA;" type="submit" disabled>
                        Hacer Reserva
                    </button>
                </div>
            </form>
        @else
            <div id="alert-additional-content-1" style="background-color: #ff8a80; width: 50%; margin: auto;"
                class="p-4 mb-4 text-white border border-white rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800"
                role="alert">
                <div class="flex items-center justify-center">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium text-center">Por el momento no es posible realizar reservas. Intente más
                        tarde.</h3>
                </div>
            </div>
        @endif

        <h1 class="text-2xl font-bold mt-12" style="color: #0A74DA">¿Hiciste una Reserva?</h1>

        <!-- Section for code entry -->
        <div class="mt-10 flex items-center justify-center w-full">
            <h2 class="text-2xl font-semibold mr-4" style="color: #0A74DA">Ingrese un código de reserva:</h2>


            <form id="searchReservationForm" class="flex items-center" action="{{ route('searchReservation') }}"
                method="GET">
                @php
                    $searchedCode = session('searchedCode');
                    // Limpiar el código almacenado en la sesión después de mostrarlo
                    session()->forget('searchedCode');
                @endphp
                @if ($searchedCode)
                    <script>
                        @if ($searchedCode)
                            document.addEventListener('DOMContentLoaded', function() {
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
        // This script triggers a confirmation dialog when all reservation fields (origin, destination, date, seat, and rate) are selected.
        const button = document.getElementById("createReservation");
        const form = document.getElementById("form");

        button.addEventListener('click', (e) => {
            const selectedOrigin = document.getElementById('origins').value;
            const selectedDestination = document.getElementById('destinations').value;

            const datePicker = document.getElementById('date').value;
            const selectedSeat = document.getElementById('seats').value;
            const fecha = new Date(datePicker);
            fecha.setMinutes(fecha.getMinutes() + fecha.getTimezoneOffset());
            const dateFormatted = fecha.toLocaleDateString('es-CL', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            })

            const baseRate = document.getElementById('baseRate').value;

            console.log(dateFormatted);
            console.log(fecha);
            console.log(form);

            e.preventDefault();
            // This code triggers a confirmation dialog when all reservation fields (origin, destination, date, seat, and rate) are selected.
            // It displays a summary with the reservation details and cost, and offers 'Confirm' and 'Return' options.
            // On confirming, the reservation form is submitted; otherwise, the action is cancelled.

            if (selectedOrigin && selectedDestination && datePicker && selectedSeat && baseRate) {
                Swal.fire({
                    title: "¿Desea continuar?",
                    text: "El total de la reserva entre " + selectedOrigin + " y " + selectedDestination +
                        " para el día " + dateFormatted + " es de " + "$" + (baseRate).toLocaleString(
                            'de-DE') +
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

    <script>
        // This script enables the 'createReservation' button only when all dropdowns are selected.
        // It checks the selection state of each dropdown and updates the button's enabled status and background color.
        // The button is activated (green) when all fields are filled, otherwise it remains disabled (grey).

        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('select');
            const button = document.getElementById('createReservation');
            const checkSelects = () => {
                let allSelected = true;
                selects.forEach(select => {
                    if (select.value === '') {
                        allSelected = false;
                    }
                });
                button.disabled = !allSelected;
                button.style.backgroundColor = allSelected ? '#2ECC71' : '#EAEAEA';
            };
            selects.forEach(select => {
                select.addEventListener('change', checkSelects);
            });
            checkSelects(); // Para revisar el estado inicial de los selects
        });
    </script>
    <script>
        // This script enables the 'paymentMethod' dropdown only when all dropdowns are selected.
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('select');
            const dateInput = document.getElementById('date');
            const paymentMethodSelect = document.getElementById('paymentMethod');
            const button = document.getElementById('createReservation');

            // Inicialmente, deshabilita el dropdown de método de pago
            paymentMethodSelect.disabled = true;

            const checkSelects = () => {
                let allSelected = true;
                selects.forEach(select => {
                    // Asegúrate de que no estás incluyendo el select de método de pago en esta verificación
                    if (select.id !== 'paymentMethod' && select.value === '') {
                        allSelected = false;
                    }
                });
                //verify that the date is not empty
                if (dateInput.value === '') {
                    allSelected = false;
                }

                // if all selects are selected, enable the payment method select
                paymentMethodSelect.disabled = !allSelected;

                // update the button's enabled status and background color
                button.disabled = !allSelected || paymentMethodSelect.value === '';
                button.style.backgroundColor = (allSelected && paymentMethodSelect.value !== '') ? '#2ECC71' :
                    '#EAEAEA';
            };

            selects.forEach(select => {
                select.addEventListener('change', checkSelects);
            });
            dateInput.addEventListener('change', checkSelects);

            checkSelects(); // check initial state of selects
        });
    </script>
@endsection
