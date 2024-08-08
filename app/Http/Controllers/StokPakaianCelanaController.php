<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\HargaProduk;
use App\Models\Produk;
use App\Models\StokHarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class StokPakaianCelanaController extends Controller
{
    public function index(Request $request)
    {
        $id = $request->query('stok_pakaian_celana');

        $dataStokBahan = Produk::where('id', $id)->get()->first();

        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();

        return view('pages.dashboard.monitoring_persediaan.pakaian_celana.satuan.stok.show', compact('dataStokBahan', 'dataSatuan', 'dataUkuran'));
    }

    public function hargaFormatted($inputHarga){
        $hargaStrReplace = str_replace('Rp', '', $inputHarga);
        $hargaStrReplace = str_replace('.', '', $hargaStrReplace);
        $hargaStrReplace = str_replace(',', '.', $hargaStrReplace);
        $hargaStrReplace = (float) $hargaStrReplace;

        return $hargaStrReplace;
    }

    public function store(Request $request)
    {
        try {
            $hargaProduksiSatuan = $this->hargaFormatted($request->input('harga_produksi_satuan'));
            $hargaJualSatuan = $this->hargaFormatted($request->input('harga_jual_satuan'));

            $validated = $request->validate([
                'id_produk' => 'required',
                'tanggal' => 'required',
                'stok_masuk' => 'nullable',
                'stok_keluar' => 'nullable',
                'id_satuan' => 'required',
                'id_ukuran' => 'required',
                $hargaProduksiSatuan => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/',
                $hargaJualSatuan => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/'
            ], [
                'id_produk.required' => 'Produk tidak ada.',
                'id_satuan.required' => 'Satuan tidak boleh kosong',
                'id_ukuran.required' => 'Ukuran tidak boleh kosong',
                $hargaProduksiSatuan.'regex' => 'Harga beli satuan harus dalam format yang benar, contoh: 1.000',
                $hargaJualSatuan.'regex' => 'Harga jual satuan harus dalam format yang benar, contoh: 1.000'
            ]);

            $parameter = [
                'id_produk' => $validated['id_produk'],
                'tanggal' => $validated['tanggal'],
                'stok_masuk' => $validated['stok_masuk'] ?? 0,
                'stok_keluar' => $validated['stok_keluar'] ?? 0,
                'sisa_stok' => $validated['stok_masuk'] ?? 0 - $validated['stok_keluar'] ?? 0,
                'id_satuan' => $validated['id_satuan'],
                'id_ukuran' => $validated['id_ukuran'],
            ];

            $existingStokHarian = StokHarian::where('id_produk', $validated['id_produk'])                
            ->where('tanggal', $validated['tanggal'])
            ->exists();

            $dataUkuran = DataUkuran::where('id', $validated['id_ukuran'])->pluck('nama_ukuran')->first();        
        
            if ($existingStokHarian) {
                Alert::error('Gagal!', 'Stok dengan tanggal ' . Carbon::parse($validated['tanggal'])->translatedFormat('d F Y') . ' dengan ukuran '.$dataUkuran.' sudah ada.');
                return redirect()->back()->withInput();
            }        
    
            $dataStokHarian = StokHarian::create($parameter);

            $parameterHarga = [
                'id_stok_harian' => $dataStokHarian->id,
                'harga_produksi_satuan' => $hargaProduksiSatuan,
                'harga_jual_satuan' => $hargaJualSatuan,
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
            $hargaProduksiSatuan = $this->hargaFormatted($request->input('harga_produksi_satuan'));
            $hargaJualSatuan = $this->hargaFormatted($request->input('harga_jual_satuan'));

            $validated = $request->validate([
                'tanggal' => 'nullable|date',
                'stok_masuk' => 'nullable|numeric',
                'stok_keluar' => 'nullable|numeric',
                'id_satuan' => 'required|integer',
                'id_ukuran' => 'required|integer',
                $hargaProduksiSatuan => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/',
                $hargaJualSatuan => 'nullable|regex:/^\d{1,3}(\.\d{3})*$/'
            ], [
                'id_satuan.required' => 'Satuan tidak boleh kosong',
                'id_ukuran.required' => 'Ukuran tidak boleh kosong',
                $hargaProduksiSatuan.'regex' => 'Harga beli satuan harus dalam format yang benar, contoh: 1.000',
                $hargaJualSatuan.'regex' => 'Harga jual satuan harus dalam format yang benar, contoh: 1.000'
            ]);
    
            $data = StokHarian::find($id);
    
            // Periksa apakah data ditemukan
            if (!$data) {
                Alert::error('Gagal!', 'Data stok harian tidak ditemukan.');
                return redirect()->back();
            }

            $existingStokHarian = StokHarian::where('id_produk', $id)    
            ->where('id', '!=', $id)            
            ->where('id_ukuran', $validated['id_ukuran'])
            ->where('tanggal', $validated['tanggal'])
            ->exists();

            $dataUkuran = DataUkuran::where('id', $validated['id_ukuran'])->pluck('nama_ukuran')->first();        
        
            if ($existingStokHarian) {
                Alert::error('Gagal!', 'Stok dengan tanggal ' . Carbon::parse($validated['tanggal'])->translatedFormat('d F Y') . ' dengan ukuran '.$dataUkuran.' sudah ada.');
                return redirect()->back()->withInput();
            }        

            // Perbarui data
            $data->tanggal = $validated['tanggal'];
            $data->stok_masuk = $validated['stok_masuk'] ?? 0;
            $data->stok_keluar = $validated['stok_keluar'] ?? 0;
            $data->sisa_stok = $validated['stok_masuk'] ?? 0 - $validated['stok_keluar'] ?? 0;
            $data->id_satuan = $validated['id_satuan'];
            $data->id_ukuran = $validated['id_ukuran'];

            /* Simpan Harga Produk */
            if ($data->hargaProduk) {
                $data->hargaProduk->harga_produksi_satuan = $hargaProduksiSatuan;
                $data->hargaProduk->harga_jual_satuan = $hargaJualSatuan;
                $data->hargaProduk->total_harga_produksi = $hargaJualSatuan;
                $data->hargaProduk->save();
            } else {
                $parameterHarga = [
                    'id_stok_harian' => $data->id,
                    'harga_produksi_satuan' => $hargaProduksiSatuan,
                    'harga_jual_satuan' => $hargaJualSatuan,
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

    public function edit(){
        return view('pages.dashboard.category.edit');
    }

    public function destroy($id)
    {
        try{
            $data = StokHarian::find($id);
            $user = $data->delete();
            if(!$user){
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
