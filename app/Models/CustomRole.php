<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class CustomRole extends Model
// {
//     use HasFactory;
// }
namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class CustomRole extends SpatieRole
{
    // Definisikan kembali relasi many-to-many dengan model UserProyek
    public function userProyeks()
    {
        return $this->belongsToMany(UserProyek::class);
    }
}

