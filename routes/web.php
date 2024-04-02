<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [LandingController::class, 'index']);
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/registrasi', [RegisterController::class, 'index']);
    Route::post('/registrasi', [RegisterController::class, 'store']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/main-menu', [DashboardController::class, 'index']);
    // Route::get('/main-menu/proyek', function () {
    //     return view('proyek');
    // });
    Route::resource('/main-menu/proyek', ProyekController::class);
    // Route::resource('/main-menu/proyek/PlanPacer', ProyekController::class);
    Route::get('/main-menu/tugas', function () {
        return view('tugas');
    });
    Route::post('/logout', [LoginController::class, 'logout']);
});
