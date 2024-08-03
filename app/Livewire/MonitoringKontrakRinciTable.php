<?php

namespace App\Livewire;

use App\Exports\StokBahanBakuGlobalExport;
use App\Helpers\TanggalHelper;
use App\Models\DataEkspedisi;
use App\Models\DataPerusahaan;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\KontrakRinci;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\Region;
use App\Models\StokHarian;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringKontrakRinciTable extends Component
{
    use WithPagination;

    public $search = "";
    public $perPage = 10;
    public $filter, $tanggal, $ID, $Id_no, $Id_kategori, $Nama_barang, $Id_warna;
    public $startDate;
    public $endDate;
    public $selectedUnit;
    public $selectedSortBy;

    public function updatedTanggal()
    {
        if ($this->tanggal == '') {
            $this->startDate = '2001-01-01';
            $this->endDate = '3001-01-01';
        } else {
            $tanggal = explode(" - ", $this->tanggal);
            $this->startDate = Carbon::parse(TanggalHelper::translateBulan($tanggal[0], 'en'))->format("Y-m-d");
            if (count($tanggal) == 2) {
                $this->endDate = Carbon::parse(TanggalHelper::translateBulan($tanggal[1], 'en'))->format("Y-m-d");
            } else {
                $this->endDate = $this->startDate;
            }
        }
    }

    public function render()
    {
        $this->startDate ? $awal = $this->startDate : $awal = Carbon::now()->startOfYear();
        $this->endDate ? $akhir = $this->endDate : $akhir = Carbon::now()->endOfYear();
    
        $startDate = Carbon::parse($awal);
        $endDate = Carbon::parse($akhir);
    
        // Ambil Kontrak Rinci dengan stok harian dalam rentang tanggal
        $query = KontrakRinci::where('takon', 'LIKE', '%'.$this->search.'%')
        ->orWhere('no_kontrak_rinci', 'LIKE', '%'.$this->search.'%')
        ->orderBy('tanggal_kontrak', 'desc')
        ->with(['prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 
                'bapb_bapp', 'bast', 'invoice'                 
               ]);    
        
    
        $dataKontrakRinci = $query->paginate($this->perPage);
        $dataSatuan = DataSatuan::all();
        $dataEkspedisi = DataEkspedisi::all();
        $dataPerusahaan = DataPerusahaan::all();
        $dataRegion = Region::all();

        $datanotfound = !$dataKontrakRinci->count();

        return view('livewire.monitoring-kontrak-rinci-table', [
            'dataKontrakRinci' => $dataKontrakRinci,
            'nodata' => $datanotfound,
            'dataSatuan' => $dataSatuan,
            'dataEkspedisi' => $dataEkspedisi,
            'dataRegion' => $dataRegion,
            'dataPerusahaan' => $dataPerusahaan,
        ]);
    }
    
    public function export() 
    {
        return Excel::download(new StokBahanBakuGlobalExport, 'stokbahanbakuglobal.xlsx');
    }
    
}
