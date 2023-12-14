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

//Route for the home page
Route::get('/', [RouteController::class, 'homeIndex'])->name('home');
//Route for obtaining origins
Route::get('/get/origins', [RouteController::class, 'obtainOrigins']);
//Route for obtaining destinations given an origin
Route::get('/get/destinations/{origin}', [RouteController::class, 'searchDestinations']);
//Route for obtaining seats given an origin and destination
Route::get('/get/route/{origin}/{destination}/{date}', [RouteController::class, 'seats']);
Route::get('/check', [RouteController::class, 'checkRoute'])->name('travels.check');
//Route for login
Route::get('login', function () {
    return view('auth.login');
})->name('login');

//Route for making a reservation
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservationStore');
//Route for redirecting to the home page if the user tries to access the reservation page
Route::get('/reservation', function () {
    return redirect('/');
});

//Route for obtaining a reservation given a code
Route::get('/get/reservation-by-code', [ReservationController::class, 'searchReservation'])->name('searchReservation');
//Route for showing the voucher of a reservation
Route::get('/voucher', [ReservationController::class, 'showVoucher'])->name('showVoucher')->middleware('redirectOnRefresh');

//Routes for the admin panel
Route::middleware(['auth'])->group(function () {
    //Route for the admin panel
    Route::get('menu', function () {
        return view('admin_routes.menu');
    })->name('menu');
    //Route for creating rows variables
    Route::get('/upload-files', [RouteController::class, 'indexAddRoutes'])->name('upload');
    //Route for checking the routes uploaded
    Route::post('/upload', [RouteController::class, 'routeCheck'])->name('routeCheck');
    //Route for sending the routes to the view
    Route::get('/result/route', [RouteController::class, 'indexRoutes'])->name('indexRoutes');
    //Route for logout button
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    //Route for showing the reservations
    Route::get('/reservation/report', [ReservationController::class, 'reportIndex'])->name('reservationReport');
    //Route for searching reservations by date
    Route::get('/search-reservation', [ReservationController::class, 'searchToDate'])->name('searchToDate');
});

//Routes for the auth
Route::post('login', [AuthController::class, 'login'])->name('authLogin');
//Route for downloading the voucher of a reservation
Route::get('download-pdf/{id}', [ReservationController::class, 'downloadPDF'])->name('pdf.download');

//Route for showing the error page
Route::fallback(function () {
    return view('error/error');
});
