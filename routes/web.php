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

// Route::group(['middleware' => ['role:user|super admin|admin|project manager|analyst|designer database|designer ui/ux|programmer|implementator|quality control|designer database']], function () {
//     Route::get('/main-menu', [DashboardController::class, 'index']);
//     Route::resource('main-menu/proyek', ProjectController::class);
//     // Route::resource('main-menu/proyek', ProjectController::class)->parameters([
//     //     'proyek' => 'slug'
//     // ]);
//     // Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class);
//     Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class)->parameters([
//         'slug' => 'slug',
//         'task' => 'slug',
//     ]);
//     Route::prefix('/main-menu/proyek/{proyek}/modul/{modul}')->group(function () {
//         Route::resource('/tugas', ProjectTaskController::class)->parameters([
//             'tugas' => 'id'
//         ]);
//     });
//     Route::resource('/main-menu/tugas', TugasController::class);
//     Route::resource('/main-menu/role', RoleController::class);
//     Route::resource('/main-menu/user', UserController::class);
//     Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
//     Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
//     Route::resource('/main-menu/kolaborator', UserProyekController::class);
//     Route::put('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'update'])->name('kolaborator.update');
//     Route::resource('/proyektugas', ProjectModulController::class);

//     Route::resource('/main-menu/proyek/{slug}/modul/{modul}/tugas', ProjectTaskController::class)->parameters([
//         'tugas' => 'tugas',
//     ]);
//     Route::get('/main-menu/tugas', function () {
//         return view('tugas');
//     });
//     Route::post('/logout', [LoginController::class, 'logout']);
//     Route::get('/detailtugas', function () {
//         return view('detailtugas');
//     });
// });

