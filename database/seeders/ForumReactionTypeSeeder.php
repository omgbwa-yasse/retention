<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ForumReactionTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('forum_reaction_types')->insert([
            ['name' => 'Like', 'url' => 'emoji/like.png'],
            ['name' => 'Love', 'url' => 'emoji/love.png'],
            ['name' => 'Haha', 'url' => 'emoji/haha.png'],
            ['name' => 'Wow', 'url' => 'emoji/wow.png'],
            ['name' => 'Sad', 'url' => 'emoji/sad.png'],
            ['name' => 'Angry', 'url' => 'emoji/angry.png'],
        ]);
    }
}
