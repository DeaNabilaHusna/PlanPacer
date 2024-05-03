<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserProyekController;
use App\Http\Controllers\ProyekTugasController;

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
// Route::resource('/hak-akses', PermissionController::class)->parameters([
//     'hak_akses' => 'permission:name'
// ]);

// PIC Route
Route::middleware(['auth', 'checkRole:pic'])->group(function () {
    Route::resource('/main-menu/role', RoleController::class);
    Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
    Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
    Route::resource('/main-menu/kolaborator', UserProyekController::class);
    Route::resource('/main-menu/proyek', ProyekController::class);
    Route::get('/main-menu', [DashboardController::class, 'index']);
    Route::resource('/proyektugas', ProyekTugasController::class);
    Route::get('/main-menu/tugas', function () {
        return view('tugas');
    });
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/detailtugas', function () {
        return view('detailtugas');
    });
});


Route::get('/about', function () {
    return view('aboutus');
});

// Route::get('/proyektugas', function () {
//     return view('proyektugas');
// });

Route::get('/tambahproyektugas', function () {
    return view('tambahproyektugas');
});

Route::get('/editproyektugas', function () {
    return view('editproyektugas');
});
