<?php

namespace App\Models;

use App\Models\User;
use App\Models\Progress;
use App\Models\Modul;
use App\Models\UserProject;
use App\Models\Document;   
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'slug'];
 
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->project_name);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->project_name);
        });
    }
    public function users(){
        return $this->belongsToMany(User::class, 'user_projects', 'project_id', 'assignee_user_id')
            ->withPivot('assigned_by_user_id')
            ->withTimestamps();

    }

    public function moduls(){
        return $this->hasMany(Modul::class);
    }
    
    public function progress(){
        return $this->hasMany(Progress::class);
    }

    public function documents(){
        return $this->hasMany(Document::class);
    }

    public function userProjects()
    {
        return $this->hasMany(UserProject::class, 'project_id');
    }

    public function getRouteKeyName(): string
{
    return 'project_name';
}
}
