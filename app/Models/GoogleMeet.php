<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleMeet extends Model
{
    protected $table = "google_meet";
    use HasFactory;

    protected $fillable = [
        'id', 'title_room', 'link_google_meet'
    ];

    public function PenjadwalanMeet()
    {
        return $this->hasMany(Penjadwalan::class, 'meet_room', 'title_room');
    }
}
