<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mahasiswa::factory(20)->create();

        Mahasiswa::create([
            'npm' => '1234567890',
            'name' => 'Rizky',
            'email' => 'rizky@gmail.com',
            'nohp' => '081234567890',
            'isKomisaris' => true,
            'id_kelas' => 2,
        ]);
    }
}
