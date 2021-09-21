<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenTerjadwal extends Model
{
    protected $table = "dosen_terjadwal";

    use HasFactory;
    protected $fillable = [
        'nipy', 'date', 'jam_ke', 'penjadwalan_id'
    ];
}
