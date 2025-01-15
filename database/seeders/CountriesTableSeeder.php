<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['abbr' => 'DZA', 'name' => 'Algérie'],
            ['abbr' => 'AGO', 'name' => 'Angola'],
            ['abbr' => 'BEN', 'name' => 'Bénin'],
            ['abbr' => 'BWA', 'name' => 'Botswana'],
            ['abbr' => 'BFA', 'name' => 'Burkina Faso'],
            ['abbr' => 'BDI', 'name' => 'Burundi'],
            ['abbr' => 'CMR', 'name' => 'Cameroun'],
            ['abbr' => 'CPV', 'name' => 'Cap-Vert'],
            ['abbr' => 'CAF', 'name' => 'République centrafricaine'],
            ['abbr' => 'TCD', 'name' => 'Tchad'],
            ['abbr' => 'COM', 'name' => 'Comores'],
            ['abbr' => 'COG', 'name' => 'Congo'],
            ['abbr' => 'COD', 'name' => 'République démocratique du Congo'],
            ['abbr' => 'DJI', 'name' => 'Djibouti'],
            ['abbr' => 'EGY', 'name' => 'Égypte'],
            ['abbr' => 'GNQ', 'name' => 'Guinée équatoriale'],
            ['abbr' => 'ERI', 'name' => 'Érythrée'],
            ['abbr' => 'ETH', 'name' => 'Éthiopie'],
            ['abbr' => 'GAB', 'name' => 'Gabon'],
            ['abbr' => 'GMB', 'name' => 'Gambie'],
            ['abbr' => 'GHA', 'name' => 'Ghana'],
            ['abbr' => 'GIN', 'name' => 'Guinée'],
            ['abbr' => 'GNB', 'name' => 'Guinée-Bissau'],
            ['abbr' => 'CIV', 'name' => 'Côte d\'Ivoire'],
            ['abbr' => 'KEN', 'name' => 'Kenya'],
            ['abbr' => 'LSO', 'name' => 'Lesotho'],
            ['abbr' => 'LBR', 'name' => 'Libéria'],
            ['abbr' => 'LBY', 'name' => 'Libye'],
            ['abbr' => 'MDG', 'name' => 'Madagascar'],
            ['abbr' => 'MWI', 'name' => 'Malawi'],
            ['abbr' => 'MLI', 'name' => 'Mali'],
            ['abbr' => 'MRT', 'name' => 'Mauritanie'],
            ['abbr' => 'MUS', 'name' => 'Maurice'],
            ['abbr' => 'MAR', 'name' => 'Maroc'],
            ['abbr' => 'MOZ', 'name' => 'Mozambique'],
            ['abbr' => 'NAM', 'name' => 'Namibie'],
            ['abbr' => 'NER', 'name' => 'Niger'],
            ['abbr' => 'NGA', 'name' => 'Nigeria'],
            ['abbr' => 'RWA', 'name' => 'Rwanda'],
            ['abbr' => 'STP', 'name' => 'Sao Tomé-et-Principe'],
            ['abbr' => 'SEN', 'name' => 'Sénégal'],
            ['abbr' => 'SYC', 'name' => 'Seychelles'],
            ['abbr' => 'SLE', 'name' => 'Sierra Leone'],
            ['abbr' => 'SOM', 'name' => 'Somalie'],
            ['abbr' => 'ZAF', 'name' => 'Afrique du Sud'],
            ['abbr' => 'SSD', 'name' => 'Soudan du Sud'],
            ['abbr' => 'SDN', 'name' => 'Soudan'],
            ['abbr' => 'SWZ', 'name' => 'Eswatini'],
            ['abbr' => 'TZA', 'name' => 'Tanzanie'],
            ['abbr' => 'TGO', 'name' => 'Togo'],
            ['abbr' => 'TUN', 'name' => 'Tunisie'],
            ['abbr' => 'UGA', 'name' => 'Ouganda'],
            ['abbr' => 'ZMB', 'name' => 'Zambie'],
            ['abbr' => 'ZWE', 'name' => 'Zimbabwe']
        ];

        DB::table('countries')->insert($countries);
    }
}

