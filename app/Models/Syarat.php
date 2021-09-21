<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syarat extends Model
{
    use HasFactory;
    protected $table = "syarat";

    protected $fillable = [
        'NamaSyaratFile', 'id_SyaratUjian','id_NamaSyarat','status','keterangan'
    ];

    public function syaratUjian()
    {
        return $this->belongsTo(SyaratUjian::class, 'id_SyaratUjian', 'id');
    }

    public function namaSyarat()
    {
        return $this->belongsTo(NamaSyarat::class, 'id_NamaSyarat', 'id');
    }
}
