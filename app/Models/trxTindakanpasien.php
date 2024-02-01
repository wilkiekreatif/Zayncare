<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trxTindakanpasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'tindakan_id',
        'qty',
        'satuan',
        'tarif',
        'total',
        'status',
        'user_id'
    ];

    public function mTindakan()
    {
        return $this->belongsTo(mTindakan::class, 'tindakan_id', 'id');
    }
    public function trxPasien()
    {
        return $this->belongsTo(m_pasien::class,'trx_id','id');
    }
}
