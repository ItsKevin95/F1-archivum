<?php

namespace App\Http\Controllers;

use App\Models\Uzenet;
use Illuminate\Http\Request;

class KapcsolatController extends Controller
{
    public function create()
    {
        return view('kapcsolat');
    }

    public function store(Request $request)
    {
        // Szerver oldali validáció
        $adatok = $request->validate([
            'nev'    => 'required|string|min:3|max:100',
            'email'  => 'required|email|max:150',
            'targy'  => 'required|string|min:3|max:150',
            'uzenet' => 'required|string|min:10|max:2000',
        ], [
            'required' => 'A(z) :attribute megadása kötelező.',
            'email'    => 'Kérjük, érvényes e-mail címet adjon meg.',
            'min'      => 'A(z) :attribute legalább :min karakter legyen.',
            'max'      => 'A(z) :attribute legfeljebb :max karakter lehet.',
        ], [
            'nev'    => 'név',
            'email'  => 'e-mail cím',
            'targy'  => 'tárgy',
            'uzenet' => 'üzenet',
        ]);

        // Mentés az adatbázisba
        Uzenet::create($adatok);

        return redirect()->route('kapcsolat')->with('siker', 'Köszönjük! Üzenetét megkaptuk, hamarosan válaszolunk.');
    }
}
