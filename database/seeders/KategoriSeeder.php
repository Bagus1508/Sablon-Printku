<?php

namespace Database\Seeders;

use App\Models\ProdukKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bahanBaku = ProdukKategori::create([
            'kode_kategori' => '01',
            'nama_kategori' => 'Bahan Baku',
        ]);
        $pakaian = ProdukKategori::create([
            'kode_kategori' => '02',
            'nama_kategori' => 'Pakaian',
        ]);
    }
}
