<?php

namespace App\Http\Controllers;

use App\Models\Typology;
use App\Models\Reference;
use App\Models\Rule;
use App\Models\Classification;
use App\Models\ReferenceCategory;
use App\Models\TypologyCategory;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    /**
     * Affiche la page d'accueil publique
     */
    public function index()
    {
        return view('public.index', [
            // Statistiques
            'activities' => Classification::count(),
            'references' => Reference::count(),
            'rules' => Rule::where('status_id', 2)->count(),
            'typologies' => Typology::count(),

            // Derniers éléments
            'latestActivities' => Classification::latest()->take(5)->get(),
            'latestReferences' => Reference::latest()->take(5)->get(),
            'latestRules' => Rule::where('status_id', 2)->latest()->take(5)->get(),
            'latestTypologies' => Typology::latest()->take(5)->get(),
        ]);
    }
    /**
     * Affiche la liste des typologies
     */
    public function typologies(Request $request)
    {
        $query = Typology::with('category')
            ->select('typologies.*')
            ->leftJoin('typology_categories', 'typologies.category_id', '=', 'typology_categories.id');

        // Filtrage par catégorie
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('typologies.name', 'like', "%{$search}%")
                    ->orWhere('typologies.description', 'like', "%{$search}%")
                    ->orWhere('typology_categories.name', 'like', "%{$search}%");
            });
        }

        // Tri
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');
        $query->orderBy($sort, $direction);

        $typologies = $query->paginate(10)->withQueryString();
        $categories = TypologyCategory::all();

        return view('public.typologies', compact('typologies', 'categories'));
    }

    /**
     * Recherche publique
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $references = Reference::where('name', 'like', "%{$query}%")->get();
        $rules = Rule::where('name', 'like', "%{$query}%")->get();
        $typologies = Typology::where('name', 'like', "%{$query}%")->get();
        $classifications = Classification::where('name', 'like', "%{$query}%")->get();

        return view('search.index', compact('references', 'rules', 'typologies', 'classifications'));
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
