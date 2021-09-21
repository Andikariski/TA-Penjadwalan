<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalDosenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_dosen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nipy');
            $table->string('senin');
            $table->string('selasa');
            $table->string('rabu');
            $table->string('kamis');
            $table->string('jumat');
            $table->string('sabtu');
            $table->string('jam_ke');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jadwal_dosen');
    }
}
