<?php

namespace App\Livewire;

use App\Helpers\TanggalHelper;
use App\Models\DataPerusahaan;
use App\Models\DataSatuan;
use App\Models\DataUkuran;
use App\Models\DataWarna;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\StokHarian;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PakaianCelanaSatuanTable extends Component
{
    use WithPagination;
    public $search = "";
    public $perPage = 10;
    public $filter, $tanggal, $ID, $Id_no, $Id_kategori, $Nama_barang, $Id_warna;
    public $startDate;
    public $endDate;
    public $selectedUnit;
    public $selectedSortBy;

    public function showDetails($id)
    {
        return redirect()->to("stok-pakaian-celana-satuan?stok_pakaian_celana=$id");
    }

    public function updatedTanggal()
    {
        if($this->tanggal==''){
            $this->startDate =   '2001-01-01';
            $this->endDate   =   '3001-01-01';
        }else{
            $tanggal = explode(" - ",$this->tanggal);
            $this->startDate = Carbon::parse(TanggalHelper::translateBulan($tanggal[0],'en'))->format("Y-m-d");
            if(count($tanggal) == 2){
                $this->endDate = Carbon::parse(TanggalHelper::translateBulan($tanggal[1],'en'))->format("Y-m-d");
            }else{
                $this->endDate = $this->startDate;
            }
        }
    }

    public function editPakaianCelana(int $id){
        $this->ID = $id;
        $data = Produk::findOrFail($id);

        $this->Id_no = $data->id_no; // Sesuaikan jika perlu
        $this->Id_kategori = $data->id_kategori; // Sesuaikan dengan nama properti yang benar
        $this->Nama_barang = $data->nama_barang; // Sesuaikan jika perlu
        $this->Id_warna = $data->id_warna;
    }    

    public function deletePakaianCelana(int $id){
        $this->ID = $id;
    }
    
    public function render()
    {
        $this->startDate ? $awal = $this->startDate : $awal = Carbon::now()->startOfMonth();
        $this->endDate ? $akhir = $this->endDate : $akhir = Carbon::now()->endOfMonth(); 
    
        $startDate = Carbon::parse($awal);
        $endDate = Carbon::parse($akhir);
    
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
        ->where('id_kategori', 2)
        ->with(['stokHarian' => function($query) use ($awal, $akhir) {
            $query->whereBetween('tanggal', [$awal, $akhir]);
        }])
        ->orderBy('nama_barang', 'asc');
    
        $data = $query->paginate($this->perPage);
    
        // Hitung total stok_masuk dan stok_keluar
        $totalStokMasuk = [];
        $totalStokKeluar = [];
        foreach ($data as $produk) {
            $totalStokMasuk[$produk->id] = 0;
            $totalStokKeluar[$produk->id] = 0;
            foreach ($produk->stokHarian as $stok) {
                $stokMasuk = $stok->stok_masuk;
                $stokKeluar = $stok->stok_keluar;
                $satuanId = $stok->id_satuan;
                $satuanNamaTotal = ''; // Deklarasi variabel
    
                if ($this->selectedUnit == '1' && $satuanId == '2') { // Yard to Meter
                    $stokMasuk = round($stokMasuk / 1.09361, 2);
                    $stokKeluar = round($stokKeluar / 1.09361, 2);
                } elseif ($this->selectedUnit == '2' && $satuanId == '1') { // Meter to Yard
                    $stokMasuk = round($stokMasuk * 1.09361, 2);
                    $stokKeluar = round($stokKeluar * 1.09361, 2);
                }

                if ($this->selectedUnit == '1') { // Yard to Meter
                    $satuanNamaTotal = $satuanNamaTotal = DataSatuan::where('id', $this->selectedUnit)->pluck('nama_satuan')->first();
                } elseif ($this->selectedUnit == '2') { // Meter to Yard
                    $satuanNamaTotal = $satuanNamaTotal = DataSatuan::where('id', $this->selectedUnit)->pluck('nama_satuan')->first();
                }
    
                $totalStokMasuk[$produk->id] += $stokMasuk;
                $totalStokKeluar[$produk->id] += $stokKeluar;
            }
        }
    
        $dataKategori = ProdukKategori::all();
        $dataSatuan = DataSatuan::all();
        $dataUkuran = DataUkuran::all();
        $dataWarna = DataWarna::all();
        $dataPerusahaan = DataPerusahaan::all();
    
        $datanotfound = !$data->count();
    
        return view('livewire.pakaian-celana-satuan-table', [
            'data' => $data,
            'nodata' => $datanotfound,
            'dataKategori' => $dataKategori ?? '',
            'dataSatuan' => $dataSatuan ?? '',
            'dataUkuran' => $dataUkuran ?? '',
            'dataWarna' => $dataWarna ?? '',
            'dateRange' => $dateRange ?? '',
            'totalStokMasuk' => $totalStokMasuk ?? '',
            'totalStokKeluar' => $totalStokKeluar ?? '',
            'jumlahHari' => count($dateRange) ?? '',
            'satuanNamaTotal' => $satuanNamaTotal??'',
            'dataPerusahaan' => $dataPerusahaan ?? '',
        ]);
    }
    

    public function updatingSearch(){
        $this->reset();
    }
}
