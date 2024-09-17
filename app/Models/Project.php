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

    public function updateStatus()
    {
        $this->load('moduls');

        $isCompleted = $this->moduls->every(function ($modul) {
            return $modul->modul_status === 'selesai';
        });

        if ($isCompleted) {
            $this->project_status = 'selesai';
        } else {
            $hasOngoingModul = $this->moduls->contains(function ($modul) {
                return $modul->modul_status === 'dalam proses' && $modul->modul_end_date < now();
            });

            if ($hasOngoingModul || $this->project_end_date < now()) {
                $this->project_status = 'terlambat';
            }
        }

        $this->save();
    }

    public function calculateProgress()
    {
        $totalModuls = $this->moduls->count();
        $completedModuls = $this->moduls->where('modul_status', 'selesai')->count();

        return $totalModuls > 0 ? ($completedModuls / $totalModuls) * 100 : 0;
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects', 'project_id', 'assignee_user_id')
            ->withPivot('role_id', 'assigned_by_user_id')
            ->withTimestamps();
    }


    public function moduls()
    {
        return $this->hasMany(Modul::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function documents()
    {
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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('project_name', 'like', '%' . $search . '%')->orWhere('project_description', 'like', '%' . $search . '%');
        });
    }
}
