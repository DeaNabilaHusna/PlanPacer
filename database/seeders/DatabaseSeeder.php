<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;

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

        User::create([
            'username' => 'lilo',
            'email' => 'lilo@gmail.com',
            'password' => bcrypt('Lilo1234!'),
        ]);

        User::create([
            'username' => 'dea',
            'email' => 'dea@gmail.com',
            'password' => bcrypt('Dea1234!'),
        ]);

        User::create([
            'username' => 'zayn',
            'email' => 'zayn@gmail.com',
            'password' => bcrypt('Zayn1234!'),
        ]);

        User::create([
            'username' => 'doni',
            'email' => 'doni@gmail.com',
            'password' => bcrypt('Doni1234!'),
        ]);

        User::create([
            'username' => 'risa',
            'email' => 'risa@gmail.com',
            'password' => bcrypt('Risa1234!'),
        ]);

        User::create([
            'username' => 'lala',
            'email' => 'lala@gmail.com',
            'password' => bcrypt('Lala1234!'),
        ]);

        Permission::create([
            'name' => 'update proyek',
            'guard_name' => 'web'
        ]);
        Permission::create([
            'name' => 'update tugas',
            'guard_name' => 'web'
        ]);
    }
}
