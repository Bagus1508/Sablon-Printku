<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAlamat extends Model
{
    use HasFactory;

    protected $table = 'alamat';

    protected $guarded = ['id'];
}
