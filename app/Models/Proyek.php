<?php

namespace App\Models;

use App\Models\User;
use App\Models\Progress;
use App\Models\KartuTugas;
use App\Models\UserProyek;
use App\Models\FilePendukung;   
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyek extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'slug'];
 
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->nama_proyek);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->nama_proyek);
        });
    }
    public function users(){
        return $this->belongsToMany(User::class, 'user_proyeks', 'proyek_id', 'assignee_user_id')
            ->withPivot('role_id', 'assigned_by_user_id')
            ->withTimestamps();

    }

    public function kartuTugas(){
        return $this->hasMany(KartuTugas::class);
    }
    
    public function progress(){
        return $this->hasMany(Progress::class);
    }

    public function filePendukungs(){
        return $this->hasMany(FilePendukung::class);
    }

    public function userProyeks()
    {
        return $this->hasMany(UserProyek::class, 'proyek_id');
    }

    public function getRouteKeyName(): string
{
    return 'nama_proyek';
}
}
