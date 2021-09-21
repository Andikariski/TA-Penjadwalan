<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    protected $table = "periode";

    protected $fillable = [
        'tahun_periode', 'status'
    ];


    public function skripsi(){
        return $this->hasMany(Topikskripsi::class,'id_periode');
    }

}
