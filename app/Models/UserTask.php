<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;
    protected $table = "user_tasks";
    protected $guarded = ["id"];

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'project_manager_id', 'id');
    }
}
