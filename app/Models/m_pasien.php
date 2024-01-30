<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_rm',
        'label',
        'gelardepan',
        'pasien_nama',
        'gelarbelakang',
        'tgllahir',
        'jeniskelamin',
        'alamat',
        'desa',
        'kecamatan',
        'kota',
        'no_telp',
        'agama',
        'pendidikan',
        'asuransi1',
        'asuransi2',
        'asuransi3',
        'user_id'
    ];

    public function trx_pasien()
    {
        return $this->hasMany(trxPasien::class ,'id', 'pasien_id');
    }
}
