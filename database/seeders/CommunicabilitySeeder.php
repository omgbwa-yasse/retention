<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunicabilitySeeder extends Seeder
{
    public function run()
    {
        DB::table('communicabilities')->insert([
            ['code' => 'PUB', 'name' => 'Public', 'description' => 'Accessible à tous'],
            ['code' => 'RES', 'name' => 'Restreint', 'description' => 'Accès limité à certains utilisateurs'],
            ['code' => 'CON', 'name' => 'Confidentiel', 'description' => 'Accès très limité'],
            ['code' => 'SEC', 'name' => 'Secret', 'description' => 'Accès hautement restreint'],
        ]);
    }
}
