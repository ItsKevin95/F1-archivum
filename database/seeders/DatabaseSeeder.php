<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GpSeeder::class,        // előbb a nagydíjak és a pilóták,
            PilotaSeeder::class,
            EredmenySeeder::class,  // végül az eredmények (idegen kulcsok rájuk)
        ]);
    }
}
