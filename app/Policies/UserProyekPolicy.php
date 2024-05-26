<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserProyek;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\Response;

class UserProyekPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, UserProyek $userProyek): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, UserProyek $userProyek): bool
    {
         // Memeriksa apakah user adalah pemilik proyek atau memiliki role 'pic'
        //  $authorized = $user->role === 'pic' || $user->id === $userProyek->proyek->user_id;
             $authorized = $user->role === 'pic' && $user->id === $userProyek->proyek->user_id;
        // $authorized = $user->hasAnyRole(['pic']) && $user->id === $userProyek->proyek->user_id;

         // Log untuk debugging
         Log::info("Authorization check for user {$user->id} on project {$userProyek->id}: " . ($authorized ? 'authorized' : 'not authorized'));
 
         return $authorized;
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, UserProyek $userProyek): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, UserProyek $userProyek): bool
    {
        //
        return true;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, UserProyek $userProyek): bool
    {
        //
        return true;

    }
}
