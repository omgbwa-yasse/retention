<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('chat_types')->insert([
            ['type' => 'individual'],
            ['type' => 'group'],
        ]);
    }
}
