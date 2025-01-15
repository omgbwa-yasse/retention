<?php
namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{


    public function index(INT $id)
    {
        $reference = Reference::findOrFail($id)->with('category','articles')->get();
        return view('reference.articles.show' , compact('reference'));
    }



    public function create(Reference $reference)
    {
        return view('reference.articles.create', compact('reference'));
    }




    public function show(INT $reference_id, INT $article_id)
    {
        $reference = Reference::findOrFail($reference_id);
        $article = Article::findOrFail($article_id);

        if ($article->reference_id !== $reference->id) {
            return redirect()->route('article.index', $reference)->with('error', 'Article not found for this reference.');
        }
        $article->load('reference','reference.category');
        return view('reference.articles.show', compact('article', 'reference'));
    }



    public function store(Request $request, Reference $reference)
    {
         Article::create([
            'code' => $request->input('code'),
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
        return view('reference.articles.edit', compact('article', 'reference'));
    }



    public function update(Request $request, Reference $reference_id, Article $Article)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $Article->name = $request->input('code');
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
