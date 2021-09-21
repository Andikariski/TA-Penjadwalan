<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topikskripsi;

class TopikSkripsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataTesting = [
            [
                'judul_topik'       => 'Sistem pencarian lokasi terdekat SPBU',
                'deskripsi'         => 'Aplikasi dalam bentuk android dan IOS',
                'id_periode'        => 1,
                'id_topikbidang'    => 1,
                'nim_submit'        => '1700018117',
                'nim_terpilih'      => '1700018117',
                'nipy'              => '60160952',
                'option_from'       => 'Testing',
                'status'            => 'Accept',
                'status_mahasiswa'  => 1,
                'dosen_penguji_1'   => '60030476',
                'dosen_penguji_2'   => '060150841',

            ],
            [
                'judul_topik'       => 'Refactore aplikasi sistem penjadwalan tugas akhir',
                'deskripsi'         => 'Fokus pada fitur penjadwalan',
                'id_periode'        => 1,
                'id_topikbidang'    => 1,
                'nim_submit'        => '1700018174',
                'nim_terpilih'      => '1700018174',
                'nipy'              => '60030476',
                'option_from'       => 'Testing',
                'status'            => 'Accept',
                'status_mahasiswa'  => 1,
                'dosen_penguji_1'   => '60160863',
                'dosen_penguji_2'   => '60110647',

            ],
            [
                'judul_topik'       => 'Rancang bangun aplikasi multimedia berbasis android',
                'deskripsi'         => 'Aplikasi pembelajaran anak',
                'id_periode'        => 1,
                'id_topikbidang'    => 1,
                'nim_submit'        => '1700018197',
                'nim_terpilih'      => '1700018197',
                'nipy'              => '60030480',
                'option_from'       => 'Testing',
                'status'            => 'Accept',
                'status_mahasiswa'  => 3,
                'dosen_penguji_1'   => '60030480',
                'dosen_penguji_2'   => '60160863',

            ],
            [
                'judul_topik'       => 'Implementasi algoritma matriks untuk fitur penjadwalan',
                'deskripsi'         => 'Aplikasi berbasis website',
                'id_periode'        => 1,
                'id_topikbidang'    => 2,
                'nim_submit'        => '1700018124',
                'nim_terpilih'      => '1700018124',
                'nipy'              => '60181171',
                'option_from'       => 'Testing',
                'status'            => 'Accept',
                'status_mahasiswa'  => 3,
                'dosen_penguji_1'   => '60160863',
                'dosen_penguji_2'   => '60160979',

            ],
            [
                'judul_topik'       => 'Implementasi algoritma genetika untuk membuat sistem antrian secara otomatis',
                'deskripsi'         => 'Aplikasi berbasis dekstop',
                'id_periode'        => 1,
                'id_topikbidang'    => 2,
                'nim_submit'        => '1700018203',
                'nim_terpilih'      => '1700018203',
                'nipy'              => '197002062005011001',
                'option_from'       => 'Testing',
                'status'            => 'Accept',
                'status_mahasiswa'  => 0,
                'dosen_penguji_1'   => '198011152005011002',
                'dosen_penguji_2'   => '60160863',

            ],
        ];
        foreach ($dataTesting as $dataTestings) {
            Topikskripsi::create($dataTestings);
        }
    }
}
