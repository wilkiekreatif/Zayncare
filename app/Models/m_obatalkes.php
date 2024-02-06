<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_obatalkes extends Model
{
    use HasFactory;

    protected $table = 'm_obatalkes';

    protected $fillable = [
        'obatalkes_id',
        'obatalkes_jenis',
        'obatalkes_nama',
        'supplier1_id',
        'supplier2_id',
        'supplier3_id',
        'satuan',
        'hargabeliterakhir',
        'margin1',
        'margin2',
        'margin3',
        'margin4',
        'margin5',
        'is_active',
        'wajibresep',
        'user_id',
    ];

    public function supplier1()
    {
        return $this->belongsTo(m_supplier::class,'supplier1_id');
    }
    public function supplier2()
    {
        return $this->belongsTo(m_supplier::class,'supplier2_id');
    }
    public function supplier3()
    {
        return $this->belongsTo(m_supplier::class,'supplier3_id');
    }
}
