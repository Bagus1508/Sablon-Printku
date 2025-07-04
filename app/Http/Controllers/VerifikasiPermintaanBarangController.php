<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use App\Models\PermintaanBarang;
use App\Models\PermintaanBarangDetail;
use App\Models\VerifikasiPermintaanBarang;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

use function PHPUnit\Framework\isNull;

class VerifikasiPermintaanBarangController extends Controller
{
    public function index(){
        return view('pages.dashboard.verifikasi_permintaan_barang.index');
    }

    public function create(){
        return view('pages.dashboard.verifikasi_permintaan_barang.create');
    }

    public function store(Request $request)
    {  
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'id_permintaan_barang' => 'required',
                'no_transaksi' => 'required',
                'nama_verifikator' => 'required',
                'status' => 'required',
            ], [
                'id_permintaan_barang.required' => 'ReferensiVerifikasi Permintaan Barang tidak boleh kosong.',
                'no_transaksi.required' => 'No Transaksi Permintaan Barang tidak boleh kosong.',
                'nama.required' => 'Nama VerifikatorVerifikasi Permintaan Barang tidak boleh kosong.',
                'status.required' => 'Status VerifikasiVerifikasi Permintaan Barang tidak boleh kosong.',
            ]);

            $dataVerifikasiPermintaanBarang = VerifikasiPermintaanBarang::create($validated);

            if ($dataVerifikasiPermintaanBarang) {
                PermintaanBarang::find($dataVerifikasiPermintaanBarang->id_permintaan_barang)->update([
                    'status' => 2,
                ]);
            }
    
            if (!$dataVerifikasiPermintaanBarang) {
                Alert::error('Gagal!', 'Gagal menambahkanVerifikasi Permintaan Barang '.$dataVerifikasiPermintaanBarang->no_transaksi);
                LogHelper::error('Gagal menambahkanVerifikasi Permintaan Barang! '.$dataVerifikasiPermintaanBarang->no_transaksi);
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambahVerifikasi Permintaan Barang '.$dataVerifikasiPermintaanBarang->no_transaksi);
            LogHelper::success('Berhasil menambahkanVerifikasi Permintaan Barang '.$dataVerifikasiPermintaanBarang->no_transaksi);

            DB::commit();
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
                'kode_perusahaan.required' => 'KodeVerifikasi Permintaan Barang tidak boleh kosong.',
                'nama_perusahaan.required' => 'NamaVerifikasi Permintaan Barang tidak boleh kosong.',
                'no_telepon.regex' => 'Nomor telepon harus berisi angka saja.',
                'email.email' => 'Email harus merupakan alamat email yang valid.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                'rt.numeric' => 'RT tidak sesuai.',
                'rw.numeric' => 'RW tidak sesuai.',
            ]);

            $dataVerifikasiPermintaanBarang = DataPerusahaan::findOrFail($id);
    
            // Cek apakah kode_perusahaan sudah digunakan olehVerifikasi Permintaan Barang lain
            if (DataPerusahaan::where('kode_perusahaan', $validated['kode_perusahaan'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Perusahaan dengan kode ' . $validated['kode_perusahaan'] . ' sudah digunakan olehVerifikasi Permintaan Barang lain.');
                return redirect()->back();
            }
    
            $dataAlamat = DataAlamat::find($dataVerifikasiPermintaanBarang->id_alamat);
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
    
            // Update dataVerifikasiPermintaanBarang dengan id_alamat dari dataAlamat yang baru disimpan
            $dataVerifikasiPermintaanBarang->kode_perusahaan = $validated['kode_perusahaan'];
            $dataVerifikasiPermintaanBarang->nama_perusahaan = $validated['nama_perusahaan'];
            $dataVerifikasiPermintaanBarang->no_telepon = $validated['no_telepon'];
            $dataVerifikasiPermintaanBarang->npwp = $validated['npwp'];
            $dataVerifikasiPermintaanBarang->email = $validated['email'];
            $dataVerifikasiPermintaanBarang->id_alamat = $dataAlamat->id; // Assign id_alamat dari dataAlamat yang baru disimpan
    
            $dataVerifikasiPermintaanBarang->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah dataVerifikasi Permintaan Barang '.$dataVerifikasiPermintaanBarang->nama_perusahaan);
            LogHelper::success('Berhasil mengubah dataVerifikasi Permintaan Barang '.$dataVerifikasiPermintaanBarang->nama_perusahaan);
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

    public function edit($id){
        $data = PermintaanBarang::find($id);

        return view('pages.dashboard.verifikasi_permintaan_barang.edit', [
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        try{
            $dataVerifikasiPermintaanBarang = dataVerifikasiPermintaanBarang::find($id);
    
            $dataVerifikasiPermintaanBarang->delete();
            
            if(!isNull($dataVerifikasiPermintaanBarang->id_alamat)){
                $dataAlamat = DataAlamat::find($dataVerifikasiPermintaanBarang->id_alamat);
                $dataAlamat->delete();
            }
            
            if(!$dataVerifikasiPermintaanBarang){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus dataVerifikasi Permintaan Barang!');
            toast('Berhasil menghapus dataVerifikasi Permintaan Barang!','success','top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus dataVerifikasi Permintaan Barang: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus dataVerifikasi Permintaan Barang: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus dataVerifikasi Permintaan Barang.');
                Alert::error('Gagal!', 'Gagal menghapus dataVerifikasi Permintaan Barang: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus dataVerifikasi Permintaan Barang.');
            Alert::error('Gagal!', 'Gagal menghapus dataVerifikasi Permintaan Barang: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
