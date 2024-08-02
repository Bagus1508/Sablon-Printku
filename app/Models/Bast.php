<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    use HasFactory;

    protected $table = 'bast_table';

    protected $guarded = ['id'];

    public function kontrakRinci()
    {
        return $this->hasOne(KontrakRinci::class, 'id', 'id_kontrak_rinci');
    }
}
