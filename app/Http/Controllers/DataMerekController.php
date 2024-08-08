<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataMerek;
use App\Models\ProdukKategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class DataMerekController extends Controller
{
    public function index(){
        $dataKategori = ProdukKategori::all();

        return view('pages.dashboard.data_master.data_merek.index', [
            'dataKategori' => $dataKategori, 
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_merek' => 'nullable|unique:data_merek_table,kode_merek',
                'nama_merek' => 'required',
                'id_kategori' => 'required|integer',
            ], [
                'kode_merek.unique' => 'Kode merek ' . $request->kode_merek . ' sudah digunakan oleh data merek lain.',
                'kode_merek.required' => 'Kode Merek tidak boleh kosong.',
                'nama_merek.required' => 'Nama Merek tidak boleh kosong.',
                'id_kategori.required' => 'Kategori tidak boleh kosong.',
                'id_kategori.integer' => 'Kategori yang dipilih tidak sesuai.'
            ]);
            
            $parameter = [
                'kode_merek' => $validated['kode_merek'],
                'nama_merek' => $validated['nama_merek'],
                'id_kategori' => $validated['id_kategori'],
            ];
    
            $dataMerek = DataMerek::create($parameter);
    
            if (!$dataMerek) {
                Alert::error('Gagal!', 'Gagal menambahkan merek');
                LogHelper::error('Gagal menambahkan merek!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah merek');
            LogHelper::success('Berhasil menambahkan merek.');
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
                'kode_merek' => 'nullable',
                'nama_merek' => 'required',
                'id_kategori' => 'required|integer',
            ], [
                'kode_merek.required' => 'Kode Merek tidak boleh kosong.',
                'nama_merek.required' => 'Nama Merek tidak boleh kosong.',
                'id_kategori.required' => 'Kategori tidak boleh kosong.',
                'id_kategori.integer' => 'Kategori yang dipilih tidak sesuai.'
            ]);

            $data = DataMerek::find($id);

            $data->kode_merek = $validated['kode_merek'];
            $data->nama_merek = $validated['nama_merek'];
            $data->id_kategori = $validated['id_kategori'];

            // Cek apakah kode_merek sudah digunakan oleh merek lain
            if (DataMerek::where('kode_merek', $validated['kode_merek'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Kode Merek '.$validated['kode_merek'].' sudah digunakan oleh merek lain.');
                return redirect()->back();
            }

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data merek');
            LogHelper::success('Berhasil mengubah data merek.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.data_master.data_merek.edit');
    }

    public function destroy($id)
    {
        try {
            $data = DataMerek::findOrFail($id); // Menggunakan findOrFail untuk memastikan data ada
            $data->delete();
    
            LogHelper::success('Berhasil menghapus data merek!');
            toast('Berhasil menghapus data merek!', 'success', 'top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data merek: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data merek: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data merek.');
                Alert::error('Gagal!', 'Gagal menghapus data merek: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data merek.');
            Alert::error('Gagal!', 'Gagal menghapus data merek: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
