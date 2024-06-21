<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name', 'owned_by_id',
    ];

    // Relasi dengan pengguna yang memiliki role ini


    // Aturan validasi untuk nama role
    public static function rules($roleId = null)
    {
        $userId = auth()->id(); // Ambil ID pengguna yang sedang masuk

        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('roles')->where(function ($query) use ($userId) {
                    return $query->where('owned_by_id', $userId); // Validasi keunikan berdasarkan owned_by_id
                })->ignore($roleId),
            ],
        ];
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->guard_name)) {
                $model->guard_name = 'web';
            }
        });
    }
}
