<?php

namespace Database\Seeders;

use App\Models\UserLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $data = [
        ['Super Admin'],
        ['Mid Admin'],
        ['Admin'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach($this->data as $d) {
            $i=0;
            UserLevel::create([
                'level' => $d[$i]
            ]);
            $i++;
        }
    }
}
