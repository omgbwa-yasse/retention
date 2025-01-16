<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _02GabonRulesTableSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Insertion des règles de conservation
        $rules = [
            [
                'id' => 15,
                'code' => 'GAB001',
                'name' => 'Documents administratifs généraux',
                'description' => 'Conservation des documents administratifs généraux selon la loi n°009/2006 relative aux archives.',
                'duration' => 30,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 16,
                'code' => 'GAB002',
                'name' => 'Documents comptables',
                'description' => 'Conservation des documents comptables (grand livre, journaux, factures) selon la circulaire N°6.',
                'duration' => 10,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 17,
                'code' => 'GAB003',
                'name' => 'Documents sensibles État',
                'description' => 'Conservation des documents relatifs à la défense nationale, sûreté nationale et procédures judiciaires.',
                'duration' => 50,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 18,
                'code' => 'GAB004',
                'name' => 'Documents médicaux et notariés',
                'description' => 'Conservation des documents médicaux, dossiers professionnels, minutes des notaires et registres d\'état civil.',
                'duration' => 100,
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 19,
                'code' => 'GAB005',
                'name' => 'Documents sociaux permanents',
                'description' => 'Conservation des registres sociaux, documents de personnel et documents constitutifs de l\'organisation.',
                'duration' => 0, // 0 indique une conservation illimitée
                'trigger_id' => 1,
                'sort_id' => 1,
                'status_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];

        DB::table('rules')->insert($rules);

        // Insertion des relations entre articles et règles
        $ruleArticles = [
            // Loi archives
            ['article_id' => 19, 'rule_id' => 15], // ART15-ARC -> Documents administratifs
            ['article_id' => 20, 'rule_id' => 15], // ART34-ARC -> Versement archives
            ['article_id' => 21, 'rule_id' => 17], // ART41-ARC -> Documents sensibles

            // Loi données personnelles
            ['article_id' => 22, 'rule_id' => 15], // ART68-DCP -> Conservation données
            ['article_id' => 23, 'rule_id' => 15], // ART70-DCP -> Pérennité

            // Circulaire conservation
            ['article_id' => 24, 'rule_id' => 16], // CIRC6-COMPT -> Documents comptables
            ['article_id' => 25, 'rule_id' => 19], // CIRC6-SOC -> Documents sociaux

            // Décret archives
            ['article_id' => 26, 'rule_id' => 15], // ART40-ARC -> Conservation physique
            ['article_id' => 27, 'rule_id' => 15]  // ART66-DCP -> Sécurité données
        ];

        DB::table('rule_articles')->insert($ruleArticles);
    }
}
