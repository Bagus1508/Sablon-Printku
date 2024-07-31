<?php

namespace App\Livewire;

use App\Models\DataAlamat;
use Illuminate\Support\Facades\Log; // Tambahkan ini
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\StatusEditModel;
use Illuminate\Support\Facades\Http;

class DataWilayah extends Component
{
    public
    $findProvinceById,
    $findRegencieById,
    $findDistrictById,
    $findVillageById,
    $apiProvice,
    $apiRegencies,
    $apiDistricts,
    $apiVillages,
    
    $ID,$edit, $Alamat, $provinsi,$kota, $kecamatan, $kelurahan, $alamat, $rtrw;

    public function getRegencies(){
        $this->apiRegencies = $this->fetchRegencies((int)$this->provinsi);
        $this->reset('apiDistricts');
        $this->reset('apiVillages');
    }
    public function getDistricts(){
        $this->apiDistricts = $this->fetchDistricts((int)$this->kota);
        $this->reset('apiVillages');

    }
    public function getVillages(){
        $this->apiVillages  = $this->fetchVillages((int)$this->kecamatan);

    }

    public function render()
    {
        if(strlen($this->rtrw) == 3){
            $part1 = substr($this->rtrw, 0, 3);
            $part2 = substr($this->rtrw, 3, 3);
            $this->rtrw = $part1 . '/' . $part2;
        }

        $this->apiProvice   = $this->fetchProvince();

        if($this->Alamat->provinsi ??'' && $this->Alamat->kota && $this->Alamat->kecamatan && $this->Alamat->kelurahan){
            $this->findProvinceById = Str::title(collect($this->fetchProvince())->filter(function ($item) {
                return $item['id'] == $this->Alamat->provinsi;
            })->first()['name']);

            $this->findRegencieById = Str::title(collect($this->fetchRegencies((int)$this->Alamat->provinsi))->filter(function ($item) {
                return $item['id'] == $this->Alamat->kota;
            })->first()['name']);

            $this->findDistrictById = Str::title(collect($this->fetchDistricts((int)$this->Alamat->kota))->filter(function ($item) {
                return $item['id'] == $this->Alamat->kecamatan;
            })->first()['name']);

            $this->findVillageById = Str::title(collect($this->fetchVillages((int)$this->Alamat->kecamatan))->filter(function ($item) {
                return $item['id'] == $this->Alamat->kelurahan;
            })->first()['name']);
        }

        return view('livewire.data-wilayah');
    }
    public function fetchProvince(){
        return Http::get(env('API_WILAYAH').'provinces.json')->json();
    }
    public function fetchRegencies($province){
        return Http::get(env('API_WILAYAH').'regencies/'.$province.'.json')->json();
    }
    public function fetchDistricts($regencie){
        return Http::get(env('API_WILAYAH').'districts/'.$regencie.'.json')->json();
    }
    public function fetchVillages($districts){
        return Http::get(env('API_WILAYAH').'villages/'.$districts.'.json')->json();
    }
}
