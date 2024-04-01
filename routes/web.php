<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;

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
// Route::get('/', function () {
//     return view('landing');
// });
Route::get('/', [LandingController::class,'index'])->middleware('guest')
;
Route::get('/login', [LoginController::class,'index']);
Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class,'logout']);
Route::get('/registrasi', [RegisterController::class,'index']);
Route::post('/registrasi', [RegisterController::class,'store']);
Route::get('/main-menu', [DashboardController::class,'index']);

Route::get('/proyek', function () {
    return view('proyek');
});
Route::get('/tugas', function () {
    return view('tugas');
});