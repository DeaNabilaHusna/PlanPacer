<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProyek extends Model
{
    use HasFactory;
    protected $table = "user_proyeks";
    protected $guarded = ["id"];
}
