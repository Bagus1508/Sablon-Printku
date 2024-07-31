<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataWarna;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class ColorController extends Controller
{
    public function index(){
        return view('pages.dashboard.data_master.data_warna.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_warna' => 'nullable|unique:data_warna_table,kode_warna',
                'nama_warna' => 'required',
            ], [
                'kode_warna.unique' => 'Kode warna ' . $request->kode_warna . ' sudah digunakan oleh data warna lain.',
                'kode_warna.required' => 'Kode Warna tidak boleh kosong.',
                'nama_warna.required' => 'Nama Warna tidak boleh kosong.',
            ]);
            
            $parameter = [
                'kode_warna' => $validated['kode_warna'],
                'nama_warna' => $validated['nama_warna'],
            ];
    
            $dataWarna = DataWarna::create($parameter);
    
            if (!$dataWarna) {
                Alert::error('Gagal!', 'Gagal menambahkan warna');
                LogHelper::error('Gagal menambahkan warna!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah warna');
            LogHelper::success('Berhasil menambahkan warna.');
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
                'kode_warna' => 'nullable',
                'nama_warna' => 'nullable',
            ]);

            $data = DataWarna::find($id);

            $data->kode_warna = $validated['kode_warna'];
            $data->nama_warna = $validated['nama_warna'];

            // Cek apakah kode_warna sudah digunakan oleh warna lain
            if (DataWarna::where('kode_warna', $validated['kode_warna'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Kode Warna '.$validated['kode_warna'].' sudah digunakan oleh warna lain.');
                return redirect()->back();
            }

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data warna');
            LogHelper::success('Berhasil mengubah data warna.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.data_master.data_warna.edit');
    }

    public function destroy($id)
    {
        try{
            $data = DataWarna::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data warna!');
            toast('Berhasil menghapus data warna!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
                return view('pages.utility.500');
        }
    }
}
