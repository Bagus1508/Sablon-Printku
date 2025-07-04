<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataProduk;
use App\Models\DataSatuan;
use App\Models\DataWarna;
use App\Models\ProdukKategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class DataProdukController extends Controller
{
    public function index(){
        $dataKategori = ProdukKategori::all();
        $dataWarna = DataWarna::all();
        $dataSatuan = DataSatuan::all();

        return view('pages.dashboard.data_produk.index', [
            'dataKategori' => $dataKategori, 
            'dataWarna' => $dataWarna, 
            'dataSatuan' => $dataSatuan, 
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_produk' => 'nullable|unique:produk_table,kode_produk',
                'nama_barang' => 'required',
                'id_kategori' => 'required|integer',
                'id_warna' => 'required|integer',
                'id_satuan' => 'required|integer',
            ], [
                'kode_produk.unique' => 'Kode Barang ' . $request->kode_produk . ' sudah digunakan oleh data Barang lain.',
                'kode_produk.required' => 'Kode Barang tidak boleh kosong.',
                'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
                'id_kategori.required' => 'Kategori tidak boleh kosong.',
                'id_kategori.integer' => 'Kategori yang dipilih tidak sesuai.',
                'id_warna.required' => 'Warna tidak boleh kosong.',
                'id_warna.integer' => 'Warna yang dipilih tidak sesuai.',
                'id_satuan.required' => 'Satuan tidak boleh kosong.',
                'id_satuan.integer' => 'Satuan yang dipilih tidak sesuai.',
            ]);
            
            $parameter = [
                'kode_produk' => $validated['kode_produk'],
                'nama_barang' => $validated['nama_barang'],
                'id_kategori' => $validated['id_kategori'],
                'id_warna' => $validated['id_warna'],
                'id_satuan' => $validated['id_satuan'],
            ];
    
            $dataProduk = DataProduk::create($parameter);
    
            if (!$dataProduk) {
                Alert::error('Gagal!', 'Gagal menambahkan Barang');
                LogHelper::error('Gagal menambahkan Barang!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah Barang');
            LogHelper::success('Berhasil menambahkan Barang.');
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
                'kode_produk' => 'nullable',
                'nama_barang' => 'required',
                'id_kategori' => 'required|integer',
            ], [
                'kode_produk.required' => 'Kode Barang tidak boleh kosong.',
                'nama_barang.required' => 'Nama Barang tidak boleh kosong.',
                'id_kategori.required' => 'Kategori tidak boleh kosong.',
                'id_kategori.integer' => 'Kategori yang dipilih tidak sesuai.'
            ]);

            $data = dataProduk::find($id);

            $data->kode_produk = $validated['kode_produk'];
            $data->nama_barang = $validated['nama_barang'];
            $data->id_kategori = $validated['id_kategori'];

            // Cek apakah kode_produk sudah digunakan oleh Barang lain
            if (dataProduk::where('kode_produk', $validated['kode_produk'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Kode Barang '.$validated['kode_produk'].' sudah digunakan oleh Barang lain.');
                return redirect()->back();
            }

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data Barang');
            LogHelper::success('Berhasil mengubah data Barang.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.data_produk.edit');
    }

    public function destroy($id)
    {
        try {
            $data = dataProduk::findOrFail($id); // Menggunakan findOrFail untuk memastikan data ada
            $data->delete();
    
            LogHelper::success('Berhasil menghapus data Barang!');
            toast('Berhasil menghapus data Barang!', 'success', 'top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data Barang: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data Barang: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data Barang.');
                Alert::error('Gagal!', 'Gagal menghapus data Barang: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data Barang.');
            Alert::error('Gagal!', 'Gagal menghapus data Barang: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
