<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    /* protected $data = [
        ['UP 1'],
        ['UP 2'],
        ['UP 3'],
        ['UP 4'],
        ['UP 5'],
        ['UP 6'],
        ['UP 7'],
    ]; */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    /* public function run()
    {
        foreach ($this->data as $d) {
            $region = Region::create([
                'nama_region' => $d[0], 
            ]);
        }
    } */


    public function run()
    {
        $csvFile = storage_path('import/data-region.csv');

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

                    $dataRegion = Region::create([
                        'nama_region' => $data['nama_region'],
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
