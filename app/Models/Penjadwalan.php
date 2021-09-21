<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    protected $table = "penjadwalan";
    use HasFactory;

    protected $fillable = [
        'date', 'waktu_mulai', 'waktu_selesai', 'kode_jam_mulai', 'kode_jam_selesai', 'meet_room', 'topik_skripsi_id'
    ];

    public function topikSkripsi()
    {
        return $this->belongsTo(TopikSkripsi::class, 'topik_skripsi_id');
    }

    public function linkGoogleMeet()
    {
        return $this->belongsTo(GoogleMeet::class, 'meet_room', 'title_room');
    }

    public function toNilaiSemprop()
    {
        return $this->hasMany(NilaiSemprop::class, 'id_penjadwalan', 'id');
    }

    public function toNilaiPendadaran()
    {
        return $this->hasMany(NilaiPendadaran::class, 'id_penjadwalan', 'id');
    }
}
