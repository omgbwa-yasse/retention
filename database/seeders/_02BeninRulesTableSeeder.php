<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _02BeninRulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Insertion des règles de conservation
        $rules = [
            [
                'id' => 20,
                'code' => 'BEN001',
                'name' => 'Documents constitutifs',
                'description' => 'Conservation des statuts, documents de création et documents historiques selon décret n°2007-532.',
                'duration' => 0, // Conservation illimitée
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 21,
                'code' => 'BEN002',
                'name' => 'Documents administratifs courants',
                'description' => 'Conservation des correspondances, bordereaux, registres et documents administratifs courants.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 2, // Tri sélectif
                'status_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 22,
                'code' => 'BEN003',
                'name' => 'Documents comptables',
                'description' => 'Conservation des factures, pièces justificatives et documents comptables selon normes OHADA.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 3, // Destruction
                'status_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 23,
                'code' => 'BEN004',
                'name' => 'Documents du personnel',
                'description' => 'Conservation des dossiers individuels des employés selon code du travail.',
                'duration' => 75,
                'trigger_id' => 2, // A compter de la date de naissance
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 24,
                'code' => 'BEN005',
                'name' => 'Documents de crédit',
                'description' => 'Conservation des dossiers de crédit selon loi n°2012 sur les SFD.',
                'duration' => 15,
                'trigger_id' => 3, // A compter de la clôture
                'sort_id' => 3,
                'status_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('rules')->insert($rules);

        // Insertion des relations entre articles et règles
        $ruleArticles = [
            // Décret 2007-532
            ['article_id' => 1, 'rule_id' => 20], // Documents constitutifs
            ['article_id' => 2, 'rule_id' => 21], // Documents administratifs

            // Loi n°2012 SFD
            ['article_id' => 3, 'rule_id' => 24], // Dossiers de crédit

            // OHADA
            ['article_id' => 4, 'rule_id' => 22], // Documents comptables

            // Code du travail
            ['article_id' => 5, 'rule_id' => 23], // Dossiers du personnel

            // Loi 2017-20 numérique
            ['article_id' => 6, 'rule_id' => 21], // Documents électroniques

            // ISO 15489
            ['article_id' => 7, 'rule_id' => 21] // Gestion documentaire
        ];

        DB::table('rule_articles')->insert($ruleArticles);
    }
}

