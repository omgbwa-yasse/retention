<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class _02GabonReferenceTableSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Insertion des références
        $references = [
            [
                'id' => 8,
                'name' => 'Loi n°009/2006 du 19 octobre 2006',
                'description' => 'Loi relative aux archives au Gabon',
                'category_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
            ],
            [
                'id' => 9,
                'name' => 'Décret n°0791/PR du 30 juin 1980',
                'description' => 'Décret portant création, organisation et attributions de la Direction générale des Archives nationales',
                'category_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
            ],
            [
                'id' => 10,
                'name' => 'Loi n°001/2011 du 25 septembre 2011',
                'description' => 'Loi relative à la protection des données à caractère personnel',
                'category_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
            ],
            [
                'id' => 11,
                'name' => 'Circulaire N°6 du 10 mai 2000',
                'description' => 'Établissement du calendrier de conservation des documents',
                'category_id' => 1,
                'country_id' => 19,
                'user_id' => 3,
            ]
        ];

        DB::table('references')->insert($references);

        // Insertion des articles
        $now = Carbon::now();
        $articles = [
            [
                'code' => 'ART15-ARC',
                'name' => 'Délais de conservation archives publiques',
                'description' => 'Les documents administratifs généraux sont conservés 30 ans, les documents de défense/sûreté nationale et procédures judiciaires 50 ans, les documents médicaux et actes notariés 100 ans.',
                'reference_id' => 8,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART34-ARC',
                'name' => 'Versement aux Archives nationales',
                'description' => 'Les documents clos depuis plus de 10 ans doivent être versés aux Archives nationales pour conservation. Les publications officielles doivent être versées en 2 exemplaires.',
                'reference_id' => 9,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART41-ARC',
                'name' => 'Communication des archives',
                'description' => 'Les archives sont communicables après 30 ans. Ce délai est porté à 50 ans pour les documents relatifs à la défense nationale et la sûreté de l\'État.',
                'reference_id' => 9,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART68-DCP',
                'name' => 'Conservation des données personnelles',
                'description' => 'Les données personnelles doivent être conservées pendant une durée n\'excédant pas la période nécessaire aux finalités pour lesquelles elles ont été collectées.',
                'reference_id' => 10,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART70-DCP',
                'name' => 'Obligation de pérennité',
                'description' => 'Le responsable du traitement est tenu de prendre toute mesure utile pour assurer la pérennité des données à caractère personnel.',
                'reference_id' => 10,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'CIRC6-COMPT',
                'name' => 'Conservation documents comptables',
                'description' => 'Les documents comptables (grand livre, journaux, factures) doivent être conservés pendant 10 ans.',
                'reference_id' => 11,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'CIRC6-SOC',
                'name' => 'Conservation documents sociaux',
                'description' => 'Les registres sociaux (PV d\'assemblées, documents de personnel) doivent être conservés de manière illimitée.',
                'reference_id' => 11,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART40-ARC',
                'name' => 'Conservation des archives',
                'description' => 'Les documents versés sont conservés dans des bâtiments appropriés, spécialement équipés contre les intempéries, la poussière, les agents biologiques et les sinistres.',
                'reference_id' => 9,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'code' => 'ART66-DCP',
                'name' => 'Mesures de sécurité',
                'description' => 'Le responsable du traitement doit prendre toutes précautions pour empêcher que les données soient déformées, endommagées ou que des tiers non autorisés y aient accès.',
                'reference_id' => 10,
                'user_id' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        ];

        DB::table('reference_articles')->insert($articles);
    }
}

