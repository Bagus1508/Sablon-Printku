<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProsesJahit extends Model
{
    use HasFactory;

    protected $table = 'proses_jahit';

    protected $guarded = ['id'];

    public function kontrakRinci()
    {
        return $this->hasOne(KontrakRinci::class, 'id', 'id_kontrak_rinci');
    }
}
