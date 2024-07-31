<?php

namespace App\Livewire;

use App\Models\DataEkspedisi;
use Livewire\Component;
use Livewire\WithPagination;

class EkspedisiTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Kode_ekspedisi, $Nama_ekspedisi;

    protected $listeners = [
        'editEkspedisi' => 'editEkspedisi'
    ];    

    public $isModalOpen = false;

    public function editEkspedisi(int $id){
        $this->ID = $id;
        $data = DataEkspedisi::findOrFail($id);

        $this->Kode_ekspedisi = $data->kode_ekspedisi; // Sesuaikan jika perlu
        $this->Nama_ekspedisi = $data->nama_ekspedisi; // Sesuaikan dengan nama properti yang benar
    }    

    public function deleteEkspedisi(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = DataEkspedisi::orderBy('id','desc')
        ->where('kode_ekspedisi','ilike','%'.$this->search.'%')
        ->orwhere('nama_ekspedisi','ilike','%'.$this->search.'%')
        ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.ekspedisi-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
