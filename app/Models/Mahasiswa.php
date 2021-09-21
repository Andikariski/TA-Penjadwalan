<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = "mahasiswa";

    protected $fillable = [
        'nim', 'status','avatar','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function skripsiSubmit(){
        return $this->hasMany(Topikskripsi::class,'nim_submit','nim');
    }

    public function skripsiPilih(){
        return $this->hasMany(Topikskripsi::class,'nim_terpilih','nim');
    }

    public function getSkripsi(){
        return $this->hasMany(MahasiswaRegisterTopikDosen::class,'nim');
    }

    
}
