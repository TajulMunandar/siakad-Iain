<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Dosen::factory(5)->create();

        Dosen::create([
            'nip' => '1234567890',
            'name' => 'Syah Sury',
            'email' => 'syahsury@gmail.com',
            'nohp' => '081234567890',
            'id_user' => 2,
        ]);

        Dosen::create([
            'nip' => '1234567891',
            'name' => 'Tajul',
            'email' => 'tajul@gmail.com',
            'nohp' => '081234567891',
            'id_user' => 3,
        ]);

        Dosen::create([
            'nip' => '1234567892',
            'name' => 'Andika',
            'email' => 'andika@gmail.com',
            'nohp' => '081234567892',
            'id_user' => 4,
        ]);
    }
}
