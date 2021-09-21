<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TopikBidang;


class TopikbidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TopikBidang::create([
            'nama_topik' => 'Pengolahan Citra',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Sistem Pakar',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Pengolahan Teks',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Media Pembelajaran',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Estimasi Effort Perangkat Lunak',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Sistem Informasi',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Kebutuhan Perangkat Lunak',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Augmented dan Virtual Reality',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Interaksi Manusia dan Komputer',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Social Network and Graph',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Multimedia dan Grafika',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Forensik Digital',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Kriptografi',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Keamanan Komputer',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Sistem Pendukung Keputusan',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Machine Learning dan Data Mining',
        ]);
        TopikBidang::create([
            'nama_topik' => 'Network dan Sistem Terdistribusi',
        ]);
    }
}
