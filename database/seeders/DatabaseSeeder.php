<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role_default = Role::updateOrCreate([
            'name' => 'user',
        ]);

        $role_super = Role::updateOrCreate([
            'name' => 'super admin',
        ]);
        $role_admin = Role::updateOrCreate([
            'name' => 'admin',
        ]);

        $role_pic = Role::updateOrCreate([
            'name' => 'project manager',
        ]);

        $role_analyst = Role::updateOrCreate([
            'name' => 'analyst',
        ]);

        $role_designer1 = Role::updateOrCreate([
            'name' => 'designer database',
        ]);

        $role_designer2 = Role::updateOrCreate([
            'name' => 'designer ui/ux',
        ]);

        $role_programmer = Role::updateOrCreate([
            'name' => 'programmer',
        ]);

        $role_implementator = Role::updateOrCreate([
            'name' => 'implementator',
        ]);

        $role_qa = Role::updateOrCreate([
            'name' => 'quality control',
        ]);

        $permissions = [
            ['name' => 'buat proyek', 'guard_name' => 'web'],
            ['name' => 'lihat proyek', 'guard_name' => 'web'],
            ['name' => 'edit proyek', 'guard_name' => 'web'],
            ['name' => 'hapus proyek', 'guard_name' => 'web'],
            ['name' => 'buat modul', 'guard_name' => 'web'],
            ['name' => 'lihat modul', 'guard_name' => 'web'],
            ['name' => 'edit modul', 'guard_name' => 'web'],
            ['name' => 'hapus modul', 'guard_name' => 'web'],
            ['name' => 'buat tugas', 'guard_name' => 'web'],
            ['name' => 'lihat tugas', 'guard_name' => 'web'],
            ['name' => 'edit tugas', 'guard_name' => 'web'],
            ['name' => 'hapus tugas', 'guard_name' => 'web'],
            ['name' => 'buat role', 'guard_name' => 'web'],
            ['name' => 'lihat role', 'guard_name' => 'web'],
            ['name' => 'edit role', 'guard_name' => 'web'],
            ['name' => 'hapus role', 'guard_name' => 'web'],
            ['name' => 'buat user', 'guard_name' => 'web'],
            ['name' => 'edit user', 'guard_name' => 'web'],
            ['name' => 'hapus user', 'guard_name' => 'web']

        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate($permission);
        }

        // Ambil semua izin yang sudah dibuat
        $allPermissions = Permission::all();

        // Berikan semua izin kepada super admin
        $role_super->syncPermissions($allPermissions);

        $role_default->syncPermissions([
            'buat proyek',
            'lihat proyek',
            'edit proyek',
            'hapus proyek',
            'buat modul',
            'lihat modul',
            'edit modul',
            'hapus modul',
            'buat tugas',
            'lihat tugas',
            'edit tugas',
            'hapus tugas'
        ]);

        // $PermissionSatu = Permission::updateOrCreate([
        //     'name' => 'edit proyek',
        //     'guard_name' => 'web'
        // ]);
        // $PermissionDua = Permission::updateOrCreate([
        //     'name' => 'edit tugas',
        //     'guard_name' => 'web'
        // ]);
        // $PermissionTiga = Permission::updateOrCreate([
        //     'name' => 'view tugas',
        //     'guard_name' => 'web'
        // ]);
        // $PermissionTiga = Permission::updateOrCreate([
        //     'name' => 'view proyek',
        //     'guard_name' => 'web'
        // ]);

        // $role_pic->givePermissionTo($PermissionSatu);
        // $role_pic->givePermissionTo($PermissionDua);
        // $role_pic->givePermissionTo($PermissionTiga);

        // $role_analyst->givePermissionTo($PermissionSatu);
        // $role_analyst->givePermissionTo($PermissionDua);

        // foreach (User::all() as $user) {
        //     $user->assignRole($role_pic);
        // }
        // $user = User::find(1);
        // $user->assignRole($role_analyst);
    }
}
