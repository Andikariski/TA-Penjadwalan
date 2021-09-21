<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NamaSyarat;

class NamaSyaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NamaSyarat::create([
            'NamaSyarat' => 'TOEFL',
        ]);

        NamaSyarat::create([
            'NamaSyarat' => 'Naskah',
        ]);

        NamaSyarat::create([
            'NamaSyarat' => 'Bukti pembayaran',
        ]);

        NamaSyarat::create([
            'NamaSyarat' => 'Upload skpi',
        ]);

        NamaSyarat::create([
            'NamaSyarat' => 'Cetak transkip',
        ]);
    }
}
