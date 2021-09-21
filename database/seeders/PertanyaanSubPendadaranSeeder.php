<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubPertanyaanPendadaran;

class PertanyaanSubPendadaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // Sub Pertanyaan Komponen id 1
            [
                'id_pertanyaanPendadaran'   => 1,
                'skor'                      => 1,
                'keterangan'                => 'Abstrak kurang dari 3 paragraf dan tidak memuat semua komponen',
            ],
            [
                'id_pertanyaanPendadaran'   => 1,
                'skor'                      => 2,
                'keterangan'                => 'Abstrak kurang dari 3 paragraf dan memuat semua komponen tetapi kurang jelas',
            ],
            [
                'id_pertanyaanPendadaran'   => 1,
                'skor'                      => 3,
                'keterangan'                => 'Abstrak Terdiri atas 3 paragraf dan memuat semua komponen tetapi kurang jelas',
            ],
            [
                'id_pertanyaanPendadaran'   => 1,
                'skor'                      => 4,
                'keterangan'                => 'Abstrak Terdiri atas 3 paragraf dan memuat semua komponen yang jelas',
            ],

            // Sub Pertanyaan Komponen id 2
            [
                'id_pertanyaanPendadaran'   => 2,
                'skor'                      => 1,
                'keterangan'                => 'Komponen lengkap, tetapi tidak jelas, tidak saling terkait dan tidak didukung oleh data yang relevan',
            ],
            [
                'id_pertanyaanPendadaran'   => 2,
                'skor'                      => 2,
                'keterangan'                => 'Komponen lengkap, jelas, tetapi tidak saling terkait dan tidak didukung oleh data yang relevan',
            ],
            [
                'id_pertanyaanPendadaran'   => 2,
                'skor'                      => 3,
                'keterangan'                => 'Komponen lengkap, jelas, saling terkait, tetapi tidak didukung oleh data yang relevan',
            ],
            [
                'id_pertanyaanPendadaran'   => 2,
                'skor'                      => 4,
                'keterangan'                => 'Komponen lengkap, jelas, saling terkait, dan didukung oleh data yang relevan',
            ],

            // Sub Pertanyaan Komponen id 3
            [
                'id_pertanyaanPendadaran'   => 3,
                'skor'                      => 1,
                'keterangan'                => 'Rujukan yang digunakan dalam komponen tinjauan pustaka tidak berasal dari sumber yang terpercaya dan tidak sesuai dengan tema penelitian',
            ],
            [
                'id_pertanyaanPendadaran'   => 3,
                'skor'                      => 2,
                'keterangan'                => 'Sebagian rujukan yang digunakan dalam komponen tinjauan pustaka berasal dari sumber yang terindex/berpustasi dan kurang sesuai dengan tema penelitian',
            ],
            [
                'id_pertanyaanPendadaran'   => 3,
                'skor'                      => 3,
                'keterangan'                => 'Sebagian rujukan yang digunakan dalam komponen tinjauan pustaka berasal dari sumber yang terindex/berputasi dan sesuai dengan tema penelitian',
            ],
            [
                'id_pertanyaanPendadaran'   => 3,
                'skor'                      => 4,
                'keterangan'                => 'Semua rujukan yang digunakan dalam komponen tinjauan pustaka berasal dari sumber yang terindex/berputasi dan sesuai dengan tema penelitian',
            ],

            // Sub Pertanyaan Komponen id 4
            [
                'id_pertanyaanPendadaran'   => 4,
                'skor'                      => 1,
                'keterangan'                => 'Tahap penelitian tidak diuraikan dengan jelas dan tidak dilengkapi dengan bagan alir',
            ],
            [
                'id_pertanyaanPendadaran'   => 4,
                'skor'                      => 2,
                'keterangan'                => 'Tahap penelitian diuraikan tetapi tidak dilengkapi dengan bagan alir',
            ],
            [
                'id_pertanyaanPendadaran'   => 4,
                'skor'                      => 3,
                'keterangan'                => 'Tahap penelitian diuraikan dan ada bagan alir tetapi kurang jelas',
            ],
            [
                'id_pertanyaanPendadaran'   => 4,
                'skor'                      => 4,
                'keterangan'                => 'Tahap penelitian diuraikan dengan jelas dan dilengkapi dengan bagan alir sesuai dengan tema',
            ],

            // Sub Pertanyaan Komponen id 5
            [
                'id_pertanyaanPendadaran'   => 5,
                'skor'                      => 1,
                'keterangan'                => 'Hasil pembahasan tidak sesuai dengan metologi',
            ],
            [
                'id_pertanyaanPendadaran'   => 5,
                'skor'                      => 2,
                'keterangan'                => 'Hasil dan pembahasan diuraikan kurang jelas, kurang lengkap dan kurang sesuai dengan metodologi yang digunakan',
            ],
            [
                'id_pertanyaanPendadaran'   => 5,
                'skor'                      => 3,
                'keterangan'                => 'Hasil dan pembahasan diuraikan dengan jelas dan sesuai dengan metodologi yang digunakan tetapi kurang lengkap',
            ],
            [
                'id_pertanyaanPendadaran'   => 5,
                'skor'                      => 4,
                'keterangan'                => 'Hasil dan pembahasan diuraikan dengan jelas dan lengkap serta sesuai dengan metodologi yang digunakan',
            ],

            // Sub Pertanyaan Komponen id 6
            [
                'id_pertanyaanPendadaran'   => 6,
                'skor'                      => 1,
                'keterangan'                => 'Kesimpulan tidak sesuai dengan tujuan penelitian. Saran tidak mencakup keberlanjutan penelitian',
            ],
            [
                'id_pertanyaanPendadaran'   => 6,
                'skor'                      => 2,
                'keterangan'                => 'Kesimpulan kurang sesuai dengan tujuan penelitian. Saran tidak mencakup keberlanjutan peneltian.',
            ],
            [
                'id_pertanyaanPendadaran'   => 6,
                'skor'                      => 3,
                'keterangan'                => 'Kesimpulan kurang sesuai dengan tujuan penelitian. Saran kurang mencakup keberlanjutan penelitian',
            ],
            [
                'id_pertanyaanPendadaran'   => 6,
                'skor'                      => 4,
                'keterangan'                => 'Kesimpulan sesuai dengan tujuan penelitian. Saran mencakup',
            ],

            // Sub Pertanyaan Komponen id 7
            [
                'id_pertanyaanPendadaran'   => 7,
                'skor'                      => 1,
                'keterangan'                => 'Format tidak sesuai dengan panduan dan tahun terbitan >5 tahun terakhir.',
            ],
            [
                'id_pertanyaanPendadaran'   => 7,
                'skor'                      => 2,
                'keterangan'                => 'Format tidak sesuai dengan panduan dan tahun terbitan maksimal 5 tahun terakhir.',
            ],
            [
                'id_pertanyaanPendadaran'   => 7,
                'skor'                      => 3,
                'keterangan'                => 'Format sesuai dengan panduan dan tahun terbitan >5 tahun',
            ],
            [
                'id_pertanyaanPendadaran'   => 7,
                'skor'                      => 4,
                'keterangan'                => 'Format sesuai dengan panduan dan tahun terbitan maksimal 5 tahun terakhir',
            ],

            // Sub Pertanyaan Komponen id 8
            [
                'id_pertanyaanPendadaran'   => 8,
                'skor'                      => 1,
                'keterangan'                => 'Tidak mampu menjawab',
            ],
            [
                'id_pertanyaanPendadaran'   => 8,
                'skor'                      => 2,
                'keterangan'                => 'Kurang Mampu Menjawab',
            ],
            [
                'id_pertanyaanPendadaran'   => 8,
                'skor'                      => 3,
                'keterangan'                => 'Mampu menjawab dengan jelas tetapi',
            ],
            [
                'id_pertanyaanPendadaran'   => 8,
                'skor'                      => 4,
                'keterangan'                => 'Mampu menjawab dengan jelas dan tepat',
            ],

            // Sub Pertanyaan Komponen id 9
            [
                'id_pertanyaanPendadaran'   => 9,
                'skor'                      => 1,
                'keterangan'                => 'Tidak menguasai analisis/pemrograman',
            ],
            [
                'id_pertanyaanPendadaran'   => 9,
                'skor'                      => 2,
                'keterangan'                => 'Kuranng menguasai analisis/pemrograman',
            ],
            [
                'id_pertanyaanPendadaran'   => 9,
                'skor'                      => 3,
                'keterangan'                => 'Cukup menguasai analisis/pemrograman',
            ],
            [
                'id_pertanyaanPendadaran'   => 9,
                'skor'                      => 4,
                'keterangan'                => 'Sangat menguasai analisis/pemrograman',
            ],

            // Sub Pertanyaan Komponen id 10
            [
                'id_pertanyaanPendadaran'   => 10,
                'skor'                      => 1,
                'keterangan'                => 'Program tidak berjalan. Tidak ada hasil analisis',
            ],
            [
                'id_pertanyaanPendadaran'   => 10,
                'skor'                      => 2,
                'keterangan'                => 'Hasil program/analisis tidak sesuai dengan kebutuhan',
            ],
            [
                'id_pertanyaanPendadaran'   => 10,
                'skor'                      => 3,
                'keterangan'                => 'Hasil program/analisis kurang sesuai dengan kebutuhan',
            ],
            [
                'id_pertanyaanPendadaran'   => 10,
                'skor'                      => 4,
                'keterangan'                => 'Hasil program/analisis sesuai dengan kebutuhan',
            ],
        ];
        foreach ($data as $insertData) {
            SubPertanyaanPendadaran::create($insertData);
        }
    }
}
