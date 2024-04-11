<?php
namespace App\Http\Controllers;
use App\Models\Articles;
use App\Models\Reference;
use Illuminate\Http\Request;

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




    public function show(Reference $reference_id, Articles $article)
    {
        if ($article->reference_id !== $reference_id->id) {
            return redirect()->route('reference.articles.index', $reference_id)->with('error', 'Article not found for this reference.');
        }

        return view('articles.articleShow', compact('article'));
    }



    public function store(Request $request, Reference $reference)
    {

        Articles::create([
            'reference' => $request->input('reference'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'reference_id' => $reference->id,
        ]);

        return redirect()->route('article.index', $reference)->with('success', 'Article created successfully.');
    }






    public function edit(Reference $reference_id, Articles $Article_id_id)
    {
        $reference = Reference::where('id', $reference_id)->firstOrFail();
        $article = Reference::where('id', $reference_id)->firstOrFail();
        return view('articles.articleEdit', compact('Article', 'reference'));
    }





    public function update(Request $request, Reference $reference_id, Articles $Articles)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $Articles->title = $request->input('title');
        $Articles->description = $request->input('description');
        $Articles->save();
        return redirect()->route('reference.articles.index', $reference_id)->with('success', 'Articles updated successfully.');
    }





    public function destroy(Reference $reference_id, Articles $Articles)
    {
        $Articles->delete();
        return redirect()->route('reference.articles.index', $reference_id)->with('success', 'Articles deleted successfully.');
    }
}
