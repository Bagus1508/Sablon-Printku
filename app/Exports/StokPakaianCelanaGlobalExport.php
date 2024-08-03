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

class StokPakaianCelanaGlobalExport implements FromView
{
    public $perPage = 10;
    public $search = "";
    public $filterPresenceInOut = "0", $start, $end, $tanggal;

    protected $startDate;
    protected $endDate;

    public function __construct($tanggalAwal, $tanggalAkhir)
    {   
        $this->startDate = Carbon::parse($tanggalAwal);
        $this->endDate = Carbon::parse($tanggalAkhir);
    }

    public function convertToMeter($value, $unitId)
    {
        if ($unitId == 2) { // Yard
            return $value * 0.9144; // Konversi Yard ke Meter
        }
        return $value; // Meter tidak perlu dikonversi
    }
    
    public function view(): View
    {
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        
        // Ambil produk dengan stok harian dalam rentang tanggal
        $query = Produk::where(function($query) {
            $query->where('nama_barang', 'LIKE', '%'.$this->search.'%')
                ->orWhere('id_no', 'LIKE', '%'.$this->search.'%');
        })
        ->where('id_kategori', 2)
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

        $data->transform(function($item) {
            $totalSisaStok = 0;
            foreach ($item->stokHarian as $stokHarian) {
                $totalSisaStok += $this->convertToMeter($stokHarian->sisa_stok, $stokHarian->id_satuan);
            }
            $item->totalSisaStok = number_format($totalSisaStok);
            return $item;
        });
        return view('pages.dashboard.monitoring_persediaan.pakaian_celana.global.export.preview_export', [
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
