<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    use HasFactory;

    protected $table = 'produk_table';

    protected $guarded = ['id'];
    
    public function kategori(){
        return $this->hasOne(ProdukKategori::class, 'id', 'id_kategori');
    }

    public function warna(){
        return $this->hasOne(DataWarna::class, 'id', 'id_warna');
    }

    public function satuan(){
        return $this->hasOne(DataSatuan::class, 'id', 'id_satuan');
    }

    public function stok(){
        return $this->hasOne(StokHarian::class, 'id_produk', 'id');
    }
}
