<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\KontrakRinci;
use App\Models\ProdukKontrak;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class BarangKontrakRinciController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Ambil semua data dari input
            $idKontrakRinci = $request->input('id_kontrak_rinci', []);
            $namaBarang = $request->input('nama_barang', []);
            $kuantitas = $request->input('kuantitas', []);
            $idSatuan = $request->input('id_satuan', []);
            $volumeKontrak = $request->input('volume_kontrak', []);
            $volumeRealisasi = $request->input('volume_realisasi', []);
            $volumeSisa = $request->input('volume_sisa', []);
            $hargaBarang = $request->input('harga_barang', []);
    
            // Validasi data
            $rules = [
                'nama_barang.*' => 'required|string',
                'kuantitas.*' => 'nullable|numeric',
                'id_satuan.*' => 'nullable|integer',
                'volume_kontrak.*' => 'nullable|numeric',
                'volume_realisasi.*' => 'nullable|numeric',
                'volume_sisa.*' => 'nullable|numeric',
                'harga_barang.*' => 'nullable',
            ];
    
            $validated = $request->validate($rules, [
                'nama_barang.*.required' => 'Nama barang wajib diisi.',
                'nama_barang.*.string' => 'Nama barang harus berupa string.',
                'kuantitas.*.nullable' => 'Kuantitas bersifat opsional.',
                'id_satuan.*.nullable' => 'ID Satuan bersifat opsional.',
                'volume_kontrak.*.numeric' => 'Volume kontrak harus berupa angka.',
                'volume_realisasi.*.numeric' => 'Volume realisasi harus berupa angka.',
                'volume_sisa.*.numeric' => 'Volume sisa harus berupa angka.',
            ]);

            $totalHarga = 0; // Variabel untuk menyimpan total harga
    
            // Proses dan simpan setiap entri
            foreach ($namaBarang as $index => $itemNamaBarang) {
                // Ambil harga barang dan ubah menjadi format numerik
                $harga = str_replace(['Rp. ', '.'], '', $hargaBarang[$index] ?? 0);
                $totalHarga += (int)$harga; // Tambahkan harga ke total harga

                // Siapkan data untuk disimpan
                $parameter = [
                    'id_kontrak_rinci' => $idKontrakRinci[0], // Atur sesuai kebutuhan
                    'nama_barang' => $itemNamaBarang,
                    'kuantitas' => $kuantitas[$index] ?? null,
                    'id_satuan' => $idSatuan[$index] ?? null,
                    'volume_kontrak' => $volumeKontrak[$index] ?? null,
                    'volume_realisasi' => $volumeRealisasi[$index] ?? null,
                    'volume_sisa' => $volumeSisa[$index] ?? null,
                    'harga_barang' => $harga,
                ];
    
                // Simpan data
                $dataBarangKontrakRinci = ProdukKontrak::create($parameter);
    
                if (!$dataBarangKontrakRinci) {
                    Alert::error('Gagal!', 'Gagal menambahkan barang kontrak rinci');
                    LogHelper::error('Gagal menambahkan barang kontrak rinci!', $parameter);
                    return redirect()->back();
                }
            }

            $dataKontrakRinci = KontrakRinci::find($idKontrakRinci[0]);

            /* Total Harga Baru + Lama */
            $totalHargaBaru = (float)$dataKontrakRinci->total_harga + $totalHarga;

            $dataKontrakRinci->total_harga = $totalHargaBaru;
            $dataKontrakRinci->save();
    
            Alert::success('Berhasil!', 'Berhasil menambah barang kontrak rinci');
            LogHelper::success('Berhasil menambahkan barang kontrak rinci.');
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

    public function updateBarang(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string',
            'kuantitas' => 'nullable|numeric',
            'id_satuan' => 'nullable|integer',
            'volume_kontrak' => 'nullable|numeric',
            'volume_realisasi' => 'nullable|numeric',
            'volume_sisa' => 'nullable|numeric',
            'harga_barang' => 'nullable',
        ],[
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.string' => 'Nama barang harus berupa string.',
            'kuantitas.nullable' => 'Kuantitas bersifat opsional.',
            'id_satuan.nullable' => 'ID Satuan bersifat opsional.',
            'volume_kontrak.numeric' => 'Volume kontrak harus berupa angka.',
            'volume_realisasi.numeric' => 'Volume realisasi harus berupa angka.',
            'volume_sisa.numeric' => 'Volume sisa harus berupa angka.',
        ]);    

        $dataProdukKontrak = ProdukKontrak::find($id);
        $dataKontrakRinci = KontrakRinci::find($dataProdukKontrak->id_kontrak_rinci);

        if (!is_null($validated['harga_barang'])) {
            $hargaString = $validated['harga_barang'] ?? '0';
            // Hapus "Rp " dari awal string dan ganti "." menjadi ""
            $harga = str_replace('Rp ', '', $hargaString); // Menghapus prefiks "Rp "
            $harga = str_replace('.', '', $harga); // Menghapus titik dari string
            $harga = str_replace('Rp ', '', $harga);
            $harga = (float) $harga; // Konversi ke float
            
            /* Hitung Total harga baru */
            $totalHargaLama = (float)$dataKontrakRinci->total_harga - (float)$dataProdukKontrak->harga_barang; // Pengurangan total sebelumnya
            $totalHargaBaru = $totalHargaLama + $harga;
            /* Update Harga Barang */
            $dataProdukKontrak->harga_barang = $harga;
            /* Update dataKontrakRinci */
            $dataKontrakRinci->total_harga = $totalHargaBaru;
        }
        
        /* Update dataProdukKontrak */
        $dataProdukKontrak->nama_barang = $validated['nama_barang'];
        $dataProdukKontrak->kuantitas = $validated['kuantitas'];
        $dataProdukKontrak->id_satuan = $validated['id_satuan'];
        $dataProdukKontrak->volume_kontrak = $validated['volume_kontrak'];
        $dataProdukKontrak->volume_realisasi = $validated['volume_realisasi'];
        $dataProdukKontrak->volume_sisa = $validated['volume_sisa'];

        $dataProdukKontrak->save();
        $dataKontrakRinci->save();

        Alert::success('Berhasil!', 'Berhasil mengubah data Barang dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
        LogHelper::success('Berhasil mengubah data Barang dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
        return redirect()->back();
        try {
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function destroy($id)
    {
        try{
            $dataProdukKontrak = ProdukKontrak::find($id);
            $dataKontrakRinci = KontrakRinci::find($dataProdukKontrak->id_kontrak_rinci);

            /* Update total harga di table Kontrak Rinci */
            $updateTotalHarga = (float)$dataKontrakRinci->total_harga - (float)$dataProdukKontrak->harga_barang;

            $dataKontrakRinci->total_harga = $updateTotalHarga;
            $dataKontrakRinci->save();

            $deleteData = $dataProdukKontrak->delete();
            if(!$deleteData){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus barang!');
            toast('Berhasil menghapus barang!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
                return view('pages.utility.500');
        }
    }
    
}
