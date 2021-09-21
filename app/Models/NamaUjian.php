<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaUjian extends Model
{
    use HasFactory;
    protected $table = "nama_ujian";

    protected $fillable = [
        'NamaUjian'
    ];

    public function syaratToUjian(){
        return $this->hasMany(SyaratUjian::class,'id_NamaUjian', 'id');
    }

}
