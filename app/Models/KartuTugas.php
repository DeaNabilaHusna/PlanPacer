<?php

namespace App\Models;

use App\Models\Proyek;
use App\Models\TugasItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuTugas extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'slug'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->nama_kartu);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->nama_kartu);
        });
    }

    public function proyek(){
        return $this->belongsTo(Proyek::class);
    }

    public function tugasitems(){
        return $this->hasMany(TugasItem::class, 'kartu_id');
    }
}
