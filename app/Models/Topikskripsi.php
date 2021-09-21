<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topikskripsi extends Model
{
    protected $table = "topik_skripsi";
    use HasFactory;

    protected $fillable = [
        'judul_topik',
        'deskripsi',
        'id_periode',
        'id_topikbidang',
        'nim_submit',
        'nim_terpilih',
        'nipy',
        'option_from',
        'status',
        'status_mahasiswa',
        'dosen_penguji_1',
        'dosen_penguji_2',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nipy', 'nipy');
    }

    public function dosenPenguji1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_1', 'nipy');
    }

    public function dosenPenguji2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_penguji_2', 'nipy');
    }

    public function mahasiswaSubmit()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_submit', 'nim');
    }

    public function mahasiswaTerpilih()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_terpilih', 'nim');
    }

    public function topik()
    {
        return $this->belongsTo(TopikBidang::class, 'id_topikbidang', 'id');
    }

    public function mahasiswaGetSkripsi()
    {
        return $this->hasMany(MahasiswaRegisterTopikDosen::class, 'id_topikskripsi');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode', 'id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class, 'id_topikskripsi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function syaratujian()
    {
        return $this->hasOne(SyaratUjian::class, 'id_Skripsimahasiswa', 'id');
    }

    public function penjadwalan()
    {
        return $this->hasOne(Penjadwalan::class, 'topik_skripsi_id');
    }

    // public function
}
