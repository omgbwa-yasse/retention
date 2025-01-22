<?php
// Dans app/Console/Commands/FixVisitorCountries.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class FixVisitorCountries extends Command
{
    protected $signature = 'visitors:fix-countries';
    protected $description = 'Fix unknown country entries in visitor stats';

    public function handle()
    {
        $this->info('Starting to fix visitor countries...');

        // Mettre à jour les entrées "Unknown"
        DB::table('visitor_stats')
            ->where('country_code', 'NI')
            ->orWhere('country_name', 'Unknown')
            ->update([
                'country_code' => 'N',
                'country_name' => 'Non Identifie'
            ]);

        $this->info('Finished fixing visitor countries.');
    }
}
