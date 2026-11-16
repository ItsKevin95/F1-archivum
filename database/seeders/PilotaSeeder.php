<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PilotaSeeder extends Seeder
{
    public function run(): void
    {
        $lines = file(database_path('seeders/data/pilota.txt'), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        array_shift($lines); // fejléc

        $rows = [];
        foreach ($lines as $line) {
            [$az, $nev, $nem, $szuldat, $nemzet] = explode("\t", $line);
            $rows[] = [
                'az' => (int) $az,
                'nev' => trim($nev),
                'nem' => trim($nem),
                'szuldat' => $this->datum($szuldat),
                'nemzet' => trim($nemzet),
            ];
        }
        foreach (array_chunk($rows, 200) as $chunk) {
            DB::table('pilota')->insert($chunk);
        }
    }

    // "1911.6.24" -> "1911-06-24", üres érték -> null
    private function datum(string $szoveg): ?string
    {
        $szoveg = trim($szoveg);
        if ($szoveg === '') {
            return null;
        }
        [$ev, $ho, $nap] = array_map('intval', explode('.', $szoveg));

        return sprintf('%04d-%02d-%02d', $ev, $ho, $nap);
    }
}
