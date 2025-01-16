<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _01CameroonReferenceTableSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertion des références
        $references = [
            [
                'id' => 1,
                'name' => 'Loi Archives 2024/01',
                'description' => 'Loi régissant la conservation et l\'accès aux archives publiques qui définit les délais et les conditions de conservation allant de 30 à 150 ans selon le type de document.',
                'category_id' => 1,
                'country_id' => 1,
            ],
            [
                'id' => 2,
                'name' => 'OHADA',
                'description' => 'Organisation pour l\'Harmonisation en Afrique du Droit des Affaires imposant la conservation des livres comptables et pièces justificatives pendant 10 ans.',
                'category_id' => 1,
                'country_id' => 1,
            ],
            [
                'id' => 3,
                'name' => 'CIMA (Assurances)',
                'description' => 'Code des Assurances imposant aux compagnies d\'assurances la conservation pendant 10 ans des documents contractuels, comptables et correspondances.',
                'category_id' => 1,
                'country_id' => 1,
            ],
        ];

        DB::table('references')->insert($references);

        // Insertion des articles
        $now = Carbon::now();
        $articles = [
            [
                'code' => 'ART21-2',
                'name' => 'Archives publiques standard',
                'description' => 'Délai général de 30 ans pour la consultation des archives relatives aux délibérations gouvernementales, relations extérieures, monnaie, affaires nationales, etc.',
                'reference_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART22-A',
                'name' => 'Dossiers médicaux',
                'description' => 'Conservation des documents comportant des renseignements médicaux individuels pendant 150 ans à compter de la date de naissance.',
                'reference_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART22-B',
                'name' => 'Dossiers du personnel',
                'description' => 'Conservation des dossiers de personnel pendant 120 ans à compter de la date de naissance.',
                'reference_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART22-C',
                'name' => 'Documents judiciaires et notariaux',
                'description' => 'Conservation pendant 100 ans des documents judiciaires, notariaux, état civil, enquêtes policières et documents de renseignement.',
                'reference_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART22-D',
                'name' => 'Documents sensibles État',
                'description' => 'Conservation pendant 60 ans des documents relatifs à la sûreté de l\'État, défense nationale, sécurité publique et vie privée.',
                'reference_id' => 1,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART24',
                'name' => 'Documents comptables',
                'description' => 'Conservation pendant 10 ans des livres comptables et pièces justificatives.',
                'reference_id' => 2,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART28-1',
                'name' => 'Contrats d\'assurance non réclamés',
                'description' => 'Conservation pendant 10 ans minimum des informations et documents relatifs aux contrats transmis à la caisse de dépôt.',
                'reference_id' => 3,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART76',
                'name' => 'Contrats d\'assurance-vie',
                'description' => 'Règles sur l\'indemnité de rachat pendant 10 ans à compter de la date d\'effet du contrat.',
                'reference_id' => 3,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART404',
                'name' => 'Documents comptables assurance',
                'description' => 'Conservation pendant 10 ans des livres comptables, correspondances et pièces justificatives des entreprises d\'assurance.',
                'reference_id' => 3,
                'user_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('reference_articles')->insert($articles);
    }

}
