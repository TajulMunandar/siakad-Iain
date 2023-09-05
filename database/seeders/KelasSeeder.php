<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
           'name' => '3A',
            'id_prodi' => 1,
        ]);

        Kelas::create([
            'name' => '3B',
            'id_prodi' => 1,
        ]);
    }
}
