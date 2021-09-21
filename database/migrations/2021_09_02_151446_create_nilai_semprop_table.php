<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiSempropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_semprop', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pertanyaanSemprop');
            $table->integer('id_penjadwalan');
            $table->string('nipy', 20);
            $table->enum('option', ['pembimbing', 'penguji1']);
            $table->integer('nilai');
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
        Schema::dropIfExists('nilai_semprop');
    }
}
