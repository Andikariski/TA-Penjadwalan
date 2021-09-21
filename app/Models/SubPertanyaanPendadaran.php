<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubPertanyaanPendadaran extends Model
{
    use HasFactory;

    protected $table = "sub_pertanyaan_pendadaran";

    protected $fillable = [
        'id_pertanyaanPendadaran', 'skor','keterangan'
    ];

    public function pertanyaanPendadaran()
    {
        return $this->belongsTo(PertanyaanPendadaran::class, 'id_pertanyaanPendadaran', 'id');
    }

    public function nilaiPendadaran(){
        return $this->hasMany(NilaiPendadaran::class, 'id_subPertanyaanPendadaran','id');
    }
}
