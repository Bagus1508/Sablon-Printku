<?php

namespace App\Http\Controllers;

use App\Exports\MonitoringKontrakRinciAllExport;
use App\Exports\MonitoringKontrakRinciDetailExport;
use App\Helpers\LogHelper;
use App\Helpers\TanggalHelper;
use App\Models\BapbBapp;
use App\Models\BaRikmatek;
use App\Models\Bast;
use App\Models\DataPerusahaan;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\Invoice;
use App\Models\KontrakGlobal;
use App\Models\KontrakRinci;
use App\Models\Pajak;
use App\Models\PengirimanBarang;
use App\Models\ProdukKategori;
use App\Models\ProdukKontrak;
use App\Models\ProsesCutting;
use App\Models\ProsesJahit;
use App\Models\ProsesPacking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

use function PHPUnit\Framework\isNull;

class MonitoringKontrakRinciController extends Controller
{
    public function index(){
        $dataPerusahaan = DataPerusahaan::get();
        $dataKontrakGlobal = KontrakGlobal::get();
        $produkKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();

        return view('pages.dashboard.monitoring_kontrak.kontrak_rinci.index',[
            'dataPerusahaan' => $dataPerusahaan,
            'dataKontrakGlobal' => $dataKontrakGlobal,
            'dataPajak' => Pajak::get()->first(),
            'produkKategori' => $produkKategori,
            'dataSatuan' => $dataSatuan,
            'dataUkuran' => $dataUkuran,
            'dataWarna' => $dataWarna,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_kontrak_global' => 'required',
                'no_kontrak_rinci' => 'nullable',
                'tanggal_kr' => 'nullable|date',
                'awal_kr' => 'nullable|date',
                'akhir_kr' => 'nullable|date',
                'uraian' => 'nullable',
                'id_perusahaan' => 'nullable|integer'
            ], [
                'id_kontrak_global.required' => 'kontrak Global tidak boleh kosong.',
                'tanggal_kr.date' => 'Tanggal KR harus berupa tanggal yang valid.',
                'awal_kr.date' => 'Tanggal awal KR harus berupa tanggal yang valid.',
                'akhir_kr.date' => 'Tanggal akhir KR harus berupa tanggal yang valid.',
                'id_perusahaan.integer' => 'Perusahaan tidak valid!',
            ]);

            $dataKontrakGlobal = KontrakGlobal::where('id', $validated['id_kontrak_global'])->first();
            
            $parameter = [
                'id_kontrak_global' => $validated['id_kontrak_global'],
                'no_kontrak_rinci' => $validated['no_kontrak_rinci'] ?? null,
                'tanggal_kr' => $validated['tanggal_kr'] ?? null,
                'awal_kr' => $validated['awal_kr'] ?? null,
                'akhir_kr' => $validated['akhir_kr'] ?? null,
                'uraian' => $validated['uraian'] ?? null,
                'id_perusahaan' => $dataKontrakGlobal->id_perusahaan ?? null,
            ];
    
            $dataKontrakRinci = KontrakRinci::create($parameter);

            $parameterProsesPekerjaan = [
                'id_kontrak_rinci' => $dataKontrakRinci->id
            ];

            $dataProsesCutting = ProsesCutting::create($parameterProsesPekerjaan);
            $dataProsesJahit = ProsesJahit::create($parameterProsesPekerjaan);
            $dataProsesPacking = ProsesPacking::create($parameterProsesPekerjaan);
    
            if (!$dataKontrakRinci) {
                Alert::error('Gagal!', 'Gagal menambahkan kontrak rinci');
                LogHelper::error('Gagal menambahkan kontrak rinci!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah kontrak rinci');
            LogHelper::success('Berhasil menambahkan kontrak rinci.');
            return redirect()->back();
            
        } catch (ValidationException $e) {
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
    

    public function update(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'takon' => 'nullable',
                // 'no_telepon' => 'required',
                'no_kontrak_pihak_pertama' => 'required',
                'tanggal_kontrak' => 'required|date',
                'no_kontrak_rinci' => 'nullable',
                'tanggal_kr' => 'nullable|date',
                'awal_kr' => 'nullable|date',
                'akhir_kr' => 'nullable|date',
                'uraian' => 'nullable',
                'id_perusahaan' => 'nullable|integer',
            ], [
                // 'no_telepon.required' => 'HP tidak boleh kosong.',
                'no_kontrak_pihak_pertama.required' => 'No Kontrak Pihak Pertama tidak boleh kosong.',
                'tanggal_kontrak.required' => 'Tanggal kontrak tidak boleh kosong.',
                'tanggal_kontrak.date' => 'Tanggal kontrak harus berupa tanggal yang valid.',
                'tanggal_kr.date' => 'Tanggal KR harus berupa tanggal yang valid.',
                'awal_kr.date' => 'Tanggal awal KR harus berupa tanggal yang valid.',
                'akhir_kr.date' => 'Tanggal akhir KR harus berupa tanggal yang valid.',
                'id_perusahaan.integer' => 'Perusahaan tidak valid!',
            ]);

            $dataKontrakRinci = KontrakRinci::find($id);

            $dataKontrakRinci->takon = $validated['takon'];
            $dataKontrakRinci->no_telepon = $validated['no_telepon'] ?? 0;
            $dataKontrakRinci->no_kontrak_pihak_pertama = $validated['no_kontrak_pihak_pertama'];
            $dataKontrakRinci->tanggal_kontrak = $validated['tanggal_kontrak'];
            $dataKontrakRinci->no_kontrak_rinci = $validated['no_kontrak_rinci'] ?? null;
            $dataKontrakRinci->tanggal_kr = $validated['tanggal_kr'] ?? null;
            $dataKontrakRinci->awal_kr = $validated['awal_kr'] ?? null;
            $dataKontrakRinci->akhir_kr = $validated['akhir_kr'] ?? null;
            $dataKontrakRinci->uraian = $validated['uraian'] ?? null;
            $dataKontrakRinci->id_perusahaan = $validated['id_perusahaan'] ?? null;

            // Cek apakah kode_ekspedisi sudah digunakan oleh kontrak rinci lain
            if (KontrakRinci::where('takon', $validated['takon'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'kontrak takon dengan kode '.$validated['takon'].' sudah digunakan oleh kontrak takon lain.');
                return redirect()->back();
            }

            $saveDataKontrakRinci = $dataKontrakRinci->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data kontrak rinci');
            LogHelper::success('Berhasil mengubah data kontrak rinci.');
            return redirect()->back();
        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Alert::error('Error!', $error);
                }
            }
            return redirect()->back()->withInput();
        }
    }

    public function updateProsesCutting(Request $request, $id)
    {
        
        try {
            $validated = $request->validate([
                'tanggal_masuk' => 'nullable',
                'tanggal_selesai' => 'nullable',
            ]);
        
            $data = ProsesCutting::find($request->input('id'));

            if (!$data) {
                // Jika data tidak ditemukan, arahkan kembali dengan pesan error
                Alert::error('Error!', 'Data Kontrak Rinci tidak ditemukan.');
                return redirect()->back();
            }
        
            $durasiProses = null; // Inisialisasi durasiProses
        
            // Hanya hitung durasi jika kedua tanggal tidak null
            if (!is_null($validated['tanggal_masuk']) && !is_null($validated['tanggal_selesai'])) {
                $durasiProses = Carbon::parse($validated['tanggal_masuk'])->diffInDays(Carbon::parse($validated['tanggal_selesai']));
            }
        
            $data->tanggal_masuk = $validated['tanggal_masuk'];
            $data->tanggal_selesai = $validated['tanggal_selesai'];
            $data->durasi = $durasiProses;
        
            $data->save();
        
            Alert::success('Berhasil!', 'Berhasil mengubah data Kontrak Rinci dengan No Kontrak Rinci '. ($data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong') . '.');
            LogHelper::success('Berhasil mengubah data Kontrak Rinci dengan No Kontrak Rinci '. ($data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong') . '.');
            return redirect()->back();
            // Additional logic here if needed
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
    

    public function updateProsesJahit(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal_masuk' => 'nullable',
                'tanggal_selesai' => 'nullable',
            ]);

            $data = ProsesJahit::find($id);

            $durasiProses = null; // Inisialisasi durasiProses
    
            // Hanya hitung durasi jika kedua tanggal tidak null
            if (!is_null($validated['tanggal_masuk']) && !is_null($validated['tanggal_selesai'])) {
                $durasiProses = Carbon::parse($validated['tanggal_masuk'])->diffInDays(Carbon::parse($validated['tanggal_selesai']));
            }

            $data->tanggal_masuk = $validated['tanggal_masuk'];
            $data->tanggal_selesai = $validated['tanggal_selesai'];
            $data->durasi = $durasiProses;

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data Proses Jahit dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            LogHelper::success('Berhasil mengubah data Proses Jahit dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function updateProsesPacking(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal_masuk' => 'nullable',
                'tanggal_selesai' => 'nullable',
            ]);

            $data = ProsesPacking::find($id);

            $durasiProses = null; // Inisialisasi durasiProses
    
            // Hanya hitung durasi jika kedua tanggal tidak null
            if (!is_null($validated['tanggal_masuk']) && !is_null($validated['tanggal_selesai'])) {
                $durasiProses = Carbon::parse($validated['tanggal_masuk'])->diffInDays(Carbon::parse($validated['tanggal_selesai']));
            }

            $data->tanggal_masuk = $validated['tanggal_masuk'];
            $data->tanggal_selesai = $validated['tanggal_selesai'];
            $data->durasi = $durasiProses;

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data Proses Packing dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            LogHelper::success('Berhasil mengubah data Proses Packing dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function updateBaRikmatek(Request $request)
    {
        try {
            $validated = $request->validate([
                'no' => 'nullable',
                'tanggal_ba_rikmatek' => 'nullable',
            ]);

            $data = ProsesPacking::find();

            $durasiProses = null; // Inisialisasi durasiProses
    
            // Hanya hitung durasi jika kedua tanggal tidak null
            if (!is_null($validated['tanggal_masuk']) && !is_null($validated['tanggal_selesai'])) {
                $durasiProses = Carbon::parse($validated['tanggal_masuk'])->diffInDays(Carbon::parse($validated['tanggal_selesai']));
            }

            $data->tanggal_masuk = $validated['tanggal_masuk'];
            $data->tanggal_selesai = $validated['tanggal_selesai'];
            $data->durasi = $durasiProses;

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data Proses Packing dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            LogHelper::success('Berhasil mengubah data Proses Packing dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.data_ekspedisi.edit');
    }

    public function destroy($id)
    {
        try {
            $dataKontrakRinci = KontrakRinci::find($id);
            
            if (!$dataKontrakRinci) {
                return redirect()->back()->with('gagal', 'Data kontrak rinci tidak ditemukan.');
            }
    
            // Menghapus semua yang terkait dengan id_kontrak_rinci
            ProsesCutting::where('id_kontrak_rinci', $id)->delete();
            ProsesJahit::where('id_kontrak_rinci', $id)->delete();
            ProsesPacking::where('id_kontrak_rinci', $id)->delete();
            Bast::where('id_kontrak_rinci', $id)->delete();
            BapbBapp::where('id_kontrak_rinci', $id)->delete();
            BaRikmatek::where('id_kontrak_rinci', $id)->delete();
            PengirimanBarang::where('id_kontrak_rinci', $id)->delete();
            Invoice::where('id_kontrak_rinci', $id)->delete();
            
            // Menghapus data KontrakRinci
            $deleteDataKontrakRinci = $dataKontrakRinci->delete();
            
            if (!$deleteDataKontrakRinci) {
                return redirect()->back()->with('gagal', 'Gagal menghapus data kontrak rinci.');
            }
            
            LogHelper::success('Berhasil menghapus data kontrak rinci!');
            toast('Berhasil menghapus data kontrak rinci!', 'success', 'top-right');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function preview_export_detail(Request $request, $id) 
    {
        try {
            $query = KontrakRinci::with(['prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 
                    'bapb_bapp', 'bast', 'invoice'                 
                   ]);    
            $dataKontrakRinci = $query->where('id', $id)->get()->first();

            $totalBarang = $dataKontrakRinci->barangKontrak->count();

            if($totalBarang == 0){
                toast('Gagal menampilkan data: data Barang masih kosong!', 'error', 'top-right');
                return redirect()->back();
            }

            $awalKr = Carbon::parse($dataKontrakRinci->awal_kr);
            $akhirKr = Carbon::parse($dataKontrakRinci->akhir_kr);
            $durasiHari = $awalKr->diffInDays($akhirKr);
        
            return view('pages.dashboard.monitoring_kontrak.kontrak_rinci.export.detail.index', [
                'dataKontrakRinci' => $dataKontrakRinci,
                'durasiHari' => $durasiHari,
                'totalBarang' => $totalBarang,
                'idKontrakRinci' => $dataKontrakRinci->id,
                "checkbox_cutting" => $request->input('checkbox_cutting'),
                "checkbox_jahit" => $request->input('checkbox_jahit'),
                "checkbox_packing" => $request->input('checkbox_packing'),
            ]);
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            toast('Gagal menampilkan data: ' . $e->getMessage(), 'error', 'top-right');
            return redirect()->back();
        }
    }

    public function exportKontrakRinciDetail(Request $request)
    {
        $idKontrakRinci = $request->input('id_kontrak_rinci');
        $checkboxCutting = $request->input('checkbox_cutting');
        $checkboxJahit = $request->input('checkbox_jahit');
        $checkboxPacking = $request->input('checkbox_packing');

        $filename = 'KONTRAK_RINCI_DETAIL_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new MonitoringKontrakRinciDetailExport($idKontrakRinci, $checkboxCutting, $checkboxJahit, $checkboxPacking), $filename);
    }

    public function preview_export_all(Request $request) 
    {
        try {
            // Tangkap rentang tanggal dari parameter query
            $tanggal_kontrak_rinci = $request->input('tanggal'); // Ambil nilai dari parameter URL
            $proses_jahit_checkbox = $request->input('proses_jahit_checkbox'); // Ambil nilai dari parameter URL
            $proses_cutting_checkbox = $request->input('proses_cutting_checkbox'); // Ambil nilai dari parameter URL
            $proses_packing_checkbox = $request->input('proses_packing_checkbox'); // Ambil nilai dari parameter URL
            $no_kontrak_pihak_pertama = $request->input('no_kontrak_pihak_pertama'); // Ambil nilai dari parameter URL
            $kode_perusahaan = $request->input('kode_perusahaan'); // Ambil nilai dari parameter URL
            
            $proses_cutting_boolean = $proses_cutting_checkbox ? "true" : "false";
            $proses_jahit_boolean = $proses_jahit_checkbox ? "true" : "false";
            $proses_packing_boolean = $proses_packing_checkbox ? "true" : "false";            

            $startDateFormatted = '';
            $endDateFormatted = '';

            if($tanggal_kontrak_rinci == null){
                // Mendapatkan tanggal awal tahun ini
                $startDateStr = Carbon::now()->startOfYear()->format('Y-m-d');
                // Mendapatkan tanggal akhir tahun ini
                $endDateStr = Carbon::now()->endOfYear()->format('Y-m-d');

                $startDate = Carbon::parse($startDateStr);
                $endDate = Carbon::parse($endDateStr);

                $startDateFormatted = Carbon::parse($startDate)->translatedFormat('j F Y');
                $endDateFormatted = Carbon::parse($endDate)->translatedFormat('j F Y');
            } else {
                $tanggalKontrakRinci = explode(' - ', $tanggal_kontrak_rinci); // Membagi berdasarkan pemisah

                if (count($tanggalKontrakRinci) == 1) {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrakRinci[0], 'en'))->format("Y-m-d");
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = $startDate;
                } else {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrakRinci[0], 'en'))->format("Y-m-d");
                    $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrakRinci[1], 'en'))->format("Y-m-d");

                    $startDate = Carbon::parse($startDateStr);
                    $endDate = Carbon::parse($endDateStr);
                }
            }

            $query = KontrakRinci::whereBetween('tanggal_kr', [$startDate, $endDate])
            ->orderBy('tanggal_kr', 'desc')
            ->with(['prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 
                    'bapb_bapp', 'bast', 'invoice'                 
                   ])
            ->whereHas('barangKontrak', function ($query) {
            // Hanya lanjutkan jika ada `id_kontrak_rinci` yang terkait di `barangKontrak`
            $query->whereNotNull('id_kontrak_rinci');
            }); 

            $checkingBarangKontrak = KontrakRinci::whereBetween('tanggal_kr', [$startDate, $endDate])
                ->orderBy('tanggal_kr', 'desc')
                ->with(['prosesCutting', 'prosesJahit', 'prosesPacking', 'barangKontrak', 'pengirimanBarang', 'ba_rikmatek', 'bapb_bapp', 'bast', 'invoice'])
                ->get();

            // Filter KontrakRinci yang valid
            $validBarangKontrak = $checkingBarangKontrak->filter(function ($item) {
                // Cek apakah barangKontrak terkait dengan id_kontrak_rinci
                return !$item->barangKontrak->isEmpty() && $item->barangKontrak->every(function ($barang) {
                    return $barang->id_kontrak_rinci !== null;
                });
            });

            // Jika ada KontrakRinci yang tidak valid
            if ($validBarangKontrak->count() !== $checkingBarangKontrak->count()) {
                Alert::error('Error!', 'Ada barang pada kontrak rinci yang belum terisi.');
                return redirect()->back();
            }
                   
            if ($no_kontrak_pihak_pertama != 0) {
                $query->where('no_kontrak_pihak_pertama', $no_kontrak_pihak_pertama);
            }
                    
            if ($kode_perusahaan != 0) {
                $query->whereHas('perusahaan', function ($query) use ($kode_perusahaan) {
                    $query->where('kode_perusahaan', $kode_perusahaan);
                });
            }

            $dataKontrakRinci = $query->get()->all();

            if ($query->get()->isEmpty()) {
                // Jika data tidak ditemukan, arahkan kembali dengan pesan error
                Alert::error('Error!', 'Ada barang pada kontrak rinci yang belum terisi.');
                return redirect()->back();
            }
        
            return view('pages.dashboard.monitoring_kontrak.kontrak_rinci.export.index', [
                'dataKontrakRinci' => $dataKontrakRinci,
                'startDateFormatted' => $startDateFormatted ?? '',
                'endDateFormatted' => $endDateFormatted ?? '',
                'startDate' => $startDate ?? '',
                'endDate' => $endDate ?? '',
                'tanggal_kontrak_rinci' => $tanggal_kontrak_rinci ?? '',
                'proses_jahit_checkbox' => $proses_jahit_checkbox ?? '',
                'proses_cutting_checkbox' => $proses_cutting_checkbox ?? '',
                'proses_packing_checkbox' => $proses_packing_checkbox ?? '',
                'checkbox_jahit' => $proses_jahit_boolean ?? '',
                'checkbox_cutting' => $proses_cutting_boolean ?? '',
                'checkbox_packing' => $proses_packing_boolean ?? '',
                'no_kontrak_pihak_pertama' => $no_kontrak_pihak_pertama ?? '',
                'kode_perusahaan' => $kode_perusahaan ?? '',
                'dataPajak' => Pajak::get()->first(),
            ]);
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            toast('Gagal menampilkan data: ' . $e->getMessage(), 'error', 'top-right');
            return redirect()->back();
        }
    }

    public function exportKontrakRinciAll(Request $request)
    {
        // Tangkap rentang tanggal dari parameter query
        $tanggal_kontrak_rinci = $request->input('tanggal'); // Ambil nilai dari parameter URL

        $startDateFormatted = '';
        $endDateFormatted = '';

        if($tanggal_kontrak_rinci == null){
            // Mendapatkan tanggal awal tahun ini
            $startDateStr = Carbon::now()->startOfYear()->format('Y-m-d');
            // Mendapatkan tanggal akhir tahun ini
            $endDateStr = Carbon::now()->endOfYear()->format('Y-m-d');

            $startDate = Carbon::parse($startDateStr);
            $endDate = Carbon::parse($endDateStr);

            $startDateFormatted = Carbon::parse($startDate)->translatedFormat('j F Y');
            $endDateFormatted = Carbon::parse($endDate)->translatedFormat('j F Y');
        } else {
            $tanggalKontrakRinci = explode(' - ', $tanggal_kontrak_rinci); // Membagi berdasarkan pemisah

            if (count($tanggalKontrakRinci) == 1) {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrakRinci[0], 'en'))->format("Y-m-d");
                $startDate = Carbon::parse($startDateStr);
                $endDate = $startDate;
            } else {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrakRinci[0], 'en'))->format("Y-m-d");
                $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalKontrakRinci[1], 'en'))->format("Y-m-d");

                $startDate = Carbon::parse($startDateStr);
                $endDate = Carbon::parse($endDateStr);
            }
        }

        $proses_jahit_checkbox = $request->input('proses_jahit_checkbox'); // Ambil nilai dari parameter URL
        $proses_cutting_checkbox = $request->input('proses_cutting_checkbox'); // Ambil nilai dari parameter URL
        $proses_packing_checkbox = $request->input('proses_packing_checkbox'); // Ambil nilai dari parameter URL
        $no_kontrak_pihak_pertama = $request->input('no_kontrak_pihak_pertama'); // Ambil nilai dari parameter URL
        $kode_perusahaan = $request->input('kode_perusahaan'); // Ambil nilai dari parameter URL

        $filename = 'KONTRAK_RINCI_ALL_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new MonitoringKontrakRinciAllExport($startDate, $endDate, $proses_jahit_checkbox, $proses_cutting_checkbox, $proses_packing_checkbox, $no_kontrak_pihak_pertama, $kode_perusahaan), $filename);
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

            
            $data = KontrakRinci::find($id);
            if (!$data) {
                // Jika data tidak ditemukan, arahkan kembali dengan pesan error
                Alert::error('Error!', 'Data Kontrak Rinci tidak ditemukan.');
                return redirect()->back();
            }

            // Nilai kontrak rinci sebelum perubahan
            $totalHargaRinciOld = floatval($data->total_harga);

            // Ambil nilai dari form input dan ubah ke float
            $totalHargaStr = str_replace('Rp', '', $validated['total_harga']);
            $totalHargaStr = str_replace('.', '', $totalHargaStr);
            $totalHargaStr = str_replace(',', '.', $totalHargaStr);
            $totalHargaRinciNew = (float)$totalHargaStr; // Nilai kontrak rinci baru setelah perubahan

            // Update nilai kontrak rinci
            $data->total_harga = $totalHargaRinciNew;
            $data->id_pajak = $validated['id_pajak'];
            $idKontrakGlobal = $data->id_kontrak_global;

            // Dapatkan data kontrak global yang terkait
            $dataKontrakGlobal = KontrakGlobal::where('id', $idKontrakGlobal)->first();
            $totalHargaGlobalOld = floatval($dataKontrakGlobal->total_harga); // Nilai kontrak global sebelum perubahan

            // Hitung selisih nilai antara kontrak rinci lama dan yang baru
            $selisih = $totalHargaRinciNew - $totalHargaRinciOld;

            // Update nilai kontrak global dengan mengurangi atau menambah sesuai selisih
            $dataKontrakGlobal->total_harga = $totalHargaGlobalOld - $selisih;
            $dataKontrakGlobal->save(); // Simpan perubahan pada kontrak global

            // Simpan perubahan pada kontrak rinci
            $data->save();
            $dataKontrakGlobal->save();
        
            Alert::success('Berhasil!', 'Berhasil mengubah total harga dengan No Kontrak Rinci '. ($data->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong') . '.');
            LogHelper::success('Berhasil mengubah total harga dengan No Kontrak Rinci '. ($data->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong') . '.');
            return redirect()->back();
            // Additional logic here if needed
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
    
}
