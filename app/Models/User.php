<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Project;
use App\Models\Task;
use App\Models\UserProject;
use App\Models\UserTask;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
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

    // public function proyek(){
    //     return $this->hasMany(Proyek::class);
    // }

    protected static function booted()
    {
        parent::booted();
        Log::info('User model booted and HasRoles trait used.');
    }



    public function projects()
    {
        // return $this->belongsToMany(Proyek::class, 'user_proyeks')->withTimestamps();
        return $this->belongsToMany(Project::class, 'user_projects')->withPivot('assigned_by_user_id')
            ->withTimestamps();
        // return $this->belongsToMany(Proyek::class, UserProyek::class);
    }

    // public function hasGlobalRole($role)
    // {
    //     return $this->hasRole($role);
    // }

    // Method untuk memeriksa apakah pengguna memiliki role dalam suatu proyek
    // public function hasRoleInProject($role, $projectId)
    // {
    //     return $this->proyeks()
    //         ->where('id', $projectId)
    //         ->wherePivot('role_id', $role)
    //         ->exists();
    // }

    public function tasks()
    {
        // return $this->belongsToMany(TugasItem::class, UserTugasitem::class, 'penanggungjawab_id');
        return $this->belongsToMany(Task::class, 'user_tasks', 'project_manager_id')
        ->withPivot('project_manager_id');
    }

    public function userProjects()
    {
        return $this->hasMany(UserProject::class, 'assignee_user_id', 'id');
    }
}
