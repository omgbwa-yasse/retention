<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ArchiveSeeder;
use Database\Seeders\ChatTypeSeeder;
use Database\Seeders\CommunicabilitySeeder;
use Database\Seeders\ForumReactionTypeSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\OrderSeeder;

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
