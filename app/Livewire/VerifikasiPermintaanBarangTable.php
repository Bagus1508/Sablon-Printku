<?php

namespace App\Livewire;

use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use App\Models\PermintaanBarang;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class VerifikasiPermintaanBarangTable extends Component
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

    public $isModalOpen = false;

    public function editPerusahaan(int $id){
        $this->ID = $id;
    
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
        $Data = PermintaanBarang::with('pengirimanBarang')
            ->orderBy('id', 'desc')
            ->where(function ($query) {
                $query->where('no_transaksi', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('nama', 'LIKE', '%' . $this->search . '%');
            })
            ->whereIn('status', [1])
            ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.verifikasi-permintaan-barang-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
