<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataWarna extends Model
{
    use HasFactory;

    protected $table = 'data_warna_table';

    protected $guarded = ['id'];

    public function dataMerek(){
        return $this->hasOne(DataMerek::class, 'id', 'id_merek');
    }
}
