<?php

namespace App\Http\Controllers;

use App\Models\Pilota;
use Illuminate\Http\Request;

class PilotaController extends Controller
{
    private function szabalyok(): array
    {
        return [
            'nev'     => 'required|string|min:3|max:100',
            'nem'     => 'required|in:F,N',
            'szuldat' => 'nullable|date|before:today',
            'nemzet'  => 'required|string|min:2|max:50',
        ];
    }

    private function uzenetek(): array
    {
        return [
            'required' => 'A(z) :attribute megadása kötelező.',
            'in'       => 'A(z) :attribute értéke F vagy N lehet.',
            'date'     => 'Érvényes dátumot adjon meg.',
            'before'   => 'A születési dátum múltbeli legyen.',
            'min'      => 'A(z) :attribute legalább :min karakter legyen.',
            'max'      => 'A(z) :attribute legfeljebb :max karakter lehet.',
        ];
    }

    private function elnevezesek(): array
    {
        return ['nev' => 'név', 'nem' => 'nem', 'szuldat' => 'születési dátum', 'nemzet' => 'nemzetiség'];
    }

    // READ – lista (keresés névre, szűrés nemzetiségre)
    public function index(Request $request)
    {
        $pilotak = Pilota::withCount('eredmenyek')
            ->when($request->filled('keres'), fn ($q) => $q->where('nev', 'like', '%'.$request->keres.'%'))
            ->when($request->filled('nemzet'), fn ($q) => $q->where('nemzet', $request->nemzet))
            ->orderBy('nev')
            ->paginate(15)
            ->withQueryString();

        $nemzetek = Pilota::distinct()->orderBy('nemzet')->pluck('nemzet');

        return view('crud.index', compact('pilotak', 'nemzetek'));
    }

    // CREATE – űrlap
    public function create()
    {
        return view('crud.create');
    }

    // CREATE – mentés
    public function store(Request $request)
    {
        $adatok = $request->validate($this->szabalyok(), $this->uzenetek(), $this->elnevezesek());
        Pilota::create($adatok);

        return redirect()->route('crud.index')->with('siker', 'A pilóta sikeresen felvéve.');
    }

    // UPDATE – űrlap
    public function edit(Pilota $pilota)
    {
        return view('crud.edit', compact('pilota'));
    }

    // UPDATE – mentés
    public function update(Request $request, Pilota $pilota)
    {
        $adatok = $request->validate($this->szabalyok(), $this->uzenetek(), $this->elnevezesek());
        $pilota->update($adatok);

        return redirect()->route('crud.index')->with('siker', 'A pilóta adatai módosítva lettek.');
    }

    // DELETE (az eredményei is törlődnek, idegen kulcs: cascade)
    public function destroy(Pilota $pilota)
    {
        $pilota->delete();

        return redirect()->route('crud.index')->with('siker', 'A pilóta törölve lett.');
    }
}
