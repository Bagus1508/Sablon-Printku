<?php

namespace Database\Seeders;

use App\Models\DataUkuran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $data = [
        ['Small', 'S'],
        ['Medium', 'M'],
        ['Large', 'L'],
        ['Xtra Large', 'XL'],
        ['30', '30'],
        ['32', '32'],
        ['34', '34'],
        ['36', '36'],
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
            DataUkuran::create([
                'nama_ukuran' => $d[0], 
                'singkatan_ukuran' => $d[1]
            ]);
            $i++; // Increment $i setiap iterasi
        }
    }
}
