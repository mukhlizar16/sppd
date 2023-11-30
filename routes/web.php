<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsnController;
use App\Http\Controllers\SppdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GolonganController;
use App\Http\Controllers\AkomodasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisTugasController;
use App\Http\Controllers\SuratTugasController;
use App\Http\Controllers\TiketPergiController;
use App\Http\Controllers\UangHarianController;
use App\Http\Controllers\TiketPulangController;

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
    $title = __('Welcome');
    return view('welcome', compact('title'));
});

Route::get('/dashboard', function () {
    $title = __('Dashboard');
    return view('dashboard', compact('title'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/asn', AsnController::class);
    Route::resource('/golongan', GolonganController::class);
    Route::resource('/pegawai', PegawaiController::class);
    Route::resource('/sppd', SppdController::class);
    Route::resource('/jenis', JenisTugasController::class);
    Route::resource('/surat', SuratTugasController::class)->parameters([
        'sppd' => 'id',
    ]);
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
require __DIR__ . '/auth.php';
