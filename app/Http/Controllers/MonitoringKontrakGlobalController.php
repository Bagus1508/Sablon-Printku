<?php

namespace App\Http\Controllers;

use App\Exports\MonitoringKontrakGlobalExport;
use App\Helpers\LogHelper;
use App\Helpers\TanggalHelper;
use App\Models\KontrakGlobal;
use App\Models\KontrakRinci;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class MonitoringKontrakGlobalController extends Controller
{
    public function index(){
        return view('pages.dashboard.monitoring_kontrak.kontrak_global.index');
    }

    public function updateStatusSpk(Request $request, $id){
                
        try {
            $validated = $request->validate([
                'status_spk' => 'required',
            ]);
        
            $data = KontrakGlobal::find($id);
            if (!$data) {
                // Jika data tidak ditemukan, arahkan kembali dengan pesan error
                Alert::error('Error!', 'Data Kontrak tidak ditemukan.');
                return redirect()->back();
            }
        
            $data->status_spk = $validated['status_spk'];
        
            $data->save();
        
            Alert::success('Berhasil!', 'Berhasil mengubah status SPK');
            LogHelper::success('Berhasil mengubah status SPK');
            return redirect()->back();
            // Additional logic here if needed
        } catch (Throwable $e) {
            Alert::error('Gagal!, Mengubah status SPK');
            return redirect()->back();
        }
    }

    public function preview_export(Request $request) 
    {
        try {
            // Tangkap rentang tanggal dari parameter query
            $tgl_kontrak = $request->input('tanggal'); // Ambil nilai dari parameter URL

            if($tgl_kontrak == null){
                // Mendapatkan tanggal awal tahun ini
                $startDate = Carbon::now()->startOfYear()->format('Y-m-d');

                // Mendapatkan tanggal akhir tahun ini
                $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
            } else {
                $tanggalKontrak = explode(' - ', $tgl_kontrak); // Membagi berdasarkan pemisah

                if (count($tanggalKontrak) == 1) {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[0], 'en'))->format("Y-m-d");
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = $startDate;
                } else {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[0], 'en'))->format("Y-m-d");
                    $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[1], 'en'))->format("Y-m-d");
            
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = Carbon::parse($endDateStr);
                }
            }

            // Ambil Kontrak Rinci dengan stok harian dalam rentang tanggal
            $query = KontrakRinci::whereBetween('tanggal_kontrak', [$startDate, $endDate])
            ->orderBy('tanggal_kontrak', 'desc')
            ->with([
                'prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 
                'pengirimanBarang', 'ba_rikmatek', 'bapb_bapp', 'bast', 'invoice', 
                'kontrakGlobal'
            ]);        
            
            $dataKontrak = $query->get();

            // Pengecekan barangKontrak kosong
            foreach ($dataKontrak as $kontrak) {
                if ($kontrak->barangKontrak->isEmpty()) {
                    // Barang kontrak kosong pada salah satu kontrak, tidak bisa lanjut
                    toast('Gagal menampilkan data: Salah satu data Barang masih kosong!', 'error', 'top-right');
                    return redirect()->back();
                }
            }

            $datanotfound = !$dataKontrak->count();
        
            return view('pages.dashboard.monitoring_kontrak.kontrak_global.export.index', [
                'tgl_kontrak' => $tgl_kontrak,
                'startDate' => $startDate,
                'endDate' => $endDate,
                'dataKontrak' => $dataKontrak,
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
        $tgl_kontrak = $request->input('tanggal'); // Ambil nilai dari parameter URL

        if($tgl_kontrak == null){
            // Mendapatkan tanggal awal tahun ini
            $startDate = Carbon::now()->startOfYear()->format('Y-m-d');
            // Mendapatkan tanggal akhir tahun ini
            $endDate = Carbon::now()->endOfYear()->format('Y-m-d');
        } else {
            $tanggalKontrak = explode(' - ', $tgl_kontrak); // Membagi berdasarkan pemisah

            if (count($tanggalKontrak) == 1) {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[0], 'en'))->format("Y-m-d");
                $startDate = Carbon::parse($startDateStr);
                $endDate = $startDate;
            } else {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[0], 'en'))->format("Y-m-d");
                $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrak[1], 'en'))->format("Y-m-d");
        
                $startDate = Carbon::parse($startDateStr);
                $endDate = Carbon::parse($endDateStr);
            }
        }

        $filename = 'Monitoring Global Export_' . $startDate . ' - '. $endDate .'.xlsx';
        return Excel::download(new MonitoringKontrakGlobalExport($startDate, $endDate), $filename);
    }
}
