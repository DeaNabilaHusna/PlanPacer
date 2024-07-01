<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modul extends Model
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
        // Cek apakah nama_kartu atau proyek_id berubah
        if ($model->isDirty('modul_name') || $model->isDirty('project_id')) {
            $model->generateSlug();
        }
    });
}

public function generateSlug()
{
    $modul_slug = Str::slug($this->modul_name);
    
    // Ambil proyek terkait dengan kartu ini
    $project = $this->project()->first();

    if ($project) {
        $project_slug = Str::slug($project->project_name); // Sesuaikan dengan nama field project di model
        $this->slug = $modul_slug . '-' . $project_slug;
    } else {
        // project tidak ditemukan, gunakan hanya modul_name
        $this->slug = $modul_slug;
    }

    // Pastikan slug unik
    $count = static::where('slug', $this->slug)->where('id', '!=', $this->id)->count();
    if ($count > 0) {
        $this->slug .= '-' . ($count + 1);
    }
}

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class, 'modul_id');
    }
}
