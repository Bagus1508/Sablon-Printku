<?php

namespace App\Exports;

use App\Models\PresensiKaryawan;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Produk;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\ProdukKategori;

class StokBahanBakuGlobalExport implements FromView
{

    public $perPage = 10;
    public $search = "";
    public $filterPresenceInOut = "0", $start, $end, $tanggal;

    protected $startDate;
    protected $endDate;
    protected $id_satuan;

    public function __construct($tanggalAwal, $tanggalAkhir, $selectedUnit)
    {   
        $this->startDate = Carbon::parse($tanggalAwal);
        $this->endDate = Carbon::parse($tanggalAkhir);
        $this->id_satuan = $selectedUnit;
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
    
    public function view(): View
    {
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        $id_satuan = $this->id_satuan;
        
        // Ambil produk dengan stok harian dalam rentang tanggal
        $query = Produk::where(function($query) {
            $query->where('nama_barang', 'LIKE', '%'.$this->search.'%')
                ->orWhere('id_no', 'LIKE', '%'.$this->search.'%');
        })
        ->where('id_kategori', 1)
        ->with(['stokHarian' => function($query) use ($startDate, $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        }])
        ->orderBy('nama_barang', 'asc');

        $data = $query->get();

        $dataKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();

        $datanotfound = !$data->count();

        if ($id_satuan == '1' || $id_satuan == null) { // Yard to Meter
            // Hitung total sisa stok dalam Meter per Produk
            $id_satuan = 1;
            $data->transform(function($item) {
                $totalSisaStok = 0;
                $totalRolls = 0;
                $usedRolls = 0;
                foreach ($item->stokHarian as $stokHarian) {
                    $totalSisaStok += $this->convertToMeter($stokHarian->sisa_stok, $stokHarian->id_satuan);
                    $totalRolls += $stokHarian->total_rolls;
                    $usedRolls += $stokHarian->used_rolls;
                }
                $item->totalSisaStok = number_format($totalSisaStok, 2);
                $item->satuanNamaTotal = DataSatuan::where('id', 1)->pluck('nama_satuan')->first();
                $item->total_rolls = $totalRolls;
                $item->used_rolls = $usedRolls;
                return $item;
            });
        } elseif ($id_satuan == '2') { // Meter to Yard
            // Hitung total sisa stok dalam Meter per Produk
            $data->transform(function($item) {
                $totalSisaStok = 0;
                $totalRolls = 0;
                $usedRolls = 0;
                foreach ($item->stokHarian as $stokHarian) {
                    $totalSisaStok += $this->convertToYard($stokHarian->sisa_stok, $stokHarian->id_satuan);
                    $totalRolls += $stokHarian->total_rolls;
                    $usedRolls += $stokHarian->used_rolls;
                }
                $item->totalSisaStok = number_format($totalSisaStok, 2);
                $item->satuanNamaTotal = DataSatuan::where('id', 2)->pluck('nama_satuan')->first();
                $item->total_rolls = $totalRolls;
                $item->used_rolls = $usedRolls;
                return $item;
            });
        }

        return view('pages.dashboard.monitoring_persediaan.bahan_baku.global.export.preview', [
            'data' => $data,
            'nodata' => $datanotfound,
            'dataKategori' => $dataKategori,
            'dataSatuan' => $dataSatuan,
            'dataUkuran' => $dataUkuran,
            'dataWarna' => $dataWarna,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
