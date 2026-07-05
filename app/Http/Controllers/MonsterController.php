<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use Illuminate\Http\Request;

class MonsterController extends Controller
{
    public function show(Monster $monster)
    {
        $monster->load(['series', 'type']);

        $activeSeriesSlug = request('series');
        $activeSeries = $monster->series->firstWhere('slug', $activeSeriesSlug)
            ?? $monster->series->first();

        return view('monster-detail', [
            'monster' => $monster,
            'activeSeries' => $activeSeries
        ]);
    }
}
