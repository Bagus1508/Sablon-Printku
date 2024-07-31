<?php

namespace App\Http\Controllers;

use App\Exports\StokBahanBakuGlobalExport;
use App\Helpers\TanggalHelper;
use App\Models\Produk;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\ProdukKategori;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BahanBakuGlobalController extends Controller
{   
    public $search = "";

    public function index(){
        return view('pages.dashboard.monitoring_persediaan.bahan_baku.global.index');
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

    public function preview_export(Request $request) 
    {
        try {
            // Tangkap rentang tanggal dari parameter query
            $tgl_stok_global = $request->input('tanggal'); // Ambil nilai dari parameter URL
            $selectedUnit = $request->input('id_satuan') ?? 1; // Ambil nilai dari parameter URL

            if($tgl_stok_global == null){
                // Mendapatkan tanggal awal tahun ini
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');

                // Mendapatkan tanggal akhir tahun ini
                $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
            } else {
                $tanggalStokGlobal = explode(' - ', $tgl_stok_global); // Membagi berdasarkan pemisah

                if (count($tanggalStokGlobal) == 1) {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokGlobal[0], 'en'))->format("Y-m-d");
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = $startDate;
                } else {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokGlobal[0], 'en'))->format("Y-m-d");
                    $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokGlobal[1], 'en'))->format("Y-m-d");
            
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = Carbon::parse($endDateStr);
                }
            }
             
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
        
            if ($selectedUnit == '1' || $selectedUnit == null) { // Yard to Meter
                // Hitung total sisa stok dalam Meter per Produk
                $selectedUnit = 1;
                $data->transform(function($item) {
                    $totalSisaStok = 0;
                    foreach ($item->stokHarian as $stokHarian) {
                        $totalSisaStok += $this->convertToMeter($stokHarian->sisa_stok, $stokHarian->id_satuan);
                    }
                    $item->totalSisaStok = number_format($totalSisaStok, 2);
                    $item->satuanNamaTotal = DataSatuan::where('id', 1)->pluck('nama_satuan')->first();
                    return $item;
                });
            } elseif ($selectedUnit == '2') { // Meter to Yard
                // Hitung total sisa stok dalam Meter per Produk
                $data->transform(function($item) {
                    $totalSisaStok = 0;
                    foreach ($item->stokHarian as $stokHarian) {
                        $totalSisaStok += $this->convertToYard($stokHarian->sisa_stok, $stokHarian->id_satuan);
                    }
                    $item->totalSisaStok = number_format($totalSisaStok, 2);
                    $item->satuanNamaTotal = DataSatuan::where('id', 2)->pluck('nama_satuan')->first();
                    return $item;
                });
            }
        
            return view('pages.dashboard.monitoring_persediaan.bahan_baku.global.export.index', [
                'data' => $data,
                'nodata' => $datanotfound,
                'tgl_stok_global' => $tgl_stok_global,
                'dataKategori' => $dataKategori,
                'dataSatuan' => $dataSatuan,
                'dataUkuran' => $dataUkuran,
                'dataWarna' => $dataWarna,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'selectedUnit' => $selectedUnit,
            ]);
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            toast('Gagal menampilkan data: ' . $e->getMessage(), 'error', 'top-right');
            return redirect()->back();
        }
    }

    public function exportBahanBakuGlobal(Request $request)
    {
        // Tangkap rentang tanggal dari parameter query
        $tgl_stok_global = $request->input('tanggal'); // Ambil nilai dari parameter URL
        $selectedUnit = $request->input('id_satuan'); // Ambil nilai dari parameter URL

        if($tgl_stok_global == null){
            // Mendapatkan tanggal awal tahun ini
            $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            // Mendapatkan tanggal akhir tahun ini
            $endDate = Carbon::now()->endOfYear()->format('Y-m-d');

        } else {
            $tanggalStokGlobal = explode(' - ', $tgl_stok_global); // Membagi berdasarkan pemisah

            if (count($tanggalStokGlobal) == 1) {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokGlobal[0], 'en'))->format("Y-m-d");
                $startDate = Carbon::parse($startDateStr);
                $endDate = $startDate;
            } else {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokGlobal[0], 'en'))->format("Y-m-d");
                $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokGlobal[1], 'en'))->format("Y-m-d");
        
                $startDate = Carbon::parse($startDateStr);
                $endDate = Carbon::parse($endDateStr);
            }
        }
        $filename = 'PERSEDIAAN KAIN_' . $startDate . ' - '. $endDate .'.xlsx';
        return Excel::download(new StokBahanBakuGlobalExport($startDate, $endDate, $selectedUnit), $filename);
    }
    
}
