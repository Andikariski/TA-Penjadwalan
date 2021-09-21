<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanSemprop extends Model
{
    use HasFactory;

    protected $table = "pertanyaan_semprop";

    protected $fillable = [
        'unsurPenilaian', 'rangeNilai','isPembimbing','isPenguji1'
    ];

    public function nilaiSemprop(){
        return $this->hasMany(NilaiSemprop::class, 'id_pertanyaanSemprop','id');
    }
}
