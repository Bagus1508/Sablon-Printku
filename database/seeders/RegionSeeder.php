<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    protected $data = [
        ['UP 1'],
        ['UP 2'],
        ['UP 3'],
        ['UP 4'],
        ['UP 5'],
        ['UP 6'],
        ['UP 7'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $d) {
            $region = Region::create([
                'nama_region' => $d[0], 
            ]);
        }
    }
}
