<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKontrak extends Model
{
    use HasFactory;

    protected $table = 'produk_kontrak';

    protected $guarded = ['id'];

    public function satuan(){
        return $this->BelongsTo(DataSatuan::class, 'id_satuan');
    }

    public function dataProduk(){
        return $this->BelongsTo(Produk::class, 'id_produk');
    }
}
