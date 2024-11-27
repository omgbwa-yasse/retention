<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Vérifier si la locale est valide
        if (array_key_exists($locale, config('app.available_locales'))) {
            // Mettre à jour la session
            session()->put('locale', $locale);

            // Forcer la mise à jour de la locale
            App::setLocale($locale);
            app()->setLocale($locale);
            config(['app.locale' => $locale]);
        }

        return redirect()->back();
    }
}
