@extends('layouts.app')

@section('title')
    Cargar rutas de viaje
@endsection

@section('content')
    <!-- If there are validRows, invalidRows or duplicatedRows, then show them -->
    @if ($validRows || $invalidRows || $duplicatedRows)
        <div class="flex flex-1 flex-col gap-2">
            <!-- Return button -->
            <div class="my-8 mx-auto">
                <a class="px-6 py-3 bg-green-500 hover:bg-green-700 transition-all text-white font-semibold rounded-lg",
                    style="background-color: #2ECC71;" href="{{ route('upload') }}">Volver a cargar rutas</a>
            </div>
            <!-- If there are validRows, then show them -->
            @if (count($validRows) > 0)
                <!-- Title -->
                <h3 class="text-2xl text-black font-semibold uppercase text-center" style="color: #333333">Listado de viajes
                    agregados
                    correctamente
                </h3>
                <!-- Table containing the validRows -->
                <div class="relative overflow-x-auto sm:rounded-lg mb-2">
                    <!-- Table -->
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400">
                        <!-- Table header -->
                        <thead
                            class="text-xs text-gray-700 uppercase bg-green-600 dark:bg-gray-700 dark:text-gray-400"style="background-color: #a8e6cf">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            <!-- For each validRow, show it -->
                            @foreach ($validRows as $validRow)
                                <!-- Table row -->
                                <tr class="bg-green-400 border-b dark:bg-gray-900 dark:border-gray-700"
                                    style="background-color: #a8e6cf">
                                    <!-- Origin -->
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white"
                                        style="color: #333333">
                                        {{ $validRow['origen'] }}
                                    </th>
                                    <!-- Destination -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ $validRow['destino'] }}
                                    </td>
                                    <!-- Seat amount -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ $validRow['cantidad_de_asientos'] }}
                                    </td>
                                    <!-- Base rate -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ $validRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <!-- If there are invalidRows, then show them -->
            @if (count($invalidRows))
                <!-- Title -->
                <h3 class="text-2xl text-black font-semibold uppercase text-center" style="color: #333333">
                    Listado de viajes que presentaron errores
                </h3>
                <!-- Table containing the invalidRows -->
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <!-- Table -->
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <!-- Table header -->
                        <thead class="text-xs text-gray-700 uppercase bg-red-600 dark:bg-gray-700 dark:text-gray-400"
                            style="background-color: #ff8a80">
                            <!-- Table row -->
                            <tr>
                                <!-- Origin -->
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Origen
                                </th>
                                <!-- Destination -->
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Destino
                                </th>
                                <!-- Seat amount -->
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Cantidad de asientos
                                </th>
                                <!-- Base rate -->
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            <!-- For each invalidRow, show it -->
                            @foreach ($invalidRows as $invalidRow)
                                <!-- Table row -->
                                <tr class="bg-red-400 border-b dark:bg-gray-900 dark:border-gray-700"
                                    style="background-color: #ff8a80">
                                    <!-- Origin -->
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white"
                                        style="color: #333333">
                                        {{ isset($invalidRow['origen']) ? $invalidRow['origen'] : '---' }}
                                    </th>
                                    <!-- Destination -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ isset($invalidRow['destino']) ? $invalidRow['destino'] : '---' }}
                                    </td>
                                    <!-- Seat amount -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ isset($invalidRow['cantidad_de_asientos']) ? $invalidRow['cantidad_de_asientos'] : '---' }}
                                    </td>
                                    <!-- Base rate -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ isset($invalidRow['tarifa_base']) ? $invalidRow['tarifa_base'] : '---' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- If there are duplicatedRows, then show them -->
            @if (count($duplicatedRows))
                <!-- Title -->
                <h3 class="text-2xl text-black font-semibold uppercase text-center" style="color: #333333">
                    Listado de viajes que se encuentran duplicados
                </h3>
                <!-- Table containing the duplicatedRows -->
                <div class="relative overflow-x-auto sm:rounded-lg">
                    <!-- Table -->
                    <table class="w-1/2 mx-auto text-sm text-left text-gray-500 dark:text-gray-400 mb-2">
                        <!-- Table header -->
                        <thead class="text-xs text-gray-700 uppercase bg-amber-600 dark:bg-gray-700 dark:text-gray-400"
                            style="background-color: #e4e6a8">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Origen
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Destino
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Cantidad de asientos
                                </th>
                                <th scope="col" class="px-6 py-3 text-white font-bold" style="color: #333333">
                                    Tarifa base
                                </th>
                            </tr>
                        </thead>
                        <!-- Table body -->
                        <tbody>
                            <!-- For each duplicatedRow, show it -->
                            @foreach ($duplicatedRows as $duplicatedRow)
                                <!-- Table row -->
                                <tr class="bg-yellow-400 border-b dark:bg-gray-900 dark:border-gray-700"
                                    style="background-color: #e4e6a8">
                                    <!-- Origin -->
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white"
                                        style="color: #333333">
                                        {{ $duplicatedRow['origen'] }}
                                    </th>
                                    <!-- Destination -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ $duplicatedRow['destino'] }}
                                    </td>
                                    <!-- Seat amount -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ $duplicatedRow['cantidad_de_asientos'] }}
                                    </td>
                                    <!-- Base rate -->
                                    <td class="px-6 py-4 text-white font-medium" style="color: #333333">
                                        {{ $duplicatedRow['tarifa_base'] }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    <!-- If there are no validRows, invalidRows or duplicatedRows, then show the form to upload the file -->
    @else
        <link rel="stylesheet" href="app.css">
        <div class="flex flex-col flex-1 justify-center items-center my-6">
            <!-- Button to return to the admin menu -->
            <div class="mb-12 mx-auto">
                <a class="px-6 py-3 bg-red-500 hover:bg-red-700 transition-all text-white font-semibold rounded-lg",
                    style="background-color: #FF6B6B" href="{{ route('menu') }}"
                    data-tooltip="Vuelve al menú de administrador" data-flow="right">Volver </a>
            </div>
            <!-- Form to upload the file -->
            <form class ="flex flex-col items-center w-1/2" action = "{{ route('routeCheck') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div>
                    <!-- Input to upload the file -->
                    <input name="document"
                        class="block w-full text-sm text-green-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file"
                        style="background-color: #FFFFFF" style="color:#333333">
                    <!-- Help text -->
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help" style="color: #333333">
                        Tipo de archivo soportado: .xlsx (max 5mb).</p>
                    <!-- Error message -->
                    @error('document')
                        <p class="bg-red-400 text-gray-200 font-semibold my-4 text-lg text-center text-white px-4 py-3 rounded-lg"
                            style="background-color: #ff8a80">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <!-- Success message -->
                @if (session('error'))
                    <div class="bg-red-400 text-gray-200 font-semibold my-4 text-lg text-center text-white px-4 py-3 rounded-lg"
                        style="background-color: #ff8a80">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Submit button -->
                <button class="lg:w-1/4 my-4 p-2 bg-green-400 rounded-sm text-white font-semibold" type="submit",
                    style="background-color: #2ECC71">
                    Importar rutas
                </button>
            </form>
        </div>
    @endif
@endsection
