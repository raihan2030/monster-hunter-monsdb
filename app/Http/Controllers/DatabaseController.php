<?php

namespace App\Http\Controllers;

use App\Models\Series;
use App\Models\Type;
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

    public function index()
    {
        return view('database', [
            'mainSeriesNav' => $this->mainSeriesNav,
            'spinOffNav' => $this->spinOffNav
        ]);
    }

    public function show(Series $series, Request $request)
    {
        $monsters = $series->monsters()
            ->filter(request(['search', 'size', 'type']))->orderBy('asc')->paginate(15)->withQueryString();

        return view('database', [
            'series' => $series,
            'monsters' => $monsters,
            'types' => Type::orderBy('name')->get(),
            'mainSeriesNav' => $this->mainSeriesNav,
            'spinOffNav' => $this->spinOffNav
        ]);
    }
}
