<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    use HasFactory;

    protected $table = 'penjualan_barang';

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(PenjualanBarangDetail::class, 'id_pb');
    }

    public function penerimaanBarang()
    {
        return $this->hasOne(SerahTerimaBarang::class, 'id_penjualan_barang', 'id');
    }
}
