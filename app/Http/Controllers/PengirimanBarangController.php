<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\PengirimanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class PengirimanBarangController extends Controller
{
    public function store(Request $request){
        try {
            $validated = $request->validate([
                'id_kontrak_rinci' => 'required|integer',
                'id_region' => 'required|integer',
                'no_surat_jalan' => 'nullable',
                'tanggal_surat_jalan' => 'nullable|date',
                'bukti_foto' => 'nullable|mimes:pdf,jpg,png,jpeg|max:2048',
                'id_ekspedisi' => 'nullable|integer',
            ], [
                'id_kontrak_rinci.required' => 'Kontrak Rinci wajib diisi.',
                'id_kontrak_rinci.integer' => 'Kontrak Rinci tidak sesuai.',
                'id_region.required' => 'Region wajib diisi.',
                'id_region.integer' => 'Region tidak sesuai.',
                'tanggal_surat_jalan.date' => 'Tanggal Surat Jalan harus berupa tanggal yang valid.',
                'bukti_foto.mimes' => 'Bukti Foto harus berupa file dengan tipe: pdf, jpg, png, jpeg.',
                'bukti_foto.max' => 'Bukti Foto tidak boleh lebih dari 2048 kilobyte.',
                'id_ekspedisi.integer' => 'Ekspedisi tidak sesuai.',
            ]);

            $existDataPengiriman = PengirimanBarang::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->exists();

            if($existDataPengiriman != true){
                $uploadedFile = $request->file('bukti_foto');
    
                if ($uploadedFile) {
                    // Menentukan direktori penyimpanan di public/upload
                    $destinationPath = 'public/upload/dokumen_pengiriman_barang';
                    // Membuat nama file unik dengan tanggal dan waktu
                    $namaFile = date('His') . '_' . date('dmy') . '_' . 'pengiriman_barang_' . $uploadedFile->getClientOriginalName();
                    // Memindahkan file yang diunggah ke direktori public/upload/dokumen_pengiriman_barang
                    $uploadedFile->storeAs($destinationPath, $namaFile);
                    // Mengatur nama file dokumen pada objek pengiriman barang
                    $validated['bukti_foto'] = $namaFile;
                } else {
                    // Handle case where no file is uploaded
                    $validated['bukti_foto'] = null; // Atau set nilai default
                }                
                
                $parameter = [
                    'id_kontrak_rinci' => $validated['id_kontrak_rinci'],
                    'id_region' => $validated['id_region'],
                    'no_surat_jalan' => $validated['no_surat_jalan'],
                    'tanggal_surat_jalan' => $validated['tanggal_surat_jalan'],
                    'bukti_foto' => $validated['bukti_foto'],
                    'id_ekspedisi' => $validated['id_ekspedisi'],
                ];
                
        
                $dataKontrakRinci = PengirimanBarang::create($parameter);
            } else {

                $data = PengirimanBarang::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->first();

                $uploadedFile = $request->file('bukti_foto');
    
                if ($uploadedFile) {
                    // Menentukan direktori penyimpanan di public/upload
                    $destinationPath = 'public/upload/dokumen_pengiriman_barang';
                    // Membuat nama file unik dengan tanggal dan waktu
                    $namaFile = date('His') . '_' . date('dmy') . '_' . 'pengiriman_barang_' . $uploadedFile->getClientOriginalName();
                    // Hapus file lama jika ada
                    if ($data->bukti_foto && Storage::exists($destinationPath . '/' . $data->bukti_foto)) {
                        Storage::delete($destinationPath . '/' . $data->bukti_foto);
                    }
                    // Memindahkan file yang diunggah ke direktori public/upload/dokumen_pengiriman_barang
                    $uploadedFile->storeAs($destinationPath, $namaFile);
                    // Mengatur nama file dokumen pada objek pengiriman barang
                    $validated['bukti_foto'] = $namaFile;
                } else {
                    // Handle case where no file is uploaded
                    $validated['bukti_foto'] = $data->bukti_foto; // Or set a default value
                }
                

                $data->id_region = $validated['id_region'];
                $data->no_surat_jalan = $validated['no_surat_jalan'];
                $data->tanggal_surat_jalan = $validated['tanggal_surat_jalan'];
                $data->bukti_foto = $validated['bukti_foto'] ?? '';
                $data->id_ekspedisi = $validated['id_ekspedisi'];

                $dataKontrakRinci = $data->save();
            }

    
            if (!$dataKontrakRinci) {
                Alert::error('Gagal!', 'Gagal menambahkan data pengiriman barang');
                LogHelper::error('Gagal menambahkan data pengiriman barang!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah data pengiriman barang');
            LogHelper::success('Berhasil menambahkan data pengiriman barang.');
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
}
