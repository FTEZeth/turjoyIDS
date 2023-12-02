<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\model_controllers\RouteController;
use App\Http\Controllers\model_controllers\ReservationController;

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


Route::get('/', [RouteController::class, 'homeIndex'])->name('home');
Route::get('/get/origins', [RouteController::class, 'obtainOrigins']);
Route::get('/get/destinations/{origin}', [RouteController::class, 'searchDestinations']);
Route::get('/get/route/{origin}/{destination}/{date}', [RouteController::class, 'seats']);
Route::get('/check', [RouteController::class, 'checkRoute'])->name('travels.check');
Route::get('login', function () {return view('auth.login');})->name('login');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservationStore');
Route::get('/reservation', function() {return redirect('/');});


Route::get('/get/reservation-by-code', [ReservationController::class, 'searchReservation'])->name('searchReservation');
Route::get('/voucher', [ReservationController::class, 'showVoucher'])->name('showVoucher')->middleware('redirectOnRefresh');

Route::middleware(['auth'])->group(function () {
    Route::get('menu', function () {return view('admin_routes.menu');})->name('menu');//Vista de menú de administrador
    Route::get('/upload-files', [RouteController::class, 'indexAddRoutes'])->name('upload'); //vista de subir archivo
    Route::post('/upload', [RouteController::class, 'routeCheck'])->name('routeCheck'); //botón de subir archivo
    Route::get('/result/route', [RouteController::class, 'indexRoutes'])->name('indexRoutes'); //Resultados de rutas
    Route::get('logout', [AuthController::class, 'logout'])->name('logout'); //Botón de cerrar sesión y dirigir al menú principal
    Route::get('/reservation-report', [ReservationController::class, 'reportIndex'])->name('reservationReport'); //Vista de reporte de reservas
});

Route::post('login', [AuthController::class, 'login'])->name('authLogin'); //Botón de iniciar sesión
