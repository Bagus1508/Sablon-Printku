<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class RegionController extends Controller
{
    public function index(){
        return view('pages.dashboard.data_region.index');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_region' => 'required',
            ], [
                'nama_region.required' => 'Nama region tidak boleh kosong.',
            ]);
            
            $parameter = [
                'nama_region' => $validated['nama_region'],
            ];
    
            $dataRegion = Region::create($parameter);
    
            if (!$dataRegion) {
                Alert::error('Gagal!', 'Gagal menambahkan region');
                LogHelper::error('Gagal menambahkan region!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah region');
            LogHelper::success('Berhasil menambahkan region.');
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
                'nama_region' => 'nullable',
            ]);

            $data = Region::find($id);

            $data->nama_region = $validated['nama_region'];

            $dataRegionSave = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data region');
            LogHelper::success('Berhasil mengubah data region.');
            return redirect()->back();
        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Alert::error('Error!', $error);
                }
            }
            return redirect()->back()->withInput();
        }
    }

    public function edit(){
        return view('pages.dashboard.data_ekspedisi.edit');
    }

    public function destroy($id)
    {
        try{
            $data = Region::find($id);
            $user = $data->delete();
            if(!$user){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data region!');
            toast('Berhasil menghapus data region!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
}
