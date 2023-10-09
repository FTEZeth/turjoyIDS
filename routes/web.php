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


Route::middleware('auth')->group(function () {

});

Route::post('login', [AuthController::class, 'login'])->name('auth.login');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('upload-files', function () {
    return view('admin_routes.index');
})->name('upload');
