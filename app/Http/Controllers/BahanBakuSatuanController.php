<?php

namespace App\Http\Controllers;

use App\Exports\StokBahanBakuSatuanExport;
use App\Helpers\LogHelper;
use App\Helpers\TanggalHelper;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\StokHarian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class BahanBakuSatuanController extends Controller
{   
    public $search = "";
    public $selectedUnit;
    public $selectedSortBy;

    public function index(){
        $produkKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();

        return view('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.index', compact('produkKategori', 'dataSatuan', 'dataUkuran', 'dataWarna'));
    }
    
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_no' => 'nullable',
                'id_kategori' => 'required',
                'nama_barang' => 'required',
                'id_warna' => 'required',
                'id_satuan' => 'nullable|integer',
                'id_ukuran' => 'nullable|integer',
                'id_perusahaan' => 'nullable|integer',
            ], [
                'id_kategori.required' => 'Kategori bahan tidak boleh kosong.',
                'nama_barang.required' => 'Nama tidak boleh kosong.',
                'id_warna.required' => 'Warna tidak boleh kosong.',
            ]);
            
            $validated['id_satuan'] = $validated['id_satuan'] ?? null;
            $validated['id_ukuran'] = $validated['id_ukuran'] ?? null;
            $validated['id_perusahaan'] = $validated['id_perusahaan'] ?? null;

            // Cek apakah No ID Bahan sudah digunakan
            if (Produk::where('id_no', '=', $validated['id_no'])->exists()) {
                Alert::error('Gagal!', 'No ID Bahan sudah digunakan.');
                return redirect()->back();
            }
            
            $parameter = [
                'id_no' => $validated['id_no'] ?? null,
                'id_kategori' => $validated['id_kategori'],
                'nama_barang' => $validated['nama_barang'],
                'id_warna' => $validated['id_warna'],
                'id_satuan' => $validated['id_satuan'],
                'id_ukuran' => $validated['id_ukuran'],
                'id_perusahaan' => $validated['id_perusahaan'],
            ];
    
            $dataProduk = Produk::create($parameter);
    
            if (!$dataProduk) {
                Alert::error('Gagal!', 'Gagal menambahkan bahan baku');
                LogHelper::error('Gagal menambahkan bahan baku!');
                return redirect()->back();
            }

            $validated['stok_masuk'] = 0;
            $validated['stok_keluar'] = 0;
            $validated['sisa_stok'] = 0;

            $parameterStok = [
                'id_produk' => $dataProduk->id,
                'tanggal' => Carbon::now(), 
                'stok_masuk' => $validated['stok_masuk'],
                'stok_keluar' => $validated['stok_keluar'],
                'sisa_stok' => $validated['sisa_stok'],
            ];

            $dataStok = StokHarian::create($parameterStok);

            if (!$dataStok) {
                Alert::error('Gagal!', 'Gagal menambahkan bahan baku');
                LogHelper::error('Gagal menambahkan bahan baku!');
                return redirect()->back();
            }
    
            Alert::success('Berhasil!', 'Berhasil menambah bahan baku');
            LogHelper::success('Berhasil menambahkan bahan baku.');
            return redirect()->back();
            
        } catch (Validator $e) {
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
                'id_no' => 'nullable',
                'id_kategori' => 'required',
                'nama_barang' => 'required',
                'id_warna' => 'required',
                'id_satuan' => 'nullable|integer',
                'id_ukuran' => 'nullable|integer',
                'id_perusahaan' => 'nullable|integer',
            ], [
                'id_kategori.required' => 'Kategori bahan tidak boleh kosong.',
                'nama_barang.required' => 'Nama tidak boleh kosong.',
                'id_warna.required' => 'Warna tidak boleh kosong.',
            ]);

            $validated['id_satuan'] = $validated['id_satuan'] ?? null;
            $validated['id_ukuran'] = $validated['id_ukuran'] ?? null;
            $validated['id_perusahaan'] = $validated['id_perusahaan'] ?? null;

            $data = Produk::find($id);

            $data->id_no = $validated['id_no'] ?? null;
            $data->id_kategori = $validated['id_kategori'];
            $data->nama_barang = $validated['nama_barang'];
            $data->id_warna = $validated['id_warna'];
            $data->id_satuan = $validated['id_satuan'];
            $data->id_ukuran = $validated['id_ukuran'];
            $data->id_perusahaan = $validated['id_perusahaan'];

            // Cek apakah No ID Bahan sudah digunakan
            if (Produk::where('id_no', '=', $validated['id_no'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'No ID '.$validated['id_no'].' Bahan sudah digunakan.');
                return redirect()->back();
            }

            $dataProduk = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data bahan baku');
            LogHelper::success('Berhasil mengubah data bahan baku.');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }

    public function updateStok(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'id_no' => 'required',
                'id_kategori' => 'required',
                'nama_barang' => 'required',
                'id_warna' => 'required',
                'id_satuan' => 'nullable|integer',
                'id_ukuran' => 'nullable|integer',
                'id_perusahaan' => 'nullable|integer',
            ], [
                'id_no.required' => 'NO ID bahan tidak boleh kosong.',
                'id_kategori.required' => 'Kategori bahan tidak boleh kosong.',
                'nama_barang.required' => 'Nama tidak boleh kosong.',
                'id_warna.required' => 'Warna tidak boleh kosong.',
            ]);

            $validated['id_satuan'] = $validated['id_satuan'] ?? null;
            $validated['id_ukuran'] = $validated['id_ukuran'] ?? null;
            $validated['id_perusahaan'] = $validated['id_perusahaan'] ?? null;

            $data = Produk::find($id);

            $data->id_no = $validated['id_no'];
            $data->id_kategori = $validated['id_kategori'];
            $data->nama_barang = $validated['nama_barang'];
            $data->id_warna = $validated['id_warna'];
            $data->id_satuan = $validated['id_satuan'];
            $data->id_ukuran = $validated['id_ukuran'];
            $data->id_perusahaan = $validated['id_perusahaan'];

            // Cek apakah No ID Bahan sudah digunakan
            if (Produk::where('id_no', '=', $validated['id_no'])->where('id', '!=', $id)->exists()) {
                Alert::error('Gagal!', 'No ID '.$validated['id_no'].' Bahan sudah digunakan.');
                return redirect()->back();
            }

            $dataProduk = $data->save();

            Alert::success('Berhasil!', 'Berhasil mengubah data bahan baku');
            LogHelper::success('Berhasil mengubah data bahan baku.');
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
            $data = Produk::find($id);
    
            if (!$data) {
                return redirect()->back()->with('gagal', 'Produk tidak ditemukan');
            }
    
            $dataProduk = $data->delete();
    
            if (!$dataProduk) {
                return redirect()->back()->with('gagal', 'Gagal menghapus produk');
            }
    
            LogHelper::success('Berhasil menghapus data produk!');
            toast('Berhasil menghapus data produk!','success','top-right');
            return redirect()->back();
        } catch (Throwable $e) {
            LogHelper::error($e->getMessage());
            return view('pages.utility.500');
        }
    }
    
    public function preview_export(Request $request) 
    {
        try {
            // Tangkap rentang tanggal dari parameter query
            $tgl_stok_satuan = $request->input('tanggal'); // Ambil nilai dari parameter URL
            $id_satuan = $request->input('id_satuan'); // Ambil nilai dari parameter URL
            $selectedTable = $request->input('selected_table');
        

            if($tgl_stok_satuan == null){
                // Mendapatkan tanggal awal tahun ini
                $startDateStr = Carbon::now()->startOfMonth()->format('Y-m-d');
                // Mendapatkan tanggal akhir tahun ini
                $endDateStr = Carbon::now()->endOfMonth()->format('Y-m-d');

                $startDate = Carbon::parse($startDateStr);
                $endDate = Carbon::parse($endDateStr);

                $startDateFormatted = '';
                $endDateFormatted = '';

                $startDateFormatted = Carbon::parse($startDate)->translatedFormat('j F Y');
                $endDateFormatted = Carbon::parse($endDate)->translatedFormat('j F Y');
            } else {
                $tanggalStokSatuan = explode(' - ', $tgl_stok_satuan); // Membagi berdasarkan pemisah

                if (count($tanggalStokSatuan) == 1) {
                    Alert::error('Gagal!', 'Rentang tanggal Export tidak boleh satu tanggal.');
                } else {
                    $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokSatuan[0], 'en'))->format("Y-m-d");
                    $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokSatuan[1], 'en'))->format("Y-m-d");
            
                    $startDate = Carbon::parse($startDateStr);
                    $endDate = Carbon::parse($endDateStr);

                    $startDateFormatted = Carbon::parse($startDate)->translatedFormat('j F Y');
                    $endDateFormatted = Carbon::parse($endDate)->translatedFormat('j F Y');
                }
            }
        

            // Buat daftar tanggal dalam rentang
            $dateRange = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dateRange[] = $date->format('Y-m-d');
            }
        
            // Ambil produk dengan stok harian dalam rentang tanggal
            $query = Produk::where(function($query) {
                $query->where('nama_barang', 'LIKE', '%'.$this->search.'%')
                      ->orWhere('id_no', 'LIKE', '%'.$this->search.'%');
            })
            ->where('id_kategori', 1)
            ->with(['stokHarian' => function($query) use ($startDateStr, $endDateStr) {
                $query->whereBetween('tanggal', [$startDateStr, $endDateStr]);
            }])
            ->orderBy('nama_barang', 'asc');
    
            $data = $query->get();
        
            // Hitung total stok_masuk dan stok_keluar
            $totalStokMasuk = [];
            $totalStokKeluar = [];
            $satuanNamaTotal = ''; // Inisialisasi variabel di luar loop
            foreach ($data as $produk) {
                $totalStokMasuk[$produk->id] = 0;
                $totalStokKeluar[$produk->id] = 0;
                foreach ($produk->stokHarian as $stok) {
                    $stokMasuk = $stok->stok_masuk;
                    $stokKeluar = $stok->stok_keluar;
                    $satuanId = $stok->id_satuan;
            
                    if ($id_satuan == '1' && $satuanId == '2') { // Yard to Meter
                        $stokMasuk = round($stokMasuk / 1.09361, 2);
                        $stokKeluar = round($stokKeluar / 1.09361, 2);
                    } elseif ($id_satuan == '2' && $satuanId == '1') { // Meter to Yard
                        $stokMasuk = round($stokMasuk * 1.09361, 2);
                        $stokKeluar = round($stokKeluar * 1.09361, 2);
                    }
    
                    if ($id_satuan == '1') { // Meter
                        $satuanNamaTotal = DataSatuan::where('id', 1)->pluck('nama_satuan')->first();
                    } elseif ($id_satuan == '2') { // Yard
                        $satuanNamaTotal = DataSatuan::where('id', 2)->pluck('nama_satuan')->first();
                    }
    
                    $totalStokMasuk[$produk->id] += $stokMasuk;
                    $totalStokKeluar[$produk->id] += $stokKeluar;
                }
            }
        
            $dataKategori = ProdukKategori::all();
            $dataSatuan = DataSatuan::all();
            $dataUkuran = DataUkuran::all();
            $dataWarna = DataWarna::all();
        
            $datanotfound = !$data->count();
        
            return view('pages.dashboard.monitoring_persediaan.bahan_baku.satuan.export.index', [
                'data' => $data,
                'nodata' => $datanotfound,
                'dataKategori' => $dataKategori,
                'dataSatuan' => $dataSatuan,
                'dataUkuran' => $dataUkuran,
                'dataWarna' => $dataWarna,
                'dateRange' => $dateRange,
                'totalStokMasuk' => $totalStokMasuk,
                'totalStokKeluar' => $totalStokKeluar,
                'jumlahHari' => count($dateRange),
                'satuanNamaTotal' => $satuanNamaTotal,
                'tgl_stok_satuan' => $tgl_stok_satuan,
                'id_satuan' => $id_satuan,
                'startDateFormatted' => $startDateFormatted,
                'endDateFormatted' => $endDateFormatted,
                'selectedTable' => $selectedTable,
            ]);
        } catch (\Exception $e) {
            // Tangani error dan tampilkan pesan
            toast('Gagal menampilkan data: ', 'error', 'top-right');
            return redirect()->back();
        }
    }

    public function exportBahanBakuSatuan(Request $request)
    {
        // Tangkap rentang tanggal dari parameter query
        $tgl_stok_satuan = $request->input('tanggal'); // Ambil nilai dari parameter URL
        $IdSatuan = $request->input('id_satuan'); // Ambil nilai dari parameter URL
        $selectedTable = $request->input('selected_table'); // Ambil nilai dari parameter URL

        if($tgl_stok_satuan == null){
            // Mendapatkan tanggal awal tahun ini
            $startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            // Mendapatkan tanggal akhir tahun ini
            $endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        } else {
            $tanggalStokSatuan = explode(' - ', $tgl_stok_satuan); // Membagi berdasarkan pemisah

            if (count($tanggalStokSatuan) == 1) {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokSatuan[0], 'en'))->format("Y-m-d");
                $startDate = Carbon::parse($startDateStr);
                $endDate = $startDate;
            } else {
                $startDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokSatuan[0], 'en'))->format("Y-m-d");
                $endDateStr = Carbon::parse(TanggalHelper::translateBulan($tanggalStokSatuan[1], 'en'))->format("Y-m-d");
        
                $startDate = Carbon::parse($startDateStr);
                $endDate = Carbon::parse($endDateStr);
            }
        }
        $filename = 'PERSEDIAAN KAIN SATUAN_' . $startDate . ' - '. $endDate .'.xlsx';
        return Excel::download(new StokBahanBakuSatuanExport($startDate, $endDate ,$IdSatuan, $selectedTable), $filename);
    }
    

}
