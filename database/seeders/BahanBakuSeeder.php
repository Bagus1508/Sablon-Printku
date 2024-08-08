<?php

namespace Database\Seeders;

use App\Models\HargaProduk;
use App\Models\Produk;
use App\Models\StokHarian;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use PDO;

class BahanBakuSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    protected $data = [
        ['KAINAC1', '1', 'AMERICO', '1', ''],
        ['KAINBIA1', '1', 'BELINI', '2', ''],
        ['KAINBSN1', '1', 'BELYSTAR', '3', ''],
        ['KAINCMP1', '1', 'CASSAMODA', '4', ''],
        ['CHINOS1', '1', 'CHINO', '5', ''],
        ['JEANS1', '2', 'JEANS1', '1', '4'],
        ['JEANS2', '2', 'JEANS2', '2', '7'],
        ['KATUN', '2', 'KATUN', '3', '9'],
        ['KATUN1', '2', 'KATUN2', '4', '3'],
        ['AMERICO', '2', 'JOGER', '5', '2'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) {
            $produk = Produk::create([
                'id_no' => $d[0], 
                'id_kategori' => $d[1],
                'nama_barang' => $d[2],
                'id_warna' => $d[3],
                'id_perusahaan' => $d[4] ?: null, // Handle empty array element
            ]);
    
            // Generate stok harian untuk satu bulan
            $startDate = Carbon::now()->startOfMonth();
            $endDate = Carbon::now()->endOfMonth();
    
            $sisaStok = 0; // Initialize sisa stok
    
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $stokMasuk = rand(50, 100); // Random stok masuk, sesuaikan dengan kebutuhan
                $stokKeluar = rand(0, 40); // Random stok keluar, sesuaikan dengan kebutuhan
                
                // Hitung sisa stok berdasarkan stok masuk dan stok keluar
                $sisaStok = $stokMasuk - $stokKeluar;

                if($produk->id_kategori == 1){
                    $idSatuan = rand(1,2);
                    $idUkuran = null;
                } else {
                    $idSatuan = 3;
                    $idUkuran = rand(1,8);
                }
    
                $stokHarian = StokHarian::create([
                    'tanggal' => $date->toDateString(),
                    'id_produk' => $produk->id,
                    'stok_masuk' => $stokMasuk,
                    'stok_keluar' => $stokKeluar,
                    'sisa_stok' => $sisaStok, // Sisa stok yang sudah dihitung
                    'id_satuan' => $idSatuan,
                    'id_ukuran' => $idUkuran,
                ]);

                if($produk->id_kategori == 1){
                    HargaProduk::create([
                        'id_stok_harian' => $stokHarian->id,
                        'harga_beli_satuan' => rand(10000,50000),
                    ]);
                } else {
                    HargaProduk::create([
                        'id_stok_harian' => $stokHarian->id,
                        'harga_produksi_satuan' => rand(10000,50000),
                        'harga_jual_satuan' => rand(50000,99000),
                    ]);
                }
            }
        }
    }
    
}
