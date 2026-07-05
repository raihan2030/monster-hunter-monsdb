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
            ->orderBy('release_year')
            ->get();

        $this->spinOffNav = Series::where('type', 'spin-off')
            ->whereNotNull('acronym')
            ->orderBy('release_year')
            ->get();
    }

    public function show(Series $series, Request $request)
    {
        $monsters = $series->monsters();

        $type_ids = $monsters->pluck('type_id')->unique()->toArray();
        $types = Type::whereIn('id', $type_ids)->orderBy('name')->get();

        $title = 'Monster Database';

        return view('database', [
            'series' => $series,
            'monsters' => $monsters->filter(request(['search', 'size', 'type']))
                ->orderBy('name')->paginate(15)->withQueryString(),
            'types' => $types,
            'mainSeriesNav' => $this->mainSeriesNav,
            'spinOffNav' => $this->spinOffNav,
            'title' => $title
        ]);
    }
}
