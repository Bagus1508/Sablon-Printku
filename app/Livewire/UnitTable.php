<?php

namespace App\Livewire;

use App\Models\DataSatuan;
use Livewire\Component;
use Livewire\WithPagination;

class UnitTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Nama_satuan, $Singkatan;

    protected $listeners = [
        'editSatuan' => 'editSatuan'
    ];    

    public $isModalOpen = false;

    public function editSatuan(int $id){
        $this->ID = $id;
        $data = DataSatuan::findOrFail($id);

        $this->Nama_satuan = $data->nama_satuan; // Sesuaikan dengan nama properti yang benar
        $this->Singkatan = $data->singkatan; // Sesuaikan jika perlu
    }    

    public function deleteSatuan(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = DataSatuan::orderBy('id','desc')
        ->where('nama_satuan','ilike','%'.$this->search.'%')
        ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.unit-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
