<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataMerek;
use App\Models\DataWarna;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class ColorController extends Controller
{
    public function index(){
        $dataMerek = DataMerek::all();

        return view('pages.dashboard.data_master.data_warna.index',[
            'dataMerek' => $dataMerek,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'kode_warna' => 'required',
                'nama_warna' => 'required',
                'id_merek' => 'integer'
            ], [
                'kode_warna.required' => 'Kode Warna tidak boleh kosong.',
                'nama_warna.required' => 'Nama Warna tidak boleh kosong.',
                'id_merek.integer' => 'Data merek tidak sesuai.',
            ]);
            $id_merek = Arr::get($validated, 'id_merek', null);

            $queryDataWarna = DataWarna::where('kode_warna', $validated['kode_warna'])
                                        ->where('id_merek', $id_merek);

            if (!is_null($id_merek)) {
                $exists = $queryDataWarna->exists();
            
                if ($exists) {
                    Alert::error('Gagal!', 'Kombinasi Kode Warna dan Merek sudah digunakan.');
                    return redirect()->back()->withInput();
                }
            }
            
            $parameter = [
                'kode_warna' => $validated['kode_warna'],
                'nama_warna' => $validated['nama_warna'],
                'id_merek' => $id_merek,
            ];
    
            $dataWarna = DataWarna::create($parameter);
    
            if (!$dataWarna) {
                Alert::error('Gagal!', 'Gagal menambahkan warna '.$dataWarna->nama_warna);
                LogHelper::error('Gagal menambahkan warna '.$dataWarna->nama_warna);
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah warna '.$dataWarna->nama_warna);
            LogHelper::success('Berhasil menambahkan warna '.$dataWarna->nama_warna);
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
                'kode_warna' => 'required',
                'nama_warna' => 'required',
                'id_merek' => 'integer'
            ], [
                'kode_warna.required' => 'Kode Warna tidak boleh kosong.',
                'nama_warna.required' => 'Nama Warna tidak boleh kosong.',
                'id_merek.integer' => 'Data merek tidak sesuai.',
            ]);

            $id_merek = Arr::get($validated, 'id_merek', null);
            if (!is_null($id_merek)) {
                $exists = DataWarna::where('kode_warna', $validated['kode_warna'])
                                   ->where('id_merek', $id_merek)
                                   ->where('id', '!=', $id)
                                   ->exists();
            
                if ($exists) {
                    Alert::error('Gagal!', 'Kombinasi Kode Warna dan Merek sudah digunakan.');
                    return redirect()->back()->withInput();
                }
            }

            $data = DataWarna::find($id);

            $data->kode_warna = $validated['kode_warna'];
            $data->nama_warna = $validated['nama_warna'];
            $data->id_merek = $validated['id_merek'] ?? '';

            $User = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data warna '.$data->nama_warna);
            LogHelper::success('Berhasil mengubah data warna '.$data->nama_warna);
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
        try {
            $data = DataWarna::findOrFail($id); // Menggunakan findOrFail untuk memastikan data ada
            $data->delete();
    
            LogHelper::success('Berhasil menghapus data warna!');
            toast('Berhasil menghapus data warna!', 'success', 'top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data warna: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data warna: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data warna.');
                Alert::error('Gagal!', 'Gagal menghapus data warna: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data warna.');
            Alert::error('Gagal!', 'Gagal menghapus data warna: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
