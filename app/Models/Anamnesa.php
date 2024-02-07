<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anamnesa extends Model
{
    use HasFactory;
    protected $table = 'trx_anamnesapasiens';
    protected $fillable = [
        'trx_id',
        'detakjantung',
        'tensi1',
        'tensi2',
        'suhu',
        'beratbadan',
        'user_id'
    ];

    public function trxPasien()
    {
        return $this->belongsTo(m_pasien::class,'trx_id','id');
    }
}
