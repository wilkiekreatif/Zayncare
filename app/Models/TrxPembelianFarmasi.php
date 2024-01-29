<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxPembelianFarmasi extends Model
{
    use HasFactory;

    protected $table = 'trx_pembelian_farmasi';
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
        // 'user_id',
        'is_active'
    ];

    //membuat trx_id otomatis  dengan format TRX-DDMMYYYY-00001 (TRX= Supplier)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latestSupplierId = static::latest('supplier_id')->value('supplier_id');

            if ($latestSupplierId) {
                $number = (int)substr($latestSupplierId, 2) + 1;
            } else {
                $number = 1;
            }
            $tglskrg    = Carbon::now()->format('dmY');
            $model->supplier_id = 'TRX-'.$tglskrg.'-'. str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }

    public function supplier()
    {
        return $this->belongsTo(m_supplier::class,'supplier_id');
    }

    public function obatalkes()
    {
        return $this->belongsTo(m_supplier::class,'obatalkes_id');
    }
}
