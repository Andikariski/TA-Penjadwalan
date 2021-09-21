<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratUjian extends Model
{
    use HasFactory;
    protected $table = "syarat_ujian";

    protected $fillable = [
        'id_Skripsimahasiswa','status','keterangan','id_NamaUjian'
    ];

     public function skripsiTopik(){
        return $this->belongsTo(Topikskripsi::class,'id_Skripsimahasiswa','id');
    }

    public function namaujian()
    {
        return $this->belongsTo(NamaUjian::class, 'id_NamaUjian', 'id');
    }

    public function syarat(){
        return $this->hasMany(Syarat::class,'id_SyaratUjian', 'id');
    }
}
