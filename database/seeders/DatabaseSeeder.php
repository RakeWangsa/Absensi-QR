<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
            'name'      => 'siswa',
            'email'     => 'siswa@gmail.com',
            'password'  => bcrypt('12345'),
            'role'     => 'siswa'
        ]);
        User::create([
            'name'      => 'guru',
            'email'     => 'guru@gmail.com',
            'password'  => bcrypt('12345'),
            'role'     => 'guru'
        ]);
        User::create([
            'name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'password'  => bcrypt('12345'),
            'role'     => 'admin'
        ]);
    }
}
