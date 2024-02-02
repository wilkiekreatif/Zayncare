<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trxObatalkes extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id',
        'obatalkes_id',
        'racikan',
        'racikanke',
        'embalace',
        'tarifembalace',
        'qty',
        'satuan',
        'etiket',
        'signa',
        'tarif',
        'total',
        'status',
        'user_id',
    ];

    public function mObatalkes(){
        return $this->belongsTo(m_obatalkes::class,'obatalkes_id');
    }
}
