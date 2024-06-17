<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkRoleCollaborators
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, $projectId, $roleId): Response
    // {
    // //     if (!Auth::check()) {
    // //         return redirect()->route('login');
    // //     }

    // //     $user = Auth::user();

    // //     // Cek apakah pengguna memiliki role tertentu di proyek tertentu
    // //     $hasRole = DB::table('user_proyeks')
    // //         ->where('user_id', $user->id)
    // //         ->where('proyek_id', $projectId)
    // //         ->where('role_id', $roleId)
    // //         ->exists();

    // //     if ($hasRole) {
    // //         Log::info('Authorization successful for user ID: ' . $user->id);
    // //         return $next($request);
    // //     }

    // //     return redirect()->route('unauthorized');
    // // }
    // if (!Auth::check()) {
    //         return redirect()->route('login');
    //     }

    //     $user = Auth::user();
    //     $projectId = $request->route('projectId'); // Ambil projectId dari route parameter

    //     // Ambil role_id dari user_proyeks berdasarkan user_id dan proyek_id
    //     $roleId = DB::table('user_proyeks')
    //         ->where('user_id', $user->id)
    //         ->where('proyek_id', $projectId)
    //         ->value('role_id');

    //     if ($roleId) {
    //         Log::info('Authorization successful for user ID: ' . $user->id . ' with role ID: ' . $roleId);
    //         return $next($request);
    //     }

    //     return redirect()->route('unauthorized');
    // }
    // public function handle(Request $request, Closure $next, $roleName) : Response
    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login');
    //     }

    //     $user = Auth::user();
    //     $projectId = $request->route('projectId'); // Ambil projectId dari route parameter

    //     // Ambil role name dari user_proyeks berdasarkan user_id, proyek_id, dan roles
    //     $role = DB::table('user_proyeks')
    //         ->join('roles', 'user_proyeks.role_id', '=', 'roles.id')
    //         ->where('user_proyeks.user_id', $user->id)
    //         ->where('user_proyeks.proyek_id', $projectId)
    //         ->value('roles.name');

    //     if ($role === $roleName) {
    //         Log::info('Authorization successful for user collab ID: ' . $user->id . ' with role: ' . $role);
    //         return $next($request);
    //     }

    //     return redirect()->route('unauthorized');
    // }

    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $proyekId = $request->route('nama_proyek'); // Pastikan parameter proyek_id ada dalam route

        if ($proyekId) {
            $userProyek = UserProyek::where('assignee_user_id', $user->id)
                                    ->where('nama_proyek', $proyekId)
                                    ->whereHas('role', function ($query) use ($role) {
                                        $query->where('name', $role);
                                    })
                                    ->first();

            if ($userProyek) {
                return $next($request);
            }
        }

        return redirect()->route('unauthorized');
    }
}
