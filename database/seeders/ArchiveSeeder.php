<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
class ArchiveSeeder extends Seeder
{
    public function run(): void
    {
        // ReferenceCategory
        DB::table('reference_categories')->insert([
            ['name' => 'Documents administratifs', 'description' => 'Documents officiels produits par l\'administration publique'],
            ['name' => 'Archives coloniales', 'description' => 'Documents datant de la période coloniale'],
            ['name' => 'Patrimoine culturel', 'description' => 'Documents relatifs aux traditions et à la culture locale'],
            ['name' => 'Cartes et plans', 'description' => 'Documents cartographiques historiques'],
            ['name' => 'Photographies', 'description' => 'Collections de photographies historiques'],
            ['name' => 'Manuscrits', 'description' => 'Textes manuscrits d\'importance historique'],
        ]);

        // TypologyCategory
        DB::table('typology_categories')->insert([
            ['name' => 'Documents textuels', 'description' => 'Tout type de document principalement textuel'],
            ['name' => 'Documents iconographiques', 'description' => 'Images, photographies, dessins'],
            ['name' => 'Documents audiovisuels', 'description' => 'Enregistrements sonores et vidéos'],
            ['name' => 'Documents numériques', 'description' => 'Documents nés numériques ou numérisés'],
            ['name' => 'Objets', 'description' => 'Artefacts physiques d\'importance historique'],
        ]);

        // BasketType
        DB::table('basket_types')->insert([
            ['name' => 'Archivage définitif'],
            ['name' => 'Élimination'],
            ['name' => 'Révision'],
            ['name' => 'Numérisation'],
            ['name' => 'Conservation préventive'],
        ]);

        // Trigger
        DB::table('triggers')->insert([
            ['code' => 'CREA', 'name' => 'Création', 'description' => 'Date de création du document'],
            ['code' => 'CLOS', 'name' => 'Clôture', 'description' => 'Date de clôture du dossier'],
            ['code' => 'VALI', 'name' => 'Validation', 'description' => 'Date de validation du document'],
            ['code' => 'EXPI', 'name' => 'Expiration', 'description' => 'Date d\'expiration du document'],
        ]);

        // Status
        DB::table('statuses')->insert([
            ['name' => 'En cours', 'description' => 'Document en cours de traitement'],
            ['name' => 'Validé', 'description' => 'Document validé et actif'],
            ['name' => 'Archivé', 'description' => 'Document archivé définitivement'],
            ['name' => 'En attente', 'description' => 'Document en attente de traitement'],
            ['name' => 'Éliminé', 'description' => 'Document destiné à l\'élimination'],
        ]);

        // Country (Central African countries)
        DB::table('countries')->insert([
            ['abbr' => 'CAM', 'name' => 'Cameroun'],
            ['abbr' => 'RCA', 'name' => 'République centrafricaine'],
            ['abbr' => 'TCH', 'name' => 'Tchad'],
            ['abbr' => 'CON', 'name' => 'Congo'],
            ['abbr' => 'GAB', 'name' => 'Gabon'],
            ['abbr' => 'GEQ', 'name' => 'Guinée équatoriale'],
        ]);

        // Sort
        DB::table('sorts')->insert([
            ['code' => 'CONS', 'name' => 'Conservation', 'description' => 'Conservation définitive aux archives historiques'],
            ['code' => 'ELIM', 'name' => 'Élimination', 'description' => 'Destruction contrôlée des documents'],
            ['code' => 'TRIA', 'name' => 'Tri', 'description' => 'Sélection des documents à conserver'],
            ['code' => 'VERS', 'name' => 'Versement', 'description' => 'Transfert vers les archives définitives'],
            ['code' => 'ECHAN', 'name' => 'Échantillonnage', 'description' => 'Sélection représentative pour conservation'],
        ]);
    }
}
