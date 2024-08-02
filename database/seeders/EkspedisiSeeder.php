<?php

namespace Database\Seeders;

use App\Models\DataEkspedisi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EkspedisiSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    protected $data = [
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
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) {
            $perusahaan = DataEkspedisi::create([
                'nama_ekspedisi' => $d[0], 
                'kode_ekspedisi' => $d[1],
            ]);
        }
    }
}
