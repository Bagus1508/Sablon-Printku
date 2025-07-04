<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanBarangDetail extends Model
{
    use HasFactory;
    
    protected $table = 'permintaan_barang_detail';

    protected $guarded = ['id'];
}
