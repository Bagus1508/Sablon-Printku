<?php

namespace App\Livewire;

use App\Models\ProdukKategori;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Kode_kategori, $Nama_kategori;

    protected $listeners = [
        'editKategori' => 'editKategori'
    ];    

    public $isModalOpen = false;

    public function editKategori(int $id){
        $this->ID = $id;
        $data = ProdukKategori::findOrFail($id);

        $this->Kode_kategori = $data->kode_kategori; // Sesuaikan jika perlu
        $this->Nama_kategori = $data->nama_kategori; // Sesuaikan dengan nama properti yang benar
    }    

    public function deleteKategori(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = ProdukKategori::orderBy('id','desc')
        ->where('nama_kategori','ilike','%'.$this->search.'%')
        ->orwhere('kode_kategori','ilike','%'.$this->search.'%')
        ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.category-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
