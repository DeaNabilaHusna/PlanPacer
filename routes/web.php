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
use App\Http\Controllers\TugasController;


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

Route::group(['middleware' => ['role:super admin|admin|project manager|analyst|designer database|designer ui/ux|programmer|implementator|quality control|designer database']], function () {
    Route::get('/main-menu', [DashboardController::class, 'index']);
    Route::resource('main-menu/proyek', ProjectController::class);
    // Route::resource('main-menu/proyek', ProjectController::class)->parameters([
    //     'proyek' => 'slug'
    // ]);
    // Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class);
    Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class)->parameters([
        'slug' => 'slug',
        'task' => 'slug',
    ]);
    Route::prefix('/main-menu/proyek/{proyek}/modul/{modul}')->group(function () {
        Route::resource('/tugas', ProjectTaskController::class)->parameters([
            'tugas' => 'id'
        ]);
    });
    Route::resource('/main-menu/tugas', TugasController::class);
    Route::resource('/main-menu/role', RoleController::class);
    Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
    Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
    Route::resource('/main-menu/user', UserController::class);
    Route::resource('/main-menu/kolaborator', UserProyekController::class);
    Route::put('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'update'])->name('kolaborator.update');
    Route::resource('/proyektugas', ProjectModulController::class);

    Route::resource('/main-menu/proyek/{slug}/modul/{modul}/tugas', ProjectTaskController::class)->parameters([
        'tugas' => 'tugas',
    ]);
    Route::get('/main-menu/tugas', function () {
        return view('tugas');
    });
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/detailtugas', function () {
        return view('detailtugas');
    });
});


// PIC Route
// Route::middleware(['auth', 'checkRole:pic,analyst,programmer'])->group(function () {
//     Route::resource('/main-menu/kolaborator', UserProyekController::class);
//     Route::put('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'update'])->name('kolaborator.update');
//     // Route::put('/main-menu/kolaborator/{kolaborator}', function($kolaborator) {
//     //     return response('Update method reached', 200);
//     // })->name('kolaborator.update');
//     Route::resource('/main-menu/role', RoleController::class);
//     Route::resource('/main-menu/user', UserController::class);

//     // Route::resource('/main-menu/proyek', ProyekController::class);
//     Route::resource('main-menu/proyek', ProjectController::class)->parameters([
//         'proyek' => 'slug'
//     ])->except(['show']);
//     Route::get('/main-menu/proyek/{slug}', [ProjectController::class, 'show'])->name('proyek.show');
//     // // Route::get('/main-menu/proyek', [ProyekController::class, 'index'])->middleware('check.role:pic');
//     // // Route::get('/main-menu/proyek/create', [ProyekController::class, 'create'])->middleware('check.role:admin');
//     // // Route::post('/main-menu/proyek', [ProyekController::class, 'store'])->middleware('check.role:pic');
//     // Route::get('/main-menu/proyek/{nama_proyek}', [ProyekController::class, 'show'])->middleware('permission:view proyek');
//     // // Route::get('/main-menu/proyek/{proyek}/edit', [ProyekController::class, 'edit'])->middleware('check.role:admin');
//     // // Route::put('/main-menu/proyek/{proyek}', [ProyekController::class, 'update'])->middleware('check.role:pic');
//     // // Route::delete('/main-menu/proyek/{proyek}', [ProyekController::class, 'destroy'])->middleware('check.role:admin');
//     Route::resource('/proyektugas', ProjectModulController::class);
//     Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
//     Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
//     Route::get('/main-menu', [DashboardController::class, 'index']);
//     // Route::resource('/main-menu/proyek/{slug}/tugas', ProjectModulController::class);
//     Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class)->parameters([
//         'slug' => 'slug',
//         'task' => 'slug',
//     ]);
//     // Route::resource('/main-menu/proyek/{slug}/modul/{modul}/tugas', TugasItemController::class);

//     Route::resource('/main-menu/proyek/{slug}/modul/{modul}/tugas', ProjectTaskController::class)->parameters([
//         'tugas' => 'tugas',
//     ]);
//     Route::resource('/main-menu/tugas', TugasController::class);
//     // Route::resource('/main-menu/proyek/{slug}/modul/{modul_slug}', ProjectTaskController::class);
// //     Route khusus untuk TugasItem
// Route::prefix('/main-menu/proyek/{proyek}/modul/{modul}')->group(function () {
//     Route::resource('/tugas', ProjectTaskController::class)->parameters([
//         'tugas' => 'id'
//     ])->except(['create', 'store']);
// });
// // // Route khusus untuk create dan store dari TugasItem
// Route::post('/main-menu/proyek/{proyek}/modul/{modul}', [ProjectTaskController::class, 'store'])->name('tugas.store');
// Route::get('/main-menu/proyek/{proyek}/modul/{modul}/create', [ProjectTaskController::class, 'create'])->name('tugas.create');

//     // Route::resource('/main-menu/proyek/{slug}/modul/{tugas_slug}', ProjectTaskController::class);

//     Route::get('/main-menu/tugas', function () {
//         return view('tugas');
//     });
//     Route::post('/logout', [LoginController::class, 'logout']);
//     Route::get('/detailtugas', function () {
//         return view('detailtugas');
//     });
// });




Route::get('/about', function () {
    return view('aboutus');
});