<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDosenTerjadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dosen_terjadwal', function (Blueprint $table) {
            $table->id();
            $table->string('nipy');
            $table->unsignedBigInteger('penjadwalan_id')->nullable();
            $table->string('date');
            $table->string('jam_ke');
            $table->timestamps();

            $table->foreign('penjadwalan_id')->references('id')->on('penjadwalan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dosen_terjadwal');
    }
}
