<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTugasitem extends Model
{
    use HasFactory;
    protected $table = "user_tugasitems";
    protected $guarded = ["id"];

    public function tugasItems()
    {
        return $this->belongsTo(TugasItem::class, 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'penanggungjawab_id', 'id');
    }
}
