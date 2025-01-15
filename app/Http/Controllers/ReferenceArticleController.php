<?php
namespace App\Http\Controllers;
use App\Models\ReferenceArticle;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferenceArticleController extends Controller
{


    public function index(INT $id)
    {
        $reference = Reference::findOrFail($id)->with('category','articles')->get();
        return view('reference.article.show' , compact('reference'));
    }



    public function create(Reference $reference)
    {
        return view('reference.article.create', compact('reference'));
    }




    public function show(INT $reference_id, INT $article_id)
    {
        $reference = Reference::findOrFail($reference_id);
        $article = ReferenceArticle::findOrFail($article_id);

        if ($article->reference_id !== $reference->id) {
            return redirect()->route('article.index', $reference)->with('error', 'ReferenceArticle not found for this reference.');
        }
        $article->load('reference','reference.category');
        return view('reference.article.show', compact('article', 'reference'));
    }



    public function store(Request $request, Reference $reference)
    {
         ReferenceArticle::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'reference_id' => $reference->id,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return redirect()->route('reference.article.index', $reference)->with('success', 'ReferenceArticle created successfully.');
    }




    public function edit(Reference $reference, ReferenceArticle $article)
    {
        if ($article->reference_id != $reference->id) {
            abort(404);
        }
        return view('reference.article.edit', compact('article', 'reference'));
    }



    public function update(Request $request, Reference $reference_id, ReferenceArticle $ReferenceArticle)
    {
        $request->validate([
            'code' => 'required',
            'name' => 'required',
            'description' => 'required'
        ]);
        $ReferenceArticle->name = $request->input('code');
        $ReferenceArticle->name = $request->input('name');
        $ReferenceArticle->description = $request->input('description');
        $ReferenceArticle->save();
        $reference = ReferenceArticle::findOrFail('$reference_id');
        return redirect()->route('reference.article.index', $reference)->with('success', 'ReferenceArticle updated successfully.');
    }





    public function destroy(int $reference_id, int $article_id)
    {
        $referenceArticle = ReferenceArticle::where('reference_id', $reference_id)
            ->where('id', $article_id)
            ->firstOrFail();
        $referenceArticle->delete();
        return redirect()->route('reference.show', $reference_id)->with('success', 'ReferenceArticle deleted successfully.');
    }
}
