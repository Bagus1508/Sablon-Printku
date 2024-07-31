<?php

namespace Database\Seeders;

use App\Models\DataSatuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $data = [
        ['Meter', 'm'],
        ['Yard', 'yd'],
        ['Pieces', 'pcs'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1; // Mulai dari 1
        foreach($this->data as $d) {
            DataSatuan::create([
                'nama_satuan' => $d[0], 
                'singkatan' => $d[1]
            ]);
            $i++; // Increment $i setiap iterasi
        }
    }
}
