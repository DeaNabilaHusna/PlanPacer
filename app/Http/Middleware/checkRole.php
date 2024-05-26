<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Traits\HasRoles;

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
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $user = auth()->user();

        if ($user->role === $role) {
            return $next($request);
        }
        
        return redirect()->route('unauthorized');
    }
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
