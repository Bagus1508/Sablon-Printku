<?php

namespace App\Livewire;

use App\Models\Region;
use Livewire\Component;
use Livewire\WithPagination;

class RegionTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Nama_region;

    protected $listeners = [
        'editRegion' => 'editRegion'
    ];    

    public $isModalOpen = false;

    public function editRegion(int $id){
        $this->ID = $id;
        $data = Region::findOrFail($id);

        $this->Nama_region = $data->nama_ekspedisi; // Sesuaikan dengan nama properti yang benar
    }    

    public function deleteRegion(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = Region::orderBy('id','desc')
        ->orwhere('nama_region','LIKE','%'.$this->search.'%')
        ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.region-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
