<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPermintaanBarang extends Model
{
    use HasFactory;
    
    protected $table = 'verifikasi_permintaan_barang';

    protected $guarded = ['id'];
}
