<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokGlobal extends Model
{
    use HasFactory;

    protected $table = 'stok_global';

    protected $guarded = ['id'];

    public function produk(){
        return $this->BelongsTo(Produk::class, 'id_produk');
    }

    public function satuan(){
        return $this->BelongsTo(DataSatuan::class, 'id_satuan');
    }
}
