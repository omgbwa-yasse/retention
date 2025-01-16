<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



    class _01IvoryCoastReferenceTableSeeder extends Seeder
    {
        use WithoutModelEvents;

        public function run(): void
        {
            // Insertion des références
            $references = [
                [
                    'id' => 4,
                    'name' => 'OHADA - Côte d\'Ivoire',
                    'description' => 'Acte uniforme relatif au droit comptable et à l\'information financière (2017)',
                    'category_id' => 1,
                    'country_id' => 24,
                    'user_id' => 2,
                ],
                [
                    'id' => 5,
                    'name' => 'Loi n° 2013-546 du 30 juillet 2013',
                    'description' => 'Loi relative aux transactions électroniques en Côte d\'Ivoire',
                    'category_id' => 1,
                    'country_id' => 24,
                    'user_id' => 2,
                ],
                [
                    'id' => 6,
                    'name' => 'Loi n° 2013-867 du 23 décembre 2013',
                    'description' => 'Loi relative à l\'accès à l\'information d\'intérêt public en Côte d\'Ivoire',
                    'category_id' => 1,
                    'country_id' => 24,
                    'user_id' => 2,
                ],
                [
                    'id' => 7,
                    'name' => 'Référentiel Général de Gestion des Archives Publiques',
                    'description' => 'Document de référence pour la gestion des archives publiques (Mars 2017)',
                    'category_id' => 1,
                    'country_id' => 24,
                    'user_id' => 2,
                ],
            ];

            DB::table('references')->insert($references);

            // Insertion des articles
            $now = Carbon::now();
            $articles = [
                [
                    'code' => 'ART24-CI',
                    'name' => 'Conservation documents comptables OHADA',
                    'description' => 'Les livres comptables ou les documents qui en tiennent lieu, ainsi que les pièces justificatives sont conservés pendant dix ans.',
                    'reference_id' => 4,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'ART40-TE',
                    'name' => 'Conservation documents électroniques',
                    'description' => 'Les documents sous forme électronique doivent être conservés pendant une période de dix ans, sauf dispositions légales prévoyant un délai plus court.',
                    'reference_id' => 5,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'ART40-TE-COND',
                    'name' => 'Conditions de conservation électronique',
                    'description' => 'La conservation doit garantir : l\'accessibilité pour consultation ultérieure, la conservation dans la forme d\'origine, l\'intégrité du contenu, et la traçabilité des informations sur l\'origine, la destination et la temporalité des documents.',
                    'reference_id' => 5,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'ART41-TE',
                    'name' => 'Garantie d\'authenticité',
                    'description' => 'L\'archivage électronique doit garantir l\'authenticité et l\'intégrité des documents et des transactions électroniques conservés.',
                    'reference_id' => 5,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'ART43-TE',
                    'name' => 'Application aux documents numériques',
                    'description' => 'Les règles de l\'archivage électronique s\'appliquent indifféremment aux documents numérisés et aux documents conçus initialement sur support électronique.',
                    'reference_id' => 5,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'ART6-IP',
                    'name' => 'Documents publics communicables',
                    'description' => 'Sont communicables les dossiers, rapports, études, comptes rendus, PV, statistiques, directives, instructions, circulaires, notes de service et réponses ministérielles comportant une interprétation du droit ou des procédures administratives.',
                    'reference_id' => 6,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'ART7-IP',
                    'name' => 'Documents non communicables',
                    'description' => 'Ne sont pas communicables les documents en cours d\'élaboration et ceux portant atteinte aux secrets des délibérations gouvernementales, de défense nationale, de politique extérieure, de sûreté de l\'État, de sécurité publique, ou de vie privée.',
                    'reference_id' => 6,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'R2GAP-GED',
                    'name' => 'Gestion Électronique des Documents',
                    'description' => 'La GED doit intégrer des procédures de capture, indexation, stockage et diffusion des documents avec des garanties d\'intégrité et de sécurité.',
                    'reference_id' => 7,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
                [
                    'code' => 'R2GAP-SAE',
                    'name' => 'Système d\'Archivage Électronique',
                    'description' => 'Le SAE est indispensable pour les documents à conserver plus de 10 ans. Il doit intégrer les règles de gestion documentaire et garantir l\'intégrité et la pérennité des documents.',
                    'reference_id' => 7,
                    'user_id' => 2,
                    'created_at' => $now,
                    'updated_at' => $now,
                ],
            ];

            DB::table('reference_articles')->insert($articles);
        }
    }
