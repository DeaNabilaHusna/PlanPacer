<?php

namespace App\Models;

use App\Models\User;
use App\Models\Proyek;
use App\Models\TugasItem;
use App\Models\UserKontributor;
use App\Models\KontributorProyek;
use App\Models\KontributorTugasitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kontributor extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsToMany(User::class, UserKontributor::class);
    }

    public function proyek(){
        return $this->belongsToMany(Proyek::class, KontributorProyek::class);
    }

    public function tugasitem(){
        return $this->belongsToMany(TugasItem::class, KontributorTugasitem::class);
    }
}
