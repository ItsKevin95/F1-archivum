<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EredmenySeeder extends Seeder
{
    public function run(): void
    {
        $lines = file(database_path('seeders/data/eredmeny.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        array_shift($lines); // fejléc

        $rows = [];
        foreach ($lines as $line) {
            [$datum, $pilotaaz, $helyezes, $hiba, $csapat, $tipus, $motor] = explode("\t", $line);
            $rows[] = [
                'datum' => str_replace('.', '-', trim($datum)),
                'pilotaaz' => (int) $pilotaaz,
                'helyezes' => trim($helyezes) === '' ? null : (int) $helyezes,
                'hiba' => trim($hiba) === '' ? null : trim($hiba),
                'csapat' => trim($csapat) === '' ? null : trim($csapat),
                'tipus' => trim($tipus),
                'motor' => trim($motor),
            ];
        }
        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('eredmeny')->insert($chunk);
        }
    }
}
