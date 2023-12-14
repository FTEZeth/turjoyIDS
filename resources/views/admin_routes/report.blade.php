@extends('layouts.app')

@section('content')
    <!-- Title -->
    <h3 class="my-6 font-bold text-center text-3xl uppercase" style="color: #333333">Reservas del sistema turjoy</h3>

    <!-- If there are reservations -->
    @if ($reservations->count() > 0)
        <div class="flex justify-center gap-4">
            <!-- Refresh routes table button -->
            <a href="{{ route('reservationReport') }}"
                class="bg-yellow-300 transition-all my-auto py-4 px-4 text-white rounded-lg" style="background-color: #0A74DA">
                <svg class="w-5 h-5 hover:animate-spin text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 1v5h-5M2 19v-5h5m10-4a8 8 0 0 1-14.947 3.97M1 10a8 8 0 0 1 14.947-3.97" />
                </svg>
            </a>
            <!-- Search by date -->
            <form action="{{ route('searchToDate') }}" method="GET">
                @csrf
                <div class="flex justify-center gap-4 my-4">
                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker type="date" name="initDate" value="{{ old('initDate') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                    </div>

                    <div class="relative max-w-sm">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                            </svg>
                        </div>
                        <input datepicker type="date" name="finishDate" value="{{ old('finishDate') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Select date">
                    </div>

                    <button type="submit"
                        class="text-white bg-green-500 hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800",
                        style="background-color: #2ECC71;">
                        Buscar
                    </button>
                </div>
            </form>
        </div>

        <div class="max-w-sm mx-auto">
            @error('initDate')
                <p class="bg-red-400 text-gray-200 font-semibold my-4 text-lg text-center text-white px-4 py-3 rounded-lg"
                    style="background-color: #ff8a80" style="color: #ffffff">
                    {{ $message }}</p>
            @enderror

            @if (session('message'))
                <p class="bg-red-400 text-gray-200 font-semibold my-4 text-lg text-center text-white px-4 py-3 rounded-lg"
                    style="background-color: #ff8a80" style="color: #ffffff">
                    {{ session('message') }}</p>
            @endif
            @error('finishDate')
                <p class="bg-red-400 text-gray-200 font-semibold my-4 text-lg text-center text-white px-4 py-3 rounded-lg"
                    style="background-color: #ff8a80" style="color: #ffffff">
                    {{ $message }}</p>
            @enderror
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-10/12 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Código de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Día de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Fecha de la reserva
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ciudad de origen
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Ciudad de destino
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Cantidad de asientos
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Valor total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Metodo de pago
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $ticket)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $ticket->code }}
                            </th>
                            <td class="px-6 py-4">
                                {{ date('d/m/Y h:i:s', strtotime($ticket->created_at)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ date('d/m/Y', strtotime($ticket->date)) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->route->origin }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->route->destination }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->seat_amount }}
                            </td>
                            <td class="px-6 py-4">
                                ${{ number_format($ticket->total, 0, '', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $ticket->payment_method }}
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($reservations)
            <div class="flex justify-center items-center mx-auto my-8">
            </div>
        @endif
    @else
        <p class="my-6 font-bold text-center text-3xl uppercase"style="color: #333333">no hay reservas en sistema</p>
    @endif

    <div class="flex justify-center items-center mx-auto my-8">
        <a class="px-6 py-3 bg-red-500 hover:bg-red-700 transition-all text-white font-semibold rounded-lg",
            style="background-color: #FF6B6B" href="{{ route('menu') }}" data-tooltip="Vuelve al menú de administrador"
            data-flow="bottom">Volver </a>
    </div>
@endsection
