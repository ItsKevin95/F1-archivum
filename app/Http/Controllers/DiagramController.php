<?php

namespace App\Http\Controllers;

use App\Models\Eredmeny;
use App\Models\Gp;
use App\Models\Pilota;

class DiagramController extends Controller
{
    public function index()
    {
        // 1) A 10 legtöbb futamgyőzelmet szerzett pilóta
        $gyoztesek = Pilota::withCount(['eredmenyek as gyozelmek' => fn ($q) => $q->where('helyezes', 1)])
            ->orderByDesc('gyozelmek')
            ->limit(10)
            ->get();

        // 2) Nagydíjak száma évenként
        $evenkent = Gp::pluck('datum')
            ->groupBy(fn ($d) => substr($d, 0, 4))
            ->map->count()
            ->sortKeys();

        // 3) Kiesések okai (a 8 leggyakoribb)
        $hibak = Eredmeny::whereNotNull('hiba')
            ->selectRaw('hiba, count(*) as db')
            ->groupBy('hiba')
            ->orderByDesc('db')
            ->limit(8)
            ->get();

        $diagramok = [
            'gyoztesek' => ['cimkek' => $gyoztesek->pluck('nev')->all(), 'ertekek' => $gyoztesek->pluck('gyozelmek')->all()],
            'evenkent'  => ['cimkek' => $evenkent->keys()->all(), 'ertekek' => $evenkent->values()->all()],
            'hibak'     => ['cimkek' => $hibak->pluck('hiba')->all(), 'ertekek' => $hibak->pluck('db')->all()],
        ];

        return view('diagram', compact('diagramok'));
    }
}
