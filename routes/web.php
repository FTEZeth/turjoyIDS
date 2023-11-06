<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Auth\TravelController;
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


Route::get('/',[RouteController::class, 'homeIndex'])->name('home');
Route::get('/get/origins', [RouteController::class, 'obtainOrigins']);
Route::get('/get/destinations/{origin}', [RouteController::class, 'searchDestinations']);
Route::get('/seating/{origin}/{destination}', [RouteController::class, 'seatings']);
Route::get('/check', [RouteController::class, 'checkRoute'])->name ('travels.check');
Route::get('login', function () {return view('auth.login');} )->name('login');

Route::middleware(['auth'])->group(function () {

    Route::get('/upload-files', [RouteController::class, 'indexAddRoutes'])->name('upload');
    Route::post('/upload', [RouteController::class,'routeCheck'])->name('routeCheck');
    Route::get('/result/route', [RouteController::class, 'indexRoutes'])->name('indexRoutes');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('login', [AuthController::class, 'login'])->name('authLogin');

