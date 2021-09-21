<?php

namespace Database\Seeders;
use App\Models\Mahasiswa;

use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mahasiswa::create([
            'nim' => '1700018117',
            'status' => '1',
            'avatar' => '',
            'user_id' => '3',
        ]);

        Mahasiswa::create([
            'nim' => '1700018174',
            'status' => '1',
            'avatar' => '',
            'user_id' => '35',
        ]);

        Mahasiswa::create([
            'nim' => '1700018197',
            'status' => '1',
            'avatar' => '',
            'user_id' => '36',
        ]);

        Mahasiswa::create([
            'nim' => '1700018203',
            'status' => '1',
            'avatar' => '',
            'user_id' => '37',
        ]);

        Mahasiswa::create([
            'nim' => '1700018118',
            'status' => '1',
            'avatar' => '',
            'user_id' => '38',
        ]);

        Mahasiswa::create([
            'nim' => '1700018121',
            'status' => '1',
            'avatar' => '',
            'user_id' => '39',
        ]);

        Mahasiswa::create([
            'nim' => '1700018122',
            'status' => '1',
            'avatar' => '',
            'user_id' => '40',
        ]);

         Mahasiswa::create([
            'nim' => '1700018123',
            'status' => '1',
            'avatar' => '',
            'user_id' => '41',
        ]);

        Mahasiswa::create([
            'nim' => '1700018124',
            'status' => '1',
            'avatar' => '',
            'user_id' => '42',
        ]);


        Mahasiswa::create([
            'nim' => '1700018125',
            'status' => '1',
            'avatar' => '',
            'user_id' => '43',
        ]);

        Mahasiswa::create([
            'nim' => '1700018130',
            'status' => '1',
            'avatar' => '',
            'user_id' => '44',
        ]);


        Mahasiswa::create([
            'nim' => '1700018131',
            'status' => '1',
            'avatar' => '',
            'user_id' => '45',
        ]);
    }
}
