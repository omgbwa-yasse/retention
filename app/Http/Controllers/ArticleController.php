<?php
namespace App\Http\Controllers;
use App\Models\Articles;
use App\Models\Reference;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function create(Reference $reference)
    {
        return view('articles.articleCreate', compact('reference'));
    }




    public function store(Request $request, Reference $reference)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $Articles = new Articles([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'reference_id' => $reference->id,
        ]);

        $Articles->save();

        return redirect()->route('reference.articles.index', $reference->id)->with('success', 'Articles created successfully.');
    }





    public function edit(Reference $reference, Articles $Articles)
    {
        return view('articles.articleEdit', compact('Articles', 'reference'));
    }





    public function update(Request $request, Reference $reference, Articles $Articles)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $Articles->title = $request->input('title');
        $Articles->description = $request->input('description');
        $Articles->save();
        return redirect()->route('reference.articles.index', $reference->id)->with('success', 'Articles updated successfully.');
    }





    public function destroy(Reference $reference, Articles $Articles)
    {
        $Articles->delete();
        return redirect()->route('reference.articles.index', $reference->id)->with('success', 'Articles deleted successfully.');
    }
}
