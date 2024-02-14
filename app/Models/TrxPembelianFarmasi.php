<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPembelianFarmasi extends Model
{
    use HasFactory;

    protected $table = 'trx_pembelian_farmasis';
    protected $fillable = [
        'trx_id',
        'obatalkes_id',
        'satuan',
        'supplier_id',
        'hargabeli',
        'hargabelisetelahfaktur',
        'qty',
        'no_faktur',
        'diskon',
        'ppn',
        'totalbayar',
        'user_id',
        'is_active'
    ];

    public function supplier()
    {
        return $this->belongsTo(m_supplier::class,'supplier_id');
    }

    public function obatalkes()
    {
        return $this->belongsTo(m_obatalkes::class,'obatalkes_id');
    }
}
