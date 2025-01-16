<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class _02IvoryCoastRulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Insertion des règles de conservation
        $rules = [
            [
                'id' => 10,
                'code' => 'CIV001',
                'name' => 'Documents comptables OHADA CIV',
                'description' => 'Conservation des livres comptables, pièces justificatives et documents connexes selon l\'Acte uniforme OHADA.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 24,
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 11,
                'code' => 'CIV002',
                'name' => 'Documents électroniques',
                'description' => 'Conservation des documents sous forme électronique avec garantie d\'intégrité et d\'authenticité selon la loi 2013-546.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 24,
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 12,
                'code' => 'CIV003',
                'name' => 'Documents administratifs communicables',
                'description' => 'Conservation des documents administratifs communicables (rapports, études, comptes rendus, statistiques, etc.)',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 24,
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 13,
                'code' => 'CIV004',
                'name' => 'Documents sensibles État',
                'description' => 'Conservation des documents relatifs à la sûreté de l\'État, défense nationale et sécurité publique.',
                'duration' => 30,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 24,
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 14,
                'code' => 'CIV005',
                'name' => 'Archives électroniques longue durée',
                'description' => 'Conservation des documents électroniques nécessitant un Système d\'Archivage Électronique (SAE) pour une durée supérieure à 10 ans.',
                'duration' => 30,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 24,
                'user_id' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('rules')->insert($rules);

        // Insertion des relations entre articles et règles
        $ruleArticles = [
            // OHADA
            ['article_id' => 10, 'rule_id' => 8], // ART24-CI -> Documents comptables

            // Loi transactions électroniques
            ['article_id' => 11, 'rule_id' => 9], // ART40-TE -> Documents électroniques
            ['article_id' => 12, 'rule_id' => 9], // ART40-TE-COND -> Conditions conservation
            ['article_id' => 13, 'rule_id' => 9], // ART41-TE -> Garantie authenticité
            ['article_id' => 14, 'rule_id' => 9], // ART43-TE -> Documents numériques

            // Loi accès information publique
            ['article_id' => 15, 'rule_id' => 10], // ART6-IP -> Documents communicables
            ['article_id' => 16, 'rule_id' => 11], // ART7-IP -> Documents sensibles

            // R2GAP
            ['article_id' => 17, 'rule_id' => 12], // R2GAP-GED -> Gestion électronique
            ['article_id' => 18, 'rule_id' => 12]  // R2GAP-SAE -> Archivage longue durée
        ];

        DB::table('rule_articles')->insert($ruleArticles);
    }
}

