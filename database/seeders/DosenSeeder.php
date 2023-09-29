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
            'id_user' => 1,
        ]);

    }
}
