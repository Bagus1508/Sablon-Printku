<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HargaProduk extends Model
{
    use HasFactory;

    protected $table = 'harga_produk';

    protected $guarded = ['id'];
}
