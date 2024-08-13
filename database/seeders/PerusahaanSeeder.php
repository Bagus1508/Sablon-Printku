<?php

namespace Database\Seeders;

use App\Models\DataPerusahaan;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    /* protected $data = [
        ['PT. Sejahtera', '845634', '082313123123', 'ptsejahtera@gmail.com'],
        ['PT. Maju Jaya', '789654', '081234567890', 'ptmajujaya@gmail.com'],
        ['PT. Makmur Sentosa', '456123', '085612345678', 'ptmakmursentosa@gmail.com'],
        ['PT. Sukses Abadi', '321789', '087812345678', 'ptsuksesabadi@gmail.com'],
        ['PT. Jaya Makmur', '654987', '083412345678', 'ptjayamakmur@gmail.com'],
        ['PT. Bersama Kita', '987321', '081912345678', 'ptbersamakita@gmail.com'],
        ['PT. Usaha Sejahtera', '123654', '089812345678', 'ptusahasejahtera@gmail.com'],
        ['PT. Maju Terus', '789123', '085712345678', 'ptmajutrus@gmail.com'],
        ['PT. Sentosa Abadi', '456789', '081812345678', 'ptsentosaabadi@gmail.com'],
        ['PT. Jaya Sentosa', '321456', '083112345678', 'ptjayasentosa@gmail.com'],
    ];  */   

    /**
     * Run the database seeds.
     *
     * @return void
     */
    /* public function run()
    {
        foreach ($this->data as $d) {
            $perusahaan = DataPerusahaan::create([
                'nama_perusahaan' => $d[0], 
                'kode_perusahaan' => $d[1],
                'no_telepon' => $d[2],
                'email' => $d[3],
            ]);
        }
    } */

    public function run()
    {
        $csvFile = storage_path('import/data-perusahaan.csv');

        if (($handle = fopen($csvFile, "r")) !== false) {
            $header = null;
            
            DB::beginTransaction();

            try {
                while (($row = fgetcsv($handle, 0, ",")) !== false) {
                    if (!$header) {
                        $header = $row;
                        continue;
                    }

                    $data = array_combine($header, $row);

                    $dataPerusahaan = DataPerusahaan::create([
                        'nama_perusahaan' => $data['nama_perusahaan'],
                        'kode_perusahaan' => $data['kode_perusahaan'],
                        'npwp' => $data['npwp'] ?? '',
                    ]);

                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            } finally {
                fclose($handle);
            }
        }
    }

}
