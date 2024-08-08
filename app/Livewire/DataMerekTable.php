<?php

namespace App\Livewire;

use App\Models\DataMerek;
use App\Models\DataWarna;
use App\Models\ProdukKategori;
use Livewire\Component;
use Livewire\WithPagination;

class DataMerekTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Kode_warna, $Nama_warna;

    public $isModalOpen = false;

    public function render()
    {
        $Data = DataMerek::orderBy('kode_merek','desc')
        ->where('nama_merek','LIKE','%'.$this->search.'%')
        ->paginate($this->perPage);

        $dataKategori = ProdukKategori::all();

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.data-merek-table',[
            'data' => $Data,
            'nodata' => $datanotfound,
            'dataKategori' => $dataKategori,
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
