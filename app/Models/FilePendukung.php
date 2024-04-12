<?php

namespace App\Models;

use App\Models\Proyek;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FilePendukung extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function proyek(){
        return $this->belongsTo(Proyek::class);
    }
}
