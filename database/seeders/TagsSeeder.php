<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/tags.csv');
        $csvData = array_map('str_getcsv', file($path));
        $tags = [];
        foreach ($csvData as $row) {
            $tags[] = [
                'id' => $row[0],
                'name' => $row[1],
                'background_color' => $row[2],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('tags')->insert($tags);
    }
}
