<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataSatuan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class UnitController extends Controller
{
    public function index(){
        return view('pages.dashboard.data_master.data_satuan.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_satuan' => 'required',
                'singkatan' => 'required',
            ], [
                'nama_satuan.required' => 'Nama Satuan tidak boleh kosong.',
                'singkatan.required' => 'Singkatan tidak boleh kosong.',
            ]);
            

            $parameter = [
                'nama_satuan'          => $validated['nama_satuan'],
                'singkatan'         => $validated['singkatan'],
            ];
    
            $dataSatuan = DataSatuan::create($parameter);
    
            if (!$dataSatuan) {
                Alert::error('Gagal!', 'Gagal menambahkan satuan');
                LogHelper::error('Gagal menambahkan satuan!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah satuan');
            LogHelper::success('Berhasil menambahkan satuan.');
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
                'nama_satuan' => 'nullable',
                'singkatan' => 'nullable',
            ]);

            $data = DataSatuan::find($id);

            $data->nama_satuan = $validated['nama_satuan'];
            $data->singkatan = $validated['singkatan'];

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data satuan');
            LogHelper::success('Berhasil mengubah data satuan.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function edit(){
        return view('pages.dashboard.account.edit');
    }

    public function destroy($id)
    {
        try{
            $data = DataSatuan::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data Satuan!');
            toast('Berhasil menghapus data Satuan!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
                return view('pages.utility.500');
        }
    }
}
