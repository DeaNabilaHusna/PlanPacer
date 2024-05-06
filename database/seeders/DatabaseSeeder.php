<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

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
            'username' => 'fitri',
            'email' => 'fitri@gmail.com',
            'password' => bcrypt('Fitri1234!'),
        ]);
        User::create([
            'username' => 'muli',
            'email' => 'muli@gmail.com',
            'password' => bcrypt('Muli1234!'),
        ]);
        User::create([
            'username' => 'doni',
            'email' => 'doni@gmail.com',
            'password' => bcrypt('Doni1234!'),
        ]);
        
    }
}
