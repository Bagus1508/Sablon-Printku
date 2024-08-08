<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataUkuran;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class SizeController extends Controller
{
    public function index(){
        return view('pages.dashboard.data_master.data_ukuran.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_ukuran' => 'required|max:100',
                'singkatan_ukuran' => 'required|max:20',
            ], [
                'nama_ukuran.required' => 'Nama Ukuran tidak boleh kosong.',
                'nama_ukuran.max' => 'Nama Ukuran tidak boleh lebih dari 100 karakter.',
                'singkatan_ukuran.required' => 'Singkatan Ukuran tidak boleh kosong.',
                'singkatan_ukuran.max' => 'Singkatan Ukuran tidak boleh lebih dari 20 karakter.',
            ]);            
            $parameter = [
                'nama_ukuran'          => $validated['nama_ukuran'],
                'singkatan_ukuran'         => $validated['singkatan_ukuran'],
            ];
    
            $dataUkuran = DataUkuran::create($parameter);
    
            if (!$dataUkuran) {
                Alert::error('Gagal!', 'Gagal menambahkan ukuran');
                LogHelper::error('Gagal menambahkan ukuran!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah ukuran');
            LogHelper::success('Berhasil menambahkan ukuran.');
            return redirect()->back();
            
        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Alert::error('Error!', $error);
                }
            }
            return redirect()->back()->withInput();
        }/*  catch (Throwable $e) {
            return view('pages.utility.500');
        } */
    }

    public function update(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'nama_ukuran' => 'required|max:100',
                'singkatan_ukuran' => 'required|max:20',
            ], [
                'nama_ukuran.required' => 'Nama Ukuran tidak boleh kosong.',
                'nama_ukuran.max' => 'Nama Ukuran tidak boleh lebih dari 100 karakter.',
                'singkatan_ukuran.required' => 'Singkatan Ukuran tidak boleh kosong.',
                'singkatan_ukuran.max' => 'Singkatan Ukuran tidak boleh lebih dari 20 karakter.',
            ]);            

            $data = DataUkuran::find($id);

            $data->nama_ukuran = $validated['nama_ukuran'];
            $data->singkatan_ukuran = $validated['singkatan_ukuran'];

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data ukuran');
            LogHelper::success('Berhasil mengubah data ukuran.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.data_master.data_ukuran.edit');
    }

    public function destroy($id)
    {
        try{
            $data = DataUkuran::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data ukuran!');
            toast('Berhasil menghapus data ukuran!','success','top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data ukuran: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data ukuran: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data ukuran.');
                Alert::error('Gagal!', 'Gagal menghapus data ukuran: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data ukuran.');
            Alert::error('Gagal!', 'Gagal menghapus data ukuran: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
