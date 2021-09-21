<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopikBidang extends Model
{
    protected $table = "topikbidang";
    use HasFactory;

    protected $fillable = [
        'id', 'nama_topik'
    ];

    public function Skripsi(){
        return $this->hasMany(Topikskripsi::class,'id_topikbidang');
    }
}
