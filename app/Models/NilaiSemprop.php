<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSemprop extends Model
{
    use HasFactory;

    protected $table = "nilai_semprop";

    protected $fillable = [
        'id_pertanyaanSemprop', 'id_penjadwalan','nipy','option','nilai'
    ];

    public function semproptoNilai()
    {
        return $this->belongsTo(PertanyaanSemprop::class, 'id_pertanyaanSemprop', 'id');
    }

    public function dosenMenilaiSemprop()
    {
        return $this->belongsTo(Dosen::class, 'nipy', 'nipy');
    }

    public function fromPenjadwalan(){
        return $this->belongsTo(Penjadwalan::class,'id_penjadwalan','id');
    }
}
