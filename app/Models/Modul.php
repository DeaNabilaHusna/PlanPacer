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

        static::saving(function ($modul) {
            // Memeriksa apakah modul_status diubah menjadi 'selesai'
            if ($modul->isDirty('modul_status') && $modul->modul_status === 'selesai') {
                // Jika selesai, periksa status proyek
                $project = Project::find($modul->project_id);
                $project->updateStatus();
            }

            // Memeriksa apakah modul perlu diubah menjadi 'terlambat'
            if ($modul->modul_status !== 'selesai' && $modul->modul_end_date < now()) {
                $modul->modul_status = 'terlambat';
            }
        });

        static::saved(function ($modul) {
            $project = Project::find($modul->project_id);
            $project->updateStatus();
        });
    });
}

//Function custom slug
public function generateSlug()
{
    $modul_slug = Str::slug($this->modul_name);
    
    // Ambil proyek 
    $project = $this->project()->first();

    // ambil field project_name untuk slug
    if ($project) {
        $project_slug = Str::slug($project->project_name); 
        $this->slug = $modul_slug . '-' . $project_slug;
    } else {
        // kondisi jika proyek tidak ditemukan, gunakan hanya modul_name
        $this->slug = $modul_slug;
    }

    // Cek apakah slug sudah ada
    $count = static::where('slug', $this->slug)->where('id', '!=', $this->id)->count();
    if ($count > 0) {
        $this->slug .= '-' . ($count + 1);
    }
}

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_moduls', 'modul_id', 'handled_by_id')->withPivot('project_id', 'handled_by_email')
                ->withTimestamps();
    }
}
