<?php

namespace App\Livewire;

use App\Models\DataMerek;
use App\Models\DataProduk;
use App\Models\DataWarna;
use App\Models\ProdukKategori;
use Livewire\Component;
use Livewire\WithPagination;

class DataProdukTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Kode_warna, $Nama_warna;

    public $isModalOpen = false;

    public function render()
    {
        $Data = DataProduk::latest()
        ->where('nama_barang','LIKE','%'.$this->search.'%')
        ->paginate($this->perPage);

        $dataKategori = ProdukKategori::all();

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.data-produk-table',[
            'data' => $Data,
            'nodata' => $datanotfound,
            'dataKategori' => $dataKategori,
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
