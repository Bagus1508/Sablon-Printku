<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\KontrakGlobal;
use App\Models\KontrakRinci;
use App\Models\Pajak;
use App\Models\PengirimanBarang;
use App\Models\ProdukKontrak;
use App\Models\ProsesCutting;
use App\Models\ProsesJahit;
use App\Models\ProsesPacking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KontrakRinciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $currentYear = 2024; // Tahun saat ini
        $startOfYear = "$currentYear-01-01";
        $endOfYear = "$currentYear-12-31";

        for ($i = 0; $i < 10; $i++) {
            $noSuratPrefix = $faker->randomNumber(2);
            $noSuratMiddle = $faker->randomNumber(2);
            $noSuratSuffix = $faker->randomNumber(6);

            // Generate tanggal kontrak pada tahun 2024
            $tanggalKontrak = $faker->date('Y-m-d', $endOfYear);
            while (date('Y', strtotime($tanggalKontrak)) != $currentYear) {
                $tanggalKontrak = $faker->date('Y-m-d', $endOfYear);
            }

            // Generate awal_kr dan akhir_kr
            $awalKr = $faker->dateTimeBetween($startOfYear, $endOfYear);
            $akhirKr = $faker->dateTimeBetween($awalKr, (clone $awalKr)->modify('+1 month'));

            // Format tanggal ke format Y-m-d
            $tanggalKontrak = $tanggalKontrak;
            $awalKr = $awalKr->format('Y-m-d');
            $akhirKr = $akhirKr->format('Y-m-d');

            // Cek jika akhirKr lebih dari satu bulan dari awalKr, atur ulang jika perlu
            if (strtotime($akhirKr) > strtotime(date('Y-m-d', strtotime($awalKr . ' +1 month')))) {
                $akhirKr = date('Y-m-d', strtotime($awalKr . ' +1 month'));
            }

            $dataKontrakRinci = KontrakRinci::create([
                'takon' => $faker->numerify('TAKON-####'),
                'no_kontrak_pihak_pertama' => $faker->numerify('NO-PP-####'),
                'no_telepon' => $faker->phoneNumber,
                'tanggal_kontrak' => $tanggalKontrak,
                'no_kontrak_rinci' => "$noSuratPrefix/$noSuratMiddle/$noSuratSuffix",
                'tanggal_kr' => $tanggalKontrak,
                'awal_kr' => $awalKr,
                'akhir_kr' => $akhirKr,
                'uraian' => $faker->text(200),
                'id_perusahaan' => $faker->numberBetween(1, 10),
                'total_harga' => $faker->numberBetween(100000,10000000),
            ]);

            for($j = 0; $j < 5; $j++){
                ProdukKontrak::create([
                    'id_kontrak_rinci' => $dataKontrakRinci->id,
                    'id_produk' => $faker->numberBetween(5,9),
                    'kuantitas' => $faker->numberBetween(10,100),
                    'id_satuan' => 3,
                    'volume_kontrak' => $faker->numberBetween(10,100),
                    'volume_realisasi' => $faker->numberBetween(10,100),
                    'volume_sisa' => $faker->numberBetween(10,100),
                ]);
            }

            ProsesJahit::create([
                'id_kontrak_rinci' => $dataKontrakRinci->id,
            ]);

            ProsesCutting::create([
                'id_kontrak_rinci' => $dataKontrakRinci->id,
            ]);

            ProsesPacking::create([
                'id_kontrak_rinci' => $dataKontrakRinci->id,
            ]);

            PengirimanBarang::create([
                'id_kontrak_rinci' => $dataKontrakRinci->id,
                'no_surat_jalan' => $faker->numberBetween(100000,20000000),
                'tanggal_surat_jalan' => $tanggalKontrak,
                'bukti_foto' => '100447_070824_pengiriman_barang_Screenshot (5).png',
                'id_ekspedisi' => $faker->numberBetween(1,9),
                'id_region' => $faker->numberBetween(1,7),
            ]);

            Invoice::create([
                'id_kontrak_rinci' => $dataKontrakRinci->id,
                'nomor_invoice' => $faker->numberBetween(100000,20000000),
                'tanggal_invoice' => $tanggalKontrak,
                'foto_invoice' => '090543_070824_invoiceScreenshot (21).png',
                'tanggal_kirim_invoice' => $tanggalKontrak,
            ]);

            KontrakGlobal::create([
                'id_kontrak_rinci' => $dataKontrakRinci->id,
                'status_spk' => 0,
            ]);

        }

        Pajak::create([
            'ppn' => 11,
        ]);
    }
}

