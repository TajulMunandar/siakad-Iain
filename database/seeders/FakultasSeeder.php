<?php

namespace Database\Seeders;

use App\Models\Fakultas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FakultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fakultas::create([
          'name' => 'Fakultas Teknik',
        ]);

        Fakultas::create([
          'name' => 'Fakultas Ekonomi',
        ]);
    }
}
