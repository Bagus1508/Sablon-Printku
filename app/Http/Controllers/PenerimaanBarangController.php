<?php

namespace App\Http\Controllers;

use App\Helpers\LogHelper;
use App\Models\DataAlamat;
use App\Models\DataPerusahaan;
use App\Models\PenerimaanBarang;
use App\Models\PengirimanBarang;
use App\Models\PermintaanBarang;
use App\Models\PermintaanBarangDetail;
use App\Models\Produk;
use App\Models\StokHarian;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

use function PHPUnit\Framework\isNull;

class PenerimaanBarangController extends Controller
{
    public function index(){
        return view('pages.dashboard.penerimaan_barang.index');
    }

    public function create(){
        return view('pages.dashboard.penerimaan_barang.create');
    }

    public function store(Request $request)
    {  
        try {
            DB::beginTransaction();

            $validated = $request->validate([
                'id_permintaan_barang' => 'required',
                'id_pengiriman_barang' => 'required',
                'no_transaksi' => 'required',
                'nama_penerima' => 'required',
                'status' => 'required',
            ], [
                'id_permintaan_barang.required' => 'Referensi Permintaan Barang Barang tidak boleh kosong.',
                'id_pengiriman_barang.required' => 'Referensi Pengiriman Barang Barang tidak boleh kosong.',
                'no_transaksi.required' => 'No Transaksi Permintaan Barang tidak boleh kosong.',
                'nama_penerima.required' => 'Nama Penerima Barang Barang tidak boleh kosong.',
                'status.required' => 'Status VerifikasiPenerimaan Barang Barang tidak boleh kosong.',
            ]);

            $dataPenerimaanBarang = PenerimaanBarang::create($validated);

            if (intval($dataPenerimaanBarang['status']) === 1) {
                if ($dataPenerimaanBarang) {
                    PermintaanBarang::find($dataPenerimaanBarang->id_permintaan_barang)->update([
                        'status' => 3,
                    ]);

                    PengirimanBarang::find($dataPenerimaanBarang->id_pengiriman_barang)->update([
                        'status' => 2,
                    ]);
                }
    
                $listBarang = $dataPenerimaanBarang->permintaanBarang?->items;
    
                foreach ($listBarang as $key => $item) {
                    $dataBarang = Produk::where('kode_produk', $item->kode_barang)->first();
                    $dataStok = StokHarian::where('id_produk', $dataBarang->id)->first();

                    if (!$dataStok) {
                        $createStok = StokHarian::create([
                            'tanggal' => Carbon::now(),
                            'id_produk' => $dataBarang->id,
                            'stok_masuk' => $item->jumlah,
                            'stok_keluar' => 0,
                            'sisa_stok' => $item->jumlah,
                            'id_satuan' => $dataBarang->id_satuan,
                            'id_ukuran' => 1,
                        ]);
                    } else {
                        $dataStok->update([
                            'stok_masuk' => $item->jumlah,
                            'sisa_stok' => $item->jumlah + $dataBarang->sisa_stok,
                            'id_ukuran' => 1,
                        ]);
                    }
                }
            }
            
            if (!$dataPenerimaanBarang) {
                Alert::error('Gagal!', 'Gagal menambahkan Penerimaan Barang Barang '.$dataPenerimaanBarang->no_transaksi);
                LogHelper::error('Gagal menambahkan Penerimaan Barang Barang! '.$dataPenerimaanBarang->no_transaksi);
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah Penerimaan Barang Barang '.$dataPenerimaanBarang->no_transaksi);
            LogHelper::success('Berhasil menambahkan Penerimaan Barang Barang '.$dataPenerimaanBarang->no_transaksi);

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

    }

    public function edit($id){
        $data = PengirimanBarang::find($id);

        return view('pages.dashboard.penerimaan_barang.edit', [
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
