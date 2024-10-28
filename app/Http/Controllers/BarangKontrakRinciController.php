<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\KontrakGlobal;
use App\Models\KontrakRinci;
use App\Models\ProdukKontrak;
use App\Models\ProdukKontrakRinci;
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
            $idKontrakGlobal = $request->input('id_kontrak_global');
            $idKontrakRinci = $request->input('id_kontrak_rinci');
            $namaBarang = $request->input('id_produk', []);
            $kuantitas = $request->input('kuantitas', []);
            $idSatuan = $request->input('id_satuan', []);
            $volumeKontrak = $request->input('volume_kontrak', []);
            $volumeRealisasi = $request->input('volume_realisasi', []);
            $volumeSisa = $request->input('volume_sisa', []);

            if($request->has('id_kontrak_rinci')){
                $type = 'detail_contract';
                $queryKontrakRinci = KontrakRinci::where('id', $request->id_kontrak_rinci);
                $dataKontrakRinci = $queryKontrakRinci->first();
                $idKontrakGlobal = $dataKontrakRinci->id_kontrak_global;
            } else {
                $type = 'global_contract';
            }
    
            // Validasi data
            $rules = [
                'id_produk.*' => 'required|integer',
                'kuantitas.*' => 'nullable|numeric',
                'id_satuan.*' => 'required|integer',
                'volume_kontrak.*' => 'nullable|numeric',
                'volume_realisasi.*' => 'nullable|numeric',
                'volume_sisa.*' => 'nullable|numeric',
                /* 'total_harga.*' => 'nullable', */
            ];
    
            $validated = $request->validate($rules, [
                'id_produk.*.required' => 'Nama barang wajib diisi.',
                'id_produk.*.integer' => 'Nama barang tidak sesuai.',
                'kuantitas.*.nullable' => 'Kuantitas bersifat opsional.',
                'id_satuan.*.nullable' => 'ID Satuan bersifat opsional.',
                'volume_kontrak.*.numeric' => 'Volume kontrak harus berupa angka.',
                'volume_realisasi.*.numeric' => 'Volume realisasi harus berupa angka.',
                'volume_sisa.*.numeric' => 'Volume sisa harus berupa angka.',
            ]);
    
            // Proses dan simpan setiap entri
            foreach ($namaBarang as $index => $itemNamaBarang) {
                if($type == 'detail_contract'){
                    $dataBarangKontrakGlobal = ProdukKontrak::where('id_kontrak_global', $idKontrakGlobal)->where('id_produk', $itemNamaBarang)->first();

                    $parameter = [
                        'id_kontrak_rinci' => $idKontrakRinci,
                        'id_kontrak_global' => $idKontrakGlobal,
                        'id_produk' => $itemNamaBarang,
                        'kuantitas' => $kuantitas[$index] ?? null,
                        'id_satuan' => $idSatuan[$index] ?? null,
                        'id_produk_kontrak_global' => $dataBarangKontrakGlobal->id,
                    ];
                    
                    // Hitung Volume
                    $volumeRealisasi = $dataBarangKontrakGlobal->volume_realisasi;
                    $volumeKontrak = $dataBarangKontrakGlobal->volume_kontrak;

                    if($volumeRealisasi == 0){
                        $totalVolumeRealisasi = $volumeRealisasi + $kuantitas[$index];
                        $totalVolumeSisa = $volumeKontrak - $totalVolumeRealisasi;
                    } else {
                        $totalVolumeRealisasi = $volumeRealisasi + $kuantitas[$index];
                        $totalVolumeSisa = $volumeKontrak - $totalVolumeRealisasi;

                    }
                    
                    $dataBarangKontrakRinci = ProdukKontrakRinci::create($parameter);

                    $dataBarangKontrakGlobal->update([
                        'volume_realisasi' => $totalVolumeRealisasi,
                        'volume_sisa' => $totalVolumeSisa,
                    ]);
        
                    if (!$dataBarangKontrakRinci) {
                        Alert::error('Gagal!', 'Gagal menambahkan barang kontrak rinci');
                        LogHelper::error('Gagal menambahkan barang kontrak rinci!', $parameter);
                        return redirect()->back();
                    }
                } else {      
                    $totalVolumeRealisasi = $volumeKontrak[$index] - $volumeRealisasi[$index];
                    
                    $parameter = [
                        'id_kontrak_global' => $idKontrakGlobal,
                        'id_produk' => $itemNamaBarang,
                        'kuantitas' => $kuantitas[$index] ?? null,
                        'id_satuan' => $idSatuan[$index] ?? null,
                        'volume_kontrak' => $volumeKontrak[$index] ?? null,
                        'volume_realisasi' => $volumeRealisasi[$index] ?? null,
                        'volume_sisa' => $totalVolumeRealisasi ?? null,
                    ];
        
                    // Simpan data
                    $dataBarangKontrakGlobal = ProdukKontrak::create($parameter);
        
                    if (!$dataBarangKontrakGlobal) {
                        Alert::error('Gagal!', 'Gagal menambahkan barang kontrak global');
                        LogHelper::error('Gagal menambahkan barang kontrak global!', $parameter);
                        return redirect()->back();
                    }
                }
            }

            // Ambil harga barang dan ubah menjadi format numerik
            /* $totalHargaStr = str_replace(['Rp. ', '.'], '', $totalHarga ?? 0);

            $dataKontrakRinci->total_harga = floatval($totalHargaStr) ;
            $dataKontrakRinci->save(); */
    
            Alert::success('Berhasil!', 'Berhasil menambah barang kontrak');
            LogHelper::success('Berhasil menambahkan barang kontrak.');
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

    public function filterByKontrakGlobal($id)
    {
        // Ambil data produk beserta relasinya ke dataProduk berdasarkan id_kontrak_global
        $dataProdukPakaian = ProdukKontrak::where('id_kontrak_global', $id)
            ->with('dataProduk') // pastikan relasi sudah ditentukan di model ProdukKontrak
            ->get();
    
        // Kirim response JSON untuk AJAX
        return response()->json($dataProdukPakaian);
    }

    public function updateBarang(Request $request, $id)
    {
        $validated = $request->validate([
            'id_produk' => 'required',
            'id_satuan' => 'nullable|integer',
            'volume_kontrak' => 'nullable|numeric',
            'volume_realisasi' => 'nullable|numeric',
            'volume_sisa' => 'nullable|numeric',
        ],[
            'id_produk.required' => 'Nama barang wajib diisi.',
            'kuantitas.nullable' => 'Kuantitas bersifat opsional.',
            'id_satuan.nullable' => 'ID Satuan bersifat opsional.',
            'volume_kontrak.numeric' => 'Volume kontrak harus berupa angka.',
            'volume_realisasi.numeric' => 'Volume realisasi harus berupa angka.',
            'volume_sisa.numeric' => 'Volume sisa harus berupa angka.',
        ]);

        if($request->type == 'detail_contract'){
            $type = 'detail_contract';
        } else {
            $type = 'global_contract';
        }

        /* if (!is_null($validated['harga_barang'])) {
            $hargaString = $validated['harga_barang'] ?? '0';
            // Hapus "Rp " dari awal string dan ganti "." menjadi ""
            $harga = str_replace('Rp ', '', $hargaString); // Menghapus prefiks "Rp "
            $harga = str_replace('.', '', $harga); // Menghapus titik dari string
            $harga = str_replace('Rp ', '', $harga);
            $harga = (float) $harga; // Konversi ke float
            
            // Hitung Total harga baru
            $totalHargaLama = (float)$dataKontrakRinci->total_harga - (float)$dataProdukKontrak->harga_barang; // Pengurangan total sebelumnya
            $totalHargaBaru = $totalHargaLama + $harga;
            // Update Harga Barang
            $dataProdukKontrak->harga_barang = $harga;
            // Update dataKontrakRinci
            $dataKontrakRinci->total_harga = $totalHargaBaru;
        } */

        if($type == 'detail_contract'){
            $dataProdukKontrakRinci = ProdukKontrakRinci::find($id);
            $dataKontrakRinci = KontrakRinci::find($dataProdukKontrakRinci->id_kontrak_global);

            $dataProdukKontrakGlobal = ProdukKontrak::where('id_kontrak_global', $dataProdukKontrakRinci->id_kontrak_global)->where('id_produk', $dataProdukKontrakRinci->id_produk)->first();
            
            $volumeKontrak = $dataProdukKontrakGlobal->volume_kontrak;
            $volumeRealisasi = $dataProdukKontrakGlobal->volume_realisasi;
            $volumeSisa = $dataProdukKontrakGlobal->volume_sisa;

            //Hitung Volume Yang sudah ada
            $totalKuantitas = $request->kuantitas - $dataProdukKontrakRinci->kuantitas;

            // Hitung Volume
            $totalVolumeRealisasi = $volumeRealisasi + $totalKuantitas;
            $totalVolumeSisa = $volumeKontrak - $totalVolumeRealisasi;

            $dataProdukKontrakRinci->update([
                'kuantitas' => $request->kuantitas,
            ]);

            $dataProdukKontrakGlobal->update([
                'volume_realisasi' => $totalVolumeRealisasi,
                'volume_sisa' => $totalVolumeSisa,
            ]);

            if (!$dataProdukKontrakRinci) {
                Alert::error('Gagal!', 'Gagal update barang kontrak rinci');
                LogHelper::error('Gagal update barang kontrak rinci!');
                return redirect()->back();
            }

            Alert::success('Berhasil!', 'Berhasil mengubah data Barang dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
            LogHelper::success('Berhasil mengubah data Barang dengan No Kontrak Rinci '. $dataKontrakRinci->no_kontrak_rinci ?? 'No Kontrak Rinci Kosong' . '.');
        } else {
            $dataProdukKontrak = ProdukKontrak::find($id);
            // Update dataProdukKontrak
            $dataProdukKontrak->id_produk = $validated['id_produk'];
            $dataProdukKontrak->id_satuan = $validated['id_satuan'];
            $dataProdukKontrak->volume_kontrak = $validated['volume_kontrak'] ?? null;
            $dataProdukKontrak->volume_realisasi = $validated['volume_realisasi'] ?? null;
            $dataProdukKontrak->volume_sisa = $validated['volume_sisa'] ?? null;

            $dataProdukKontrak->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data Barang dengan No Kontrak.');
            LogHelper::success('Berhasil mengubah data Barang dengan No Kontrak.');
        }
        return redirect()->back();
    }

    public function destroy(Request $request, $id)
    {
        if($request->type == 'produk_kontrak_global'){
            $dataProdukKontrak = ProdukKontrak::find($id);
            $dataKontrakGlobal = KontrakGlobal::find($dataProdukKontrak->id_kontrak_rinci);
    
            /* Update total harga di table Kontrak Rinci */
            // $updateTotalHarga = (float)$dataKontrakGlobal->total_harga - (float)$dataProdukKontrak->harga_barang;
    
            // $dataKontrakGlobal->total_harga = $updateTotalHarga;
            // $dataKontrakGlobal->save();
    
            $deleteData = $dataProdukKontrak->delete();
        } else {
            $dataProdukKontrakRinci = ProdukKontrakRinci::find($id);
            $dataProdukKontrakGlobal = ProdukKontrak::where('id', $dataProdukKontrakRinci->id_produk_kontrak_global)->first();
            $dataKontrakRinci = KontrakRinci::find($dataProdukKontrakGlobal->id_kontrak_rinci);

            $volumeKontrak = $dataProdukKontrakGlobal->volume_kontrak;
            $volumeRealisasi = $dataProdukKontrakGlobal->volume_realisasi;
            $volumeSisaGlobal = $dataProdukKontrakGlobal->volume_sisa;
            $kuantitasRinci = $dataProdukKontrakRinci->kuantitas;

            // Hitung Volume
            $totalVolumeRealisasi = $volumeRealisasi - $kuantitasRinci;
            $totalVolumeSisa = $volumeSisaGlobal + $kuantitasRinci;

            $dataProdukKontrakGlobal->update([
                'volume_realisasi' => $totalVolumeRealisasi,
                'volume_sisa' => $totalVolumeSisa,
            ]);
    
            $deleteData = $dataProdukKontrakRinci->delete();
        }
        if(!$deleteData){
            return redirect()->back()->with('gagal', 'menghapus');
        }
        LogHelper::success('Berhasil menghapus barang!');
        toast('Berhasil menghapus barang!','success','top-right');
        return redirect()->back();
        try{
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
                return view('pages.utility.500');
        }
    }
    
}
