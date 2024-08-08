<?php

namespace App\Exports;

use App\Models\KontrakRinci;
use App\Models\Pajak;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MonitoringKontrakRinciAllExport implements FromView, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;
    protected $no_kontrak_pihak_pertama;
    protected $kode_perusahaan;
    protected $checkboxCutting;
    protected $checkboxJahit;
    protected $checkboxPacking;
    protected $dataKontrakRinci;
    protected $proses_cutting_boolean;
    protected $proses_jahit_boolean;
    protected $proses_packing_boolean;

    public function __construct($tanggalAwal, $tanggalAkhir, $checkJahit, $checkCutting, $checkPacking , $noKontrakPihakPertama, $kodePerusahaan)
    {   
        $this->startDate = Carbon::parse($tanggalAwal);
        $this->endDate = Carbon::parse($tanggalAkhir);
        $this->no_kontrak_pihak_pertama = $noKontrakPihakPertama;
        $this->kode_perusahaan = $kodePerusahaan;
        $this->checkboxCutting = $checkCutting;
        $this->checkboxJahit = $checkJahit;
        $this->checkboxPacking = $checkPacking;

        $this->proses_cutting_boolean = $checkCutting ? "true" : "false";
        $this->proses_jahit_boolean = $checkJahit ? "true" : "false";
        $this->proses_packing_boolean = $checkPacking ? "true" : "false";  
        
        // Fetch the data needed
        $query = KontrakRinci::whereBetween('tanggal_kontrak', [$this->startDate, $this->endDate])
        ->orderBy('tanggal_kontrak', 'desc')
        ->with(['prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 
                'bapb_bapp', 'bast', 'invoice'                 
               ]); 
               
        if ($noKontrakPihakPertama != 0) {
            $query->where('no_kontrak_pihak_pertama', $noKontrakPihakPertama);
        }
                
        if ($kodePerusahaan != 0) {
            $query->whereHas('perusahaan', function ($query) use ($kodePerusahaan) {
                $query->where('kode_perusahaan', $kodePerusahaan);
            });
        }

        $this->dataKontrakRinci = $query->get()->all();
    }

    public function view(): View
    {
        return view('pages.dashboard.monitoring_kontrak.kontrak_rinci.export.ready-export', [
            'dataKontrakRinci' => $this->dataKontrakRinci,
            'checkbox_cutting' => $this->proses_cutting_boolean ?? '',
            'checkbox_jahit' => $this->proses_jahit_boolean ?? '',
            'checkbox_packing' => $this->proses_packing_boolean ?? '',
            'no_kontrak_pihak_pertama' => $this->no_kontrak_pihak_pertama ?? '',
            'kode_perusahaan' => $this->kode_perusahaan ?? '',
            'dataPajak' => Pajak::get()->first(),
        ]);
    }
}
