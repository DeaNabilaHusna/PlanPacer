<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserProyekController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectModulController;
use App\Http\Controllers\ProjectTaskController;
use App\Http\Controllers\ModulController;


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

Route::group(['middleware' => ['role:user|super admin|admin|project manager|analyst|designer database|designer ui/ux|programmer|implementator|quality control|designer database']], function () {

    Route::get('/main-menu', [DashboardController::class, 'index']);

    //Fitur Proyek
      Route::resource('main-menu/proyek', ProjectController::class)->parameters([
        'proyek' => 'slug'
    ]);

    //Fitur Modul
    Route::get('/main-menu/modul', [ModulController::class, 'index']);
    Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class);

    //Fitur Role
    Route::resource('/main-menu/role', RoleController::class);
    Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
    Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);

    //Fitur User
    Route::resource('/main-menu/user', UserController::class);

    // Lainnya
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::get('/about', function () {
    return view('aboutus');
});
