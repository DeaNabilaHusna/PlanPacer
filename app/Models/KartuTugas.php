<?php

namespace App\Models;

use App\Models\Proyek;
use App\Models\TugasItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuTugas extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function proyek(){
        return $this->belongsTo(Proyek::class);
    }

    public function tugasitems(){
        return $this->hasMany(TugasItem::class);
    }
}
