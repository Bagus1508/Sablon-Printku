<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokHarian extends Model
{
    use HasFactory;

    protected $table = 'stok_harian_table';

    protected $guarded = ['id'];

    public function produk(){
        return $this->BelongsTo(Produk::class, 'id_produk');
    }

    public function satuan(){
        return $this->BelongsTo(DataSatuan::class, 'id_satuan');
    }

    public function ukuran(){
        return $this->BelongsTo(DataUkuran::class, 'id_ukuran');
    }

    public function hargaProduk(){
        return $this->hasOne(HargaProduk::class, 'id_stok_harian', 'id');
    }

    public function getTotalRollsAttribute()
    {
        return floor($this->stok_masuk / $this->roll_length);
    }

    public function getUsedRollsAttribute()
    {
        return floor($this->stok_keluar / $this->roll_length);
    }
}
