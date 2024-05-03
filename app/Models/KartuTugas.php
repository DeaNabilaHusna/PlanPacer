<?php

namespace App\Models;

use App\Models\Proyek;
use App\Models\TugasItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProyekTugas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function proyek(){
        return $this->belongsTo(Proyek::class);
    }

    public function tugasitem(){
        return $this->hasMany(TugasItem::class);
    }
}
