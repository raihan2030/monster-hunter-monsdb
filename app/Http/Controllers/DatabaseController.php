<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Models\Series;
use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    protected $mainSeriesNav;
    protected $spinOffNav;

    public function __construct()
    {
        $this->mainSeriesNav = Series::where('type', 'main')
            ->whereNotNull('acronym')
            ->orderBy('release_year', 'asc')
            ->get();

        $this->spinOffNav = Series::where('type', 'spin-off')
            ->whereNotNull('acronym')
            ->orderBy('release_year', 'asc')
            ->get();
    }

    // public function index()
    // {
    //     $mainSeriesNav = $this->mainSeriesNav;
    //     $spinOffNav = $this->spinOffNav;

    //     return view('series', compact('mainSeriesNav', 'spinOffNav'));
    // }

    public function index()
    {
        $monsters = null;
        $keyword = request('search');

        if ($keyword) {
            $monsters = Monster::with('series')
                ->filter(request(['search']))
                ->orderBy('name', 'asc')
                ->paginate(15)
                ->withQueryString();
        }

        return view('series', [
            'mainSeriesNav' => $this->mainSeriesNav,
            'spinOffNav'    => $this->spinOffNav,
            'monsters'      => $monsters,
            'keyword'       => $keyword
        ]);
    }

    public function show(Series $series)
    {
        $series->load('monsters');

        return view('series', [
            'series'        => $series,
            'mainSeriesNav' => $this->mainSeriesNav,
            'spinOffNav'    => $this->spinOffNav
        ]);
    }
}
