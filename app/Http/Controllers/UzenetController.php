<?php

namespace App\Http\Controllers;

use App\Models\Uzenet;

class UzenetController extends Controller
{
    public function index()
    {
        // Fordított időrend: a legfrissebb üzenet van elöl
        $uzenetek = Uzenet::orderByDesc('created_at')->orderByDesc('id')->paginate(15);

        return view('uzenetek', compact('uzenetek'));
    }
}
