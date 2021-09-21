<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiPendadaran extends Model
{
    use HasFactory;

    protected $table = "nilai_pendadaran";

    protected $fillable = [
        'id_subPertanyaanPendadaran', 'id_penjadwalan','nipy','option','nilai'
    ];

    public function subPendadarantoNilai()
    {
        return $this->belongsTo(SubPertanyaanPendadaran::class, 'id_subPertanyaanPendadaran', 'id');
    }

    public function dosenMenilaiPendadaran()
    {
        return $this->belongsTo(Dosen::class, 'nipy', 'nipy');
    }

    public function fromPenjadwalan(){
        return $this->belongsTo(Penjadwalan::class,'id_penjadwalan','id');
    }
}
