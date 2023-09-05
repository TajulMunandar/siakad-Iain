<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliah::create([
          'name' => 'Pemrograman Web',
          'kode_matakuliah' => 'Mk212',
          'sks' => 3,
          'id_prodi' => 1,
        ]);

        MataKuliah::create([
          'name' => 'Pemrograman Berorientasi Objek',
          'kode_matakuliah' => 'Mk212',
          'sks' => 3,
          'id_prodi' => 1,
        ]);
    }
}
