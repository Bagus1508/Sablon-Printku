<?php

namespace App\Http\Controllers;

use App\Exports\MonitoringKontrakGlobalExport;
use App\Helpers\TanggalHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MonitoringKontrakGlobalController extends Controller
{
    public function index(){
        return view('pages.dashboard.monitoring_kontrak.kontrak_global.index');
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
             
        
            return view('pages.dashboard.monitoring_kontrak.kontrak_global.export.index', [
                'tgl_stok_global' => $tgl_stok_global,
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

    public function exportMonitoringKontrakGlobal(Request $request)
    {
        // Tangkap rentang tanggal dari parameter query
        $tgl_stok_global = $request->input('tanggal'); // Ambil nilai dari parameter URL

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

        $filename = 'Monitoring Global Export_' . $startDate . ' - '. $endDate .'.xlsx';
        return Excel::download(new MonitoringKontrakGlobalExport($startDate, $endDate), $filename);
    }
}
