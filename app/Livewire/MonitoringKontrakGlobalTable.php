<?php

namespace App\Livewire;

use App\Exports\MonitoringKontrakGlobalExport;
use App\Exports\StokBahanBakuGlobalExport;
use App\Helpers\TanggalHelper;
use App\Models\DataEkspedisi;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\KontrakRinci;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\Region;
use App\Models\StokHarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringKontrakGlobalTable extends Component
{
    use WithPagination;

    public $search = "";
    public $perPage = 10;
    public $filter, $tanggal, $ID, $Id_no;
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
        $query = KontrakRinci::where(function ($q) {
            $q->where('takon', 'ilike', '%'.$this->search.'%')
              ->orWhere('no_kontrak_rinci', 'ilike', '%'.$this->search.'%');
        })
        ->whereBetween('tanggal_kontrak', [$awal, $akhir])
        ->orderBy('tanggal_kontrak', 'desc')
        ->with([
            'prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 
            'pengirimanBarang', 'ba_rikmatek', 'bapb_bapp', 'bast', 'invoice', 
            'kontrakGlobal'
        ]);        
        
        $dataKontrak = $query->paginate($this->perPage);
        $dataSatuan = DataSatuan::all();
        $dataEkspedisi = DataEkspedisi::all();
        $dataRegion = Region::all();

        $datanotfound = !$dataKontrak->count();

        return view('livewire.monitoring-kontrak-global-table', [
            'dataKontrak' => $dataKontrak,
            'nodata' => $datanotfound,
            'dataSatuan' => $dataSatuan,
            'dataEkspedisi' => $dataEkspedisi,
            'dataRegion' => $dataRegion,
        ]);
    }

    public function preview_export(Request $request) 
    {
        try {
            // Tangkap rentang tanggal dari parameter query
            $tgl_kontrak = $request->input('tanggal'); // Ambil nilai dari parameter URL

            if($tgl_kontrak == null){
                // Mendapatkan tanggal awal tahun ini
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
                // Mendapatkan tanggal akhir tahun ini
                $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
            } else {
                $tanggalKontrak = explode(' - ', $tgl_kontrak); // Membagi berdasarkan pemisah

                if (count($tanggalKontrak) == 1) {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[0], 'en'))->format("Y-m-d");
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = $startDate;
                } else {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[0], 'en'))->format("Y-m-d");
                    $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[1], 'en'))->format("Y-m-d");
            
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = Carbon::parse($endDateStr);
                }
            }

            // Ambil Kontrak Rinci dengan stok harian dalam rentang tanggal
            $query = KontrakRinci::where(function ($q) {
                $q->where('takon', 'ilike', '%'.$this->search.'%')
                ->orWhere('no_kontrak_rinci', 'ilike', '%'.$this->search.'%');
            })
            ->whereBetween('tanggal_kontrak', [$startDate, $endDate])
            ->orderBy('tanggal_kontrak', 'desc')
            ->with([
                'prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 
                'pengirimanBarang', 'ba_rikmatek', 'bapb_bapp', 'bast', 'invoice', 
                'kontrakGlobal'
            ]);
        
            $data = $query->get();
        
            $dataKategori = ProdukKategori::all();
            $dataSatuan = DataSatuan::all();
            $dataUkuran = DataUkuran::all();
            $dataWarna = DataWarna::all();
        
            $datanotfound = !$data->count();
        
            $data->transform(function($item) {
                $totalSisaStok = 0;
                foreach ($item->stokHarian as $stokHarian) {
                    $totalSisaStok += $this->convertToMeter($stokHarian->sisa_stok, $stokHarian->id_satuan);
                }
                $item->totalSisaStok = number_format($totalSisaStok);
                return $item;
            });
        
            return view('pages.dashboard.monitoring_persediaan.pakaian_celana.global.export.index', [
                'data' => $data,
                'nodata' => $datanotfound,
                'tgl_kontrak' => $tgl_kontrak,
                'dataKategori' => $dataKategori,
                'dataSatuan' => $dataSatuan,
                'dataUkuran' => $dataUkuran,
                'dataWarna' => $dataWarna,
                'startDate' => $startDate,
                'endDate' => $endDate,
            ]);
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            toast('Gagal menampilkan data: ' . $e->getMessage(), 'error', 'top-right');
            return redirect()->back();
        }
    }
    
    public function export() 
    {
        return Excel::download(new MonitoringKontrakGlobalExport(), 'stokbahanbakuglobal.xlsx');
    }
    
}
