<?php

namespace App\Models;

use App\Models\User;
use App\Models\Progress;
use App\Models\KartuTugas;
use App\Models\UserProyek;
use App\Models\FilePendukung;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyek extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
 
    public function users(){
        // return $this->belongsToMany(User::class, UserProyek::class);
        // return $this->belongsToMany(User::class, 'user_proyeks', 'proyek_id', 'user_id');
        return $this->belongsToMany(User::class, 'user_proyeks')->withTimestamps();

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

    public function getRouteKeyName(): string
{
    return 'nama_proyek';
}
}
