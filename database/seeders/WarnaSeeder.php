<?php

namespace Database\Seeders;

use App\Models\DataMerek;
use App\Models\DataWarna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /* protected $data = [
        ['Putih'],
        ['Navy'],
        ['Biru'],
        ['Coklat'],
        ['Maroon'],
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
            DataWarna::create([
                'kode_warna' => '#0000' . $i, // Tambahkan nilai $i
                'nama_warna' => $d[0] // Karena $d adalah array dengan satu elemen, gunakan $d[0]
            ]);
            $i++; // Increment $i setiap iterasi
        }
    } */

    public function run()
    {
        $csvFile = storage_path('import/data-warna.csv');

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

                    $dataMerek = DataMerek::where('kode_merek', $data['kode_merek'])->get()->first();

                    $dataWarna = DataWarna::create([
                        'kode_warna' => $data['kode_warna'],
                        'nama_warna' => $data['nama_warna'],
                        'id_merek' => $dataMerek->id,
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
