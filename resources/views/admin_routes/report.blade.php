@extends('layouts.app')

@section('content')
    <h3 class="my-6 font-bold text-center text-3xl uppercase">Reservas del sistema turjoy</h3>

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
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $ticket)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $ticket->code }}
                        </th>
                        <td class="px-6 py-4">
                            {{ date('d/m/Y h:i:s', strtotime($ticket->created_at)) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('d/m/Y', strtotime($ticket->date)) }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->travelDates->origin }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->travelDates->destination }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->seat }}
                        </td>
                        <td class="px-6 py-4">
                            ${{ number_format($ticket->total, 0, '', '.') }}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
