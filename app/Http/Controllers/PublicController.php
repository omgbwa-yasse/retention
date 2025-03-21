<?php

namespace App\Http\Controllers;

use App\Models\Typology;
use App\Models\Reference;
use App\Models\Rule;
use App\Models\News;
use App\Models\Classification;
use App\Models\ReferenceCategory;
use App\Models\TypologyCategory;
use App\Models\Country;
use App\Models\ReferenceArticle;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class PublicController extends Controller
{
    public function advancedFormular()
    {
        $countries = Country::all();
        return view('public.search.advanced', compact('countries'));
    }

    /**
     * Affiche la page d'accueil publique
     */




     public function index()
     {
         $countries = Country::all();
        $number_country = Country::count();
        $number_classes = Classification::count();
        $number_rules = Rule::count();
        $number_references = Reference::count();
        $number_articles = ReferenceArticle::count();
        $number_typologies = Typology::count();

         $references = Reference::query()
             ->latest()
             ->with('articles')
             ->paginate(20);

         return view('public.search.index', compact('references','number_country' ,'number_classes','number_rules','number_references','number_articles','number_typologies','countries'));
     }






    public function advancedSearchResults(Request $request)
    {
        $searchQuery = $request->input('searchQuery');
        $country = $request->input('country');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        // Initialiser la requête avec les relations nécessaires
        $query = Reference::with(['country', 'articles']);

        // Appliquer les termes de recherche
        if (!empty($searchQuery)) {
            $searchTerms = json_decode($searchQuery, true) ?: [];

            if (!empty($searchTerms)) {
                $query->where(function($mainQuery) use ($searchTerms) {
                    foreach ($searchTerms as $index => $term) {
                        if (is_string($term)) {
                            // Nouveau format simplifié (sans sélecteurs)
                            if ($index === 0) {
                                // Premier terme - condition initiale
                                $mainQuery->where(function($q) use ($term) {
                                    $q->where('name', 'LIKE', "%{$term}%")
                                      ->orWhere('description', 'LIKE', "%{$term}%")
                                      ->orWhereHas('country', function($countryQ) use ($term) {
                                          $countryQ->where('name', 'LIKE', "%{$term}%");
                                      })
                                      ->orWhereHas('articles', function($articlesQ) use ($term) {
                                          $articlesQ->where('name', 'LIKE', "%{$term}%")
                                                  ->orWhere('description', 'LIKE', "%{$term}%");
                                      });
                                });
                            } else {
                                // Termes suivants - AND avec les conditions précédentes
                                $mainQuery->where(function($q) use ($term) {
                                    $q->where('name', 'LIKE', "%{$term}%")
                                      ->orWhere('description', 'LIKE', "%{$term}%")
                                      ->orWhereHas('country', function($countryQ) use ($term) {
                                          $countryQ->where('name', 'LIKE', "%{$term}%");
                                      })
                                      ->orWhereHas('articles', function($articlesQ) use ($term) {
                                          $articlesQ->where('name', 'LIKE', "%{$term}%")
                                                  ->orWhere('description', 'LIKE', "%{$term}%");
                                      });
                                });
                            }
                        }
                        else if (is_array($term) && isset($term['term'])) {
                            // Ancien format avec sélecteurs pour la compatibilité
                            $termValue = $term['term'];
                            $selector = $term['selector'] ?? 'contains';

                            switch ($selector) {
                                case 'contains':
                                    $mainQuery->where(function($q) use ($termValue) {
                                        $q->where('name', 'LIKE', "%{$termValue}%")
                                          ->orWhere('description', 'LIKE', "%{$termValue}%")
                                          ->orWhereHas('country', function($countryQ) use ($termValue) {
                                              $countryQ->where('name', 'LIKE', "%{$termValue}%");
                                          })
                                          ->orWhereHas('articles', function($articlesQ) use ($termValue) {
                                              $articlesQ->where('name', 'LIKE', "%{$termValue}%")
                                                      ->orWhere('description', 'LIKE', "%{$termValue}%");
                                          });
                                    });
                                    break;
                                case 'starts':
                                    $mainQuery->where(function($q) use ($termValue) {
                                        $q->where('name', 'LIKE', "{$termValue}%")
                                          ->orWhere('description', 'LIKE', "{$termValue}%")
                                          ->orWhereHas('country', function($countryQ) use ($termValue) {
                                              $countryQ->where('name', 'LIKE', "{$termValue}%");
                                          })
                                          ->orWhereHas('articles', function($articlesQ) use ($termValue) {
                                              $articlesQ->where('name', 'LIKE', "{$termValue}%")
                                                      ->orWhere('description', 'LIKE', "{$termValue}%");
                                          });
                                    });
                                    break;
                                case 'except':
                                    $mainQuery->where(function($q) use ($termValue) {
                                        $q->where('name', 'NOT LIKE', "%{$termValue}%")
                                          ->where('description', 'NOT LIKE', "%{$termValue}%")
                                          ->whereDoesntHave('country', function($countryQ) use ($termValue) {
                                              $countryQ->where('name', 'LIKE', "%{$termValue}%");
                                          })
                                          ->whereDoesntHave('articles', function($articlesQ) use ($termValue) {
                                              $articlesQ->where('name', 'LIKE', "%{$termValue}%")
                                                      ->orWhere('description', 'LIKE', "%{$termValue}%");
                                          });
                                    });
                                    break;
                            }
                        }
                    }
                });
            }
        }

        // Filtre par pays
        if (!empty($country)) {
            $query->where('country_id', $country);
        }

        // Filtre par date
        if (!empty($dateFrom)) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }

        if (!empty($dateTo)) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        // Pagination des résultats
        $references = $query->paginate(20);

        return view('public.search.advanced', [
            'references' => $references,
            'countries' => Country::all(),
        ]);
    }

    /**
     * Alias pour la méthode advancedSearchResults pour correspondre à la route
     */
    public function advanced(Request $request)
    {
        return $this->advancedSearchResults($request);
    }







    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        if (empty($searchTerm)) {
            return $this->index();
        }

        // Diviser les mots-clés
        $searchTerms = preg_split('/\s+/', trim($searchTerm));

        // Fonction pour ajouter des conditions dynamiques
        $searchFunction = function ($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $query->where(function ($subQuery) use ($term) {
                    $subQuery->where('name', 'LIKE', "%{$term}%")
                            ->orWhere('description', 'LIKE', "%{$term}%")
                            ->orWhereHas('country', function ($q) use ($term) {
                                $q->where('name', 'LIKE', "%{$term}%");
                            })
                            ->orWhereHas('articles', function ($q) use ($term) {
                                $q->where('name', 'LIKE', "%{$term}%")
                                    ->where('description', 'LIKE', "%{$term}%");
                            });
                    });
            }
        };

        // Rechercher dans les références avec eager loading de la relation country
        $references = Reference::with(['country', 'articles'])
                ->where($searchFunction)
                ->paginate(20);

        return view('public.search.index', compact('references', 'searchTerm'));
    }




    public function showCharter($id)
    {

        $classification = Classification::with([
            'parent.childrenRecursive', // Parent et tous ses enfants
            'children', // Enfants directs
            'childrenRecursive', // Tous les descendants
            'rules.trigger',
            'rules.articles',
            'typologies'
        ])->findOrFail($id);

        $rootClassification = $classification->parent ?? $classification;

        return view('public.charter', [
            'classification' => $classification,
            'rootClassification' => $rootClassification
        ]);
    }



    public function downloadCharter($id)
    {
        $classification = Classification::with([
            'childrenRecursive',
            'rules.articles',
            'typologies'
        ])->findOrFail($id);

        $pdf = PDF::loadView('public.charter-pdf', compact('classification'));
        return $pdf->download($classification->code . '-charte.pdf');
    }





    public function showClass(INT $id)
    {
        $class = Classification::with(['parent', 'childrenRecursive', 'rules.articles', 'typologies'])->findOrFail($id);
        return view('public.classes.show', compact('class'));
    }


    /**
     * Affiche les détails d'une référence
     */

    public function showReference(INT $id)
    {
        $reference = Reference::with(['category', 'country', 'articles', 'files' => function($query) {
            $query->whereNotNull('file_path');
        }])->findOrFail($id);

        $reference->load(['category', 'country', 'articles', 'files' => function($query) {
            $query->whereNotNull('file_path');
        }]);
        return view('public.references.show', compact('reference'));
    }



    /**
     * Affiche les détails d'une règle
     */

    public function showRule(INT $id)
    {
        $rule = Rule::with(['country', 'classifications', 'status','validator'])->findOrFail($id);
        $rule->load(['country', 'classifications', 'status', 'validator']);
        return view('public.rules.show', compact('rule'));
    }




    /**
     * Affiche la page À propos
     */
    public function about()
    {
        return view('public.about');
    }




    /**
     * Affiche la page Nouveautés
     */
    public function news()
    {
        $news = News::where('published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            $news =  $news ->load('user');
        return view('public.news', compact('news'));
    }



}
