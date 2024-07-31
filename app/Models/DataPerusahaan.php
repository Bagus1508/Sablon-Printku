<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerusahaan extends Model
{
    use HasFactory;

    protected $table = 'perusahaan_table';

    protected $guarded = ['id'];

    public function alamat(){
        return $this->BelongsTo(DataAlamat::class, 'id_alamat');
    }
}
