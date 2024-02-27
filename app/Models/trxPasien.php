<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trxPasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'pasien_id',
        'poli_id',
        'kelastarif',
        'antrian',
        'status',
        'user_id'
    ];

    public function mPasien()
    {
        return $this->belongsTo(m_pasien::class,'pasien_id','id');
    }
    public function mPoli()
    {
        return $this->belongsTo(m_poli::class,'poli_id','id');
    }
}
