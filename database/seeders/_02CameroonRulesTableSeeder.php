<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _02CameroonRulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $now = Carbon::now();

        // Insertion des règles de conservation
        $rules = [
            [
                'id' => 1,
                'code' => '00001',
                'name' => 'Archives administratives standard',
                'description' => 'Conservation des documents relatifs aux délibérations gouvernementales, relations extérieures et affaires nationales.',
                'duration' => 30,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 2,
                'code' => '00002',
                'name' => 'Dossiers médicaux',
                'description' => 'Conservation des documents médicaux individuels à partir de la date de naissance.',
                'duration' => 150,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 3,
                'code' => '00003',
                'name' => 'Dossiers du personnel',
                'description' => 'Conservation des documents relatifs à la carrière des employés à partir de leur date de naissance.',
                'duration' => 120,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 4,
                'code' => '00004',
                'name' => 'Documents judiciaires',
                'description' => 'Conservation des documents juridiques, actes notariés, état civil et enquêtes.',
                'duration' => 100,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 5,
                'code' => '00005',
                'name' => 'Documents sensibles État',
                'description' => 'Conservation des documents relatifs à la sûreté de l\'État et à la sécurité publique.',
                'duration' => 60,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 6,
                'code' => '00006',
                'name' => 'Documents comptables',
                'description' => 'Conservation des livres comptables et pièces justificatives selon normes OHADA.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 7,
                'code' => '00007',
                'name' => 'Contrats d\'assurance',
                'description' => 'Conservation des contrats d\'assurance et documents associés selon code CIMA.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('rules')->insert($rules);

        // Insertion des relations entre articles et règles
        $ruleArticles = [
            // Loi Archives
            ['article_id' => 1, 'rule_id' => 1], // ART21-2 -> Archives standard
            ['article_id' => 2, 'rule_id' => 2], // ART22-A -> Dossiers médicaux
            ['article_id' => 3, 'rule_id' => 3], // ART22-B -> Dossiers personnel
            ['article_id' => 4, 'rule_id' => 4], // ART22-C -> Documents judiciaires
            ['article_id' => 5, 'rule_id' => 5], // ART22-D -> Documents sensibles
            // OHADA
            ['article_id' => 6, 'rule_id' => 6], // ART24 -> Documents comptables
            // CIMA
            ['article_id' => 7, 'rule_id' => 7], // ART28-1 -> Contrats assurance
            ['article_id' => 8, 'rule_id' => 7], // ART76 -> Contrats assurance
            ['article_id' => 9, 'rule_id' => 7]  // ART404 -> Contrats assurance
        ];

        DB::table('rule_articles')->insert($ruleArticles);
    }

}
