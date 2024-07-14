<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Project;
use App\Models\Modul;
use App\Models\UserProject;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        parent::booted();
        Log::info('User model booted and HasRoles trait used.');
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_projects', 'assignee_user_id', 'project_id')
                    ->withPivot('role_id', 'assigned_by_user_id')
                    ->withTimestamps();
    }

//     public function tasks()
// {
//     return $this->belongsToMany(Task::class, 'user_tasks', 'project_manager_id', 'task_id') ->withPivot('project_id', 'modul_id', 'project_manager_email')
//                 ->withTimestamps();
// }

public function moduls()
{
    return $this->belongsToMany(Modul::class, 'user_moduls', 'handled_by_id', 'modul_id')
    ->withPivot('project_id', 'handled_by_email')
                ->withTimestamps();
}

    public function userProjects()
    {
        return $this->hasMany(UserProject::class, 'assignee_user_id', 'id');
    }
}
