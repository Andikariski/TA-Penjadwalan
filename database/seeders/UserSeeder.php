<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Supriyanto, S.T.,M.T.',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $super_admin->assignRole('super_admin');

        $dosen = User::create([
            'name' => 'Ardiansyah, S.T., M.Cs.',
            'email' => 'ardiansyah@tif.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $dosen->assignRole('dosen');

        $mahasiswa = User::create([
            'name' => 'Muhammad Nashir Allatif',
            'email' => 'muhammad1700018117@webmail.uad.ac.id',
            'password' => bcrypt('12345678')
        ]);

        $mahasiswa->assignRole('mahasiswa');
    }
}
