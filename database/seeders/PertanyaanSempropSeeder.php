<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PertanyaanSemprop;

class PertanyaanSempropSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Pertanyaan Dosen Penguji 1
            [
                'unsurPenilaian'       => 'Abstrak Proposal',
                'rangeNilai'           => 5,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],
            [
                'unsurPenilaian'       => 'Keterkaitan : Latar belakang masalah, Identifikasi Masalah, Batasan Masalah, Rumusan Masalah, Tujuan Penelitian dan Manfaat Penelitian',
                'rangeNilai'           => 25,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],
            [
                'unsurPenilaian'       => 'Pemahaman terhadap metode/algoritma yang digunakan',
                'rangeNilai'           => 25,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],
            [
                'unsurPenilaian'       => 'Kelengkapan dan Pemahaman Landasan Teori',
                'rangeNilai'           => 20,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],
            [
                'unsurPenilaian'       => 'Kejelasan Metode Penelitian',
                'rangeNilai'           => 10,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],
            [
                'unsurPenilaian'       => 'Kebaruan Pustaka/Referensi',
                'rangeNilai'           => 10,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],
            [
                'unsurPenilaian'       => 'Rancangan Arsitektur Sistem/Struktur Menu/Antarmuka/Prototype/Struktur Collection Data  (Untuk analisis forensic)',
                'rangeNilai'           => 5,
                'isPembimbing'         => false,
                'isPenguji1'           => true,
            ],

            // Pertanyaan Dosen Pembimbing
            [
                'unsurPenilaian'       => 'Pembimbingan (Checklis berkas)',
                'rangeNilai'           => 10,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Abstrak Proposal',
                'rangeNilai'           => 5,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Keterkaitan : Latar belakang masalah, Identifikasi Masalah, Batasan Masalah, Rumusan Masalah, Tujuan Penelitian dan Manfaat Penelitian',
                'rangeNilai'           => 20,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Pemahaman terhadap metode/algoritma yang digunakan',
                'rangeNilai'           => 10,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Kelengkapan dan Pemahaman Landasan Teori',
                'rangeNilai'           => 20,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Kejelasan Metodologi Penelitian',
                'rangeNilai'           => 10,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Kebaruan Pustaka/Referensi',
                'rangeNilai'           => 10,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
            [
                'unsurPenilaian'       => 'Rancangan Arsitektur Sistem/Struktur Menu/Antarmuka/Prototype/Struktur Collection Data  (Untuk analisis forensic)',
                'rangeNilai'           => 5,
                'isPembimbing'         => true,
                'isPenguji1'           => false,
            ],
        ];
        foreach ($data as $insertData) {
            PertanyaanSemprop::create($insertData);
        }
    }
}
