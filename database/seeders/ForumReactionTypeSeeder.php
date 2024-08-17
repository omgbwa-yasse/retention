<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumReactionTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('forum_reaction_types')->insert([
            ['name' => 'Like', 'url' => 'emoji/like.png'],
            ['name' => 'dislike', 'url' => 'emoji/love.png'],

        ]);
    }
}
