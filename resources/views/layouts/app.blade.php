<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css','resources/js/app.js')
    <title>Turjoy   </title>
</head>


<body>

    <nav class="bg-blue-500 text-white border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-screen-xl mx-auto flex justify-between items-center p-4">
            <a href="{{ route('home') }}" class="flex items-center space-x-8">
                <img src="{{ asset('images/logoTurjoyCambioCliente.png') }}" class="h-14 w-25" alt="LogoTurjoy" />
            </a>
            <div class="hidden md:flex space-x-8">
                <ul class="flex space-x-8 font-medium">
                    @auth
                        <li>
                            <a href="{{ route('logout') }}" class="hover:text-gray-200 hover:bg-gray-100 rounded px-3 py-2 transition">Cerrar sesión</a>
                        </li>
                        <li>
                            <a href="{{ route('upload') }}" class="hover:text-gray-200 hover:bg-gray-100 rounded px-3 py-2 transition">Subir rutas</a>
                        </li>
                    @endauth

                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="hover:text-gray-200 hover:bg-gray-100 rounded px-3 py-2 transition">Iniciar Sesión</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


  <main>
    @yield('content')
  </main>

</body>
</html>
