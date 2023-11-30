<?php

use App\Http\Controllers\AkomodasiController;
use App\Http\Controllers\AsnController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\JenisTugasController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\TiketPergiController;
use App\Http\Controllers\TiketPulangController;
use App\Http\Controllers\UangHarianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::resource('/user', UserController::class);
    Route::resource('/asn', AsnController::class);
    Route::resource('/golongan', GolonganController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/sppd', SppdController::class);
    Route::resource('/jenis', JenisTugasController::class);
    Route::resource('/surat', SuratTugasController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::get('/surat/{sppd}/detail', [SuratTugasController::class, 'showDetail'])->name('surat.detail');
    Route::resource('/uang', UangHarianController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::resource('/akomodasi', AkomodasiController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::resource('/pergi', TiketPergiController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::resource('/pulang', TiketPulangController::class)->parameters([
        'sppd' => 'id',
    ]);
    Route::put('/resetpassword/{user}', [UserController::class, 'resetPasswordAdmin'])->name('resetpassword.resetPasswordAdmin')->middleware('auth');
});
