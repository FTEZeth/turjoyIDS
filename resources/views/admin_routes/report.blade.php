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
        </table>
    </div>
@endsection
