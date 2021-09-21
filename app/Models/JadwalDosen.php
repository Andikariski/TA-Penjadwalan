<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JadwalDosen extends Model
{
    protected $table = "jadwal_dosen";
    use HasFactory;

    protected $fillable = [
        'nipy', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'jam_ke'
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nipy', 'nipy');
    }
}
