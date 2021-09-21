<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiPendadaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_pendadaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_subPertanyaanPendadaran');
            $table->integer('id_penjadwalan');
            $table->string('nipy', 20);
            $table->enum('option', ['pembimbing', 'penguji1','penguji2']);
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
        Schema::dropIfExists('nilai_pendadaran');
    }
}
