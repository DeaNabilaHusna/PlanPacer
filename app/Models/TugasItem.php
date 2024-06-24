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
            $model->generateSlug();
        });
    
        static::updating(function ($model) {
            if ($model->isDirty('nama_tugas_item') || $model->isDirty('kartu_id')) {
                $model->generateSlug();
            }
        });
    }
    
    public function generateSlug()
    {
        $nama_tugas_slug = Str::slug($this->nama_tugas_item);
        
        // Ambil proyek terkait dengan kartu ini
        $kartu = $this->kartutugas()->first();
    
        if ($kartu) {
            $nama_kartu_slug = Str::slug($kartu->nama_kartu); // Sesuaikan dengan nama field kartu di model
            $this->slug = $nama_tugas_slug . '-' . $nama_kartu_slug;
        } else {
            // kartu tidak ditemukan, gunakan hanya nama_kartu
            $this->slug = $nama_tugas_slug;
        }
    
        // Pastikan slug unik
        $count = static::where('slug', $this->slug)->where('id', '!=', $this->id)->count();
        if ($count > 0) {
            $this->slug .= '-' . ($count + 1);
        }
    }

    public function kartutugas()
    {
        return $this->belongsTo(KartuTugas::class);
    }

    public function user()
    {
        return $this->belongsToMany(User::class, UserTugasitem::class);
    }
    public function penanggungjawab()
    {
        return $this->belongsToMany(User::class, 'user_proyeks', 'proyek_id', 'assignee_user_id')
            ->withTimestamps();
    }

    
}
