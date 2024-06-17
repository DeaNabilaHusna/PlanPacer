<?php

namespace App\Http\Middleware;

use Closure;
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
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $user = auth()->user();

        if ($user->role === $role) {
            Log::info('Authorization successful for user ID: ' . auth()->id());
            return $next($request);
        }
        
        return redirect()->route('unauthorized');
    }

    // END BATAS 



    // {
    //     if (!Auth::check()) {
    //         return redirect()->route('login');
    //     }

    //     $user = Auth::user();

    //     if ($user->hasRole($role)) {
    //         return $next($request);
    //     }

    //     return redirect()->route('unauthorized');
    // }
}
