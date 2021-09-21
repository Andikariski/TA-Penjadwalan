<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(User2Seeder::class);
        $this->call(TopikbidangSeeder::class);
        $this->call(PeriodeSeeder::class);
        $this->call(MahasiswaSeeder::class);
        $this->call(DosenSeeder::class);
        $this->call(SetupSeeder::class);
        $this->call(TopikSkripsiSeeder::class);
        $this->call(NamaUjianSeeder::class);
        $this->call(NamaSyaratSeeder::class);
        $this->call(PertanyaanSempropSeeder::class);
        $this->call(PertanyaanPendadaranSeeder::class);
        $this->call(PertanyaanSubPendadaranSeeder::class);
    }
}
