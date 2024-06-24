<?php

namespace App\Models;

use App\Models\Proyek;
use App\Models\TugasItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KartuTugas extends Model
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
        // Cek apakah nama_kartu atau proyek_id berubah
        if ($model->isDirty('nama_kartu') || $model->isDirty('proyek_id')) {
            $model->generateSlug();
        }
    });
}

public function generateSlug()
{
    $nama_kartu_slug = Str::slug($this->nama_kartu);
    
    // Ambil proyek terkait dengan kartu ini
    $proyek = $this->proyek()->first();

    if ($proyek) {
        $nama_proyek_slug = Str::slug($proyek->nama_proyek); // Sesuaikan dengan nama field proyek di model
        $this->slug = $nama_kartu_slug . '-' . $nama_proyek_slug;
    } else {
        // Proyek tidak ditemukan, gunakan hanya nama_kartu
        $this->slug = $nama_kartu_slug;
    }

    // Pastikan slug unik
    $count = static::where('slug', $this->slug)->where('id', '!=', $this->id)->count();
    if ($count > 0) {
        $this->slug .= '-' . ($count + 1);
    }
}

    public function proyek(){
        return $this->belongsTo(Proyek::class);
    }

    public function tugasitems(){
        return $this->hasMany(TugasItem::class, 'kartu_id');
    }
}
