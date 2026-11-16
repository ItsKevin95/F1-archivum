<?php

namespace App\Http\Controllers;

use App\Models\Eredmeny;
use App\Models\Gp;
use App\Models\Pilota;
use Illuminate\Http\Request;

class AdatbazisController extends Controller
{
    public function index(Request $request)
    {
        // Nagydíjak (szűrés helyszínre)
        $nagydijak = Gp::query()
            ->when($request->filled('helyszin'), fn ($q) => $q->where('helyszin', $request->helyszin))
            ->orderByDesc('datum')
            ->paginate(10, ['*'], 'gp_oldal')
            ->withQueryString();

        // Pilóták (szűrés nemzetiségre és névre)
        $pilotak = Pilota::query()
            ->withCount('eredmenyek')
            ->when($request->filled('nemzet'), fn ($q) => $q->where('nemzet', $request->nemzet))
            ->when($request->filled('keres'), fn ($q) => $q->where('nev', 'like', '%'.$request->keres.'%'))
            ->orderBy('nev')
            ->paginate(10, ['*'], 'pilota_oldal')
            ->withQueryString();

        // Eredmények (szűrés évre)
        $ev = (int) $request->input('ev');
        $eredmenyek = Eredmeny::with(['gp', 'pilota'])
            ->when($ev > 0, fn ($q) => $q->whereBetween('datum', ["$ev-01-01", "$ev-12-31"]))
            ->orderByDesc('datum')
            ->orderBy('id')
            ->paginate(15, ['*'], 'eredmeny_oldal')
            ->withQueryString();

        $helyszinek = Gp::distinct()->orderBy('helyszin')->pluck('helyszin');
        $nemzetek = Pilota::distinct()->orderBy('nemzet')->pluck('nemzet');
        $evek = Eredmeny::distinct()->pluck('datum')->map(fn ($d) => substr($d, 0, 4))->unique()->sortDesc()->values();

        return view('adatbazis', compact('nagydijak', 'pilotak', 'eredmenyek', 'helyszinek', 'nemzetek', 'evek'));
    }
}
