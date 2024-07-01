<?php

namespace App\Models;

use App\Models\Modul;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'slug'];
    public static function boot()
    {
        parent::boot();
    
        static::creating(function ($model) {
            $model->generateSlug();
        });
    
        static::updating(function ($model) {
            if ($model->isDirty('task_name') || $model->isDirty('modul_id')) {
                $model->generateSlug();
            }
        });
    }
    
    public function generateSlug()
    {
        $tugas_slug = Str::slug($this->task_name);
        
        // Ambil proyek terkait dengan kartu ini
        $modul = $this->modul()->first();
    
        if ($modul) {
            $modul_slug = Str::slug($modul->modul_name); // Sesuaikan dengan nama field modul di model
            $this->slug = $tugas_slug . '-' . $modul_slug;
        } else {
            // modul tidak ditemukan, gunakan hanya nama_modul
            $this->slug = $tugas_slug;
        }
    
        // Pastikan slug unik
        $count = static::where('slug', $this->slug)->where('id', '!=', $this->id)->count();
        if ($count > 0) {
            $this->slug .= '-' . ($count + 1);
        }
    }

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, UserTask::class);
    }
    public function manager()
    {
        return $this->belongsToMany(User::class, 'user_projects', 'project_id', 'assignee_user_id')
            ->withTimestamps();
    }

    
}
