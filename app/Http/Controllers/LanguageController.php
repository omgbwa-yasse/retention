<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    // Liste des langues disponibles dans la zone CEMAC
    protected $availableLocales = [
        'fr'    => 'Cameroun',      // Langue officielle dans tous les pays CEMAC
        'en'    => 'English',      // Langue officielle dans tous les pays CEMAC
        'ar'    => 'Arabe',         // Tchad
        'sng'   => 'Sango',         // République Centrafricaine
        'ln'    => 'Lingala',       // Congo, RDC
        'kde'   => 'Makonde',       // Gabon
        'bum'   => 'Bulu',          // Cameroun
        'sg'    => 'Sango',         // Guinée Équatoriale
    ];

    public function switch($locale)
    {
        // Vérifie si la langue demandée est disponible
        if (!array_key_exists($locale, $this->availableLocales)) {
            abort(400, 'Langue non supportée');
        }

        // Stocke la langue choisie dans la session
        session()->put('locale', $locale);

        // Définit la langue pour l'application
        App::setLocale($locale);

        // Redirige vers la page précédente
        return redirect()->back();
    }

    // Méthode pour obtenir la liste des langues disponibles
    public function getAvailableLocales()
    {
        return $this->availableLocales;
    }
}
