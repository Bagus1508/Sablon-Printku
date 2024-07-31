<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataUkuran;
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
                'nama_ukuran' => 'required',
                'singkatan_ukuran' => 'required',
            ], [
                'nama_ukuran.required' => 'Nama Ukuran tidak boleh kosong.',
                'singkatan_ukuran.required' => 'Singkatan Ukuran tidak boleh kosong.',
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
                'nama_ukuran' => 'nullable',
                'singkatan_ukuran' => 'nullable',
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
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
                return view('pages.utility.500');
        }
    }
}
