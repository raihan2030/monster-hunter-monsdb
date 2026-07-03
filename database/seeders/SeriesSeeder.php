<?php

namespace Database\Seeders;

use App\Models\Series;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $games = [
            'Monster Hunter Freedom Unite' => ['year' => 2008, 'acronym' => 'MHFU'],
            'Monster Hunter 3 Ultimate' => ['year' => 2011, 'acronym' => 'MH3U'],
            'Monster Hunter 4 Ultimate' => ['year' => 2014, 'acronym' => 'MH4U'],
            'Monster Hunter Generations Ultimate' => ['year' => 2017, 'acronym' => 'MHGU'],
            'Monster Hunter World' => ['year' => 2018, 'acronym' => 'MH World'],
            'Monster Hunter Rise' => ['year' => 2021, 'acronym' => 'MH Rise'],
            'Monster Hunter Wilds' => ['year' => 2025, 'acronym' => 'MH Wilds'],
            'Monster Hunter Stories' => ['year' => 2016, 'acronym' => 'MHST'],
            'Monster Hunter Stories 2' => ['year' => 2021, 'acronym' => 'MHST2'],
        ];

        foreach ($games as $name => $data) {
            $isSpinOff = str_contains($name, 'Stories');
            $slug = Str::slug($name);

            Series::firstOrCreate(
                ['name' => $name],
                [
                    'slug'         => $slug,
                    'acronym'      => $data['acronym'],
                    'type'         => $isSpinOff ? 'spin-off' : 'main',
                    'image_path'   => '/img/series-logo/' . $slug . '.jpg',
                    'release_year' => $data['year']
                ]
            );
        }
    }
}
