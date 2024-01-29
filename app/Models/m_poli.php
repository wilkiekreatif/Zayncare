<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'poli_nama',
        'is_active',
        'user_id'
    ];

    public function trxPasien()
    {
        return $this->hasMany(trxPasien::class,'id','poli_id');
    }
}
