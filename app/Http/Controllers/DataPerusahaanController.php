<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class DataPerusahaanController extends Controller
{
    public function index(){
        return view('pages.dashboard.data_perusahaan.index');
    }

    public function store(Request $request)
    {   
        
        try {
            $validated = $request->validate([
                'kode_perusahaan' => 'required|unique:perusahaan_table,kode_perusahaan',
                'nama_perusahaan' => 'required',
                'no_telepon' => 'nullable|regex:/^[0-9]+$/',
                'email' => 'nullable|email',
                'alamat' => 'nullable|string|max:255',
                'provinsi' => 'nullable',
                'kota' => 'nullable',
                'kecamatan' => 'nullable',
                'kelurahan' => 'nullable',
                'rt' => 'nullable|numeric',
                'rw' => 'nullable|numeric',
            ], [
                'kode_perusahaan.required' => 'Kode perusahaan tidak boleh kosong.',
                'kode_perusahaan.unique' => 'Perusahaan dengan kode ' . $request->kode_perusahaan . ' sudah digunakan oleh data perusahaan lain.',
                'nama_perusahaan.required' => 'Nama perusahaan tidak boleh kosong.',
                'no_telepon.regex' => 'Nomor telepon harus berisi angka saja.',
                'email.email' => 'Email harus merupakan alamat email yang valid.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                'rt.numeric' => 'RT tidak sesuai.',
                'rw.numeric' => 'RW tidak sesuai.',
            ]);

            $provinsi = explode("|",$validated['provinsi']);
            $kota = explode("|",$validated['kota']);
            $kecamatan = explode("|",$validated['kecamatan']);
            $kelurahan = explode("|",$validated['kelurahan']);

            $parameterAlamat = [
                'alamat' => $validated['alamat']?? null,
                'id_provinsi' => $provinsi[0] ?? null,
                'id_kota' => $kota[0] ?? null,
                'id_kecamatan' => $kecamatan[0]?? null,
                'id_kelurahan' => $kelurahan[0] ?? null,
                'provinsi' => $provinsi[1] ?? null,
                'kota' => $kota[1] ?? null,
                'kecamatan' => $kecamatan[1]?? null,
                'kelurahan' => $kelurahan[1] ?? null,
                'rt' => $validated['rt'] ?? null,
                'rw' => $validated['rw'] ?? null,
            ];
            
            $dataAlamatPerusahaan = DataAlamat::create($parameterAlamat);
            
            $parameter = [
                'kode_perusahaan' => $validated['kode_perusahaan'],
                'nama_perusahaan' => $validated['nama_perusahaan'],
                'no_telepon' => $validated['no_telepon'],
                'email' => $validated['email'],
                'id_alamat' => $dataAlamatPerusahaan->id,
            ];
    
            $dataPerusahaan = DataPerusahaan::create($parameter);

            if (!$dataPerusahaan) {
                Alert::error('Gagal!', 'Gagal menambahkan perusahaan');
                LogHelper::error('Gagal menambahkan perusahaan!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah perusahaan');
            LogHelper::success('Berhasil menambahkan perusahaan.');
            return redirect()->back();
            
        } catch (ValidationException $e) {
            foreach ($e->errors() as $errors) {
                foreach ($errors as $error) {
                    Alert::error('Error!', $error);
                }
            }
            return redirect()->back()->withInput();
        }/*  finally {
            return view('pages.utility.500');
        } */
    }
    

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'kode_perusahaan' => 'required',
                'nama_perusahaan' => 'required',
                'no_telepon' => 'nullable|regex:/^[0-9]+$/',
                'email' => 'nullable|email',
                'alamat' => 'nullable|string|max:255',
                'provinsi' => 'nullable',
                'kota' => 'nullable',
                'kecamatan' => 'nullable',
                'kelurahan' => 'nullable',
                'rt' => 'nullable|numeric',
                'rw' => 'nullable|numeric',
            ], [
                'kode_perusahaan.required' => 'Kode perusahaan tidak boleh kosong.',
                'nama_perusahaan.required' => 'Nama perusahaan tidak boleh kosong.',
                'no_telepon.regex' => 'Nomor telepon harus berisi angka saja.',
                'email.email' => 'Email harus merupakan alamat email yang valid.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                'rt.numeric' => 'RT tidak sesuai.',
                'rw.numeric' => 'RW tidak sesuai.',
            ]);
    
            $dataPerusahaan = DataPerusahaan::findOrFail($id);
    
            // Cek apakah kode_perusahaan sudah digunakan oleh perusahaan lain
            if (DataPerusahaan::where('kode_perusahaan', $validated['kode_perusahaan'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Perusahaan dengan kode ' . $validated['kode_perusahaan'] . ' sudah digunakan oleh perusahaan lain.');
                return redirect()->back();
            }
    
            $dataAlamat = DataAlamat::find($dataPerusahaan->id_alamat);
            if (!$dataAlamat) {
                $dataAlamat = new DataAlamat();
            }
    
            $provinsi = explode("|", $validated['provinsi']);
            $kota = explode("|", $validated['kota']);
            $kecamatan = explode("|", $validated['kecamatan']);
            $kelurahan = explode("|", $validated['kelurahan']);
    
            $dataAlamat->alamat = $validated['alamat'] ?? null;
            $dataAlamat->id_provinsi = $provinsi[0] ?? null;
            $dataAlamat->id_kota = $kota[0] ?? null;
            $dataAlamat->id_kecamatan = $kecamatan[0] ?? null;
            $dataAlamat->id_kelurahan = $kelurahan[0] ?? null;
            $dataAlamat->provinsi = $provinsi[1] ?? null;
            $dataAlamat->kota = $kota[1] ?? null;
            $dataAlamat->kecamatan = $kecamatan[1] ?? null;
            $dataAlamat->kelurahan = $kelurahan[1] ?? null;
            $dataAlamat->rt = $validated['rt'] ?? null;
            $dataAlamat->rw = $validated['rw'] ?? null;
    
            $dataAlamat->save();
    
            // Update dataPerusahaan dengan id_alamat dari dataAlamat yang baru disimpan
            $dataPerusahaan->kode_perusahaan = $validated['kode_perusahaan'];
            $dataPerusahaan->nama_perusahaan = $validated['nama_perusahaan'];
            $dataPerusahaan->no_telepon = $validated['no_telepon'];
            $dataPerusahaan->email = $validated['email'];
            $dataPerusahaan->id_alamat = $dataAlamat->id; // Assign id_alamat dari dataAlamat yang baru disimpan
    
            $dataPerusahaan->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah data perusahaan');
            LogHelper::success('Berhasil mengubah data perusahaan.');
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
        return view('pages.dashboard.data_perusahaan.edit');
    }

    public function destroy($id)
    {
        try{
            $dataPerusahaan = dataPerusahaan::find($id);
            $dataAlamat = DataAlamat::find($dataPerusahaan->id_alamat);
            $dataPerusahaan->delete();
            $dataAlamat->delete();
            if(!$dataPerusahaan){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data perusahaan!');
            toast('Berhasil menghapus data perusahaan!','success','top-right');
            return redirect()->back();
        }catch(Throwable $e){
            LogHelper::error('Gagal menghapus data, error pada sistem!');
            return view('pages.utility.500');
        }
    }
}
