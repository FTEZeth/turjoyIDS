@extends('layouts.app')

@section('content')
    <div class="mx-auto p-10 text-center w-1/2">
        <div class="w-7/8 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="bg-cyan-600 p-10 rounded-t-lg", style="background-color: #0A74DA;">
                <p class="text-xl text-white text-center">Tu reserva ha sido <br> <span class="font-bold text-2xl">realizada
                        con
                        éxito</span></p>
            </div>
            <!-- Table containing the data of the reservation -->
            <div class="flex flex-col p-5">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <!-- Table -->
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <tbody>
                            <!-- Reservation code -->
                            <tr class="bg-cyan-100 border-b border-cyan-500 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Código de reserva
                                </th>
                                <td class="px-6 py-4">
                                    {{ $reservation->code }}
                                </td>
                            </tr>
                            <!-- Reservation origin -->
                            <tr class="bg-cyan-100 border-b border-cyan-500 dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ciudad de origen
                                </th>
                                <td class="px-6 py-4">
                                    {{ $origin }}
                                </td>
                            </tr>
                            <!-- Reservation destination -->
                            <tr class="bg-cyan-100 border-b border-cyan-500">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Ciudad de destino
                                </th>
                                <td class="px-6 py-4">
                                    {{ $destination }}
                                </td>
                            </tr>
                            <!-- Reservation date -->
                            <tr class="bg-cyan-100 border-b border-cyan-500">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Día de la reserva
                                </th>
                                <td class="px-6 py-4">
                                    {{ date('d/m/Y', strtotime($reservation->date)) }}
                                </td>
                            </tr>
                            <!-- Reservation seat amount -->
                            <tr class="bg-cyan-100 border-b border-cyan-500">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Cantidad de asientos
                                </th>
                                <td class="px-6 py-4">
                                    {{ $reservation->seat_amount }}
                                </td>
                            </tr>
                            <!-- Reservation date of creation -->
                            <tr class="bg-cyan-100 border-b border-cyan-500">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Fecha de la compra
                                </th>
                                <td class="px-6 py-4">
                                    {{ date('d/m/Y h:i:s A', strtotime($reservation->created_at)) }}
                                </td>
                            </tr>
                            <!-- Reservation total -->
                            <tr class="bg-cyan-100 border-b border-cyan-500">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Total pagado
                                </th>
                                <td class="px-6 py-4">
                                    ${{ number_format((int) $reservation->total, 0, ',', '.') }} CLP
                                </td>
                            </tr>
                            <!-- Reservation payment method -->
                            <tr class="bg-cyan-100 border-b border-cyan-500">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    Medio de pago
                                </th>
                                <td class="px-6 py-4">
                                    {{ $reservation->payment_method }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Buttons -->
            <div
                class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <div
                    class="flex items-center justify-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <!-- Button to go back to the home page -->
                    <a href="{{ route('home') }}" type="button"
                        class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        style="background-color: #FF6B6B" data-tooltip="Vuelve a la página principal" data-flow="left">
                        Finalizar
                    </a>
                    <!-- Button to download the reservation receipt -->
                    <a href="{{ route('pdf.download', ['id' => $reservation->id]) }}" type="button"
                        class="text-white bg-gray-300 hover:bg-gray-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-800",
                        style="background-color: #2ECC71" data-tooltip="Descarga tu comprobante de reserva"
                        data-flow="right">
                        Descargar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
