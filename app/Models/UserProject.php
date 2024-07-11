<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class UserProject extends Model
{
    use HasFactory;
    protected $table = "user_projects";
    protected $guarded = ["id"];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'assignee_user_id', 'id');
    }
}

