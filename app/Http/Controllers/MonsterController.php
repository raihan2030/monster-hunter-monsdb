<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function show(Monster $monster)
    {
        // 1. Ambil semua relasi series beserta data pivot & relasi typenya
        $monster->load(['series', 'type']);

        // 2. Cek apakah ada parameter 'series' dari halaman sebelumnya
        $activeSeriesSlug = request('series');

        // 3. Tentukan game mana yang menjadi default tampilan pertama kali
        $activeSeries = $monster->series->firstWhere('slug', $activeSeriesSlug)
            ?? $monster->series->first(); // fallback ke game pertama jika tidak ada parameter

        return view('monster-detail', [
            'monster' => $monster,
            'activeSeries' => $activeSeries
        ]);
    }
}
