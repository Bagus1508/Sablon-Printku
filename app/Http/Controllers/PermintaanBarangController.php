<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use App\Models\DataProduk;
use App\Models\PermintaanBarang;
use App\Models\PermintaanBarangDetail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

use function PHPUnit\Framework\isNull;

class PermintaanBarangController extends Controller
{
    public function index(){
        $dataProduk = DataProduk::select('kode_produk', 'kode_produk')->get();

        return view('pages.dashboard.permintaan_barang.index', [
            'dataProduk' => $dataProduk,
        ]);
    }

    public function create(){
        $dataProduk = DataProduk::pluck('kode_produk', 'kode_produk');

        return view('pages.dashboard.permintaan_barang.create', [
            'dataProduk' => $dataProduk,
        ]);
    }

    public function store(Request $request)
    {  
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'no_transaksi' => 'required',
                'nama' => 'required',
                'status' => 'required',
                'catatan' => 'nullable',
                'barang' => 'required|array|min:1',
            ], [
                'no_transaksi.required' => 'No Transaksi tidak boleh kosong.',
                'nama.required' => 'Nama Pengaju Permintaan Barang tidak boleh kosong.',
                'status.required' => 'Status Permintaan Barang tidak boleh kosong.',
                'barang.required' => 'Barang tidak boleh kosong.',
            ]);
            
            $parameter = [
                'no_transaksi' => $validated['no_transaksi'],
                'nama' => $validated['nama'],
                'catatan' => $validated['catatan'],
                'status' => $validated['status'],
            ];

            $dataPermintaanBarang = PermintaanBarang::create($parameter);

            if ($validated['barang']) {
                foreach ($validated['barang'] as $key => $item) {
                    PermintaanBarangDetail::create([
                        'id_pr' => $dataPermintaanBarang->id,
                        "kode_barang" => $item['kode_barang'],
                        "nama_barang" => $item['nama_barang'],
                        "spesifikasi_barang" => $item['spesifikasi_barang'],
                        "satuan" => $item['satuan'],
                        "jumlah" => $item['jumlah'],
                        "alasan_kebutuhan" => $item['alasan_kebutuhan'],
                    ]);
                }
            }
    

            if (!$dataPermintaanBarang) {
                Alert::error('Gagal!', 'Gagal menambahkan Permintaan Barang '.$dataPermintaanBarang->no_transaksi);
                LogHelper::error('Gagal menambahkan Permintaan Barang! '.$dataPermintaanBarang->no_transaksi);
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah Permintaan Barang '.$dataPermintaanBarang->no_transaksi);
            LogHelper::success('Berhasil menambahkan Permintaan Barang '.$dataPermintaanBarang->no_transaksi);

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
                'kode_perusahaan.required' => 'Kode Permintaan Barang tidak boleh kosong.',
                'nama_perusahaan.required' => 'Nama Permintaan Barang tidak boleh kosong.',
                'no_telepon.regex' => 'Nomor telepon harus berisi angka saja.',
                'email.email' => 'Email harus merupakan alamat email yang valid.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                'rt.numeric' => 'RT tidak sesuai.',
                'rw.numeric' => 'RW tidak sesuai.',
            ]);

            $dataPermintaanBarang = DataPerusahaan::findOrFail($id);
    
            // Cek apakah kode_perusahaan sudah digunakan oleh Permintaan Barang lain
            if (DataPerusahaan::where('kode_perusahaan', $validated['kode_perusahaan'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Perusahaan dengan kode ' . $validated['kode_perusahaan'] . ' sudah digunakan oleh Permintaan Barang lain.');
                return redirect()->back();
            }
    
            $dataAlamat = DataAlamat::find($dataPermintaanBarang->id_alamat);
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
    
            // Update dataPermintaanBarang dengan id_alamat dari dataAlamat yang baru disimpan
            $dataPermintaanBarang->kode_perusahaan = $validated['kode_perusahaan'];
            $dataPermintaanBarang->nama_perusahaan = $validated['nama_perusahaan'];
            $dataPermintaanBarang->no_telepon = $validated['no_telepon'];
            $dataPermintaanBarang->npwp = $validated['npwp'];
            $dataPermintaanBarang->email = $validated['email'];
            $dataPermintaanBarang->id_alamat = $dataAlamat->id; // Assign id_alamat dari dataAlamat yang baru disimpan
    
            $dataPermintaanBarang->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah data Permintaan Barang '.$dataPermintaanBarang->nama_perusahaan);
            LogHelper::success('Berhasil mengubah data Permintaan Barang '.$dataPermintaanBarang->nama_perusahaan);
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

        return view('pages.dashboard.permintaan_barang.edit', [
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        try{
            $dataPermintaanBarang = dataPermintaanBarang::find($id);
    
            $dataPermintaanBarang->delete();
            
            if(!isNull($dataPermintaanBarang->id_alamat)){
                $dataAlamat = DataAlamat::find($dataPermintaanBarang->id_alamat);
                $dataAlamat->delete();
            }
            
            if(!$dataPermintaanBarang){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data Permintaan Barang!');
            toast('Berhasil menghapus data Permintaan Barang!','success','top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data Permintaan Barang: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data Permintaan Barang: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data Permintaan Barang.');
                Alert::error('Gagal!', 'Gagal menghapus data Permintaan Barang: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data Permintaan Barang.');
            Alert::error('Gagal!', 'Gagal menghapus data Permintaan Barang: Data terkait masih ada.');
            return redirect()->back();
        }
    }
}
