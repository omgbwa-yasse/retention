<?php
namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{


    public function index(Reference $reference)
    {
        $Article = $reference->Article()->get();
        return view('reference.Article.articleIndex', compact('reference', 'Article'));
    }



    public function create(Reference $reference)
    {
        return view('reference.Article.articleCreate', compact('reference'));
    }




    public function show(Reference $reference, Article $article)
    {
        if ($article->reference_id !== $reference->id) {
            return redirect()->route('article.index', $reference)->with('error', 'Article not found for this reference.');
        }
        $article->load('reference','reference.category');
        return view('reference.Article.articleShow', compact('article', 'reference'));
    }



    public function store(Request $request, Reference $reference)
    {
         Article::create([
            'reference' => $request->input('reference'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'reference_id' => $reference->id,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return redirect()->route('reference.article.index', $reference)->with('success', 'Article created successfully.');
    }




    public function edit(Reference $reference, Article $article)
    {
        if ($article->reference_id != $reference->id) {
            abort(404);
        }
        return view('reference.Article.articleEdit', compact('article', 'reference'));
    }



    public function update(Request $request, Reference $reference_id, Article $Article)
    {
        $request->validate([
            'reference' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $Article->name = $request->input('reference');
        $Article->name = $request->input('name');
        $Article->description = $request->input('description');
        $Article->save();
        $reference = Article::findOrFail('$reference_id');
        return redirect()->route('reference.article.index', $reference)->with('success', 'Article updated successfully.');
    }





    public function destroy(Reference $reference, Article $Article)
    {
        $Article->delete();
        return redirect()->route('reference.article.index', $reference)->with('success', 'Article deleted successfully.');
    }
}
