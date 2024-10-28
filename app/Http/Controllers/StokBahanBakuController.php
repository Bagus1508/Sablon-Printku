<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataSatuan;
use App\Models\HargaProduk;
use App\Models\Produk;
use App\Models\StokHarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class StokBahanBakuController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('stok-bahan');

        $dataStokBahan = Produk::where('id', $id)->get()->first();

        $dataSatuan = DataSatuan::all();
        
        return view('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.stok.show', compact('dataStokBahan', 'dataSatuan'));
    }

    public function store(Request $request)
    {
        try {
            $hargaBeliSatuan = str_replace('Rp', '', $request->input('harga_beli_satuan'));
            $hargaBeliSatuan = str_replace('.', '', $hargaBeliSatuan);
            $hargaBeliSatuan = str_replace(',', '.', $hargaBeliSatuan);
            $hargaBeliSatuan = (float) $hargaBeliSatuan;

            $validated = $request->validate([
                'id_produk' => 'required',
                'tanggal' => 'required|date',
                'roll_length' => 'nullable|numeric',
                'stok_masuk' => 'nullable|numeric',
                'stok_keluar' => 'nullable|numeric',
                'id_satuan' => 'required|integer',
                $hargaBeliSatuan => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/'
            ], [
                'tanggal.required' => 'Kolom Tanggal wajib diisi.',
                'tanggal.date' => 'Tanggal harus berupa format tanggal yang valid.',
                'stok_masuk.numeric' => 'Stok masuk harus berupa angka.',
                'stok_keluar.numeric' => 'Stok keluar harus berupa angka.',
                'id_satuan.required' => 'Satuan tidak boleh kosong.',
                'id_satuan.integer' => 'Satuan tidak sesuai.',
                $hargaBeliSatuan.'regex' => 'Harga beli satuan harus dalam format yang benar, contoh: 1.000'
            ]);

            $used_rolls = floor(($validated['stok_keluar'] ?? 0) / ($validated['roll_length'] ?? 1));
            $total_meter = $validated['stok_masuk'] ?? 0;
            $used_meter = $validated['stok_keluar'] ?? 0;
            $remaining_meter = $total_meter - $used_meter;
            $remaining_rolls = floor(($total_meter - $used_meter) / $validated['roll_length'] ?? 0);

            $parameter = [
                'id_produk' => $validated['id_produk'],
                'tanggal' => $validated['tanggal'],
                'stok_masuk' => $validated['stok_masuk'] ?? 0,
                'stok_keluar' => $validated['stok_keluar'] ?? 0,
                'sisa_stok' => $validated['stok_masuk'] ?? 0 - $validated['stok_keluar'] ?? 0,
                'roll_length' => $validated['roll_length'] ?? 0,
                'used_meter' => $validated['stok_keluar'] ?? 0,
                'used_rolls' => $used_rolls,
                'remaining_meter' => $remaining_meter,
                'remaining_rolls' => $remaining_rolls,
                'id_satuan' => $validated['id_satuan'],
            ];
    
            $dataStokHarian = StokHarian::create($parameter);

            $parameterHarga = [
                'id_stok_harian' => $dataStokHarian->id,
                'harga_beli_satuan' => $hargaBeliSatuan,
            ];

            $hargaProduk = HargaProduk::create($parameterHarga);
    
            if (!$dataStokHarian) {
                Alert::error('Gagal!', 'Gagal menambahkan stok harian');
                LogHelper::error('Gagal menambahkan stok harian!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah stok harian');
            LogHelper::success('Berhasil menambahkan stok harian.');
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
            $hargaBeliSatuan = str_replace('Rp', '', $request->input('harga_beli_satuan'));
            $hargaBeliSatuan = str_replace('.', '', $hargaBeliSatuan);
            $hargaBeliSatuan = str_replace(',', '.', $hargaBeliSatuan);
            $hargaBeliSatuan = (float) $hargaBeliSatuan;

            $validated = $request->validate([
                'tanggal' => 'required|date',
                'roll_length' => 'nullable|numeric',
                'stok_masuk' => 'nullable|numeric',
                'stok_keluar' => 'nullable|numeric',
                'id_satuan' => 'required|integer',
                $hargaBeliSatuan => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/'
            ], [
                'tanggal.required' => 'Kolom Tanggal wajib diisi.',
                'tanggal.date' => 'Tanggal harus berupa format tanggal yang valid.',
                'stok_masuk.numeric' => 'Stok masuk harus berupa angka.',
                'stok_keluar.numeric' => 'Stok keluar harus berupa angka.',
                'id_satuan.required' => 'Satuan tidak boleh kosong.',
                'id_satuan.integer' => 'Satuan tidak sesuai.',
                $hargaBeliSatuan.'regex' => 'Harga beli satuan harus dalam format yang benar, contoh: 1.000'
            ]);

            $used_rolls = floor($validated['stok_keluar'] ?? 0 / $validated['roll_length'] ?? 0);
            $total_meter = $validated['stok_masuk'] ?? 0;
            $used_meter = $validated['stok_keluar'] ?? 0;
            $remaining_meter = $total_meter - $used_meter;
            $remaining_rolls = floor(($total_meter - $used_meter) / $validated['roll_length'] ?? 0);
    
            $data = StokHarian::with('hargaProduk')->find($id);
    
            // Periksa apakah data ditemukan
            if (!$data) {
                Alert::error('Gagal!', 'Data stok harian tidak ditemukan.');
                return redirect()->back();
            }

            // Perbarui data
            $data->tanggal = $validated['tanggal'];
            $data->stok_masuk = $validated['stok_masuk'] ?? 0;
            $data->stok_keluar = $validated['stok_keluar'] ?? 0;
            $data->sisa_stok = $validated['stok_masuk'] ?? 0 - $validated['stok_keluar'] ?? 0;
            $data->roll_length = $validated['roll_length'] ?? 0;
            $data->used_meter = $validated['stok_keluar'] ?? 0;
            $data->used_rolls = $used_rolls;
            $data->remaining_meter = $remaining_meter;
            $data->remaining_rolls = $remaining_rolls;
            $data->id_satuan = $validated['id_satuan'];

            /* Simpan Harga Produk */
            if ($data->hargaProduk) {
                $data->hargaProduk->harga_beli_satuan = $hargaBeliSatuan;
                $data->hargaProduk->save();
            } else {
                $parameterHarga = [
                    'id_stok_harian' => $data->id,
                    'harga_beli_satuan' => $hargaBeliSatuan,
                ];

                HargaProduk::create($parameterHarga);
            }
            
            // Simpan data
            $data->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah data stok harian');
            LogHelper::success('Berhasil mengubah data stok harian.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }    

    public function destroy($id)
    {
        try{
            $data = StokHarian::find($id);
            $deleteStok = $data->delete();
            if(!$deleteStok){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data stok harian!');
            toast('Berhasil menghapus data stok harian!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
