<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\StatusAbsensi;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Super Admin',
            'username' => 'admin',
            'isAdmin' => 1,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Syah Sury',
            'username' => 'syahsury',
            'isAdmin' => 0,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Tajul',
            'username' => 'tajul',
            'isAdmin' => 0,
            'password' => Hash::make('password'),
        ]);

        User::create([
            'name' => 'Andika',
            'username' => 'andika',
            'isAdmin' => 0,
            'password' => Hash::make('password'),
        ]);

        $this->call([
            FakultasSeeder::class,
            DosenSeeder::class,
            ProdiSeeder::class,
            KelasSeeder::class,
            MahasiswaSeeder::class,
            MataKuliahSeeder::class,
            MataKuliahDosenSeeder::class,
            StatusAbsensiSeeder::class,
        ]);
    }
}
