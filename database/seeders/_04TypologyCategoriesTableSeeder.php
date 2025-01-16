<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class _04TypologyCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['id' => 1, 'name' => 'Administratif', 'description' => 'Catégorie des typologies administratives','user_id' => 1],
            ['id' => 2, 'name' => 'Technique', 'description' => 'Catégorie des typologies techniques','user_id' => 1],
            ['id' => 3, 'name' => 'Communication', 'description' => 'Catégorie des typologies de communication','user_id' => 1]
        ];

        DB::table('typology_categories')->insert($categories);
    }
}
