<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $table = "dosen";
    use HasFactory;

    protected $fillable = [
        'nipy', 'nidn', 'jabfung', 'avatar', 'user_id'
    ];


    //atribut user_id adalah kepunyaan dari tb user, dan id adalak kepunyaan dari tb dosen
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    //atribut nipy adalah kepunyaan dari tabel topikSkripsi (FK)
    public function skripsi()
    {
        return $this->hasMany(Topikskripsi::class, 'nipy', 'nipy');
    }

    public function skripsiPenguji1()
    {
        return $this->hasMany(Topikskripsi::class, 'dosen_penguji_1', 'nipy');
    }

    public function skripsiPenguji2()
    {
        return $this->hasMany(Topikskripsi::class, 'dosen_penguji_2', 'nipy');
    }

    public function getAvatarAttribute($value)
    {
        return url('storage/' . $value);
    }

    public function dosentoPendadaran()
    {
        return $this->hasMany(NilaiPendadaran::class, 'nipy', 'nipy');
    }

    public function dosentoSemprop()
    {
        return $this->hasMany(NilaiSemprop::class, 'nipy', 'nipy');
    }
}
