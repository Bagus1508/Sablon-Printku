<?php

namespace App\Http\Controllers;

use App\Exports\MonitoringKontrakGlobalExport;
use App\Helpers\LogHelper;
use App\Helpers\TanggalHelper;
use App\Models\DataPerusahaan;
use App\Models\KontrakGlobal;
use App\Models\KontrakRinci;
use App\Models\Pajak;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class MonitoringKontrakGlobalController extends Controller
{
    public function index(){
        $dataPerusahaan = DataPerusahaan::get();
        
        return view('pages.dashboard.monitoring_kontrak.kontrak_global.index', [
            'dataPerusahaan' => $dataPerusahaan,
            'dataPajak' => Pajak::get()->first(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'takon' => 'nullable|unique:kontrak_global,takon',
                // 'no_telepon' => 'required',
                'no_kontrak_pihak_pertama' => 'required',
                'tanggal_kontrak' => 'required|date',
                'tanggal_kr' => 'nullable|date',
                'awal_kr' => 'nullable|date',
                'akhir_kr' => 'nullable|date',
                'uraian' => 'nullable',
                'id_perusahaan' => 'nullable|integer'
            ], [
                'takon.unique' => 'No Kontrak Takon ini sudah digunakan dalam kontrak Global lain.',
                // 'no_telepon.required' => 'HP tidak boleh kosong.',
                'no_kontrak_pihak_pertama.required' => 'No Kontrak Pihak Pertama tidak boleh kosong.',
                'tanggal_kontrak.required' => 'Tanggal kontrak tidak boleh kosong.',
                'tanggal_kontrak.date' => 'Tanggal kontrak harus berupa tanggal yang valid.',
                'tanggal_kr.date' => 'Tanggal KR harus berupa tanggal yang valid.',
                'awal_kr.date' => 'Tanggal awal KR harus berupa tanggal yang valid.',
                'akhir_kr.date' => 'Tanggal akhir KR harus berupa tanggal yang valid.',
                'id_perusahaan.integer' => 'Perusahaan tidak valid!',
            ]);
            
            $parameter = [
                'takon' => $validated['takon'],
                'no_telepon' => $validated['no_telepon'] ?? 0,
                'no_kontrak_pihak_pertama' => $validated['no_kontrak_pihak_pertama'],
                'tanggal_kontrak' => $validated['tanggal_kontrak'],
                'tanggal_kr' => $validated['tanggal_kr'] ?? null,
                'awal_kr' => $validated['awal_kr'] ?? null,
                'akhir_kr' => $validated['akhir_kr'] ?? null,
                'uraian' => $validated['uraian'] ?? null,
                'id_perusahaan' => $validated['id_perusahaan'] ?? null,
                'status_spk' => 0,
            ];
    
            $createKontrakGlobal = KontrakGlobal::create($parameter);
            

            if (!$createKontrakGlobal) {
                Alert::error('Gagal!', 'Gagal menambahkan kontrak Global');
                LogHelper::error('Gagal menambahkan kontrak Global!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah kontrak Global');
            LogHelper::success('Berhasil menambahkan kontrak Global.');
            return redirect()->back();
            
        } catch (ValidationException $e) {
            if(!$e){
                return view('pages.utility.500');
            }

            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Alert::error('Error!', $error);
                }
            }
            return redirect()->back()->withInput();
        } /* catch (Throwable $e) {
            return view('pages.utility.500');
        } */
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

            // Ambil Kontrak Global dengan stok harian dalam rentang tanggal
            $query = KontrakGlobal::whereBetween('tanggal_kontrak', [$startDate, $endDate])
            ->orderBy('tanggal_kontrak', 'desc');        
            
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
                'dataPajak' => Pajak::get()->first(),
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

    public function updateTotalHarga(Request $request, $id){
        try {
            $validated = $request->validate([
                'total_harga' => 'required',
                'id_pajak' => 'required|integer',
            ],
            [
                'total_harga.required' => 'Kolom Harga wajib diisi.',
                'id_pajak.required' => 'Kolom Pajak wajib diisi.',
                'id_pajak.integer' => 'Input pajak tidak sesuai',
            ]);

            
            $data = KontrakGlobal::find($id);

            if (!$data) {
                // Jika data tidak ditemukan, arahkan kembali dengan pesan error
                Alert::error('Error!', 'Data Kontrak Global tidak ditemukan.');
                return redirect()->back();
            }

            $totalHargaStr = str_replace('Rp', '', $validated['total_harga']);
            $totalHargaStr = str_replace('.', '', $totalHargaStr);
            $totalHargaStr = str_replace(',', '.', $totalHargaStr);

            if($data->total_harga_old == null){
                $data->total_harga_old = (float)$totalHargaStr;
            }
            
            $data->total_harga = (float)$totalHargaStr ;
            $data->id_pajak = $validated['id_pajak'];

        
            $data->save();
        
            Alert::success('Berhasil!', 'Berhasil mengubah total harga dengan No Kontrak Global '. ($data->no_kontrak_rinci ?? 'No Kontrak Global Kosong') . '.');
            LogHelper::success('Berhasil mengubah total harga dengan No Kontrak Global '. ($data->no_kontrak_rinci ?? 'No Kontrak Global Kosong') . '.');
            return redirect()->back();
            // Additional logic here if needed
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
