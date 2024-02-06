<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trxUmum extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'Total',
        'status',
        'user_id'
    ];
}
