<?php

namespace Database\Seeders;

use App\Models\Monster;
use App\Models\Series;
use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

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

        // CACHE: Ambil semua ID Type dan Series ke dalam Array
        // Formatnya akan menjadi ['Flying Wyvern' => 1, 'Bird Wyvern' => 2, ...]
        $typesMap = Type::pluck('id', 'name');
        $seriesMap = Series::pluck('id', 'name');

        foreach ($monsters as $monsterData) {

            // 1. Simpan data monster (Ubah 'type' menjadi 'type_id')
            $monster = Monster::create([
                'mongo_id'   => $monsterData['_id']['$oid'] ?? null,
                'name'       => $monsterData['name'],
                'type_id'    => $typesMap[$monsterData['type']] ?? null, // Ambil ID dari mapping
                'isLarge'    => $monsterData['isLarge'] ?? false,
                'subSpecies' => $monsterData['subSpecies'] ?? [],
                'elements'   => $monsterData['elements'] ?? [],
                'ailments'   => $monsterData['ailments'] ?? [],
                'weakness'   => $monsterData['weakness'] ?? [],
            ]);

            // 2. Relasikan dengan tabel Series menggunakan ID hasil mapping
            if (isset($monsterData['games'])) {
                $pivotData = [];

                foreach ($monsterData['games'] as $gameData) {
                    $gameName = $gameData['game'];

                    // Pastikan Series ditemukan di mapping agar tidak error
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

                // Gunakan fungsi sync() untuk memasukkan data ke tabel monster_series secara bersamaan
                if (!empty($pivotData)) {
                    $monster->series()->sync($pivotData);
                }
            }
        }
    }
}
