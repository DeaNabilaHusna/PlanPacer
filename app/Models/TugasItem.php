<?php

namespace App\Models;

use App\Models\KartuTugas;
use App\Models\Kontributor;
use App\Models\KontributorTugasitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kartutugas(){
        return $this->belongsTo(KartuTugas::class);
    }

    public function kontributor(){
        return $this->belongsToMany(Kontributor::class, KontributorTugasitem::class);
    }
}
