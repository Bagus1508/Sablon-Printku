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

class MonitoringKontrakRinciDetailExport implements FromView, WithEvents, ShouldAutoSize
{
    protected $idKontrakRinci;
    protected $dataKontrakRinci;
    protected $totalBarang;
    protected $durasiHari;

    public function __construct($Id)
    {   
        $this->idKontrakRinci = $Id;

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
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Path gambar
                $invoiceImagePath = storage_path('app/public/upload/dokumen_invoice/' . $this->dataKontrakRinci->invoice->foto_invoice);
                $pengirimanBarangImagePath = storage_path('app/public/upload/dokumen_pengiriman_barang/' . $this->dataKontrakRinci->pengirimanBarang->bukti_foto);

                // Sisipkan gambar untuk invoice
                if (file_exists($invoiceImagePath)) {
                    $drawingInvoice = new Drawing();
                    $drawingInvoice->setName('Invoice Image');
                    $drawingInvoice->setDescription('Invoice Image');
                    $drawingInvoice->setPath($invoiceImagePath);
                    $drawingInvoice->setCoordinates('AJ3'); // Koordinat untuk gambar
                    $drawingInvoice->setHeight(150); // Atur tinggi gambar
                    $drawingInvoice->setWorksheet($sheet);
                } else {
                    $sheet->setCellValue('AJ3', 'Gambar tidak tersedia');
                }

                // Sisipkan gambar untuk pengiriman barang
                if (file_exists($pengirimanBarangImagePath)) {
                    $drawingPengirimanBarang = new Drawing();
                    $drawingPengirimanBarang->setName('Pengiriman Barang Image');
                    $drawingPengirimanBarang->setDescription('Pengiriman Barang Image');
                    $drawingPengirimanBarang->setPath($pengirimanBarangImagePath);
                    $drawingPengirimanBarang->setCoordinates('Z3'); // Koordinat untuk gambar
                    $drawingPengirimanBarang->setHeight(150); // Atur tinggi gambar
                    $drawingPengirimanBarang->setWorksheet($sheet);
                } else {
                    $sheet->setCellValue('Z3', 'Gambar tidak tersedia');
                }
            },
        ];
    }
}
