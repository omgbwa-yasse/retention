<?php

namespace App\Http\Controllers;

use App\Models\Typology;
use App\Models\Reference;
use App\Models\Rule;
use App\Models\Classification;
use App\Models\ReferenceCategory;
use App\Models\TypologyCategory;
use App\Models\Country;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function advancedFormular()
    {
        $countries = Country::pluck('name', 'abbr');
        return view('public.search.advanced', compact('countries'));
    }

    public function advanced(Request $request)
    {
//         Debug pour voir ce qui arrive


        $query = $request->input('term');
        $type = $request->input('type');
        $countries = $request->input('countries', []);

//        if (!$query) {
//            return $this->advancedFormular();
//        }

        $results = collect();

        // Fonction de recherche pour chaque modèle
        $searchQuery = function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->term}%")
                    ->orWhere('description', 'LIKE', "%{$request->term}%");
            });

            if (!empty($request->countries)) {
                $query->whereIn('country', $request->countries);
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
            $rules = Rule::when(true, $searchQuery)->get()
                ->map(fn($item) => [...$item->toArray(), 'type' => 'rule']);
            $results = $results->concat($rules);
        }

        if (!$type || $type === 'class') {
            $classes = Classification::when(true, $searchQuery)->get()
                ->map(fn($item) => [...$item->toArray(), 'type' => 'class']);
            $results = $results->concat($classes);
        }

        if (!$type || $type === 'reference') {
            $references = Reference::when(true, $searchQuery)->get()
                ->map(fn($item) => [...$item->toArray(), 'type' => 'reference']);
            $results = $results->concat($references);
        }
//        dd($request->all());
//        dd([
//            'count' => $results->count(),
//            'empty' => $results->isEmpty(),
//            'first_few' => $results->take(100)->toArray()
//        ]);

        $countries = Country::pluck('name', 'abbr');

        return view('public.search.advanced', [
            'records' => $results,
            'countries' => $countries,
            'searchTerm' => $query
        ]);
    }

    /**
     * Affiche la page d'accueil publique
     */
    public function index()
    {
        // Récupérer les 5 dernières règles
        $rules = Rule::latest()
            ->take(5)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'rule',
                    'created_at' => $item->created_at
                ];
            });

        // Récupérer les 5 dernières classes
        $classes = Classification::latest()
            ->take(5)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'class',
                    'created_at' => $item->created_at
                ];
            });

        // Récupérer les 5 dernières références
        $references = Reference::latest()
            ->take(5)
            ->get()
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
                ->sortByDesc('created_at')
                ->take(50);
        return view('public.search.index', compact('records'));
    }




    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        if (empty($searchTerm)) {
            return $this->index();
        }

        $searchFunction = function ($query, $searchTerm) {
            return $query->where('name', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        };

        $rules = Rule::when($searchTerm, $searchFunction)
                    ->get()
                    ->map(function($item) use ($searchTerm) {
                        $relevance = strpos($item->name, $searchTerm) !== false ? 1 : 2;
                        if ($relevance !== 1 && strpos($item->description, $searchTerm) !== false) {
                            $relevance = 2;
                        }
                        return array_merge($item->toArray(), [
                            'type' => 'rule',
                            'relevance' => $relevance
                        ]);
                    });

        $classes = Classification::when($searchTerm, $searchFunction)
                    ->get()
                    ->map(function($item) use ($searchTerm) {
                        $relevance = strpos($item->name, $searchTerm) !== false ? 1 : 2;
                        if ($relevance !== 1 && strpos($item->description, $searchTerm) !== false) {
                            $relevance = 2;
                        }
                        return array_merge($item->toArray(), [
                            'type' => 'class',
                            'relevance' => $relevance
                        ]);
                    });

        $references = Reference::when($searchTerm, $searchFunction)
                    ->get()
                    ->map(function($item) use ($searchTerm) {
                        $relevance = strpos($item->name, $searchTerm) !== false ? 1 : 2;
                        if ($relevance !== 1 && strpos($item->description, $searchTerm) !== false) {
                            $relevance = 2;
                        }
                        return array_merge($item->toArray(), [
                            'type' => 'reference',
                            'relevance' => $relevance
                        ]);
                    });

        $records = collect([$rules, $classes, $references])->flatten()->sortBy('relevance');
        $records = $rules->concat($classes)
                    ->concat($references)
                    ->sortByDesc('relevance')
                    ->take(50);

        return view('public.search.index', compact('records', 'searchTerm'));
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
        $news = DB::table('news')
            ->where('published', true)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('public.news', compact('news'));
    }



}
