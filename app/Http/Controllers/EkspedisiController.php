<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataEkspedisi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class EkspedisiController extends Controller
{
    public function index(){
        return view('pages.dashboard.data_ekspedisi.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_ekspedisi' => 'nullable|unique:data_ekspedisi_table,kode_ekspedisi',
                'nama_ekspedisi' => 'required',
            ], [
                'kode_ekspedisi.unique' => 'ekspedisi dengan kode ' . $request->kode_ekspedisi . ' sudah digunakan oleh data ekspedisi lain.',
                'kode_ekspedisi.required' => 'Kode ekspedisi tidak boleh kosong.',
                'nama_ekspedisi.required' => 'Nama ekspedisi tidak boleh kosong.',
            ]);
            
            $parameter = [
                'kode_ekspedisi' => $validated['kode_ekspedisi'],
                'nama_ekspedisi' => $validated['nama_ekspedisi'],
            ];
    
            $dataEkspedisi = DataEkspedisi::create($parameter);
    
            if (!$dataEkspedisi) {
                Alert::error('Gagal!', 'Gagal menambahkan ekspedisi');
                LogHelper::error('Gagal menambahkan ekspedisi!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah ekspedisi');
            LogHelper::success('Berhasil menambahkan ekspedisi.');
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
                'kode_ekspedisi' => 'nullable',
                'nama_ekspedisi' => 'nullable',
            ]);

            $data = DataEkspedisi::find($id);

            $data->kode_ekspedisi = $validated['kode_ekspedisi'];
            $data->nama_ekspedisi = $validated['nama_ekspedisi'];

            // Cek apakah kode_ekspedisi sudah digunakan oleh ekspedisi lain
            if (DataEkspedisi::where('kode_ekspedisi', $validated['kode_ekspedisi'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'ekspedisi dengan kode '.$validated['kode_ekspedisi'].' sudah digunakan oleh ekspedisi lain.');
                return redirect()->back();
            }

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data ekspedisi');
            LogHelper::success('Berhasil mengubah data ekspedisi.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.data_ekspedisi.edit');
    }

    public function destroy($id)
    {
        try{
            $data = DataEkspedisi::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data ekspedisi!');
            toast('Berhasil menghapus data ekspedisi!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
