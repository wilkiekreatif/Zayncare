<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trx_kasir_umum extends Model
{
    protected $table = 'trx_kasir_umums';
    protected $fillable = [
                            'tanggal_transaksi',
                            'id_transaksi',
                            'total_transaksi',
                            'user_id'
                        ];
}
