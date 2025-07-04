<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBarang extends Model
{
    use HasFactory;

    protected $table = 'permintaan_barang';

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(PermintaanBarangDetail::class, 'id_pr');
    }

    public function pengirimanBarang()
    {
        return $this->belongsTo(PengirimanBarang::class, 'id', 'id_permintaan_barang');
    }
}
