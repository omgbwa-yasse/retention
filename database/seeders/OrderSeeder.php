<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            ['name' => 'Alphabétique', 'description' => 'A-Z'],
            ['name' => 'Chronologique', 'description' => 'Date'],
            ['name' => 'Numérique', 'description' => '0-9'],
            ['name' => 'Thématique', 'description' => 'Sujet'],
        ]);
    }
}
