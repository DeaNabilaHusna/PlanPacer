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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // User::updateOrCreate([
        //     'username' => 'fitri',
        //     'email' => 'fitri@gmail.com',
        //     'password' => bcrypt('Fitri1234!'),
        // ]);
        // User::updateOrCreate([
        //     'username' => 'muli',
        //     'email' => 'muli@gmail.com',
        //     'password' => bcrypt('Muli1234!'),
        // ]);

        // User::updateOrCreate([
        //     'username' => 'lilo',
        //     'email' => 'lilo@gmail.com',
        //     'password' => bcrypt('Lilo1234!'),
        // ]);

        // User::updateOrCreate([
        //     'username' => 'dea',
        //     'email' => 'dea@gmail.com',
        //     'password' => bcrypt('Dea1234!'),
        // ]);

        // User::updateOrCreate([
        //     'username' => 'zayn',
        //     'email' => 'zayn@gmail.com',
        //     'password' => bcrypt('Zayn1234!'),
        // ]);

        // User::updateOrCreate([
        //     'username' => 'doni',
        //     'email' => 'doni@gmail.com',
        //     'password' => bcrypt('Doni1234!'),
        // ]);

        // User::updateOrCreate([
        //     'username' => 'risa',
        //     'email' => 'risa@gmail.com',
        //     'password' => bcrypt('Risa1234!'),
        // ]);

        // User::updateOrCreate([
        //     'username' => 'lala',
        //     'email' => 'lala@gmail.com',
        //     'password' => bcrypt('Lala1234!'),
        // ]);

        $role_pic = Role::updateOrCreate([
            'name' => 'pic',
        ]);
        $role_analyst = Role::updateOrCreate([
            'name' => 'analyst',
        ]);
        $role_designer = Role::updateOrCreate([
            'name' => 'designer',
        ]);
        $role_programmer = Role::updateOrCreate([
            'name' => 'programmer',
        ]);
        $role_mentor = Role::updateOrCreate([
            'name' => 'mentor',
        ]);

        // Permission::updateOrCreate([
        //     'name' => 'update proyek',
        //     'guard_name' => 'web'
        // ]);
        // Permission::updateOrCreate([
        //     'name' => 'update tugas',
        //     'guard_name' => 'web'
        // ]);

        $PermissionSatu = Permission::updateOrCreate([
            'name' => 'update_proyek',
            'guard_name' => 'web'
        ]);
        $PermissionDua = Permission::updateOrCreate([
            'name' => 'update_tugas',
            'guard_name' => 'web'
        ]);
        $PermissionTiga = Permission::updateOrCreate([
            'name' => 'update_role_kolaborator',
            'guard_name' => 'web'
        ]);
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
