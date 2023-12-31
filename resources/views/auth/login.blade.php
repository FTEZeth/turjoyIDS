@extends('layouts.app')

@section('title')
    Iniciar Sesión
@endsection


@section('content')
    <div class="flex items-center justify-center h-screen">
        <div class="bg-gray-200 p-6 mx-auto rounded-lg lg:w-1/4" style="background-color: #eaeaea">
            <h3 class="font-bold text-2xl text-center text-blue-500 uppercase mb-4" style="color: #0474DA;">Inicia sesión en
                Turjoy</h3>
            <form class="w-full" action="{{ route('authLogin') }}" method="POST" novalidate>
                @csrf
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white"
                        style="color: #333333">
                        Correo electrónico
                    </label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        style="background-color: #FFFFFF">
                    @error('email')
                        <p class="bg-red-400 font-semibold text-lg text-white p-2 my-2 rounded-lg text-center"
                            style="background-color: #ff8a80" style="color: #ffffff">{{ $message }} </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white"
                        style="color: #333333">
                        Contraseña
                    </label>
                    <input type="password" id="password" name="password"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        required style="background-color: #FFFFFF">
                    @error('password')
                        <p class="bg-red-400 font-semibold text-lg text-white p-2 my-2 rounded-lg text-center"
                            style="background-color: #ff8a80" style="color: #ffffff">{{ $message }}</p>
                    @enderror
                </div>

                @if (session('message'))
                    <p class="bg-red-400 font-semibold text-lg text-white p-2 my-2 rounded-lg text-center"
                        style="background-color: #ff8a80">{{ session('message') }}</p>
                @endif

                <div>
                    <input type="submit" value="Iniciar Sesión"
                    class="text-white bg-green-500 hover:cursor-pointer hover:bg-emerald-800 font-medium rounded-lg text-sm w-full p-3 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800",
                    style="background-color: #2ECC71;">
                </div>
            </form>
        </div>
    </div>
@endsection
