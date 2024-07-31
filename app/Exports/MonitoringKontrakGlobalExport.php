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

class MonitoringKontrakGlobalExport implements FromView
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
    
    public function view(): View
    {
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        
        // Ambil produk dengan stok harian dalam rentang tanggal
        $query = Produk::where(function($query) {
            $query->where('nama_barang', 'ilike', '%'.$this->search.'%')
                ->orWhere('id_no', 'ilike', '%'.$this->search.'%');
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

        return view('pages.dashboard.monitoring_kontrak.kontrak_global.export.preview', [
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
