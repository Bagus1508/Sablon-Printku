<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk_table';

    protected $guarded = ['id'];

    public function warna(){
        return $this->BelongsTo(DataWarna::class, 'id_warna');
    }
    public function kategori(){
        return $this->BelongsTo(ProdukKategori::class, 'id_kategori');
    }
    public function satuan(){
        return $this->BelongsTo(DataSatuan::class, 'id_satuan');
    }
    public function ukuran(){
        return $this->BelongsTo(DataUkuran::class, 'id_ukuran');
    }
    public function perusahaan(){
        return $this->BelongsTo(DataPerusahaan::class, 'id_perusahaan');
    }

    // Relasi ke model Stok
    public function stokHarian()
    {
        return $this->hasMany(StokHarian::class, 'id_produk', 'id');
    }
    public function stok()
    {
        return $this->hasMany(StokHarian::class, 'id_produk', 'id');
    }

    // Event deleting untuk menghapus stok terkait
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($produk) {
            $produk->stok()->delete();
        });
    }
}
