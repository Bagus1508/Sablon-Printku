<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataMerek extends Model
{
    use HasFactory;

    protected $table = 'data_merek_table';

    protected $guarded = ['id'];

    public function kategori(){
        return $this->hasOne(ProdukKategori::class, 'id', 'id_kategori');
    }
}
