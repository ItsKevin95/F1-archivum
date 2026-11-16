<?php

namespace App\Http\Controllers;

use App\Models\Eredmeny;
use App\Models\Gp;
use App\Models\Pilota;

class FooldalController extends Controller
{
    public function index()
    {
        $statisztika = [
            'nagydijak'  => Gp::count(),
            'pilotak'    => Pilota::count(),
            'eredmenyek' => Eredmeny::count(),
            'tol'        => substr(Gp::min('datum'), 0, 4),
            'ig'         => substr(Gp::max('datum'), 0, 4),
        ];

        // Az 5 legtöbb futamgyőzelmet szerzett pilóta
        $legjobbak = Pilota::withCount(['eredmenyek as gyozelmek' => fn ($q) => $q->where('helyezes', 1)])
            ->orderByDesc('gyozelmek')
            ->limit(5)
            ->get();

        // A 4 legutóbbi, eredménnyel rendelkező nagydíj a győztesével
        $legutobbiak = Gp::whereHas('eredmenyek')
            ->with(['eredmenyek' => fn ($q) => $q->where('helyezes', 1)->with('pilota')])
            ->orderByDesc('datum')
            ->limit(4)
            ->get();

        return view('fooldal', compact('statisztika', 'legjobbak', 'legutobbiak'));
    }
}
