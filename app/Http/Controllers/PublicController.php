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
        $searchTerm = $request->input('search');

        $rules = Rule::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'rule'
                ];
            });

        $classes = Classification::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'class'
                ];
            });

        $references = Reference::where('name', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'type' => 'reference'
                ];
            });

        $records = $rules->concat($classes)->concat($references);
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
