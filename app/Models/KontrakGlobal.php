<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakGlobal extends Model
{
    use HasFactory;

    protected $table = 'kontrak_global';

    protected $guarded = ['id'];

    public function barangKontrak()
    {
        return $this->hasMany(ProdukKontrak::class, 'id_kontrak_global', 'id');
    }

    public function perusahaan()
    {
        return $this->hasOne(DataPerusahaan::class, 'id', 'id_perusahaan');
    }
}
