<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _01BeninReferenceTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Insertion des références
        $references = [
            [
                'id' => 12,
                'name' => 'Décret n°2007-532 du 02 novembre 2007',
                'description' => 'Décret portant attributions, organisation et fonctionnement de la Direction des Archives Nationales',
                'category_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
            ],
            [
                'id' => 13,
                'name' => 'Loi n°2017-20 du 20 avril 2018',
                'description' => 'Code du numérique en République du Bénin',
                'category_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
            ],
            [
                'id' => 14,
                'name' => 'Loi n°2012 du 21 mars 2012',
                'description' => 'Réglementation des systèmes financiers décentralisés en République du Bénin',
                'category_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
            ],
            [
                'id' => 15,
                'name' => 'Norme ISO 15489-1:2001',
                'description' => 'Information et documentation - Records Management - Partie 1: Principes directeurs',
                'category_id' => 1,
                'country_id' => 4,
                'user_id' => 4,
            ]
        ];

        DB::table('references')->insert($references);

        // Insertion des articles
        $now = Carbon::now();
        $articles = [
            [
                'code' => 'DEC532-ARC',
                'name' => 'Définition des archives',
                'description' => 'Les archives sont l\'ensemble des documents, quels que soient la date, la nature, la forme ou le support matériel produits ou reçus par une personne publique ou privée dans le cadre de ses activités.',
                'reference_id' => 12,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DEC532-AGE',
                'name' => 'Principe des trois âges',
                'description' => 'Les archives suivent un cycle de vie en trois phases: archives courantes, archives intermédiaires et archives définitives.',
                'reference_id' => 12,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DEC532-ELI',
                'name' => 'Élimination des archives',
                'description' => 'L\'élimination doit respecter une procédure particulière et ne peut se faire qu\'avec l\'accord préalable des Archives Nationales du Bénin.',
                'reference_id' => 12,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'L2017-NUM',
                'name' => 'Conservation numérique',
                'description' => 'L\'archivage électronique doit garantir l\'authenticité, l\'intégrité, la fiabilité et l\'exploitabilité des documents sur toute leur durée de conservation.',
                'reference_id' => 13,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'L2012-DOC',
                'name' => 'Conservation documents financiers',
                'description' => 'Les pièces justificatives et documents comptables doivent être conservés pendant 10 ans à compter de la clôture de l\'exercice.',
                'reference_id' => 14,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ISO15489-1',
                'name' => 'Records management',
                'description' => 'Ensemble des mesures destinées à rationaliser la production, le tri, la conservation et l\'utilisation des archives courantes et intermédiaires.',
                'reference_id' => 15,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DEC532-COM',
                'name' => 'Communication des archives',
                'description' => 'La communication est la mise à disposition des services producteurs des documents dont les Archives ont la responsabilité.',
                'reference_id' => 12,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DEC532-TRI',
                'name' => 'Tri des archives',
                'description' => 'Le tri interne consiste en l\'élimination des doublons, brouillons et toute pièce se trouvant accidentellement dans le dossier.',
                'reference_id' => 12,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'DEC532-URG',
                'name' => 'Plan d\'urgence',
                'description' => 'Un plan de mesures d\'urgence doit être établi pour assurer la sécurité des personnes et sauver les documents en cas de sinistre.',
                'reference_id' => 12,
                'user_id' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('reference_articles')->insert($articles);
    }
}
