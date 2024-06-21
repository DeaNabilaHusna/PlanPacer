<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\UserProyekController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
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
// PIC Route
Route::middleware(['auth', 'checkRole:pic,analyst,programmer'])->group(function () {
    Route::resource('/main-menu/kolaborator', UserProyekController::class);
    Route::put('/main-menu/kolaborator/{kolaborator}', [UserProyekController::class, 'update'])->name('kolaborator.update');
    // Route::put('/main-menu/kolaborator/{kolaborator}', function($kolaborator) {
    //     return response('Update method reached', 200);
    // })->name('kolaborator.update');
    Route::resource('/main-menu/role', RoleController::class);
    // Route::resource('/main-menu/proyek', ProyekController::class);
    Route::resource('main-menu/proyek', ProyekController::class)->parameters([
        'proyek' => 'slug'
    ])->except(['show']);
    Route::get('/main-menu/proyek/{slug}', [ProyekController::class, 'show'])->name('proyek.show');
    // // Route::get('/main-menu/proyek', [ProyekController::class, 'index'])->middleware('check.role:pic');
    // // Route::get('/main-menu/proyek/create', [ProyekController::class, 'create'])->middleware('check.role:admin');
    // // Route::post('/main-menu/proyek', [ProyekController::class, 'store'])->middleware('check.role:pic');
    // Route::get('/main-menu/proyek/{nama_proyek}', [ProyekController::class, 'show'])->middleware('permission:view proyek');
    // // Route::get('/main-menu/proyek/{proyek}/edit', [ProyekController::class, 'edit'])->middleware('check.role:admin');
    // // Route::put('/main-menu/proyek/{proyek}', [ProyekController::class, 'update'])->middleware('check.role:pic');
    // // Route::delete('/main-menu/proyek/{proyek}', [ProyekController::class, 'destroy'])->middleware('check.role:admin');
    Route::resource('/proyektugas', ProyekTugasController::class);
    Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
    Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
    Route::get('/main-menu', [DashboardController::class, 'index']);
    Route::resource('/main-menu/proyek/{slug}/tugas', ProyekTugasController::class);

    // Route::get('/main-menu/proyek/{nama_proyek}/tugas/create', [ProyekTugasController::class, 'create']);

    Route::get('/main-menu/tugas', function () {
        return view('tugas');
    });
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/detailtugas', function () {
        return view('detailtugas');
    });
});

// Route::middleware(['auth', 'checkRoleCollaborators:analyst'])->group(function () {
//     Route::resource('/main-menu/proyek', ProyekController::class)->except(['show']);
//     // Route::get('/main-menu/proyek', [ProyekController::class, 'index'])->middleware('check.role:pic');
//     // Route::get('/main-menu/proyek/create', [ProyekController::class, 'create'])->middleware('check.role:admin');
//     // Route::post('/main-menu/proyek', [ProyekController::class, 'store'])->middleware('check.role:pic');
//     Route::get('/main-menu/proyek/{proyek}', [ProyekController::class, 'show'])->middleware('permission:view proyek');
//     Route::resource('/main-menu/proyek/{nama_proyek}/tugas', ProyekTugasController::class);
// });
// Route::group(['middleware' => ['auth', 'checkRoleCollaborators:analyst']], function () {
//      // Rute GET untuk mengambil detail proyek
//      Route::get('/main-menu/proyek/{proyek}', [ProyekController::class, 'show'])
//      ->name('proyek.show');
 
//  // Rute PUT untuk memperbarui detail proyek
//  Route::put('/main-menu/proyek/{proyek}', [ProyekController::class, 'update'])
//      ->name('proyek.update');
// });

Route::get('/about', function () {
    return view('aboutus');
});

Route::get('/tambahproyektugas', function () {
    return view('tambahproyektugas');
});

Route::get('/editproyektugas', function () {
    return view('editproyektugas');
});

// Route::resource('/hak-akses', PermissionController::class)->parameters([
    //     'hak_akses' => 'permission:name'
    // ]);
    // Route::group(['middleware' => ['role:pic']], function () {

//     Route::group(['middleware' => ['auth'], 'as' => 'pic'], function () {
//     Route::resource('/main-menu/kolaborator', UserProyekController::class);
//     Route::resource('/main-menu/role', RoleController::class);
//     Route::resource('/main-menu/proyek', ProyekController::class);
//     Route::resource('/proyektugas', ProyekTugasController::class);
//     Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
//     Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
//     Route::get('/main-menu', [DashboardController::class, 'index']);
//     Route::resource('/main-menu/proyek/{nama_proyek}/tugas', ProyekTugasController::class);
//     // Route::get('/main-menu/proyek/{nama_proyek}/tugas/create', [ProyekTugasController::class, 'create']);
//     Route::get('/main-menu/tugas', function () {
//         return view('tugas');
//     });
//     Route::post('/logout', [LoginController::class, 'logout']);
//     Route::get('/detailtugas', function () {
//         return view('detailtugas');
//     });
// });


// Route::get('/proyektugas', function () {
//     return view('proyektugas');
// });




// Route::group(['middleware' => ['checkRole:pic']], function () {
//     Route::resource('/main-menu/kolaborator', UserProyekController::class);
//     Route::resource('/main-menu/role', RoleController::class);
//     Route::resource('/main-menu/proyek', ProyekController::class);
//     // Route::put('/main-menu/proyek/{proyek}/update', [ProyekController::class, 'update'])
//     // ->middleware('permission:update proyek');
//     Route::resource('/proyektugas', ProyekTugasController::class);
//     Route::get('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'addPermissionsToRole']);
//     Route::put('/main-menu/role/{roleId}/tambah-hak-akses', [RoleController::class, 'updatePermissionsToRole']);
//     Route::get('/main-menu', [DashboardController::class, 'index']);
//     Route::resource('/main-menu/proyek/{nama_proyek}/tugas', ProyekTugasController::class);
//     // Route::get('/main-menu/proyek/{nama_proyek}/tugas/create', [ProyekTugasController::class, 'create']);
//     Route::get('/main-menu/tugas', function () {
//         return view('tugas');
//     });
//     Route::post('/logout', [LoginController::class, 'logout']);
//     Route::get('/detailtugas', function () {
//         return view('detailtugas');
//     });
// });



