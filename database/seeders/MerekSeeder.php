<?php

namespace Database\Seeders;

use App\Models\DataMerek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $csvFile = storage_path('import/data-merek.csv');

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

                    $dataMerek = DataMerek::create([
                        'nama_merek' => $data['nama_merek'],
                        'kode_merek' => $data['kode_merek'],
                        'id_kategori' => 1,
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
