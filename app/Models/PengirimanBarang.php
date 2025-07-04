<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_barang_table';

    protected $guarded = ['id'];

    public function permintaanBarang()
    {
        return $this->hasOne(PermintaanBarang::class, 'id', 'id_permintaan_barang');
    }

    public function penerimaanBarang()
    {
        return $this->hasOne(PenerimaanBarang::class, 'id_pengiriman_barang', 'id');
    }

    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'id_region');
    }

    public function ekspedisi()
    {
        return $this->hasOne(DataEkspedisi::class, 'id', 'id_ekspedisi');
    }
}
