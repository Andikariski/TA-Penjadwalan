<?php

use PhpParser\Builder\Namespace_;

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class ImportJadwal extends Model
{
    protected $table = "jadwal_dosen";
    protected $primaryKey = "id";
    protected $fillable = [
        'nipy', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'jam_ke'
    ];
}
