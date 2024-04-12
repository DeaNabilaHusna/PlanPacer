<?php

namespace App\Models;

use App\Models\User;
use App\Models\Progress;
use App\Models\KartuTugas;
use App\Models\FilePendukung;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proyek extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function kartutugas(){
        return $this->hasMany(KartuTugas::class);
    }

    public function progress(){
        return $this->hasMany(Progress::class);
    }

    public function filePendukung(){
        return $this->hasMany(FilePendukung::class);
    }

    public function getRouteKeyName(): string
{
    return 'nama_proyek';
}
}
