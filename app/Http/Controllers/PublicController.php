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
             ->limit(20)
             ->get();

             $references = $references->load('articles');

         return view('public.search.index', compact('references','number_country' ,'number_classes','number_rules','number_references','number_articles','number_typologies','countries'));
     }






     public function advanced(Request $request)
     {



        $query = trim($request->input('term', ''));
        $references = Reference::query();

        $references->where(function ($q) use ($query, $request) {
            if ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                ->limit(20)
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhereHas('articles', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->where('description', 'LIKE', "%{$query}%");
                });
            }
            if ($request->input('country') !== '') {
                $q->orWhereHas('country', function ($q) use ($request) {
                $q->where('id', $request->input('country'));
                });
            }

            if ($request->input('date_from') !== '') {
                $q->orWhere('created_at', '=>', $request->input('date_from'));
            }

            if ($request->input('date_to') !== '') {
                $q->orWhere('created_at', '=<', $request->input('date_to'));
            }
            });


        $references = $references->get();

         return view('public.search.advanced', [
             'references' => $references,
             'countries' => Country::all(),
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

        // Rechercher dans les références avec eager loading de la relation country
        $references = Reference::with('country')
                ->where($searchFunction)
                ->get();

        $references = $references->load('articles');

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
