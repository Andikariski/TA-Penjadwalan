<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class User2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen1 = User::create([
            'name' => 'Adhi Prahara, S.Si., M.Cs',
            'email' => 'adhi.prahara@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen1->assignRole('dosen');

        $dosen2 = User::create([
            'name' => 'Ahmad Azhari, S.Kom., M.Eng',
            'email' => 'Ahmad.azhari@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen2->assignRole('dosen');

        $dosen3 = User::create([
            'name' => 'Ali Tarmuji, S.T., M. Cs',
            'email' => 'Ali.tarmuji@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen3->assignRole('dosen');

        $dosen4 = User::create([
            'name' => 'Anna Hendri Soleliza Jones, S. Kom, M.Cs.',
            'email' => 'Anna.hendri@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen4->assignRole('dosen');

        $dosen5 = User::create([
            'name' => 'Ir. Ardi Pujiyanta, M. T.',
            'email' => 'Ardipujiyanta@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen5->assignRole('dosen');

        $dosen6 = User::create([
            'name' => 'Andri Pranolo, S.Kom., M. Cs',
            'email' => 'andripranolo@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen6->assignRole('dosen');

        $dosen7 = User::create([
            'name' => 'Arfiani Nur Khusna, S.T., M.Kom.',
            'email' => 'Arfiani.khusna@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen7->assignRole('dosen');

        $dosen8 = User::create([
            'name' => 'Dewi Pramudi Ismi, S.T., M.CompSc',
            'email' => 'dewi.ismi@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen8->assignRole('dosen');

        $dosen9 = User::create([
            'name' => 'Dewi Soyusiawaty, S.T., M.T',
            'email' => 'Dewi.soyusiawatyi@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen9->assignRole('dosen');

        $dosen10 = User::create([
            'name' => 'Dinan Yulianto, S.T., M.Eng.',
            'email' => 'Dinan.yulianto@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen10->assignRole('dosen');

        $dosen11 = User::create([
            'name' => 'Dwi Normawati, S.T., M.Eng.',
            'email' => 'Dwi.normawati@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen11->assignRole('dosen');

        $dosen12 = User::create([
            'name' => 'Eko Aribowo, S.T., M.Kom',
            'email' => 'ekoab@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen12->assignRole('dosen');



        $dosen13 = User::create([
            'name' => 'Faisal Fajri Rahani S.Si., M.Cs.',
            'email' => 'Faisal.fajri@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen13->assignRole('dosen');

        $dosen14 = User::create([
            'name' => 'Fiftin Noviyanto, S.T., M. Cs',
            'email' => 'Fiftin.noviyanto@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen14->assignRole('dosen');

        $dosen15 = User::create([
            'name' => 'Fitri Indra Indikawati, S.Kom., M.Eng.',
            'email' => 'Fitri.indikawati@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen15->assignRole('dosen');

        $dosen16 = User::create([
            'name' => 'Guntur Maulana Zamroni, B.Sc., M.Kom.',
            'email' => 'Guntur.zamroni@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen16->assignRole('dosen');

        $dosen17 = User::create([
            'name' => 'Bambang Robiin, S.T.,M.T',
            'email' => 'Bambang.robiin@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen17->assignRole('dosen');

        $dosen18 = User::create([
            'name' => 'Ika Arfiani, S.T., M.Cs.',
            'email' => 'Ika.arfiani@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen18->assignRole('dosen');

        $dosen19 = User::create([
            'name' => 'Jefree Fahana, ST., M.Kom.',
            'email' => 'Jefree.fahana@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen19->assignRole('dosen');

        $dosen20 = User::create([
            'name' => 'Lisna Zahrotun S.T., M.Cs.',
            'email' => 'Lisna.zahrotun@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen20->assignRole('dosen');

        $dosen21 = User::create([
            'name' => 'Miftahurrahma Rosyda, S.Kom, M.Eng.',
            'email' => 'Miftahurrahma.rosyda@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen21->assignRole('dosen');

        $dosen22 = User::create([
            'name' => 'Murein Miksa Mardhia, S.T., M.T.',
            'email' => 'murein.miksa@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen22->assignRole('dosen');

        $dosen23 = User::create([
            'name' => 'Murinto, S.Si., M. Kom',
            'email' => 'Murintokusno@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen23->assignRole('dosen');

        $dosen24 = User::create([
            'name' => 'Mushlihudin, S.T., M.T.',
            'email' => 'mdin@ee.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen24->assignRole('dosen');

        $dosen25 = User::create([
            'name' => 'Nuril Anwar, S.T.,M.Kom',
            'email' => 'Nuril.anwar@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen25->assignRole('dosen');

        $dosen26 = User::create([
            'name' => 'Nur Rochmah Dyah Pujiastuti, S.T, M.Kom.',
            'email' => 'rochmahdyah@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen26->assignRole('dosen');

        $dosen27 = User::create([
            'name' => 'Rusydi Umar, S.T., M.T, Ph.D.',
            'email' => 'rusydi.umar@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen27->assignRole('dosen');

        $dosen28 = User::create([
            'name' => 'Sri Winiarti, S.T., M. Cs',
            'email' => 'sri.winiarti@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen28->assignRole('dosen');

        $dosen29 = User::create([
            'name' => 'Taufiq Ismail, S.T., M. Cs',
            'email' => 'taufiq@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen29->assignRole('dosen');

        $dosen30 = User::create([
            'name' => 'Drs. Tedy Setiadi, M.T',
            'email' => 'tedy.setiadi@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen30->assignRole('dosen');

        $dosen31 = User::create([
            'name' => 'Drs. Wahyu Pujiyono, M. Kom',
            'email' => 'yywahyup@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);
        $dosen31->assignRole('dosen');


        $mahasiswa1 = User::create([
            'name' => 'Muhammad Andika Riski',
            'email' => 'muhammad1700018174@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa1->assignRole('mahasiswa');

        $mahasiswa2 = User::create([
            'name' => 'Abi Abdurahman',
            'email' => 'abi1700018197@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa2->assignRole('mahasiswa');

        $mahasiswa3 = User::create([
            'name' => 'Rois Fatoni',
            'email' => 'rois1700018203@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa3->assignRole('mahasiswa');

        $mahasiswa4 = User::create([
            'name' => 'Adil Baihaqi',
            'email' => 'adil1700018118@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa4->assignRole('mahasiswa');


        $mahasiswa5 = User::create([
            'name' => 'Amir Fauzi Ansharif',
            'email' => 'amir1700018121@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa5->assignRole('mahasiswa');

        $mahasiswa6 = User::create([
            'name' => 'Nur fadhilah alfianty firman',
            'email' => 'nur1700018122@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa6->assignRole('mahasiswa');

        $mahasiswa7 = User::create([
            'name' => 'Rafida Kumalasari',
            'email' => 'rafida1700018123@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa7->assignRole('mahasiswa');


        $mahasiswa8 = User::create([
            'name' => 'Iftitah Dwi Ulumiyah',
            'email' => 'iftitah1700018124@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa8->assignRole('mahasiswa');

        $mahasiswa9 = User::create([
            'name' => 'Muhammad Satria Gradienta ',
            'email' => 'muhammad1700018125@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa9->assignRole('mahasiswa');

        $mahasiswa10 = User::create([
            'name' => 'Eef Mekelliano',
            'email' => 'eef1700018130@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa10->assignRole('mahasiswa');


        $mahasiswa11 = User::create([
            'name' => 'Aditya Angga Ramadhan',
            'email' => 'aditya1700018131@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa11->assignRole('mahasiswa');
    }
}
