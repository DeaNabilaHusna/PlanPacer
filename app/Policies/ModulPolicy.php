<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ModulPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        
    }
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Project $project) 
    {
        return true;
    }

    public function create(User $user, Project $project)
{
    if ($project->user_id === $user->id) {
        return true;
    }

    // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit project'
      if ($project->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) use ($project) {
            $query->whereHas('permissions', function ($query) {
                $query->where('name', 'buat modul');
            });
        })
        ->exists()
    ) {
        return true;
    }

    // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
    return false;
}

public function store(User $user, Project $project)
{
    return $user->id === $project->user_id || $project->users()->where('users.id', $user->id)->exists();
}

public function show(User $user, Project $project)
{
    if ($project->user_id === $user->id) {
        return true;
    }

    // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit project'
      if ($project->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) use ($project) {
            $query->whereHas('permissions', function ($query) {
                $query->where('name', 'lihat modul');
            });
        })
        ->exists()
    ) {
        return true;
    }

    // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
    return false;
}

// public function edit(User $user, Project $project)
// {
//     if ($project->user_id === $user->id) {
//         return true;
//     }

//     // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit project'
//     if ($project->users()
//         ->where('users.id', $user->id)
//         ->whereHas('roles', function ($query) {
//             $query->whereHas('permissions', function ($query) {
//                 $query->where('name', 'lihat modul');
//             });
//         })
//         ->exists()
//     ) {
//         return true;
//     }

//     // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
//     return false;
// }

public function update(User $user, Project $project)
{
    if ($project->user_id === $user->id) {
        return true;
    }

    // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit project'
      if ($project->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) use ($project) {
            $query->whereHas('permissions', function ($query) {
                $query->where('name', 'edit modul');
            });
        })
        ->exists()
    ) {
        return true;
    }

    // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
    return false;
}

public function destroy(User $user, Project $project)
{
    if ($project->user_id === $user->id) {
        return true;
    }

    // Periksa apakah pengguna adalah kolaborator dengan peran yang memiliki izin 'edit project'
      if ($project->users()
            ->where('users.id', $user->id)
            ->whereHas('roles', function ($query) use ($project) {
            $query->whereHas('permissions', function ($query) {
                $query->where('name', 'hapus modul');
            });
        })
        ->exists()
    ) {
        return true;
    }

    // Jika tidak memenuhi keduanya, kembalikan false atau gunakan metode deny jika ada
    return false;
}

}
