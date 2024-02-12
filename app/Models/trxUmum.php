<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trxUmum extends Model
{
    use HasFactory;
    protected $table ='trx_umums';
    protected $fillable = [
        'trx_id',
        'total',
        'status',
        'user_id'
    ];

    public function mObatalkes(){
        return $this->belongsTo(m_obatalkes::class,'obatalkes_id');
    }

    public static function totalObatAlkes($id){
        return self::where('trx_id', $id)->sum('total');
    }
}
