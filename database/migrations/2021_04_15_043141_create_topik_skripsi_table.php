<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopikSkripsiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topik_skripsi', function (Blueprint $table) {
            $table->id();
            $table->string('judul_topik');
            $table->longText('deskripsi');
            $table->integer('id_periode');
            $table->integer('id_topikbidang');
            $table->string('nim_submit', 11)->nullable();
            $table->string('nim_terpilih', 11)->nullable();
            $table->string('nipy', 20);
            $table->string('option_from');
            $table->string('status')->nullable();
            $table->string('status_mahasiswa')->nullable();
            $table->string('dosen_penguji_1', 20)->nullable();
            $table->string('dosen_penguji_2', 20)->nullable();
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
        Schema::dropIfExists('topik_skripsi');
    }
}
