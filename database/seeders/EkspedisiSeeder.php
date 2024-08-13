<?php

namespace Database\Seeders;

use App\Models\DataEkspedisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkspedisiSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    /* protected $data = [
        ['JNE', '845634'],
        ['JNT', '789654'],
        ['Tiki', '675839'],
        ['Pos Indonesia', '783920'],
        ['SiCepat', '584726'],
        ['Ninja Express', '293847'],
        ['Wahana', '109238'],
        ['Lion Parcel', '483920'],
        ['Anteraja', '573920'],
        ['Paxel', '902837'],
    ]; */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    /* public function run()
    {
        foreach ($this->data as $d) {
            $perusahaan = DataEkspedisi::create([
                'nama_ekspedisi' => $d[0], 
                'kode_ekspedisi' => $d[1],
            ]);
        }
    } */

        /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('import/data-ekspedisi.csv');

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

                    $user = DataEkspedisi::create([
                        'kode_ekspedisi' => $data['kode_ekspedisi'] ?? null,
                        'nama_ekspedisi' => $data['nama_ekspedisi'],
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
