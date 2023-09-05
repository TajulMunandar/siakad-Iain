<?php

namespace Database\Seeders;

use App\Models\MataKuliahDosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahDosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliahDosen::create([
          'id_matakuliah' => 1,
          'id_dosen' => 1,
        ]);

        MataKuliahDosen::create([
          'id_matakuliah' => 2,
          'id_dosen' => 2,
        ]);
    }
}
