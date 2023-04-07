<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;

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
});
Route::get('/', [App\Http\Controllers\QrcodeController::class, 'index']);
Route::post('/post', [App\Http\Controllers\QrcodeController::class, 'post'])->name('post');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


route::get('/home', [HomeController::class, 'homeSiswa'])->name('homeSiswa')->middleware('auth');
route::get('/home/guru', [HomeController::class, 'homeGuru'])->name('homeGuru')->middleware('auth');
route::get('/home/admin', [HomeController::class, 'homeAdmin'])->name('homeAdmin')->middleware('auth');

// Route::group(['middleware' => ['auth', 'cekRole:siswa']], function() {
//     // route::get('/home', [HomeController::class, 'homeSiswa'])->name('homeSiswa')->middleware('auth');
// });