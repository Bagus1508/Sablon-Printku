<?php

namespace App\Livewire;

use App\Helpers\TanggalHelper;
use App\Models\DataSatuan;
use App\Models\StokHarian;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class StokBahanBakuSatuanTable extends Component
{
    use WithPagination;

    public $search = "";
    public $perPage = 10;
    public $filter, $tanggal, $ID, $Id_stok, $Id_produk, $Id_no, $Nama_barang, $Warna, $Kode_warna, $Id_satuan, $Tanggal_stok, $Stok_masuk, $Stok_keluar;
    public $DataStok;
    public $startDate;
    public $endDate;

    public function mount()
    {
        // Ambil parameter 'stok_bahan' dari URL
        $this->ID = request()->query('stok-bahan');
        if (is_numeric($this->ID)) {
            $this->ID = (int) $this->ID;
        } else {
            $this->ID = null;
        }

    }

    public function updatedTanggal()
    {
        if($this->tanggal==''){
            $this->startDate =   '2001-01-01';
            $this->endDate   =   '3001-01-01';
        }else{
            $tanggal = explode(" - ",$this->tanggal);
            $this->startDate = Carbon::parse(TanggalHelper::translateBulan($tanggal[0],'en'))->format("Y-m-d");
            if(count($tanggal) == 2){
                $this->endDate = Carbon::parse(TanggalHelper::translateBulan($tanggal[1],'en'))->format("Y-m-d");
            }else{
                $this->endDate = $this->startDate;
            }
        }
    }
    
    public function editStokHarian(int $id){
        $this->Id_stok = $id;
        $data = StokHarian::findOrFail($this->Id_stok);

        $this->Id_produk = $data->id_produk;
        $this->Id_no = $data->produk->id_no; // Sesuaikan jika perlu
        $this->Nama_barang = $data->produk->nama_barang; // Sesuaikan jika perlu
        $this->Warna = $data->produk->warna->nama_warna;
        $this->Kode_warna = $data->produk->warna->kode_warna;
        $this->Stok_masuk = $data->stok_masuk;
        $this->Stok_keluar = $data->stok_keluar;
        $this->Tanggal_stok = $data->tanggal;
        $this->Id_satuan = $data->id_satuan;
    }    

    public function deleteStokHarian(int $id){
        $this->Id_stok = $id;
    }


    public function render()
    {
        $this->startDate ? $awal = $this->startDate : $awal = Carbon::now()->startOfMonth();
        $this->endDate ? $akhir = $this->endDate : $akhir = Carbon::now()->endOfMonth(); 
    
        $startDate = Carbon::parse($awal);
        $endDate = Carbon::parse($akhir);

        $dataSatuan = DataSatuan::all();

        $idStokHarian = $this->ID;

        $dataStok = StokHarian::orderBy('tanggal', 'desc')
            ->where('id_produk', $idStokHarian)
            ->where('stok_masuk', 'LIKE', '%' . $this->search . '%')
            ->whereBetween('tanggal', [$awal, $akhir]);
            
        $Data = $dataStok->paginate($this->perPage);

        $datanotfound = !$Data->count();

        return view('livewire.stok-bahan-baku-satuan-table', [
            'dataStok' => $Data,
            'nodata' => $datanotfound,
            'dataSatuan' => $dataSatuan
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset page pagination saat pencarian berubah
    }
}
