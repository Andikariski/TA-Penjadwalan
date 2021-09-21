<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periode;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Periode::create([
            'tahun_periode' => 'Ganjil 2020/2021',
            'status' => '0',
        ]);

        Periode::create([
            'tahun_periode' => 'Genap 2020/2021',
            'status' => '0',
        ]);

        Periode::create([
            'tahun_periode' => 'Ganjil 2021/2022',
            'status' => '1',
        ]);

        Periode::create([
            'tahun_periode' => 'Genap 2021/2022',
            'status' => '1',
        ]);
    }
}
