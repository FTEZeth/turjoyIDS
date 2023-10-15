@extends('layouts.app')

@section('title')
    Cargar rutas de viaje
@endsection

@section('content')

@if ($validRows || $invalidRows || $duplicatedRows)

    <div class="flex flex-1 flex-col gap-2">
        <div class="my-8 mx-auto">
            <a class="px-6 py-3 bg-green-500 hover:bg-green-700 transition-all text-white font-semibold rounded-lg",  style="background-color: #2ECC71;"
                href="{{ route('upload') }}">Finalizar</a>
        </div>

            @if (count($validRows) > 0)
                <h3 class="text-2xl text-black font-semibold uppercase text-center">Listado de viajes agregados
                    correctamente
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg mb-2">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-green-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($validRows as $validRow)
                                <tr class="bg-green-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $validRow['origen'] }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['destino'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['cantidad_de_asientos'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $validRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (count($invalidRows))
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    Listado de viajes que presentaron errores
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <thead class="text-xs text-gray-700 uppercase bg-red-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invalidRows as $invalidRow)
                                <tr class="bg-red-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ isset($invalidRow['origen']) ? $invalidRow['origen'] : '---' }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ isset($invalidRow['destino']) ? $invalidRow['destino'] : '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ isset($invalidRow['cantidad_de_asientos']) ? $invalidRow['cantidad_de_asientos'] : '---' }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ isset($invalidRow['tarifa_base']) ? $invalidRow['tarifa_base'] : '---' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if (count($duplicatedRows))
                <h3 class="text-2xl text-black font-semibold uppercase text-center">
                    Listado de viajes que se encuentran duplicados
                </h3>
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <thead class="text-xs text-gray-700 uppercase bg-amber-600 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($duplicatedRows as $duplicatedRow)
                                <tr class="bg-yellow-400 border-b dark:bg-gray-900 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                        {{ $duplicatedRow['origen'] }}
                                    </th>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['destino'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['cantidad_de_asientos'] }}
                                    </td>
                                    <td class="px-6 py-4 text-white font-medium">
                                        {{ $duplicatedRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
@else

    <div class="flex flex-col flex-1 justify-center items-center my-6">
        <div class="mb-12 mx-auto">
            <a class="px-6 py-3 bg-red-500 hover:bg-red-400 transition-all text-white font-semibold rounded-lg", style="background-color: #FF6B6B"
                href="{{ route('home') }}">Volver</a>
        </div>

        <form class ="flex flex-col items-center w-1/2" action = "{{route('routes.check')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <input name="document" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-200 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help"> Tipo de archivo soportado: .xlsx (max 5mb).</p>
                
                @if (session('message'))
                    <p class="bg-red-400 text-gray-200 font-semibold my-4 text-lg text-center text-red-800 px-4 py-3 rounded-lg">
                        {{session('message')}}
                @endif
                
                @error('document')
                    <p class="bg-red-500 font-semibold my-4 text-lg text-center text-white px-4 py-3 rounded-lg", style="background-color: #FF6B6B">
                        {{$message}}
                    </p>
                @enderror
            </div>

            <button class="lg:w-1/4 my-4 p-2 bg-green-400 rounded-sm text-white font-semibold",  style="background-color: #2ECC71;" type="submit">
                Importar rutas
            </button>
        </form>
    </div>
@endif
@endsection
