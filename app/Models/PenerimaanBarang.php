<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanBarang extends Model
{
    use HasFactory;
    
    protected $table = 'penerimaan_barang';

    protected $guarded = ['id'];

    public function permintaanBarang()
    {
        return $this->hasOne(PermintaanBarang::class, 'id', 'id_permintaan_barang');
    }
}
