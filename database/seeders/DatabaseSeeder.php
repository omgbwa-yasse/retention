<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use ArchiveSeeder;
use ChatTypeSeeder;
use CommunicabilitySeeder;
use ForumReactionTypeSeeder;
use Illuminate\Database\Seeder;
use OrderSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        $this->call([
            ArchiveSeeder::class,
            CommunicabilitySeeder::class,
            OrderSeeder::class,
            ForumReactionTypeSeeder::class,
            ChatTypeSeeder::class,
        ]);
    }
}
