<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PertanyaanPendadaran extends Model
{
    use HasFactory;
    protected $table = "pertanyaan_pendadaran";

    protected $fillable = [
        'komponen','bobot'
    ];

    public function subPendadaran(){
        return $this->hasMany(SubPertanyaanPendadaran::class,'id_pertanyaanPendadaran', 'id');
    }

}
