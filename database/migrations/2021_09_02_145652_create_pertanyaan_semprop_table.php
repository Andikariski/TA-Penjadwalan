<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaanSempropTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan_semprop', function (Blueprint $table) {
            $table->id();
            $table->string('unsurPenilaian');
            $table->integer('rangeNilai');
            $table->boolean('isPembimbing');
            $table->boolean('isPenguji1');
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
        Schema::dropIfExists('pertanyaan_semprop');
    }
}
