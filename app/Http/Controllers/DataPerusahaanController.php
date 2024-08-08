<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

use function PHPUnit\Framework\isNull;

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
                'npwp' => 'nullable',
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
                'npwp' => $validated['npwp'],
                'no_telepon' => $validated['no_telepon'],
                'email' => $validated['email'],
                'id_alamat' => $dataAlamatPerusahaan->id,
            ];
    
            $dataPerusahaan = DataPerusahaan::create($parameter);

            if (!$dataPerusahaan) {
                Alert::error('Gagal!', 'Gagal menambahkan perusahaan '.$dataPerusahaan->nama_perusahaan);
                LogHelper::error('Gagal menambahkan perusahaan! '.$dataPerusahaan->nama_perusahaan);
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah perusahaan '.$dataPerusahaan->nama_perusahaan);
            LogHelper::success('Berhasil menambahkan perusahaan '.$dataPerusahaan->nama_perusahaan);
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
                'npwp' => 'nullable',
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
    
            $provinsi = explode("|", $validated['provinsi'] ?? null);
            $kota = explode("|", $validated['kota'] ?? null);
            $kecamatan = explode("|", $validated['kecamatan'] ?? null);
            $kelurahan = explode("|", $validated['kelurahan'] ?? null);            
    
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
            $dataPerusahaan->npwp = $validated['npwp'];
            $dataPerusahaan->email = $validated['email'];
            $dataPerusahaan->id_alamat = $dataAlamat->id; // Assign id_alamat dari dataAlamat yang baru disimpan
    
            $dataPerusahaan->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah data perusahaan '.$dataPerusahaan->nama_perusahaan);
            LogHelper::success('Berhasil mengubah data perusahaan '.$dataPerusahaan->nama_perusahaan);
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
    
            $dataPerusahaan->delete();
            
            if(!isNull($dataPerusahaan->id_alamat)){
                $dataAlamat = DataAlamat::find($dataPerusahaan->id_alamat);
                $dataAlamat->delete();
            }
            
            if(!$dataPerusahaan){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data perusahaan!');
            toast('Berhasil menghapus data perusahaan!','success','top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data perusahaan: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data perusahaan: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data perusahaan.');
                Alert::error('Gagal!', 'Gagal menghapus data perusahaan: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data perusahaan.');
            Alert::error('Gagal!', 'Gagal menghapus data perusahaan: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
