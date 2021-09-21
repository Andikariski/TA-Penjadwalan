<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PertanyaanPendadaran;

class PertanyaanPendadaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Komponen id 1
            [
                'komponen'       => 'Abstrak dengan komponen masalah, tujuan, metodologi dan hasil',
                'bobot'           => 1,
            ],
            // Komponen id 2
            [
                'komponen'       => 'BAB I Pendahuluan dengan komponen latar belakang, identifikasi masalah, batasan masalah, rumusah masalah, tujuan penelitian dan manfaat',
                'bobot'           => 2,
            ],
            // Komponen id 3
            [
                'komponen'       => 'BAB II Tinjauan pustaka dengan komponen penelitian terdahulu dan landasan teori',
                'bobot'           => 2,
            ],
            // Komponen id 4
            [
                'komponen'       => 'BAB III Metodologi Penelitian',
                'bobot'           => 2,
            ],
            // Komponen id 5
            [
                'komponen'       => 'BAB IV Hasil dan Pembahasan',
                'bobot'           => 3,
            ],
            // Komponen id 6
            [
                'komponen'       => 'BAB V Kesimpulan dan Saran',
                'bobot'           => 1,
            ],
            // Komponen id 7
            [
                'komponen'       => 'Daftar Pustaka (Referensi)',
                'bobot'           => 1,
            ],
            // Komponen id 8
            [
                'komponen'       => 'Kemampuan Menjawab',
                'bobot'           => 4,
            ],
            // Komponen id 9
            [
                'komponen'       => 'Penguasaan Analisis/Pemrograman',
                'bobot'           => 5,
            ],
            // Komponen id 10
            [
                'komponen'       => 'Hasil Program/Analisis',
                'bobot'           => 4,
            ],
        ];
        foreach ($data as $insertData) {
            PertanyaanPendadaran::create($insertData);
        }
    }
}
