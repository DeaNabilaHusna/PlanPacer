<?php

namespace App\Models;

use App\Models\Proyek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Progress extends Model
{
    use HasFactory;

    public function proyek(){
        return $this->belongsTo(Proyek::class);
    }
}
