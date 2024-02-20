<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class infoKlinik extends Model
{
    use HasFactory;

    protected $fillable = [
        'klinik_nama',
        'klinik_subnama',
        'sip',
        'alamat',
        'email',
        'notelp',
        'website',
        'user_id',
    ];

}
