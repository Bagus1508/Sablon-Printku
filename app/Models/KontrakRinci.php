<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontrakRinci extends Model
{
    use HasFactory;

    protected $table = 'kontrak_rinci_table';

    protected $guarded = ['id'];

    public function prosesCutting()
    {
        return $this->hasOne(ProsesCutting::class, 'id_kontrak_rinci', 'id');
    }

    public function prosesJahit()
    {
        return $this->hasOne(ProsesJahit::class, 'id_kontrak_rinci', 'id');
    }

    public function prosesPacking()
    {
        return $this->hasOne(ProsesPacking::class, 'id_kontrak_rinci', 'id');
    }

    public function barangKontrak()
    {
        return $this->hasMany(ProdukKontrak::class, 'id_kontrak_rinci', 'id');
    }

    public function pengirimanBarang()
    {
        return $this->hasOne(PengirimanBarang::class, 'id_kontrak_rinci', 'id');
    }

    public function ba_rikmatek()
    {
        return $this->hasOne(BaRikmatek::class, 'id_kontrak_rinci', 'id');
    }

    public function bapb_bapp()
    {
        return $this->hasOne(BapbBapp::class, 'id_kontrak_rinci', 'id');
    }

    public function bast()
    {
        return $this->hasOne(Bast::class, 'id_kontrak_rinci', 'id');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'id_kontrak_rinci', 'id');
    }

    public function kontrakGlobal()
    {
        return $this->hasOne(KontrakGlobal::class, 'id_kontrak_rinci', 'id');
    }

    public function perusahaan()
    {
        return $this->hasOne(DataPerusahaan::class, 'id', 'id_perusahaan');
    }
}
