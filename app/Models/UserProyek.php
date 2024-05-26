<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserProyek extends Model
{
    use HasFactory;
    protected $table = "user_proyeks";
    protected $guarded = ["id"];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
