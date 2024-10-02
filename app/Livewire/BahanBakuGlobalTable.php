<?php

namespace App\Livewire;

use App\Exports\StokBahanBakuGlobalExport;
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

class BahanBakuGlobalTable extends Component
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

    public function convertToYard($value, $unitId)
    {
        if ($unitId == 1) { // Yard
            return $value / 0.9144; // Konversi Yard ke Meter
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
            $query->where('nama_barang', 'LIKE', '%'.$this->search.'%')
                  ->orWhere('id_no', 'LIKE', '%'.$this->search.'%');
        })
        ->where('id_kategori', 1)
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

        if ($this->selectedUnit == '1' || $this->selectedUnit == null) { // Yard to Meter
            // Hitung total sisa stok dalam Meter per Produk
            $this->selectedUnit = 1;
            $data->getCollection()->transform(function($item) {
                $stokMasuk = 0;
                $stokKeluar = 0;
                $totalSisaStok = 0;
                foreach ($item->stokHarian as $stokHarian) {
                    $stokMasuk += $this->convertToMeter($stokHarian->stok_masuk, $stokHarian->id_satuan);
                    $stokKeluar += $this->convertToMeter($stokHarian->stok_keluar, $stokHarian->id_satuan);

                    $totalSisaStok = $stokMasuk - $stokKeluar;
                }
                $item->totalSisaStok = number_format($totalSisaStok, 2);
                $item->satuanNamaTotal = DataSatuan::where('id', $this->selectedUnit)->pluck('nama_satuan')->first();
                return $item;
            });
        } elseif ($this->selectedUnit == '2') { // Meter to Yard
            // Hitung total sisa stok dalam Meter per Produk
            $data->getCollection()->transform(function($item) {
                $stokMasuk = 0;
                $stokKeluar = 0;
                $totalSisaStok = 0;
                foreach ($item->stokHarian as $stokHarian) {
                    $stokMasuk += $this->convertToYard($stokHarian->stok_masuk, $stokHarian->id_satuan);
                    $stokKeluar += $this->convertToYard($stokHarian->stok_keluar, $stokHarian->id_satuan);

                    $totalSisaStok = $stokMasuk - $stokKeluar;
                }
                $item->totalSisaStok = number_format($totalSisaStok, 2);
                $item->satuanNamaTotal = DataSatuan::where('id', $this->selectedUnit)->pluck('nama_satuan')->first();
                return $item;
            });

        }

        return view('livewire.bahan-baku-global-table', [
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
        return Excel::download(new StokBahanBakuGlobalExport, 'stokbahanbakuglobal.xlsx');
    }
    
}
