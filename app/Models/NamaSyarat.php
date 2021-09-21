<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NamaSyarat extends Model
{
    use HasFactory;
    protected $table = "nama_syarat";

    protected $fillable = [
        'NamaSyarat'
    ];

    public function syarat(){
        return $this->hasMany(Syarat::class,'id_NamaSyarat', 'id');
    }

    public function toTopikSkripsi(){
          return $this->belongsTo(Topikskripsi::class,'id_Skripsimahasiswa','id');
    }
    
}
