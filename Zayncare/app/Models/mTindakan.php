<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mTindakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tindakan_nama',
        'jenis',
        'tarifdasar',
        'margin1',
        'margin2',
        'margin3',
        'is_active',
        'user_id'
    ];

    public function trxTindakan()
    {
        return $this->hasMany(trxTindakanpasien::class, 'id', 'tindakan_id');
    }
}
