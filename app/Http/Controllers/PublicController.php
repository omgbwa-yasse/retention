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


    /**
     * Affiche la page d'accueil publique
     */

    public function search(Request $request)
    {

        $searchTerm = $request->input('query');
        $categoryFilter = $request->input('category');
        $countryFilter = $request->input('country');
        $dateFilter = $request->input('date');

        $countries = Country::all();
        $categories = ReferenceCategory::all();

        if (empty($searchTerm)) {
           if ($request->ajax() || $request->wantsJson() || $request->header('Accept') === 'application/json') {
              return response()->json([
                 'success' => true,
                 'results' => [],
                 'count' => 0,
                 'message' => 'No search query provided',
                 'countries' => $countries,
                 'categories' => $categories
              ]);
           }
           return view('public.search.index', [
              'countries' => $countries,
              'categories' => $categories
           ]);
        }

        $searchTerms = preg_split('/\s+/', trim($searchTerm));
        $allResults = [];

        $references = Reference::with(['country', 'articles', 'category', 'user'])
           ->when($categoryFilter, function ($query, $categoryFilter) {
              return $query->where('category_id', $categoryFilter);
           })
           ->when($countryFilter, function ($query, $countryFilter) {
              return $query->where('country_id', $countryFilter);
           })
           ->when($dateFilter, function ($query, $dateFilter) {
              return $query->whereDate('created_at', $dateFilter);
           })
           ->get();

        foreach ($references as $reference) {
           $relevance = 0;
           $matchesTitle = false;
           $matchesDescription = false;

           foreach ($searchTerms as $term) {
              if (stripos($reference->name, $term) !== false) {
                 $relevance += 100;
                 $matchesTitle = true;
              }
              if (stripos($reference->description, $term) !== false) {
                 $relevance += 50;
                 $matchesDescription = true;
              }
              if ($reference->country && stripos($reference->country->name, $term) !== false) {
                 $relevance += 30;
              }
              if ($reference->category && stripos($reference->category->name, $term) !== false) {
                 $relevance += 20;
              }
           }

           if ($matchesTitle || $matchesDescription) {
              $createdDate = strtotime($reference->created_at);
              $currentDate = time();
              $daysDifference = ($currentDate - $createdDate) / (60 * 60 * 24);
              $dateRelevance = max(0, 20 - min(20, $daysDifference));
              $relevance += $dateRelevance;

              $allResults[] = [
                 'id' => $reference->id,
                 'name' => $reference->name,
                 'description' => $reference->description,
                 'country' => [
                    'name' => $reference->country ? $reference->country->name : null,
                    'abbr' => $reference->country ? $reference->country->abbr : null,
                 ],
                 'category' => $reference->category ? [
                    'name' => $reference->category->name,
                    'id' => $reference->category->id,
                 ] : null,
                 'created_at' => $reference->created_at ? $reference->created_at->format('d/m/Y') : null,
                 'user' => $reference->user ? [
                    'name' => $reference->user->name,
                    'id' => $reference->user->id,
                 ] : null,
                 'articles_count' => $reference->articles->count(),
                 'type' => 'reference',
                 'relevance' => $relevance
              ];
           }
        }

        $articles = ReferenceArticle::with(['reference', 'reference.country', 'user'])
           ->when($categoryFilter, function ($query, $categoryFilter) {
              return $query->whereHas('reference', function ($query) use ($categoryFilter) {
                 $query->where('category_id', $categoryFilter);
              });
           })
           ->when($countryFilter, function ($query, $countryFilter) {
              return $query->whereHas('reference', function ($query) use ($countryFilter) {
                 $query->where('country_id', $countryFilter);
              });
           })
           ->when($dateFilter, function ($query, $dateFilter) {
              return $query->whereDate('created_at', $dateFilter);
           })
           ->get();

        foreach ($articles as $article) {
           $relevance = 0;
           $matchesTitle = false;
           $matchesDescription = false;
           $matchesCode = false;

           foreach ($searchTerms as $term) {
              if (stripos($article->name, $term) !== false) {
                 $relevance += 100;
                 $matchesTitle = true;
              }
              if (stripos($article->code, $term) !== false) {
                 $relevance += 90;
                 $matchesCode = true;
              }
              if (stripos($article->description, $term) !== false) {
                 $relevance += 50;
                 $matchesDescription = true;
              }
              if ($article->reference && stripos($article->reference->name, $term) !== false) {
                 $relevance += 40;
              }
              if ($article->reference && $article->reference->country &&
                 stripos($article->reference->country->name, $term) !== false) {
                 $relevance += 30;
              }
           }

           if ($matchesTitle || $matchesDescription || $matchesCode) {
              $createdDate = strtotime($article->created_at);
              $currentDate = time();
              $daysDifference = ($currentDate - $createdDate) / (60 * 60 * 24);
              $dateRelevance = max(0, 20 - min(20, $daysDifference));
              $relevance += $dateRelevance;

              $allResults[] = [
                 'id' => $article->id,
                 'name' => $article->name,
                 'code' => $article->code,
                 'description' => $article->description,
                 'reference' => $article->reference ? $article->reference->name : null,
                 'reference_id' => $article->reference ? $article->reference->id : null,
                 'country' => $article->reference && $article->reference->country ? [
                    'name' => $article->reference->country->name,
                    'abbr' => $article->reference->country->abbr,
                 ] : null,
                 'created_at' => $article->created_at ? $article->created_at->format('d/m/Y') : null,
                 'user' => $article->user ? [
                    'name' => $article->user->name,
                    'id' => $article->user->id,
                 ] : null,
                 'type' => 'article',
                 'relevance' => $relevance
              ];
           }
        }

        usort($allResults, function($a, $b) {
           return $b['relevance'] <=> $a['relevance'];
        });


        $searchData = [
           'success' => true,
           'count' => count($allResults),
           'query' => $searchTerm,
           'results' => $allResults,
           'countries' => $countries,
           'categories' => $categories
        ];


        if ($request->ajax() || $request->wantsJson() || $request->header('Accept') === 'application/json') {
           return response()->json($searchData);
        }

        $perPage = 10;
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $paginatedResults = array_slice($allResults, $offset, $perPage);

        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
           $paginatedResults,
           count($allResults),
           $perPage,
           $page,
           ['path' => $request->url(), 'query' => $request->query()]
        );



    }

     public function index()
     {
         $countries = Country::all();
         $categories = ReferenceCategory::all();
         return view('public.search.index', [
            'countries' => $countries,
            'categories' => $categories
         ]);
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
