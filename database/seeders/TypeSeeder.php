<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $jsonPath = database_path('data/monsters.json');
        $jsonContent = File::get($jsonPath);
        $data = json_decode($jsonContent, true);
        $types = array_unique(array_column($data['monsters'], 'type'));

        foreach ($types as $typeName) {
            if (!empty($typeName)) {
                Type::firstOrCreate([
                    'slug' => $typeName == '???' ? 'unknown' : Str::slug($typeName)
                ], [
                    'name' => $typeName
                ]);
            }
        }
    }
}
