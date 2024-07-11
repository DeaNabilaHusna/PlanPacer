<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserProyek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\Response;

class checkRoleCollaborators
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        $user = Auth::user();
        $slug = $request->route('slug');
        
        // Ambil proyek berdasarkan slug
        $project = Project::where('slug', $slug)->first();

        if (!$project) {
            abort(404, 'Proyek tidak ditemukan');
        }

        // Cek apakah user adalah pemilik proyek
        if ($project->user_id === $user->id) {
            return $next($request);
        }

        // Cek apakah user adalah kolaborator dalam proyek tersebut dengan izin yang sesuai
        $userRole = $project->users()->where('users.id', $user->id)->first()->pivot->role_id;
        $role = Role::find($userRole);

        if ($role && $role->permissions()->where('name', $permission)->exists()) {
            return $next($request);
        }

        abort(403, 'Tidak memiliki izin');
    }
}
