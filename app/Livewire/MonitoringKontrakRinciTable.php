<?php

namespace App\Livewire;

use App\Exports\StokBahanBakuGlobalExport;
use App\Helpers\TanggalHelper;
use App\Models\DataEkspedisi;
use App\Models\DataPerusahaan;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\KontrakGlobal;
use App\Models\KontrakRinci;
use App\Models\Pajak;
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
    public $no_kontrak_pihak_pertama;
    public $kode_perusahaan;

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

    public $columnsVisibility = [
        'proses_cutting' => true,
        'proses_jahit' => true,
        'proses_packing' => true,
    ];

    public function toggleColumnVisibility($column)
    {
        $this->columnsVisibility[$column] = !$this->columnsVisibility[$column];
    }

    public function render()
    {
        $this->startDate ? $awal = $this->startDate : $awal = Carbon::now()->startOfYear();
        $this->endDate ? $akhir = $this->endDate : $akhir = Carbon::now()->endOfYear();
    
        $startDate = Carbon::parse($awal);
        $endDate = Carbon::parse($akhir);

        //Data Kontrak Rinci
        $allDataKontrakRinci = KontrakRinci::with('perusahaan')->get();

        //Produk Pakaian
        $dataProdukPakaian = Produk::where('id_kategori', 2)->get();
    
        // Ambil Kontrak Rinci dengan stok harian dalam rentang tanggal
        $query = KontrakRinci::where(function ($q) {
            $q->where('no_kontrak_rinci', 'LIKE', '%'.$this->search.'%');
        })
        ->whereBetween('tanggal_kr', [$awal, $akhir])
        ->orderBy('tanggal_kr', 'desc')
        ->with(['prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 
                'bapb_bapp', 'bast', 'invoice'                 
               ]);    
        
            
        if ($this->no_kontrak_pihak_pertama) {
            $query->where('no_kontrak_pihak_pertama', $this->no_kontrak_pihak_pertama);
        }
        
        if ($this->kode_perusahaan) {
            $query->whereHas('perusahaan', function ($query) {
                $query->where('kode_perusahaan', $this->kode_perusahaan);
            });
        }
        
        $dataKontrakRinci = $query->paginate($this->perPage);
            
        $dataSatuan = DataSatuan::all();
        $dataEkspedisi = DataEkspedisi::all();
        $dataKontrakGlobal = KontrakGlobal::all();
        $dataRegion = Region::all();

        $produkKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();
        $dataPerusahaan = DataPerusahaan::all();

        $datanotfound = !$dataKontrakRinci->count();

        return view('livewire.monitoring-kontrak-rinci-table', [
            'dataKontrakRinci' => $dataKontrakRinci,
            'allDataKontrakRinci' => $allDataKontrakRinci,
            'nodata' => $datanotfound,
            'dataSatuan' => $dataSatuan,
            'dataEkspedisi' => $dataEkspedisi,
            'dataRegion' => $dataRegion,
            'dataKontrakGlobal' => $dataKontrakGlobal,
            'dataProdukPakaian' => $dataProdukPakaian,
            'dataPajak' => Pajak::get()->all(),
            'produkKategori' => $produkKategori,
            'dataUkuran' => $dataUkuran,
            'dataWarna' => $dataWarna,
            'dataPerusahaan' => $dataPerusahaan,
        ]);
    }
    
}
