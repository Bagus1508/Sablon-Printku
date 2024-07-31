<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\ProdukKategori;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class CategoryController extends Controller
{
    public function index(){
        return view('pages.dashboard.category.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_kategori' => 'nullable|unique:produk_kategori_table,kode_kategori',
                'nama_kategori' => 'required',
            ], [
                'kode_kategori.unique' => 'Kategori dengan kode ' . $request->kode_kategori . ' sudah digunakan oleh data kategori lain.',
                'kode_kategori.required' => 'Kode Kategori tidak boleh kosong.',
                'nama_kategori.required' => 'Nama Kategori tidak boleh kosong.',
            ]);
            
            $parameter = [
                'kode_kategori' => $validated['kode_kategori'],
                'nama_kategori' => $validated['nama_kategori'],
            ];
    
            $dataKategori = ProdukKategori::create($parameter);
    
            if (!$dataKategori) {
                Alert::error('Gagal!', 'Gagal menambahkan kategori');
                LogHelper::error('Gagal menambahkan kategori!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah kategori');
            LogHelper::success('Berhasil menambahkan kategori.');
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
                'kode_kategori' => 'nullable',
                'nama_kategori' => 'nullable',
            ]);

            $data = ProdukKategori::find($id);

            $data->kode_kategori = $validated['kode_kategori'];
            $data->nama_kategori = $validated['nama_kategori'];

            // Cek apakah kode_kategori sudah digunakan oleh kategori lain
            if (ProdukKategori::where('kode_kategori', $validated['kode_kategori'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Kategori dengan kode '.$validated['kode_kategori'].' sudah digunakan oleh kategori lain.');
                return redirect()->back();
            }

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data kategori');
            LogHelper::success('Berhasil mengubah data kategori.');
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
            $data = ProdukKategori::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data kategori!');
            toast('Berhasil menghapus data kategori!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
