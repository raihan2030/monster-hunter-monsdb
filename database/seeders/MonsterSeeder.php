<?php

namespace Database\Seeders;

use App\Models\Monster;
use App\Models\Series;
use App\Models\Type;
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

        $typesMap = Type::pluck('id', 'name');
        $seriesMap = Series::pluck('id', 'name');

        foreach ($monsters as $monsterData) {

            $monster = Monster::create([
                'mongo_id'   => $monsterData['_id']['$oid'] ?? null,
                'slug'       => Str::slug($monsterData['name']),
                'name'       => $monsterData['name'],
                'type_id'    => $typesMap[$monsterData['type']] ?? null,
                'isLarge'    => $monsterData['isLarge'] ?? false,
                'subSpecies' => $monsterData['subSpecies'] ?? [],
                'elements'   => $monsterData['elements'] ?? [],
                'ailments'   => $monsterData['ailments'] ?? [],
                'weakness'   => $monsterData['weakness'] ?? [],
            ]);

            if (isset($monsterData['games'])) {
                $pivotData = [];

                foreach ($monsterData['games'] as $gameData) {
                    $gameName = $gameData['game'];

                    if (isset($seriesMap[$gameName])) {
                        $seriesId = $seriesMap[$gameName];

                        // Siapkan array untuk Bulk Insert
                        $pivotData[$seriesId] = [
                            'image'  => $gameData['image'] ?? null,
                            'info'   => $gameData['info'] ?? null,
                            'danger' => $gameData['danger'] ?? null,
                        ];
                    }
                }

                if (!empty($pivotData)) {
                    $monster->series()->sync($pivotData);
                }
            }
        }
    }
}
