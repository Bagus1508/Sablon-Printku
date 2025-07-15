<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerahTerimaBarang extends Model
{
    use HasFactory;
    
    protected $table = 'serah_terima_barang';

    protected $guarded = ['id'];

    public function penjualanBarang()
    {
        return $this->hasOne(PenjualanBarang::class, 'id', 'id_penjualan_barang');
    }
}
