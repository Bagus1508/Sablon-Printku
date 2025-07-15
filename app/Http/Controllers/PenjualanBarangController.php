<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use App\Models\DataProduk;
use App\Models\PenjualanBarang;
use App\Models\PenjualanBarangDetail;
use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

use function PHPUnit\Framework\isNull;

class PenjualanBarangController extends Controller
{
    public function index(){
        $dataProduk = DataProduk::select('kode_produk', 'kode_produk')->get();

        return view('pages.dashboard.penjualan_barang.index', [
            'dataProduk' => $dataProduk,
        ]);
    }

    public function create(){
        $dataProduk = DataProduk::pluck('kode_produk', 'kode_produk');

        return view('pages.dashboard.penjualan_barang.create', [
            'dataProduk' => $dataProduk,
        ]);
    }

    public function store(Request $request)
    {  
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'no_transaksi' => 'required',
                'total_transaksi' => 'required',
                'nama' => 'required',
                'status' => 'required',
                'catatan' => 'nullable',
                'barang' => 'required|array|min:1',
            ], [
                'no_transaksi.required' => 'No Transaksi tidak boleh kosong.',
                'total_transaksi.required' => 'Total Transaksi tidak boleh kosong.',
                'nama.required' => 'Nama Pengaju Penjualan Barang tidak boleh kosong.',
                'status.required' => 'Status Penjualan Barang tidak boleh kosong.',
                'barang.required' => 'Barang tidak boleh kosong.',
            ]);
            
            $parameter = [
                'no_transaksi' => $validated['no_transaksi'],
                'total_transaksi' => $validated['total_transaksi'],
                'nama' => $validated['nama'],
                'catatan' => $validated['catatan'],
                'status' => $validated['status'],
            ];

            $dataPenjualanBarang = PenjualanBarang::create($parameter);

            if ($validated['barang']) {
                foreach ($validated['barang'] as $key => $item) {
                    $dataItem = Produk::where('kode_produk', $item['kode_barang'])->first();

                    PenjualanBarangDetail::create([
                        'id_pb' => $dataPenjualanBarang->id,
                        'id_produk' => $dataItem->id,
                        "kode_barang" => $item['kode_barang'],
                        "nama_barang" => $item['nama_barang'],
                        "harga" => $item['harga'],
                        "jumlah" => $item['jumlah'],
                        "sub_total" => $item['sub_total'],
                    ]);
                }
            }
    

            if (!$dataPenjualanBarang) {
                Alert::error('Gagal!', 'Gagal menambahkan Penjualan Barang '.$dataPenjualanBarang->no_transaksi);
                LogHelper::error('Gagal menambahkan Penjualan Barang! '.$dataPenjualanBarang->no_transaksi);
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah Penjualan Barang '.$dataPenjualanBarang->no_transaksi);
            LogHelper::success('Berhasil menambahkan Penjualan Barang '.$dataPenjualanBarang->no_transaksi);

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
                'kode_perusahaan.required' => 'Kode Penjualan Barang tidak boleh kosong.',
                'nama_perusahaan.required' => 'Nama Penjualan Barang tidak boleh kosong.',
                'no_telepon.regex' => 'Nomor telepon harus berisi angka saja.',
                'email.email' => 'Email harus merupakan alamat email yang valid.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
                'rt.numeric' => 'RT tidak sesuai.',
                'rw.numeric' => 'RW tidak sesuai.',
            ]);

            $dataPenjualanBarang = DataPerusahaan::findOrFail($id);
    
            // Cek apakah kode_perusahaan sudah digunakan oleh Penjualan Barang lain
            if (DataPerusahaan::where('kode_perusahaan', $validated['kode_perusahaan'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'Perusahaan dengan kode ' . $validated['kode_perusahaan'] . ' sudah digunakan oleh Penjualan Barang lain.');
                return redirect()->back();
            }
    
            $dataAlamat = DataAlamat::find($dataPenjualanBarang->id_alamat);
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
    
            // Update dataPenjualanBarang dengan id_alamat dari dataAlamat yang baru disimpan
            $dataPenjualanBarang->kode_perusahaan = $validated['kode_perusahaan'];
            $dataPenjualanBarang->nama_perusahaan = $validated['nama_perusahaan'];
            $dataPenjualanBarang->no_telepon = $validated['no_telepon'];
            $dataPenjualanBarang->npwp = $validated['npwp'];
            $dataPenjualanBarang->email = $validated['email'];
            $dataPenjualanBarang->id_alamat = $dataAlamat->id; // Assign id_alamat dari dataAlamat yang baru disimpan
    
            $dataPenjualanBarang->save();
    
            Alert::success('Berhasil!', 'Berhasil mengubah data Penjualan Barang '.$dataPenjualanBarang->nama_perusahaan);
            LogHelper::success('Berhasil mengubah data Penjualan Barang '.$dataPenjualanBarang->nama_perusahaan);
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
        $data = PenjualanBarang::find($id);

        return view('pages.dashboard.penjualan_barang.edit', [
            'data' => $data,
        ]);
    }

    public function destroy($id)
    {
        try{
            $dataPenjualanBarang = dataPenjualanBarang::find($id);
    
            $dataPenjualanBarang->delete();
            
            if(!isNull($dataPenjualanBarang->id_alamat)){
                $dataAlamat = DataAlamat::find($dataPenjualanBarang->id_alamat);
                $dataAlamat->delete();
            }
            
            if(!$dataPenjualanBarang){
                return redirect()->back()->with('gagal', 'menghapus');
            }
            LogHelper::success('Berhasil menghapus data Penjualan Barang!');
            toast('Berhasil menghapus data Penjualan Barang!','success','top-right');
            return redirect()->back();
        } catch (QueryException $e) {
            // Cek apakah kesalahan adalah Integrity constraint violation
            if ($e->getCode() == 23000) {
                LogHelper::error('Gagal menghapus data Penjualan Barang: Data terkait masih ada.');
                Alert::error('Gagal!', 'Gagal menghapus data Penjualan Barang: Data terkait masih ada.');
            } else {
                LogHelper::error('Terjadi kesalahan saat mencoba menghapus data Penjualan Barang.');
                Alert::error('Gagal!', 'Gagal menghapus data Penjualan Barang: Data terkait masih ada.');
            }
    
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error('Terjadi kesalahan saat mencoba menghapus data Penjualan Barang.');
            Alert::error('Gagal!', 'Gagal menghapus data Penjualan Barang: Data terkait masih ada.');
            return redirect()->back();
        }
    }

    public function print($id)
    {
        $data = PenjualanBarang::with('items')->find($id);

        $pdf = Pdf::loadView('pages.dashboard.penjualan_barang.export', [
            'nama' => 'Penjualan',
            'no_transaksi' => $data->no_transaksi,
            'data' => $data,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Penjualan Barang - ' . $data->no_transaksi . '.pdf');
    }
}
