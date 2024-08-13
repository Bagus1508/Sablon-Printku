<?php

namespace Database\Seeders;

use App\Models\DataUkuran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /* protected $data = [
        ['Small', 'S'],
        ['Medium', 'M'],
        ['Large', 'L'],
        ['Xtra Large', 'XL'],
        ['30', '30'],
        ['32', '32'],
        ['34', '34'],
        ['36', '36'],
    ]; */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    /* public function run()
    {
        $i = 1; // Mulai dari 1
        foreach($this->data as $d) {
            DataUkuran::create([
                'nama_ukuran' => $d[0], 
                'singkatan_ukuran' => $d[1]
            ]);
            $i++; // Increment $i setiap iterasi
        }
    } */

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('import/data-ukuran.csv');

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

                    $user = DataUkuran::create([
                        'nama_ukuran' => $data['nama_ukuran'],
                        'singkatan_ukuran' => $data['singkatan_ukuran'],
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
