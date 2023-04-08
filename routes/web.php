<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\QrCodeController;

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
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/qrcode', function () {
    return view('qrcode');
});

Route::get('/qrcode-generate', function () {
    $qrCode = new \SimpleSoftwareIO\QrCode\Facades\QrCode();
    $qrCode->size(500);
    $qrCode->format('png');
    $qrCode->generate('https://example.com', public_path('images/qrcode.png'));

    return redirect('/qrcode');
});


Route::group(['middleware' => ['auth', 'cekRole:siswa']], function() {
    route::get('/home', [HomeController::class, 'homeSiswa'])->name('homeSiswa')->middleware('auth');
    Route::get('/scan', [App\Http\Controllers\QrcodeController::class, 'index'])->name('scan')->middleware('auth');
    Route::post('/post', [App\Http\Controllers\QrcodeController::class, 'post'])->name('post')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'cekRole:guru']], function() {
    route::get('/home/guru', [HomeController::class, 'homeGuru'])->name('homeGuru')->middleware('auth');
});

Route::group(['middleware' => ['auth', 'cekRole:admin']], function() {
    route::get('/home/admin', [HomeController::class, 'homeAdmin'])->name('homeAdmin')->middleware('auth');
    Route::get('/managementUser', [ManagementController::class, 'index'])->name('managementUser')->middleware('auth');
    Route::get('/registerGuru', [ManagementController::class, 'tambah'])->name('registerGuru')->middleware('auth');
    Route::post('/registerGuru', [ManagementController::class, 'store'])->middleware('auth');
    Route::get('/editUser/{id}', [ManagementController::class, 'editUser'])->name('editUser')->middleware('auth');
    Route::get('/updateUser/{id}', [ManagementController::class, 'updateUser'])->name('updateUser');
    Route::get('/hapusUser/{id}', [ManagementController::class, 'hapusUser'])->name('hapusUser')->middleware('auth');
});

