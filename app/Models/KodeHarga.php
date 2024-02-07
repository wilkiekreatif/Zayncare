<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KodeHarga extends Model
{
    protected $table = 'kode_harga_t';
    protected $fillable = ['tindakan','kode'];

    public function tindakan(){
        return $this->hasOne(mTindakan::class);
    }
}
