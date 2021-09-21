<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    protected $table = "set_up";
    use HasFactory;

    protected $fillable = [
        'batashari'
    ];
}
