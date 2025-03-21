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

         if (empty($searchTerm)) {
             // Si c'est une requête AJAX ou si on demande du JSON
             if ($request->ajax() || $request->wantsJson() || $request->header('Accept') === 'application/json') {
                 return response()->json([
                     'success' => true,
                     'results' => [],
                     'count' => 0,
                     'message' => 'No search query provided'
                 ]);
             }

             // Sinon, retourner la vue avec un tableau vide
             return view('public.search.index');
         }

         // Diviser les mots-clés
         $searchTerms = preg_split('/\s+/', trim($searchTerm));
         $allResults = [];

         // Rechercher dans les références
         $references = Reference::with(['country', 'articles', 'category', 'user'])->get();
         foreach ($references as $reference) {
             $relevance = 0;
             $matchesTitle = false;
             $matchesDescription = false;

             foreach ($searchTerms as $term) {
                 // Vérifier le titre (priorité 1)
                 if (stripos($reference->name, $term) !== false) {
                     $relevance += 100; // Priorité 1
                     $matchesTitle = true;
                 }

                 // Vérifier la description (priorité 2)
                 if (stripos($reference->description, $term) !== false) {
                     $relevance += 50; // Priorité 2
                     $matchesDescription = true;
                 }

                 // Vérifier le pays (priorité supplémentaire)
                 if ($reference->country && stripos($reference->country->name, $term) !== false) {
                     $relevance += 30;
                 }

                 // Vérifier la catégorie
                 if ($reference->category && stripos($reference->category->name, $term) !== false) {
                     $relevance += 20;
                 }
             }

             // Si au moins un terme correspond au titre ou à la description
             if ($matchesTitle || $matchesDescription) {
                 // Ajouter la date (priorité 3)
                 $createdDate = strtotime($reference->created_at);
                 $currentDate = time();
                 $daysDifference = ($currentDate - $createdDate) / (60 * 60 * 24);

                 // Plus récent = plus pertinent (max 20 points pour les éléments créés aujourd'hui)
                 $dateRelevance = max(0, 20 - min(20, $daysDifference));
                 $relevance += $dateRelevance;

                 // Structurer les données pour la vue
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

         // Rechercher dans les articles
         $articles = ReferenceArticle::with(['reference', 'reference.country', 'user'])->get();
         foreach ($articles as $article) {
             $relevance = 0;
             $matchesTitle = false;
             $matchesDescription = false;
             $matchesCode = false;

             foreach ($searchTerms as $term) {
                 // Vérifier le titre (priorité 1)
                 if (stripos($article->name, $term) !== false) {
                     $relevance += 100; // Priorité 1
                     $matchesTitle = true;
                 }

                 // Vérifier le code (priorité similaire au titre)
                 if (stripos($article->code, $term) !== false) {
                     $relevance += 90;
                     $matchesCode = true;
                 }

                 // Vérifier la description (priorité 2)
                 if (stripos($article->description, $term) !== false) {
                     $relevance += 50; // Priorité 2
                     $matchesDescription = true;
                 }

                 // Vérifier la référence parente
                 if ($article->reference && stripos($article->reference->name, $term) !== false) {
                     $relevance += 40;
                 }

                 // Vérifier le pays
                 if ($article->reference && $article->reference->country &&
                     stripos($article->reference->country->name, $term) !== false) {
                     $relevance += 30;
                 }
             }

             // Si au moins un terme correspond au titre, code ou à la description
             if ($matchesTitle || $matchesDescription || $matchesCode) {
                 // Ajouter la date (priorité 3)
                 $createdDate = strtotime($article->created_at);
                 $currentDate = time();
                 $daysDifference = ($currentDate - $createdDate) / (60 * 60 * 24);

                 // Plus récent = plus pertinent (max 20 points pour les éléments créés aujourd'hui)
                 $dateRelevance = max(0, 20 - min(20, $daysDifference));
                 $relevance += $dateRelevance;

                 // Structurer les données pour la vue
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

         // Trier tous les résultats par pertinence (du plus élevé au plus bas)
         usort($allResults, function($a, $b) {
             return $b['relevance'] <=> $a['relevance'];
         });

         // Préparer les données pour le retour
         $searchData = [
             'success' => true,
             'count' => count($allResults),
             'query' => $searchTerm,
             'results' => $allResults
         ];

         // Pour les requêtes AJAX ou demandant du JSON
         if ($request->ajax() || $request->wantsJson() || $request->header('Accept') === 'application/json') {
             return response()->json($searchData);
         }

         // Pour la pagination en mode non-AJAX
         $perPage = 10; // Nombre d'éléments par page
         $page = $request->input('page', 1);
         $offset = ($page - 1) * $perPage;

         $paginatedResults = array_slice($allResults, $offset, $perPage);

         // Créer un paginateur personnalisé
         $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
             $paginatedResults,
             count($allResults),
             $perPage,
             $page,
             ['path' => $request->url(), 'query' => $request->query()]
         );

         // Pour les requêtes web classiques, charger la vue
         return view('public.search.index', [
             'searchData' => $searchData,
             'paginator' => $paginator
         ]);
     }

     public function index()
     {
         return view('public.search.index');
     }


     public function advanced()
     {
         // Logique pour la recherche avancée
         return view('public.search.advanced');
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
