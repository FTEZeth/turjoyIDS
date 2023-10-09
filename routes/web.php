 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('login', function () {
    return view('auth.login');
})->name('login');

Route::get('upload', function () {
    return view('auth.upload');
})->name('upload');

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

//ruta para el botón de subir archivo
//Route::get()
Route::post('/upload',[RouteController::class,'routeCheck'])->name('routes.check');
