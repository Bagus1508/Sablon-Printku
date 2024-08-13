<?php

namespace Database\Seeders;

use App\Models\Pajak;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            LevelUser::class,
            UserSeeder::class,
            KategoriSeeder::class,
            MerekSeeder::class,
            WarnaSeeder::class,
            SatuanSeeder::class,
            UkuranSeeder::class,
            PerusahaanSeeder::class,
            EkspedisiSeeder::class,
            RegionSeeder::class,
            BahanKainSeeder::class,
            /* BahanBakuSeeder::class,
            KontrakRinciSeeder::class, */
        ]);

        $dataPajak = Pajak::create([
            'ppn' => 11,
        ]);
    }
}
