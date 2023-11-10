@extends('layouts.app')

@section('content')

<div class="flex flex-col items-center justify-center h-screen">
    <div class="w-1/3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="bg-cyan-600 p-10 rounded-t-lg", style="background-color: #0A74DA;">
            <p class="text-xl text-white text-center">Tu pago ha sido <br> <span class="font-bold text-2xl">realizado con
                    éxito</span></p>
        </div>
        <div class="flex flex-col p-5">

            {{-- Empieza el contenido de la tabla --}}
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody>
                        <tr
                            class="bg-cyan-100 border-b border-cyan-500 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Código de reserva
                            </th>
                            <td class="px-6 py-4">
                                {{ $reservation->code }}
                            </td>
                        </tr>
                        <tr
                            class="bg-cyan-100 border-b border-cyan-500 dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Ciudad de origen
                            </th>
                            <td class="px-6 py-4">
                                {{ $origin }}
                            </td>
                        </tr>
                        <tr class="bg-cyan-100 border-b border-cyan-500">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Ciudad de destino
                            </th>
                            <td class="px-6 py-4">
                                {{ $destination}}
                            </td>
                        </tr>
                        <tr class="bg-cyan-100 border-b border-cyan-500">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Día de la reserva
                            </th>
                            <td class="px-6 py-4">
                                {{ $reservation->date }}
                            </td>
                        </tr>

                        <tr class="bg-cyan-100 border-b border-cyan-500">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Cantidad de asientos
                            </th>
                            <td class="px-6 py-4">
                                {{ $reservation->seat_amount }}
                            </td>
                        </tr>

                        <tr class="bg-cyan-100 border-b border-cyan-500">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Fecha de la compra
                            </th>
                            <td class="px-6 py-4">
                                {{  $reservation->created_at }}
                            </td>
                        </tr>

                        <tr class="bg-cyan-100 border-b border-cyan-500">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                Total pagado
                            </th>
                            <td class="px-6 py-4">
                                {{ $reservation->total }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">

            <a href="{{ route('home') }}" type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Finalizar
            </a>

            <a href="#" type="button"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                Finalizar>

            </a>
        </div>
    </div>
</div>
@endsection