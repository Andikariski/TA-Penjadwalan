<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setup;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setup::create([
            'batashari' => 3,
        ]);
    }
}
