<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Invoice;
use App\Models\PengirimanBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class InvoiceController extends Controller
{
    public function store(Request $request){
        try {
            $validated = $request->validate([
                'id_kontrak_rinci' => 'required|integer',
                'nomor_invoice' => 'required|integer',
                'tanggal_invoice' => 'nullable|date',
                'foto_invoice' => 'nullable|mimes:pdf,jpg,png,jpeg|max:2048',
                'tanggal_kirim_invoice' => 'nullable|date',
            ], [
                'id_kontrak_rinci.required' => 'Kontrak Rinci wajib diisi.',
                'id_kontrak_rinci.integer' => 'Kontrak Rinci tidak sesuai.',
                'nomor_invoice.required' => 'Nomor Invoice wajib diisi.',
                'nomor_invoice.integer' => 'Nomor Invoice tidak sesuai.',
                'tanggal_invoice.date' => 'Tanggal Invoice harus berupa tanggal yang valid.',
                'foto_invoice.mimes' => 'Bukti Foto harus berupa file dengan tipe: pdf, jpg, png, jpeg.',
                'foto_invoice.max' => 'Bukti Foto tidak boleh lebih dari 2048 kilobyte.',
                'tanggal_kirim_invoice.date' => 'Tanggal Kirim harus berupa tanggal yang valid.',
            ]);

            $existDataInvoice = Invoice::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->exists();

            if($existDataInvoice != true){
                $uploadedFile = $request->file('foto_invoice');
    
                if ($uploadedFile) {
                    // Menentukan direktori penyimpanan di public/upload
                    $destinationPath = 'public/upload/dokumen_invoice';
                    // Membuat nama file unik dengan tanggal dan waktu
                    $namaFile = date('His') . '_' . date('dmy') . '_' . 'invoice' . $uploadedFile->getClientOriginalName();
                    // Memindahkan file yang diunggah ke direktori public/upload/dokumen_invoice
                    $uploadedFile->storeAs($destinationPath, $namaFile);
                    // Mengatur nama file dokumen pada objek pengiriman barang
                    $validated['foto_invoice'] = $namaFile;
                } else {
                    // Handle case where no file is uploaded
                    $validated['foto_invoice'] = null; // Atau set nilai default
                }       
                
                $parameter = [
                    'id_kontrak_rinci' => $validated['id_kontrak_rinci'],
                    'nomor_invoice' => $validated['nomor_invoice'],
                    'tanggal_invoice' => $validated['tanggal_invoice'],
                    'foto_invoice' => $validated['foto_invoice'],
                    'tanggal_kirim_invoice' => $validated['tanggal_kirim_invoice'],
                ];
                
        
                $dataInvoice = Invoice::create($parameter);
            } else {

                $data = Invoice::where('id_kontrak_rinci', $validated['id_kontrak_rinci'])->first();

                $uploadedFile = $request->file('foto_invoice');
    
                if ($uploadedFile) {
                    // Menentukan direktori penyimpanan di public/upload
                    $destinationPath = 'public/upload/dokumen_invoice';
                    // Membuat nama file unik dengan tanggal dan waktu
                    $namaFile = date('His') . '_' . date('dmy') . '_' . 'invoice' . $uploadedFile->getClientOriginalName();
                    // Hapus file lama jika ada
                    if ($data->foto_invoice && Storage::exists($destinationPath . '/' . $data->foto_invoice)) {
                        Storage::delete($destinationPath . '/' . $data->foto_invoice);
                    }
                    // Memindahkan file yang diunggah ke direktori public/upload/dokumen_pengiriman_barang
                    $uploadedFile->storeAs($destinationPath, $namaFile);
                    // Mengatur nama file dokumen pada objek pengiriman barang
                    $validated['foto_invoice'] = $namaFile;
                } else {
                    // Handle case where no file is uploaded
                    $validated['foto_invoice'] = $data->foto_invoice; // Or set a default value
                }
                

                $data->nomor_invoice = $validated['nomor_invoice'];
                $data->tanggal_invoice = $validated['tanggal_invoice'];
                $data->foto_invoice = $validated['foto_invoice'] ?? '';
                $data->tanggal_kirim_invoice = $validated['tanggal_kirim_invoice'];

                $dataInvoice = $data->save();
            }

    
            if (!$dataInvoice) {
                Alert::error('Gagal!', 'Gagal update data Invoice');
                LogHelper::error('Gagal update data Invoice!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil update data Invoice');
            LogHelper::success('Berhasil update data Invoice.');
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
