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
use App\Models\KontrakRinci;
use App\Models\Pajak;
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
        
        // Ambil Kontrak Rinci dengan stok harian dalam rentang tanggal
        $query = KontrakRinci::whereBetween('tanggal_kontrak', [$startDate, $endDate])
        ->orderBy('tanggal_kontrak', 'desc')
        ->with([
            'prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 
            'pengirimanBarang', 'ba_rikmatek', 'bapb_bapp', 'bast', 'invoice', 
            'kontrakGlobal'
        ]);        
        
        $dataKontrak = $query->get();

        $datanotfound = !$dataKontrak->count();
    
        return view('pages.dashboard.monitoring_kontrak.kontrak_global.export.preview', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'dataKontrak' => $dataKontrak,
            'dataPajak' => Pajak::get()->first(),
        ]);
    }
}