Route::group(['middleware' => ['role:user|super admin|admin|project manager|analyst|designer database|designer ui/ux|programmer|implementator|quality control|designer database']], function () {

    Route::get('/main-menu', [DashboardController::class, 'index']);

    // Proyek
      Route::resource('main-menu/proyek', ProjectController::class)->parameters([
        'proyek' => 'slug'
    ]);
    Route::get('/download/{filename}', 'DownloadController@download')->name('download');
    // Route::get('/main-menu/proyek', [ProjectController::class, 'index']);
    // Route::get('/main-menu/proyek/create', [ProjectController::class, 'create']);
    // Route::post('/main-menu/proyek', [ProjectController::class, 'store']);
    // Route::get('/main-menu/proyek/{slug}', [ProjectController::class, 'show']);
    // Route::get('/main-menu/proyek/{slug}/edit', [ProjectController::class, 'edit']);
    // Route::put('/main-menu/proyek/{slug}', [ProjectController::class, 'update']);
    // Route::delete('/main-menu/proyek/{slug}', [ProjectController::class, 'destroy']);

    // Modul
    Route::resource('/main-menu/proyek/{slug}/modul', ProjectModulController::class);
    // Route::get('/main-menu/proyek/{slug}/modul', [ProjectModulController::class, 'index']);
    // Route::get('/main-menu/proyek/{slug}/modul/create', [ProjectModulController::class, 'create'])->middleware('checkRoleCollaborators:buat modul');
    // Route::post('/main-menu/proyek/{slug}/modul', [ProjectModulController::class, 'store'])->middleware('checkRoleCollaborators:buat modul');
    // Route::get('/main-menu/proyek/{slug}/modul/{modul}', [ProjectModulController::class, 'show'])->middleware('checkRoleCollaborators:lihat modul');
    // Route::get('/main-menu/proyek/{slug}/modul/{modul}/edit', [ProjectModulController::class, 'edit'])->middleware('checkRoleCollaborators:edit modul');
    // Route::put('/main-menu/proyek/{slug}/modul/{modul}', [ProjectModulController::class, 'update'])->middleware('checkRoleCollaborators:edit modul');
    // Route::delete('/main-menu/proyek/{slug}/modul/{modul}', [ProjectModulController::class, 'destroy'])->middleware('checkRoleCollaborators:hapus modul');

    // Tugas
    Route::get('/main-menu/tugas', [TugasController::class, 'index']);
    Route::resource('/main-menu/proyek/{slug}/modul/{modul}/tugas', ProjectTaskController::class);
    // Route::get('/main-menu/proyek/{slug}/modul/{modul}/tugas/create', [ProjectTaskController::class, 'create'])->middleware('checkRoleCollaborators:buat tugas');
    // Route::post('/main-menu/proyek/{slug}/modul/{modul}/tugas', [ProjectTaskController::class, 'store'])->middleware('checkRoleCollaborators:buat tugas');
    // Route::get('/main-menu/proyek/{slug}/modul/{modul}/tugas/{tugas}', [ProjectTaskController::class, 'show'])->middleware('checkRoleCollaborators:lihat tugas');
    // Route::get('/main-menu/proyek/{slug}/modul/{modul}/tugas/{tugas}/edit', [ProjectTaskController::class, 'edit'])->middleware('checkRoleCollaborators:edit tugas');
    // Route::put('/main-menu/proyek/{slug}/modul/{modul}/tugas/{tugas}', [ProjectTaskController::class, 'update'])->middleware('checkRoleCollaborators:edit tugas');
    // Route::delete('/main-menu/proyek/{slug}/modul/{modul}/tugas/{tugas}', [ProjectTaskController::class, 'destroy'])->middleware('checkRoleCollaborators:hapus tugas');

    // Role
    Route::resource('/main-menu/role', RoleController::class);
    Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
    Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);


    // User
    Route::resource('/main-menu/user', UserController::class);

    // Kolaborator (assuming it's for managing collaborators)
    // Route::get('/main-menu/kolaborator', [UserProyekController::class, 'index'])->middleware('permission:lihat kolaborator');
    // Route::put('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'update'])->middleware('permission:edit kolaborator');
    // Route::delete('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'destroy'])->middleware('permission:hapus kolaborator');

    // Lainnya
    Route::post('/logout', [LoginController::class, 'logout']);
    // Route::get('/detailtugas', function () {
    //     return view('detailtugas');
    // });
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/main-menu', [DashboardController::class, 'index']);

// // Proyek
// Route::get('/main-menu/proyek', [ProjectController::class, 'index'])->middleware('checkRoleCollaborators:lihat proyek');
// Route::get('/main-menu/proyek/create', [ProjectController::class, 'create'])->middleware('checkRoleCollaborators:buat proyek');
// Route::post('/main-menu/proyek', [ProjectController::class, 'store'])->middleware('checkRoleCollaborators:buat proyek');
// Route::get('/main-menu/proyek/{slug}', [ProjectController::class, 'show'])->middleware('checkRoleCollaborators:lihat proyek');
// Route::get('/main-menu/proyek/{slug}/edit', [ProjectController::class, 'edit'])->middleware('checkRoleCollaborators:edit proyek');
// Route::put('/main-menu/proyek/{slug}', [ProjectController::class, 'update'])->middleware('checkRoleCollaborators:edit proyek');
// Route::delete('/main-menu/proyek/{slug}', [ProjectController::class, 'destroy'])->middleware('checkRoleCollaborators:hapus proyek');

// // Modul
// Route::get('/main-menu/proyek/{slug}/modul', [ProjectModulController::class, 'index'])->middleware('checkRoleCollaborators:lihat modul');
// Route::get('/main-menu/proyek/{slug}/modul/create', [ProjectModulController::class, 'create'])->middleware('checkRoleCollaborators:buat modul');
// Route::post('/main-menu/proyek/{slug}/modul', [ProjectModulController::class, 'store'])->middleware('checkRoleCollaborators:buat modul');
// Route::get('/main-menu/proyek/{slug}/modul/{modul}', [ProjectModulController::class, 'show'])->middleware('checkRoleCollaborators:lihat modul');
// Route::get('/main-menu/proyek/{slug}/modul/{modul}/edit', [ProjectModulController::class, 'edit'])->middleware('checkRoleCollaborators:edit modul');
// Route::put('/main-menu/proyek/{slug}/modul/{modul}', [ProjectModulController::class, 'update'])->middleware('checkRoleCollaborators:edit modul');
// Route::delete('/main-menu/proyek/{slug}/modul/{modul}', [ProjectModulController::class, 'destroy'])->middleware('checkRoleCollaborators:hapus modul');

// // Tugas
// Route::get('/main-menu/tugas', [TugasController::class, 'index'])->middleware('checkRoleCollaborators:lihat tugas');
// Route::get('/main-menu/tugas/create', [TugasController::class, 'create'])->middleware('checkRoleCollaborators:buat tugas');
// Route::post('/main-menu/tugas', [TugasController::class, 'store'])->middleware('checkRoleCollaborators:buat tugas');
// Route::get('/main-menu/tugas/{tugas}', [TugasController::class, 'show'])->middleware('checkRoleCollaborators:lihat tugas');
// Route::get('/main-menu/tugas/{tugas}/edit', [TugasController::class, 'edit'])->middleware('checkRoleCollaborators:edit tugas');
// Route::put('/main-menu/tugas/{tugas}', [TugasController::class, 'update'])->middleware('checkRoleCollaborators:edit tugas');
// Route::delete('/main-menu/tugas/{tugas}', [TugasController::class, 'destroy'])->middleware('checkRoleCollaborators:hapus tugas');

// // Role
// Route::get('/main-menu/role', [RoleController::class, 'index'])->middleware('permission:lihat role');
// Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole'])->middleware('permission:buat role');
// Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole'])->middleware('permission:edit role');
// Route::delete('/main-menu/role/{roleId}', [RoleController::class, 'destroy'])->middleware('permission:hapus role');

// // User
// Route::get('/main-menu/user', [UserController::class, 'index'])->middleware('permission:lihat user');
// Route::get('/main-menu/user/create', [UserController::class, 'create'])->middleware('permission:buat user');
// Route::post('/main-menu/user', [UserController::class, 'store'])->middleware('permission:buat user');
// Route::get('/main-menu/user/{user}', [UserController::class, 'show'])->middleware('permission:lihat user');
// Route::get('/main-menu/user/{user}/edit', [UserController::class, 'edit'])->middleware('permission:edit user');
// Route::put('/main-menu/user/{user}', [UserController::class, 'update'])->middleware('permission:edit user');
// Route::delete('/main-menu/user/{user}', [UserController::class, 'destroy'])->middleware('permission:hapus user');

// // Kolaborator (assuming it's for managing collaborators)
// Route::get('/main-menu/kolaborator', [UserProyekController::class, 'index'])->middleware('permission:lihat kolaborator');
// Route::put('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'update'])->middleware('permission:edit kolaborator');
// Route::delete('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'destroy'])->middleware('permission:hapus kolaborator');

// // Lainnya
// Route::post('/logout', [LoginController::class, 'logout']);
// Route::get('/detailtugas', function () {
//     return view('detailtugas');
// });
// });


Route::get('/about', function () {
    return view('aboutus');
});
