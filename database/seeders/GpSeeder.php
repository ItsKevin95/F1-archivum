<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GpSeeder extends Seeder
{
    public function run(): void
    {
        $lines = file(database_path('seeders/data/gp.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        array_shift($lines); // fejléc

        $rows = [];
        foreach ($lines as $line) {
            [$datum, $nev, $helyszin] = explode("\t", $line);
            $rows[] = [
                'datum' => str_replace('.', '-', $datum), // 1994.05.15 -> 1994-05-15
                'nev' => trim($nev),
                'helyszin' => trim($helyszin),
            ];
        }
        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('gp')->insert($chunk);
        }
    }
}
