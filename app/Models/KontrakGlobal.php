<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakGlobal extends Model
{
    use HasFactory;

    protected $table = 'kontrak_global';

    protected $guarded = ['id'];

}
