<?php

namespace App\Livewire;

use App\Models\DataUkuran;
use Livewire\Component;
use Livewire\WithPagination;

class SizeTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $ID, $Nama_ukuran, $Singkatan_ukuran;

    protected $listeners = [
        'editUkuran' => 'editUkuran'
    ];    

    public $isModalOpen = false;

    public function editUkuran(int $id){
        $this->ID = $id;
        $data = DataUkuran::findOrFail($id);

        $this->Nama_ukuran = $data->nama_ukuran; // Sesuaikan dengan nama properti yang benar
        $this->Singkatan_ukuran = $data->singkatan_ukuran; // Sesuaikan jika perlu
    }    

    public function deleteUkuran(int $id){
        $this->ID = $id;
    }

    public function render()
    {
        $Data = DataUkuran::orderBy('id','desc')
        ->where('nama_ukuran','ilike','%'.$this->search.'%')
        ->paginate($this->perPage);

        $datanotfound = false;
        if(!$Data[0]){
            $datanotfound = true;
        }

        return view('livewire.size-table',[
            'data' => $Data,
            'nodata' => $datanotfound
        ]);
    }

    public function updatingSearch(){
        $this->reset();
    }
}
