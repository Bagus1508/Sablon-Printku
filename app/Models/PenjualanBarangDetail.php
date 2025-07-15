<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarangDetail extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan_barang_detail';

    protected $guarded = ['id'];
}
