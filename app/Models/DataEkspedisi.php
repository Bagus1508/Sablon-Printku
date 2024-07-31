<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataEkspedisi extends Model
{
    use HasFactory;

    protected $table = 'data_ekspedisi_table';

    protected $guarded = ['id'];
}
