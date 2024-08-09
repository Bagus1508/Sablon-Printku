<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\Pajak;
use App\Models\PajakModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class PajakController extends Controller
{
    public function index(){
        $dataPajak = Pajak::all();

        return view('pages.dashboard.data_master.data_pajak.index', [
            'dataPajak' => $dataPajak, 
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'ppn' => 'required|integer|unique:pajak_table,ppn|max:100',
            ], [
                'ppn.unique' => 'PPN ' . $request->ppn . '% sudah ada.',
                'ppn.integer' => 'Format harus berupa angka.',
                'ppn.max' => 'Nilai PPN tidak boleh lebih dari 100%.',
            ]);
            
            $parameter = [
                'ppn' => $validated['ppn'],
            ];
    
            $dataMerek = Pajak::create($parameter);
    
            if (!$dataMerek) {
                Alert::error('Gagal!', 'Gagal menambahkan pajak');
                LogHelper::error('Gagal menambahkan pajak!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah pajak');
            LogHelper::success('Berhasil menambahkan pajak.');
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
                'ppn' => 'required|integer|max:100',
            ], [
                'ppn.required' => 'PPN tidak boleh kosong.',
                'ppn.integer' => 'Format harus berupa angka.',
                'ppn.max' => 'Nilai PPN tidak boleh lebih dari 100%.',
            ]);

            $data = Pajak::find($id);

            if($data->where('ppn', $validated['ppn'])->where('id', '!=', $id)->exists()){
                Alert::error('Gagal!', 'PPN ' . $data->ppn . '% sudah ada.');
                return redirect()->back();
            }

            $data->ppn = $validated['ppn'];

            $deletePajak = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data pajak');
            LogHelper::success('Berhasil mengubah data pajak.');
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

    public function destroy($id)
    {
        try{
            $data = Pajak::find($id);
            $deletePajak = $data->delete();
            if(!$deletePajak){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data pajak!');
            toast('Berhasil menghapus data pajak!','success','top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data pajak: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data pajak: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data pajak.');
                Alert::error('Gagal!', 'Gagal menghapus data pajak: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data pajak.');
            Alert::error('Gagal!', 'Gagal menghapus data pajak: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
