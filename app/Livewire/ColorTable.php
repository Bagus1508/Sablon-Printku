<?php

namespace App\Livewire;

use App\Models\DataWarna;
use Livewire\Component;
use Livewire\WithPagination;

class ColorTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Kode_warna, $Nama_warna;

    protected $listeners = [
        'editUkuran' => 'editUkuran'
    ];    

    public $isModalOpen = false;

    public function editWarna(int $id){
        $this->ID = $id;
        $data = DataWarna::findOrFail($id);

        $this->Kode_warna = $data->kode_warna; // Sesuaikan dengan nama properti yang benar
        $this->Nama_warna = $data->nama_warna; // Sesuaikan jika perlu
    }    

    public function deleteWarna(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = DataWarna::orderBy('kode_warna','desc')
        ->where('nama_warna','ilike','%'.$this->search.'%')
        ->orwhere('kode_warna','ilike','%'.$this->search.'%')
        ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.color-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
