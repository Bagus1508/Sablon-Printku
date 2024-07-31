<?php

namespace Database\Seeders;

use App\Models\DataWarna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $data = [
        ['Putih'],
        ['Navy'],
        ['Biru'],
        ['Coklat'],
        ['Maroon'],
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
            DataWarna::create([
                'kode_warna' => '#0000' . $i, // Tambahkan nilai $i
                'nama_warna' => $d[0] // Karena $d adalah array dengan satu elemen, gunakan $d[0]
            ]);
            $i++; // Increment $i setiap iterasi
        }
    }

}
