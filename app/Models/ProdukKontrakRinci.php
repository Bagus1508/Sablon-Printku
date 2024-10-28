<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKontrakRinci extends Model
{
    use HasFactory;

    protected $table = 'produk_kontrak_rinci';

    protected $guarded = ['id'];

    public function satuan(){
        return $this->BelongsTo(DataSatuan::class, 'id_satuan');
    }

    public function dataProduk(){
        return $this->BelongsTo(Produk::class, 'id_produk');
    }

    public function kontrakGlobal(){
        return $this->hasOne(KontrakGlobal::class, 'id_kontrak_global', 'id');
    }
}
