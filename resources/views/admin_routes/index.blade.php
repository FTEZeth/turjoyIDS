@extends('layouts.app')

@section('title')
    Cargar rutas de viaje
@endsection

@section('content')

    <form class ="flex flex-col items-center w-1/2" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <input name="document" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help"> Tipo de archivo soportado: .xlsx (5mb).</p>
            @error('document')
                <p class="bg-red-400 font-semibold my-4 text-lg text-center text-red-800 px-4 py-3 rounded-lg">
                    {{$message}}
                </p>
            @enderror
        </div>

        <button class="lg:w-1/4 my-4 p-2 bg-green-400 rounded-sm text-white font-semibold" type="submit">
            Importar rutas
        </button>

    </form>

@endsection
