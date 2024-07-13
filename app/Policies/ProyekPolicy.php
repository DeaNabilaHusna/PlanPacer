<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProyekPolicy
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

     public function view(User $user, Project $proyek) 
    {
        return true;
    }


    public function show(User $user, Project $proyek): bool
    {
        if ($proyek->user_id === $user->id) {
            return true;
        }

        // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit proyek'
        if ($proyek->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($query) {
                    $query->where('name', 'lihat proyek');
                });
            })
            ->exists()
        ) {
            return true;
        }

        // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
        return false;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $proyek): bool
    {
        if ($proyek->user_id === $user->id) {
            return true;
        }

        // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit proyek'
        if ($proyek->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($query) {
                    $query->where('name', 'edit proyek');
                });
            })
            ->exists()
        ) {
            return true;
        }

        // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $proyek): bool
    {
        // Only the owner (PIC) can delete the proyek
        // return $user->id === $proyek->user_id;
        if ($proyek->user_id === $user->id) {
            return true;
        }

        // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit proyek'
        if ($proyek->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) {
                $query->whereHas('permissions', function ($query) {
                    $query->where('name', 'hapus proyek');
                });
            })
            ->exists()
        ) {
            return true;
        }

        // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $proyek): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $proyek): bool
    {
        return true;
    }
}
