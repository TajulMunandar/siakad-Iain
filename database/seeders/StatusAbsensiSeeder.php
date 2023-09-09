<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusAbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'status' => 'Hadir',
            ],
            [
                'status' => 'Alpa',
            ],
            [
                'status' => 'Izin',
            ],
            [
                'status' => 'Sakit',
            ],
            [
                'status' => '-',
            ],
        ];

        foreach ($status as $key => $value) {
            \App\Models\StatusAbsensi::create($value);
        }
    }
}
