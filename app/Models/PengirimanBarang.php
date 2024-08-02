<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanBarang extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_barang_table';

    protected $guarded = ['id'];

    public function kontrakRinci()
    {
        return $this->hasOne(KontrakRinci::class, 'id', 'id_kontrak_rinci');
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
