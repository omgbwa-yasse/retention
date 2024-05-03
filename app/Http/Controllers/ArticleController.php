<?php
namespace App\Http\Controllers;
use App\Models\Articles;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{


    public function index(Reference $reference)
    {
        $articles = $reference->articles()->get();
        return view('articles.articleIndex', compact('reference', 'articles'));
    }



    public function create(Reference $reference)
    {
        return view('articles.articleCreate', compact('reference'));
    }




    public function show(Reference $reference, Articles $article)
    {
        if ($article->reference_id !== $reference->id) {
            return redirect()->route('article.index', $reference)->with('error', 'Article not found for this reference.');
        }
        $article->load('reference','reference.category');
        return view('reference.articles.articleShow', compact('article', 'reference'));
    }



    public function store(Request $request, Reference $reference)
    {
         Articles::create([
            'reference' => $request->input('reference'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'reference_id' => $reference->id,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return redirect()->route('reference.article.index', $reference)->with('success', 'Article created successfully.');
    }




    public function edit(Reference $reference, Articles $article)
    {
        if ($article->reference_id != $reference->id) {
            abort(404);
        }
        return view('reference.articles.articleEdit', compact('article', 'reference'));
    }



    public function update(Request $request, Reference $reference_id, Articles $Articles)
    {
        $request->validate([
            'reference' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $Articles->name = $request->input('reference');
        $Articles->name = $request->input('name');
        $Articles->description = $request->input('description');
        $Articles->save();
        $reference = articles::findOrFail('$reference_id');
        return redirect()->route('reference.article.index', $reference)->with('success', 'Articles updated successfully.');
    }





    public function destroy(Reference $reference, Articles $Article)
    {
        $Article->delete();
        return redirect()->route('reference.article.index', $reference)->with('success', 'Articles deleted successfully.');
    }
}
