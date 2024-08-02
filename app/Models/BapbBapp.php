<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BapbBapp extends Model
{
    use HasFactory;

    protected $table = 'bapb_bapp_table';

    protected $guarded = ['id'];

    public function kontrakRinci()
    {
        return $this->hasOne(KontrakRinci::class, 'id', 'id_kontrak_rinci');
    }
}
