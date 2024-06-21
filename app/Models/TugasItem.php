<?php

namespace App\Models;

use App\Models\KartuTugas;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserTugasitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasItem extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'slug'];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->slug = Str::slug($model->nama_tugas_item);
        });

        static::updating(function ($model) {
            $model->slug = Str::slug($model->nama_tugas_item);
        });
    }

    public function kartutugas(){
        return $this->belongsTo(KartuTugas::class);
    }

    public function user(){
        return $this->belongsTo(User::class, UserTugasitem::class);
    }

}
