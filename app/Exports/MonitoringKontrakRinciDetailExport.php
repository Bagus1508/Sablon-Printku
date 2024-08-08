<?php
namespace App\Exports;

use App\Models\KontrakRinci;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MonitoringKontrakRinciDetailExport implements FromView, ShouldAutoSize
{
    protected $idKontrakRinci;
    protected $checkboxCutting;
    protected $checkboxJahit;
    protected $checkboxPacking;
    protected $dataKontrakRinci;
    protected $totalBarang;
    protected $durasiHari;

    public function __construct($Id, $checkCutting, $checkJahit, $checkPacking)
    {   
        $this->idKontrakRinci = $Id;
        $this->checkboxCutting = $checkCutting;
        $this->checkboxJahit = $checkJahit;
        $this->checkboxPacking = $checkPacking;

        // Fetch the data needed
        $this->dataKontrakRinci = KontrakRinci::with([
            'prosesCutting', 'prosesJahit', 'prosesPacking', 
            'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 
            'bapb_bapp', 'bast', 'invoice'
        ])
        ->where('id', $Id)
        ->first();

        $this->totalBarang = $this->dataKontrakRinci->barangKontrak->count();
        $awalKr = Carbon::parse($this->dataKontrakRinci->awal_kr);
        $akhirKr = Carbon::parse($this->dataKontrakRinci->akhir_kr);
        $this->durasiHari = $awalKr->diffInDays($akhirKr);
    }

    public function view(): View
    {
        return view('pages.dashboard.monitoring_kontrak.kontrak_rinci.export.detail.ready-export', [
            'dataKontrakRinci' => $this->dataKontrakRinci,
            'durasiHari' => $this->durasiHari,
            'totalBarang' => $this->totalBarang,
            'checkbox_cutting' => $this->checkboxCutting,
            'checkbox_jahit' => $this->checkboxJahit,
            'checkbox_packing' => $this->checkboxPacking,
        ]);
    }

}
