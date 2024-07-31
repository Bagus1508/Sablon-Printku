<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\KontrakRinci;
use App\Models\ProdukKontrak;
use App\Models\ProsesCutting;
use App\Models\ProsesJahit;
use App\Models\ProsesPacking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class MonitoringKontrakRinciController extends Controller
{
    public function index(){
        return view('pages.dashboard.monitoring_kontrak.kontrak_rinci.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'takon' => 'nullable|unique:kontrak_rinci_table,takon',
                'no_telepon' => 'required',
                'tanggal_kontrak' => 'required|date',
                'no_kontrak_rinci' => 'nullable',
                'tanggal_kr' => 'nullable|date',
                'awal_kr' => 'nullable|date',
                'akhir_kr' => 'nullable|date',
                'uraian' => 'nullable',
            ], [
                'takon.unique' => 'No Kontrak Takon ini sudah digunakan dalam kontrak rinci lain.',
                'no_telepon.required' => 'HP tidak boleh kosong.',
                'tanggal_kontrak.required' => 'Tanggal kontrak tidak boleh kosong.',
                'tanggal_kontrak.date' => 'Tanggal kontrak harus berupa tanggal yang valid.',
                'tanggal_kr.date' => 'Tanggal KR harus berupa tanggal yang valid.',
                'awal_kr.date' => 'Tanggal awal KR harus berupa tanggal yang valid.',
                'akhir_kr.date' => 'Tanggal akhir KR harus berupa tanggal yang valid.',
            ]);
            
            $parameter = [
                'takon' => $validated['takon'],
                'no_telepon' => $validated['no_telepon'],
                'tanggal_kontrak' => $validated['tanggal_kontrak'],
                'no_kontrak_rinci' => $validated['no_kontrak_rinci'],
                'tanggal_kr' => $validated['tanggal_kr'],
                'awal_kr' => $validated['awal_kr'],
                'akhir_kr' => $validated['akhir_kr'],
                'uraian' => $validated['uraian'],
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
                'takon' => 'nullable|unique:kontrak_rinci_table,takon',
                'no_telepon' => 'required',
                'tanggal_kontrak' => 'required|date',
                'no_kontrak_rinci' => 'nullable',
                'tanggal_kr' => 'nullable|date',
                'awal_kr' => 'nullable|date',
                'akhir_kr' => 'nullable|date',
                'uraian' => 'nullable',
            ], [
                'takon.unique' => 'No Kontrak Takon ini sudah digunakan dalam kontrak rinci lain.',
                'no_telepon.required' => 'HP tidak boleh kosong.',
                'tanggal_kontrak.required' => 'Tanggal kontrak tidak boleh kosong.',
                'tanggal_kontrak.date' => 'Tanggal kontrak harus berupa tanggal yang valid.',
                'tanggal_kr.date' => 'Tanggal KR harus berupa tanggal yang valid.',
                'awal_kr.date' => 'Tanggal awal KR harus berupa tanggal yang valid.',
                'akhir_kr.date' => 'Tanggal akhir KR harus berupa tanggal yang valid.',
            ]);

            $dataKontrakRinci = KontrakRinci::find($id);

            $dataKontrakRinci->takon = $validated['takon'];
            $dataKontrakRinci->no_telepon = $validated['no_telepon'];
            $dataKontrakRinci->tanggal_kontrak = $validated['tanggal_kontrak'];
            $dataKontrakRinci->no_kontrak_rinci = $validated['no_kontrak_rinci'];
            $dataKontrakRinci->tanggal_kr = $validated['tanggal_kr'];
            $dataKontrakRinci->awal_kr = $validated['awal_kr'];
            $dataKontrakRinci->akhir_kr = $validated['akhir_kr'];
            $dataKontrakRinci->uraian = $validated['uraian'];

            // Cek apakah kode_ekspedisi sudah digunakan oleh kontrak rinci lain
            if (KontrakRinci::where('no_kontrak_rinci', $validated['no_kontrak_rinci'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'kontrak rinci dengan kode '.$validated['no_kontrak_rinci'].' sudah digunakan oleh kontrak rinci lain.');
                return redirect()->back();
            }

            $saveDataKontrakRinci = $dataKontrakRinci->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data kontrak rinci');
            LogHelper::success('Berhasil mengubah data kontrak rinci.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function updateProsesCutting(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'tanggal_masuk' => 'nullable',
                'tanggal_selesai' => 'nullable',
            ]);
    
            $data = ProsesCutting::find($id);
    
            $durasiProses = null; // Inisialisasi durasiProses
    
            // Hanya hitung durasi jika kedua tanggal tidak null
            if (!is_null($validated['tanggal_masuk']) && !is_null($validated['tanggal_selesai'])) {
                $durasiProses = Carbon::parse($validated['tanggal_masuk'])->diffInDays(Carbon::parse($validated['tanggal_selesai']));
            }
    
            $data->tanggal_masuk = $validated['tanggal_masuk'];
            $data->tanggal_selesai = $validated['tanggal_selesai'];
            $data->durasi = $durasiProses;
    
            $User = $data->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah data Proses Cutting dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            LogHelper::success('Berhasil mengubah data Proses Cutting dengan No Kontrak Rinci '. $data->kontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            return redirect()->back();
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

    public function edit(){
        return view('pages.dashboard.data_ekspedisi.edit');
    }

    public function destroy($id)
    {
        $dataKontrakRinci = KontrakRinci::find($id);
        
        if (!$dataKontrakRinci) {
            return redirect()->back()->with('gagal', 'Data kontrak rinci tidak ditemukan.');
        }

        // Menghapus semua yang terkait dengan id_kontrak_rinci
        ProdukKontrak::where('id_kontrak_rinci', $id)->delete();
        ProsesCutting::where('id_kontrak_rinci', $id)->delete();
        ProsesJahit::where('id_kontrak_rinci', $id)->delete();
        ProsesPacking::where('id_kontrak_rinci', $id)->delete();
        
        // Menghapus data KontrakRinci
        $deleteDataKontrakRinci = $dataKontrakRinci->delete();
        
        if (!$deleteDataKontrakRinci) {
            return redirect()->back()->with('gagal', 'Gagal menghapus data kontrak rinci.');
        }
        
        LogHelper::success('Berhasil menghapus data kontrak rinci!');
        toast('Berhasil menghapus data kontrak rinci!', 'success', 'top-right');
        return redirect()->back();
        try {
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
