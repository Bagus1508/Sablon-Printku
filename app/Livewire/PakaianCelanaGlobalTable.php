<?php

namespace App\Livewire;

use App\Exports\StokBahanBakuGlobalExport;
use App\Exports\StokPakaianCelanaGlobalExport;
use App\Helpers\TanggalHelper;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\StokHarian;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class PakaianCelanaGlobalTable extends Component
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

    public function convertToMeter($value, $unitId)
    {
        if ($unitId == 2) { // Yard
            return $value * 0.9144; // Konversi Yard ke Meter
        }
        return $value; // Meter tidak perlu dikonversi
    }

    public function render()
    {
        $this->startDate ? $awal = $this->startDate : $awal = Carbon::now()->startOfYear();
        $this->endDate ? $akhir = $this->endDate : $akhir = Carbon::now()->endOfYear();
    
        $startDate = Carbon::parse($awal);
        $endDate = Carbon::parse($akhir);
    
        // Buat daftar tanggal dalam rentang
        $dateRange = [];
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dateRange[] = $date->format('Y-m-d');
        }
    
        // Ambil produk dengan stok harian dalam rentang tanggal
        $query = Produk::where(function($query) {
            $query->where('nama_barang', 'ilike', '%'.$this->search.'%')
                  ->orWhere('id_no', 'ilike', '%'.$this->search.'%');
        })
        ->where('id_kategori', 2)
        ->with(['stokHarian' => function($query) use ($awal, $akhir) {
            $query->whereBetween('tanggal', [$awal, $akhir]);
        }])
        ->orderBy('nama_barang', 'asc');
    
        $data = $query->paginate($this->perPage);
    
        $dataKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();
    
        $datanotfound = !$data->count();
    
        // Hitung total sisa stok dalam Meter per Produk
        $data->getCollection()->transform(function($item) {
            $totalSisaStok = 0;
            foreach ($item->stokHarian as $stokHarian) {
                $totalSisaStok += $this->convertToMeter($stokHarian->sisa_stok, $stokHarian->id_satuan);
            }
            $item->totalSisaStok = number_format($totalSisaStok, 0, ',', '.');

            return $item;
        });
    
        return view('livewire.pakaian-celana-global-table', [
            'data' => $data,
            'nodata' => $datanotfound,
            'dataKategori' => $dataKategori,
            'dataSatuan' => $dataSatuan,
            'dataUkuran' => $dataUkuran,
            'dataWarna' => $dataWarna,
            'dateRange' => $dateRange,
            'jumlahHari' => count($dateRange),
        ]);
    }
    
    public function export() 
    {
        return Excel::download(new StokPakaianCelanaGlobalExport(), 'stokpakaiancelanaglobal.xlsx');
    }
    
}
