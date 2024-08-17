<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Assurez-vous d'importer le modèle User

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Créer un utilisateur pour les références
        $user = User::factory()->create([
            'gender' => 'Male', // Ajoutez le champ gender ici
            'country_id' => 1, // Ajoutez le champ country_id ici
        ]);

        // Insertion des données dans la table orders avec user_id
        DB::table('orders')->insert([
            ['name' => 'Alphabétique', 'description' => 'A-Z', 'user_id' => $user->id],
            ['name' => 'Chronologique', 'description' => 'Date', 'user_id' => $user->id],
            ['name' => 'Numérique', 'description' => '0-9', 'user_id' => $user->id],
            ['name' => 'Thématique', 'description' => 'Sujet', 'user_id' => $user->id],
        ]);
    }
}
