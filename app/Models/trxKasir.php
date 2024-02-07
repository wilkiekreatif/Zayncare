<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trxKasir extends Model
{
    use HasFactory;
    protected $table = 'trx_kasirs';
    protected $fillable = [
                            'id_transaksi',
                            'tanggal_transaksi',
                            'no_rekmed',
                            'nama_pasien',
                            'asal_poli',
                            'kelas_tarif',
                            'total_tindakan',
                            'total_obat_alkes',
                            'total_transaksi',
                            'user_id'
                        ];
}
