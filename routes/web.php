<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\model_controllers\RouteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () { //vista de menú principal e inicio de la página

    return view('welcome');
})->name('home');

Route::get('login', function () { //Vista de iniciar sesión

    return view('auth.login');
})->name('login');








Route::middleware(['auth'])->group(function () {
    Route::get('menu', function () { //Vista de menú de administrador

        return view('admin_routes.menu');
    })->name('menu');
    Route::get('/upload-files', [RouteController::class, 'indexAddRoutes'])->name('upload'); //vista de subir archivo
    Route::post('/upload', [RouteController::class,'routeCheck'])->name('routeCheck'); //botón de subir archivo
    Route::get('/result/route', [RouteController::class, 'indexRoutes'])->name('indexRoutes'); //Resultados de rutas
    Route::get('logout', [AuthController::class, 'logout'])->name('logout'); //Botón de cerrar sesión y dirigir al menú principal
});

Route::post('login', [AuthController::class, 'login'])->name('authLogin'); //Botón de iniciar sesión

