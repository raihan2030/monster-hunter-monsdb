<?php

namespace Database\Seeders;

use App\Models\Monster;
use App\Models\Series;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MonsterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/monsters.json');
        $jsonContent = File::get($jsonPath);
        $data = json_decode($jsonContent, true);
        $monsters = $data['monsters'];

        $releaseYears = [
            'Monster Hunter Freedom Unite' => 2008,
            'Monster Hunter 3 Ultimate' => 2011,
            'Monster Hunter 4 Ultimate' => 2014,
            'Monster Hunter Generations Ultimate' => 2017,
            'Monster Hunter World' => 2018,
            'Monster Hunter Rise' => 2021,
            'Monster Hunter Wilds' => 2025,
            'Monster Hunter Stories' => 2016,
            'Monster Hunter Stories 2' => 2021,
        ];

        $gameAcronym = [
            'Monster Hunter Freedom Unite' => 'MHFU',
            'Monster Hunter 3 Ultimate' => 'MH3U',
            'Monster Hunter 4 Ultimate' => 'MH4U',
            'Monster Hunter Generations Ultimate' => 'MHGU',
            'Monster Hunter World' => 'MH World',
            'Monster Hunter Rise' => 'MH Rise',
            'Monster Hunter Wilds' => 'MH Wilds',
            'Monster Hunter Stories' => 'MHST',
            'Monster Hunter Stories 2' => 'MHST2',
        ];

        foreach ($monsters as $monsterData) {
            // 1. Simpan data monster
            $monster = Monster::create([
                'mongo_id'   => $monsterData['_id']['$oid'] ?? null,
                'name'       => $monsterData['name'],
                'type'       => $monsterData['type'],
                'isLarge'    => $monsterData['isLarge'] ?? false,
                'subSpecies' => $monsterData['subSpecies'] ?? [],
                'elements'   => $monsterData['elements'] ?? [],
                'ailments'   => $monsterData['ailments'] ?? [],
                'weakness'   => $monsterData['weakness'] ?? [],
            ]);

            // 2. Relasikan dengan tabel Series
            if (isset($monsterData['games'])) {
                foreach ($monsterData['games'] as $gameData) {
                    $isSpinOff = str_contains($gameData['game'], 'Stories');
                    $type = $isSpinOff ? 'spin-off' : 'main';

                    $slug = Str::slug($gameData['game']);
                    $acronym = $gameAcronym[$gameData['game']] ?? null;
                    $imagePath = '/img/series-logo/' . Str::slug($gameData['game']) . '.jpg';
                    $year = $releaseYears[$gameData['game']] ?? null;

                    $series = Series::firstOrCreate(
                        ['name' => $gameData['game']],
                        [
                            'slug'         => $slug,
                            'acronym'      => $acronym,
                            'type'         => $type,
                            'image_path'   => $imagePath,
                            'release_year' => $year
                        ]
                    );

                    $monster->series()->attach($series->id, [
                        'image'  => $gameData['image'] ?? null,
                        'info'   => $gameData['info'] ?? null,
                        'danger' => $gameData['danger'] ?? null,
                    ]);
                }
            }
        }

        $this->command->info("Seeding database berhasil diselesaikan!");
    }
}
