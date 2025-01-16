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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
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
        // Récupérer les règles avec pagination
        $rules = Rule::latest()
            ->paginate(10)
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'rule',
                    'created_at' => $item->created_at
                ];
            });

        // Récupérer les classes avec pagination
        $classes = Classification::latest()
            ->paginate(10)
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'class',
                    'created_at' => $item->created_at
                ];
            });

        // Récupérer les références avec pagination
        $references = Reference::latest()
            ->paginate(10)
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'reference',
                    'created_at' => $item->created_at
                ];
            });

        // Combiner et trier tous les résultats par date de création
        $records = $rules->concat($classes)
                ->concat($references)
                ->sortByDesc('created_at');

        return view('public.search.index', compact('records'));
    }








    public function advanced(Request $request)
    {
        $query = $request->input('term');
        $type = $request->input('type');

        $results = collect();

        // Fonction de recherche pour chaque modèle
        $searchQuery = function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->term}%")
                    ->orWhere('description', 'LIKE', "%{$request->term}%");
            });
            if (!empty($request->country)) {
                $query->whereHas('country', function ($q) use ($request) {
                    $q->where('id', $request->country);
                });
            }

            if ($request->date) {
                $query->whereDate('created_at', $request->date_operator ?? '=', $request->date);
            } elseif ($request->date_from && $request->date_to) {
                $query->whereBetween('created_at', [
                    $request->date_from . ' 00:00:00',
                    $request->date_to . ' 23:59:59'
                ]);
            }

            return $query;
        };

        // Récupération des résultats
        if (!$type || $type === 'rule') {
            $rules = Rule::where($searchQuery)->with('country')->get()
                ->map(fn($item) => [...$item->toArray(), 'type' => 'rule']);
            $results = $results->concat($rules);
        }

        if (!$type || $type === 'class') {
            $classes = Classification::where($searchQuery)->with('country')->get()
                ->map(fn($item) => [...$item->toArray(), 'type' => 'class']);
            $results = $results->concat($classes);
        }

        if (!$type || $type === 'reference') {
            $references = Reference::where($searchQuery)->with('country')->get()
                ->map(fn($item) => [...$item->toArray(), 'type' => 'reference']);
            $results = $results->concat($references);
        }

        // Paginer les résultats
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $results->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $records = new LengthAwarePaginator($currentItems, $results->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        // Ajouter les paramètres de requête aux liens de pagination
        $records->appends($request->except('page'));

        $countries = Country::all();
        return view('public.search.advanced', [
            'records' => $records,
            'countries' => $countries,
            'searchTerm' => $query
        ]);
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
                            });
                });
            }
        };

        // Rechercher dans les règles
        $rules = Rule::where($searchFunction)
                    ->get()
                    ->map(function ($item) use ($searchTerms) {
                        $relevance = $this->calculateRelevance($item, $searchTerms);
                        return array_merge($item->toArray(), [
                            'type' => 'rule',
                            'relevance' => $relevance,
                        ]);
                    });

        // Rechercher dans les classes
        $classes = Classification::where($searchFunction)
                    ->get()
                    ->map(function ($item) use ($searchTerms) {
                        $relevance = $this->calculateRelevance($item, $searchTerms);
                        return array_merge($item->toArray(), [
                            'type' => 'class',
                            'relevance' => $relevance,
                        ]);
                    });

        // Rechercher dans les références
        $references = Reference::where($searchFunction)
                    ->get()
                    ->map(function ($item) use ($searchTerms) {
                        $relevance = $this->calculateRelevance($item, $searchTerms);
                        return array_merge($item->toArray(), [
                            'type' => 'reference',
                            'relevance' => $relevance,
                        ]);
                    });

        // Combiner et trier tous les résultats par pertinence
        $records = $rules->concat($classes)
                        ->concat($references)
                        ->sortByDesc('relevance');

        // Paginer les résultats
        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $records->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $records = new LengthAwarePaginator($currentItems, $records->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('public.search.index', compact('records', 'searchTerm'));
    }

    /**
     * Calculer la pertinence pour un élément.
     */
    private function calculateRelevance($item, $searchTerms)
    {
        $relevance = 0;
        foreach ($searchTerms as $term) {
            if (stripos($item->name, $term) !== false) {
                $relevance += 1;
            }
            if (stripos($item->description, $term) !== false) {
                $relevance += 1;
            }
        }
        return $relevance;
    }






    /**
     * Affiche la charte publique pour une classification
     */
    public function showCharter($id)
    {
        // Si c'est un parent, on récupère tous ses enfants
        // Si c'est un enfant, on récupère son parent et tous les frères/sœurs
        $classification = Classification::with([
            'parent.childrenRecursive', // Parent et tous ses enfants
            'children', // Enfants directs
            'childrenRecursive', // Tous les descendants
            'rules.duls.trigger',
            'rules.articles',
            'typologies'
        ])->findOrFail($id);

        // Si c'est un enfant, on remonte au parent
        $rootClassification = $classification->parent ?? $classification;

        return view('public.charter', [
            'classification' => $classification,
            'rootClassification' => $rootClassification
        ]);
    }



    /**
     * Télécharger la charte en PDF
     */
    public function downloadCharter($id)
    {
        $classification = Classification::with([
            'childrenRecursive',
            'rules.duls.trigger',
            'rules.articles',
            'typologies'
        ])->findOrFail($id);

        $pdf = PDF::loadView('public.charter-pdf', compact('classification'));
        return $pdf->download($classification->code . '-charte.pdf');
    }


    /**
     * Recherche globale
     */


    /**
     * Affiche les détails d'une classe
     */

    public function showClass(INT $id)
    {
        $class = Classification::with(['parent', 'childrenRecursive', 'rules.duls.trigger', 'rules.articles', 'typologies'])->findOrFail($id);
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
        $rule = Rule::with(['country', 'classifications', 'duls.trigger', 'duls.sort','status','validator'])->findOrFail($id);
        $rule->load(['country', 'classifications', 'duls.trigger', 'duls.sort', 'status', 'validator']);
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
