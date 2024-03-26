<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKontributor extends Model
{
    use HasFactory;

    protected $table = "user_kontributors";
    protected $guarded = ["id"];

}
