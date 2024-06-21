<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use App\Models\Proyek;
use App\Models\UserProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Symfony\Component\HttpFoundation\Response;

class checkRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $roles): Response
    // {
    //     $roles = array('pic', 'analyst', 'designer', 'programmer', 'mentor', 'client');
    //     if (!auth()->check()) {
    //         return redirect()->route('login');
    //     }

    //     $user = auth()->user();

    //     foreach ($roles as $role) {
    //         if ($user->role === $role) {
    //             return $next($request);
    //         }
    //     }

    //     return redirect()->route('unauthorized');
    // }




    // BATAS DIPAKAI
    // public function handle(Request $request, Closure $next, $role): Response
    // {
    //     if (!auth()->check()) {
    //         return redirect()->route('login');
    //     }

    //     $user = auth()->user();

    //     if ($user->role === $role) {
    //         Log::info('Authorization successful for user ID: ' . auth()->id());
    //         return $next($request);
    //     }

    //     return redirect()->route('unauthorized');
    // }

    // END BATAS 
    // public function handle($request, Closure $next, $role)
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login');
    //     }
    //     // Ambil nama proyek dari route jika ada
    //     $projectName = $request->route('nama_proyek');

    //     // Jika tidak ada nama proyek (misalnya route tanpa parameter nama_proyek)
    //     if (!$projectName) {
    //         return $next($request); // Lanjutkan ke request berikutnya
    //     }

    //     $userId = Auth::id();

    //     // Cari proyek berdasarkan nama jika nama_proyek ada di URL
    //     $project = Proyek::where('nama_proyek', $projectName)->first();

    //     // Jika proyek tidak ditemukan
    //     if (!$project) {
    //         Log::warning('Project not found: ' . $projectName);
    //         return redirect()->route('unauthorized');
    //     }

    //     // Periksa apakah pengguna memiliki akses ke proyek dan peran yang sesuai
    //     $hasRole = UserProyek::where('proyek_id', $project->id)
    //         ->where('assignee_user_id', $userId)
    //         ->where('role_id', $role)
    //         ->exists();

    //     if ($hasRole) {
    //         Log::info('Authorization successful for user ID: ' . auth()->id());
    //         return $next($request);
    //     }
    //     Log::warning('User does not have the right permissions: ' . auth()->id());
    //     // return redirect()->route('unauthorized');
    //     return response()->json(['error' => 'Unauthorized'], 403);
    // }


    // PERCOBAAN 

    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userId = Auth::id();
        $projectName = $request->route('slug');

        // Jika tidak ada nama proyek, lanjutkan request
        if (!$projectName) {
            return $next($request);
        }

        // Ambil proyek berdasarkan nama_proyek
        $project = Proyek::where('slug', $projectName)->first();

        if (!$project) {
            Log::warning('Project not found: ' . $projectName);
            return redirect()->route('unauthorized');
        }

        // Cek apakah user adalah pemilik proyek
        if ($project->user_id == $userId) {
            return $next($request);
        }

        // Cek apakah user adalah kontributor dengan role yang diberikan
        $userProject = UserProyek::where('proyek_id', $project->id)
            ->where('assignee_user_id', $userId)
            ->first();

        if ($userProject && in_array($userProject->role_id, $roles)) {
            // Cek apakah user memiliki permission untuk route ini
            // Anda perlu mendefinisikan cara untuk mengecek permission berdasarkan route dan role
            $permissions = $this->getPermissionsForRole($userProject->role_id);
            if ($this->checkPermission($permissions, $request->route()->getName())) {
                return $next($request);
            } else {
                return response()->json(['error' => 'Permission Denied'], 403);
            }
        }

        // Jika user adalah kontributor tanpa role yang sesuai, hanya dapat mengakses detail proyek
        if ($userProject && !$userProject->role_id) {
            if ($request->route()->getName() == 'proyek.show') {
                return $next($request);
            }
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    private function getPermissionsForRole($roleId)
{
    // Ambil role berdasarkan ID
    $role = Role::findById($roleId);

    if (!$role) {
        return [];
    }

    // Ambil semua permissions untuk role ini
    $permissions = $role->permissions;

    // Kembalikan daftar nama permissions
    return $permissions->pluck('name')->toArray();
}

    private function checkPermission($permissions, $routeName)
    {
        // Cek apakah routeName ada dalam permissions
        // Implementasikan logika ini sesuai dengan kebutuhan Anda
        return in_array($routeName, $permissions);
    }
}
