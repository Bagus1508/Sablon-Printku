<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUkuran extends Model
{
    use HasFactory;

    protected $table = 'ukuran_table';

    protected $guarded = ['id'];
}
