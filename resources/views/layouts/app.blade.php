<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css', 'resources/js/app.js')
    <title>Turjoy</title>
</head>

<body>
    <nav class="border-gray-200 bg-blue-500 dark:bg-gray-800 dark:border-gray-700"
        style="background-color: #0A74DA; color: white;">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/TurjoyLogoSi.png') }}" class="h-14 w-20 ml-8 mr-8" alt="LogoTurjoy" />
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
                <ul
                    class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-transparent dark:bg-gray-800 md:dark:bg-transparent dark:border-gray-700">

                    @auth
                        <li>
                            <a href="{{ route('logout') }}"
                                class="block py-2 pl-3 pr-4 text-white hover:text-gray-200 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Cerrar
                                sesión</a>
                        </li>

                        <li>
                            @if (Route::currentRouteName() !== 'menu')
                                <a href="{{ route('menu') }}"
                                    class="block py-2 pl-3 pr-4 text-white hover:text-gray-200 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Menú
                                    Administrador</a>
                            @endif
                        </li>
                    @endauth

                    @guest
                        <li>
                            <a href="{{ route('login') }}"
                                class="block py-2 pl-3 pr-4 text-white hover:text-gray-200 rounded hover:bg-#333333 bg-#f4f4f4 md:border-0 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Iniciar
                                Sesión</a>
                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
@yield('js')
</body>

</html>

