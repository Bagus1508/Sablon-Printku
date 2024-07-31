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

class StokPakaianCelanaSatuanExport implements FromView
{
    protected $startDate;
    protected $endDate;
    protected $startDateStr;
    protected $endDateStr;
    protected $id_satuan;
    public $search = "";

    public function __construct($tanggalAwal, $tanggalAkhir, $IdSatuan)
    {   
        $this->startDate = Carbon::parse($tanggalAwal);
        $this->endDate = Carbon::parse($tanggalAkhir);
        $this->id_satuan = $IdSatuan;
    }
    
    public function view(): View
    {   
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        $startDateStr = $startDate->format('Y-m-d');
        $endDateStr = $endDate->format('Y-m-d');
        $id_satuan = $this->id_satuan;

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
        ->with(['stokHarian' => function($query) use ($startDateStr, $endDateStr) {
            $query->whereBetween('tanggal', [$startDateStr, $endDateStr]);
        }])
        ->orderBy('nama_barang', 'asc');

        $data = $query->get();
    
        // Hitung total stok_masuk dan stok_keluar
        $totalStokMasuk = [];
        $totalStokKeluar = [];
        $satuanNamaTotal = ''; // Inisialisasi variabel di luar loop
        foreach ($data as $produk) {
            $totalStokMasuk[$produk->id] = 0;
            $totalStokKeluar[$produk->id] = 0;
            foreach ($produk->stokHarian as $stok) {
                $stokMasuk = $stok->stok_masuk;
                $stokKeluar = $stok->stok_keluar;
                $satuanId = $stok->id_satuan;
        
                if ($id_satuan == '1' && $satuanId == '2') { // Yard to Meter
                    $stokMasuk = round($stokMasuk / 1.09361, 2);
                    $stokKeluar = round($stokKeluar / 1.09361, 2);
                } elseif ($id_satuan == '2' && $satuanId == '1') { // Meter to Yard
                    $stokMasuk = round($stokMasuk * 1.09361, 2);
                    $stokKeluar = round($stokKeluar * 1.09361, 2);
                }

                if ($id_satuan == '1') { // Meter
                    $satuanNamaTotal = DataSatuan::where('id', 1)->pluck('nama_satuan')->first();
                } elseif ($id_satuan == '2') { // Yard
                    $satuanNamaTotal = DataSatuan::where('id', 2)->pluck('nama_satuan')->first();
                }

                $totalStokMasuk[$produk->id] += $stokMasuk;
                $totalStokKeluar[$produk->id] += $stokKeluar;
            }
        }
    
        $dataKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();
    
        $datanotfound = !$data->count();
    
        return view('pages.dashboard.monitoring_persediaan.pakaian_celana.satuan.export.preview', [
            'data' => $data,
            'nodata' => $datanotfound,
            'dataKategori' => $dataKategori,
            'dataSatuan' => $dataSatuan,
            'dataUkuran' => $dataUkuran,
            'dataWarna' => $dataWarna,
            'dateRange' => $dateRange,
            'totalStokMasuk' => $totalStokMasuk,
            'totalStokKeluar' => $totalStokKeluar,
            'jumlahHari' => count($dateRange),
            'satuanNamaTotal' => $satuanNamaTotal,
            'id_satuan' => $id_satuan,
        ]);
    }
}
