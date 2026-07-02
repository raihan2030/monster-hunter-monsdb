<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\Series;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalMonsters = Monster::count();
        $totalSpinOffs   = Series::where('type', 'spin-off')->count();
        $totalMainSeries = Series::where('type', 'main')->count();

        $mainSeriesGrid = Series::where('type', 'main')
            ->whereNotNull('image_path')
            ->orderBy('release_year', 'asc')
            ->get();

        $spinOffGrid = Series::where('type', 'spin-off')
            ->whereNotNull('image_path')
            ->orderBy('release_year', 'asc')
            ->get();

        $title = 'Home Page';

        return view('home', compact('totalMonsters', 'totalMainSeries', 'totalSpinOffs', 'mainSeriesGrid', 'spinOffGrid', 'title'));
    }
}
