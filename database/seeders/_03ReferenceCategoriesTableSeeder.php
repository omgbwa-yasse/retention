<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class _03ReferenceCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'id' => 1,
                'name' => 'Constitution',
                'description' => 'Texte fondamental de la République qui définit les droits et libertés des citoyens ainsi que l\'organisation et la séparation des pouvoirs de l\'État. Elle représente la norme suprême du système juridique français.'
            ],
            [
                'id' => 2,
                'name' => 'Loi constitutionnelle',
                'description' => 'Texte qui modifie la Constitution. Elle nécessite une procédure spéciale d\'adoption et fait partie du bloc de constitutionnalité, ayant la même valeur juridique que la Constitution.'
            ],
            [
                'id' => 3,
                'name' => 'Traité international',
                'description' => 'Accord écrit conclu entre États ou organisations internationales, créant des droits et obligations juridiquement contraignants en droit international. Il nécessite une ratification pour entrer en vigueur.'
            ],
            [
                'id' => 4,
                'name' => 'Convention internationale',
                'description' => 'Accord formel entre plusieurs États établissant des règles et engagements mutuels sur des sujets spécifiques. Elle définit un cadre de coopération international dans divers domaines.'
            ],
            [
                'id' => 5,
                'name' => 'Accord international',
                'description' => 'Entente formelle entre pays définissant des engagements mutuels sur des sujets précis. Plus souple qu\'un traité, il peut porter sur des domaines variés comme l\'économie ou la culture.'
            ],
            [
                'id' => 6,
                'name' => 'Règlement européen',
                'description' => 'Acte juridique de l\'Union Européenne directement applicable dans tous les États membres. Il s\'impose à tous les pays sans nécessiter de transposition en droit national.'
            ],
            [
                'id' => 7,
                'name' => 'Directive européenne',
                'description' => 'Texte législatif européen fixant des objectifs à atteindre par les États membres, qui doivent adapter leur législation nationale pour les respecter dans un délai donné.'
            ],
            [
                'id' => 8,
                'name' => 'Loi organique',
                'description' => 'Loi complétant la Constitution pour préciser l\'organisation des pouvoirs publics. Elle suit une procédure d\'adoption spécifique et est soumise au contrôle du Conseil constitutionnel.'
            ],
            [
                'id' => 9,
                'name' => 'Loi ordinaire',
                'description' => 'Texte législatif voté par le Parlement selon la procédure législative normale. Elle établit des règles générales dans les domaines définis par la Constitution.'
            ],
            [
                'id' => 10,
                'name' => 'Ordonnance',
                'description' => 'Mesure prise par le gouvernement dans des domaines relevant normalement de la loi, après autorisation du Parlement. Elle doit être ratifiée pour avoir valeur législative.'
            ],
            [
                'id' => 11,
                'name' => 'Code',
                'description' => 'Recueil organisé et structuré des lois et règlements relatifs à une matière spécifique. Il rassemble et ordonne les textes juridiques d\'un domaine particulier.'
            ],
            [
                'id' => 12,
                'name' => 'Décret',
                'description' => 'Acte réglementaire pris par le pouvoir exécutif pour appliquer une loi ou exercer son pouvoir réglementaire autonome. Il peut être pris en Conseil d\'État ou simple.'
            ],
            [
                'id' => 13,
                'name' => 'Arrêté',
                'description' => 'Décision administrative à portée générale ou individuelle prise par une autorité administrative (ministre, préfet, maire). Il applique les lois et décrets à un niveau plus local.'
            ],
            [
                'id' => 14,
                'name' => 'Circulaire',
                'description' => 'Document administratif interne précisant l\'interprétation et les modalités d\'application des lois et règlements. Elle guide l\'action des services administratifs.'
            ],
            [
                'id' => 15,
                'name' => 'Instruction',
                'description' => 'Directive interne à l\'administration précisant les modalités d\'application des textes légaux et réglementaires. Elle organise le fonctionnement des services administratifs.'
            ]
        ];

        DB::table('reference_categories')->insert($categories);
    }
}
