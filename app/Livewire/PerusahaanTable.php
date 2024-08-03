<?php

namespace App\Livewire;

use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class PerusahaanTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public    $findProvinceById,
    $findRegencieById,
    $findDistrictById,
    $findVillageById,
    $apiProvice,
    $apiRegencies,
    $apiDistricts,
    $apiVillages,
    $filter, $ID, $ID_delete, $Kode_perusahaan, $Nama_perusahaan, $No_telepon, $Email,
    $ID_provinsi, $ID_kota, $ID_kecamatan, $ID_kelurahan,
    
    $Alamat, $AlamatJalan, $Provinsi, $Kota, $Kecamatan, $Kelurahan, $Rt, $Rw;

    protected $listeners = [
        'editPerusahaan' => 'editPerusahaan'
    ];    

    public function getRegencies(){
        $this->ID_provinsi = explode('|', $this->ID_provinsi);

        $this->apiRegencies = $this->fetchRegencies((int)$this->ID_provinsi[0]);
        $this->reset('apiDistricts');
        $this->reset('apiVillages');
    }
    public function getDistricts(){
        $this->ID_kota = explode('|', $this->ID_kota);

        $this->apiDistricts = $this->fetchDistricts((int)$this->ID_kota[0]);
        $this->reset('apiVillages');

    }
    public function getVillages(){
        $this->ID_kecamatan = explode('|', $this->ID_kecamatan);

        $this->apiVillages  = $this->fetchVillages((int)$this->ID_kecamatan[0]);
    }

    public $isModalOpen = false;

    public function editPerusahaan(int $id){
        $this->ID = $id;
        $data = DataPerusahaan::findOrFail($id);
    
        $dataAlamat = DataAlamat::select('id_provinsi', 'id_kota', 'id_kecamatan', 'id_kelurahan', 'alamat', 'rt','rw')
            ->where("id", $this->ID)
            ->first();
    
        if ($dataAlamat) {
            $this->apiRegencies = $this->fetchRegencies((int)$dataAlamat->id_provinsi);
            $this->apiDistricts = $this->fetchDistricts((int)$dataAlamat->id_kota);
            $this->apiVillages  = $this->fetchVillages((int)$dataAlamat->id_kecamatan);
    
            $this->Provinsi = $dataAlamat->id_provinsi;
            $this->Kota = $dataAlamat->id_kota; 
            $this->Kecamatan = $dataAlamat->id_kecamatan;
            $this->Kelurahan = $dataAlamat->id_kelurahan;
            $this->Rt = $dataAlamat->rt;
            $this->Rw = $dataAlamat->rw;
            $this->AlamatJalan = $dataAlamat->alamat;
        } else {
            // Handle the case where $dataAlamat is null
            $this->apiRegencies = [];
            $this->apiDistricts = [];
            $this->apiVillages  = [];
            
            $this->Provinsi = '';
            $this->Kota = ''; 
            $this->Kecamatan = '';
            $this->Kelurahan = '';
            $this->Rt = '';
            $this->Rw = '';
            $this->AlamatJalan = '';
        }
    
        $this->Kode_perusahaan = $data->kode_perusahaan; // Sesuaikan jika perlu
        $this->Nama_perusahaan = $data->nama_perusahaan; // Sesuaikan dengan nama properti yang benar
        $this->No_telepon = $data->no_telepon;
        $this->Email = $data->email;
    
        $this->myModal('#modal-edit-perusahaan');
    }
    
    
    public function myModal($overlayValue, $id = null) {
        $this->resetvalidation();
        $this->id_param = $id;
        $this->dispatch('myModal', [
            'nama_modal'=>$overlayValue,
            'id'        => $id
        ]);
    }

    public function success($title) {
        $this->dispatchBrowserEvent('swal', [
            'title' => $title,
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton'=>false,
            'timerProgressBar'=>true,
            'width'=> 'fit-content',
        ]);
    }
    
    public function error($title) {
        $this->dispatchBrowserEvent( 'swal', [
            'title' => $title,
            'timer'=>3000,
            'icon'=>'error',
            'toast'=>true,
            'position'=>'top-right',
            'showConfirmButton'=>false,
            'timerProgressBar'=>true,
            'width'=> 'fit-content',
        ] );
    }

    public function deletePerusahaan(int $id){
        $this->ID_delete = $id;
    }

    public function render()
    {
        $Data = DataPerusahaan::orderBy('id','desc')
        ->where('kode_perusahaan','LIKE','%'.$this->search.'%')
        ->orwhere('nama_perusahaan','LIKE','%'.$this->search.'%')
        ->paginate($this->perPage);

        $this->apiProvice   = $this->fetchProvince();

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.perusahaan-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
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
