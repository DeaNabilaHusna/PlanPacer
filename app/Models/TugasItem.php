<?php

namespace App\Models;

use App\Models\KartuTugas;
use App\Models\User;
use App\Models\UserTugasitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kartutugas(){
        return $this->belongsTo(KartuTugas::class);
    }

    public function user(){
        return $this->belongsTo(User::class, UserTugasitem::class);
    }

}
