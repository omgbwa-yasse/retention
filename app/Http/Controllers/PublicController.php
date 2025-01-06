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
    /**
     * Affiche la page d'accueil publique
     */
    public function index()
    {
        $classes = Classification::with([
            'typologies',
            'rules.duls.trigger',
            'rules.articles',
            'country',
            'parent',
            'user'
        ])->orderBy('created_at', 'desc')->paginate(50);
        return view('public.search.index', compact('classes'));
    }


    public function search(Request $request)
    {
        $query = $request->input('q');
        $type = $request->input('type');
        $country = $request->input('country');
        $duration = $request->input('duration');
        $sort = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        if (!empty($query) || $request->has('show_all')) {
            // Recherche des classifications
            $classifications = Classification::with([
                'typologies',
                'rules.duls.trigger',
                'rules.articles',
                'country'
            ]);

            if (!empty($query)) {
                $classifications->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('code', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            }

            if ($country) {
                $classifications->where('country_id', $country);
            }

            if ($duration) {
                $classifications->whereHas('rules.duls', function($q) use ($duration) {
                    $q->where('duration', 'like', "%{$duration}%");
                });
            }

            // Regrouper par typologie
            $classifications = $classifications->get()
                ->groupBy(function($item) {
                    return $item->typologies->first() ? $item->typologies->first()->name : 'Sans typologie';
                });

            // Recherche des règles
            $rules = Rule::with([
                'classifications',
                'duls.trigger',
                'articles',
                'country',
                'status'
            ])
                ->where('status_id', 2); // Uniquement les règles validées

            if (!empty($query)) {
                $rules->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('code', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                });
            }

            if ($country) {
                $rules->where('country_id', $country);
            }

            if ($duration) {
                $rules->whereHas('duls', function($q) use ($duration) {
                    $q->where('duration', 'like', "%{$duration}%");
                });
            }

            // Tri
            if ($sort === 'date') {
                $rules->orderBy('created_at', $order);
            } else {
                $rules->orderBy($sort, $order);
            }

            $results = [
                'classifications' => $classifications,
                'rules' => $rules->get(),
                'filters' => [
                    'countries' => Country::all(),
                    'durations' => [
                        '1_year' => '1 an',
                        '2_years' => '2 ans',
                        '5_years' => '5 ans',
                        '10_years' => '10 ans',
                        'permanent' => 'Conservation permanente'
                    ],
                    'sorts' => [
                        'name' => 'Nom',
                        'code' => 'Code',
                        'date' => 'Date'
                    ]
                ]
            ];
        } else {
            $results = [];
        }

        return view('public.index', [
            'searchQuery' => $query,
            'searchResults' => $results,
            'currentCountry' => $country,
            'currentDuration' => $duration,
            'currentSort' => $sort,
            'currentOrder' => $order
        ]);
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
     * Affiche la liste des références
     */
    public function references(Request $request)
    {
        $query = Reference::with(['category', 'countries'])
            ->select('references.*')
            ->leftJoin('reference_categories', 'references.category_id', '=', 'reference_categories.id');

        // Filtrage par catégorie
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Filtrage par pays
        if ($request->has('country')) {
            $query->whereHas('countries', function($q) use ($request) {
                $q->where('countries.id', $request->country);
            });
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('references.name', 'like', "%{$search}%")
                    ->orWhere('references.description', 'like', "%{$search}%")
                    ->orWhere('reference_categories.name', 'like', "%{$search}%");
            });
        }

        $references = $query->paginate(10)->withQueryString();
        $categories = ReferenceCategory::all();
        $countries = Country::all();

        return view('public.references', compact('references', 'categories', 'countries'));
    }




    /**
     * Télécharger la charte en PDF
     */
    public function downloadCharter($id)
    {
        $classification = Classification::with([
            'childrenRecursive',
            'rules.actives.trigger',
            'rules.duas.trigger',
            'rules.duls.trigger',
            'rules.articles',
            'typologies'
        ])->findOrFail($id);

        $pdf = PDF::loadView('public.charter-pdf', compact('classification'));
        return $pdf->download($classification->code . '-charte.pdf');
    }



    public function filter(Request $request)
    {
        $query = $request->input('q');
        $typology = $request->input('typology');
        $duration = $request->input('duration');

        $classifications = Classification::with([
            'typologies',
            'rules.actives.trigger',
            'rules.duas.trigger',
            'rules.duls.trigger',
            'rules.articles'
        ]);

        if ($typology) {
            $classifications->whereHas('typologies', function($q) use ($typology) {
                $q->where('name', $typology);
            });
        }

        if ($duration) {
            $classifications->whereHas('rules.duls', function($q) use ($duration) {
                $q->where('duration', 'like', "%{$duration}%");
            });
        }

        if ($query) {
            $classifications->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('code', 'like', "%{$query}%")
                    ->orWhere('description', 'like', "%{$query}%");
            });
        }

        $results = $classifications->get()->groupBy('typologies.*.name');

        return response()->json(['results' => $results]);
    }




    /**
     * Affiche la liste des règles
     */
    public function rules(Request $request)
    {
        $query = Rule::with(['country', 'classifications'])
            ->select('rules.*')
            ->where('status_id', 2); // Uniquement les règles validées/publiées

        // Filtrage par pays
        if ($request->has('country')) {
            $query->where('country_id', $request->country);
        }

        // Filtrage par classification
        if ($request->has('classification')) {
            $query->whereHas('classifications', function($q) use ($request) {
                $q->where('classifications.id', $request->classification);
            });
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $rules = $query->paginate(10)->withQueryString();
        $countries = Country::all();
        $classifications = Classification::whereNull('parent_id')->with('children')->get();

        return view('public.rules', compact('rules', 'countries', 'classifications'));
    }




    /**
     * Affiche la liste des classifications
     */
    public function classifications(Request $request)
    {
        $query = Classification::with('parent')
            ->select('classifications.*');

        // Filtrage par type (parent/enfant)
        if ($request->has('type')) {
            if ($request->type === 'parent') {
                $query->whereNull('parent_id');
            } elseif ($request->type === 'child') {
                $query->whereNotNull('parent_id');
            }
        }

        // Filtrage par pays
        if ($request->has('country')) {
            $query->where('country_id', $request->country);
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $classifications = $query->paginate(10)->withQueryString();
        $countries = Country::all();

        return view('public.classifications', compact('classifications', 'countries'));
    }







    /**
     * Recherche globale
     */


    /**
     * Affiche les détails d'une référence
     */
    public function showReference(Reference $reference)
    {
        $reference->load(['category', 'countries', 'articles', 'files' => function($query) {
            $query->whereNotNull('file_path');
        }]);

        return view('public.references.show', compact('reference'));
    }

    /**
     * Affiche les détails d'une règle
     */
    public function showRule(Rule $rule)
    {
        $rule->load(['country', 'classifications', 'duls.articles', 'duls.trigger', 'duls.sort']);

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
