<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $table = "logbook";

    use HasFactory;
    protected $fillable = [
        'kegiatan', 'catatan_kemajuan','status','file','id_topikskripsi','created_at'
    ];

    public function skripsi(){
        return $this->belongsTo(Topikskripsi::class,'id_topikskripsi','id');
    }
}
