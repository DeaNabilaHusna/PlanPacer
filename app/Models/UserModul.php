<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModul extends Model
{
    use HasFactory;
    protected $table = "user_moduls";
    protected $guarded = ["id"];
    public function moduls()
    {
        return $this->belongsTo(Modul::class, 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'handled_by_id', 'id');
    }
}
