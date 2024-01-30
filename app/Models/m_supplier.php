<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_supplier extends Model
{
    use HasFactory;

    protected $table = 'm_suppliers';
    protected $fillable = [
        'supplier_id',
        'supplier_nama',
        'supplier_alamat',
        'supplier_telp',
        'user_id',
        'is_active'
    ];

    //membuat supplier_ID otomatis  dengan format S-00001 (S= Supplier)
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

            $model->supplier_id = 'S-' . str_pad($number, 5, '0', STR_PAD_LEFT);
        });
    }
}
