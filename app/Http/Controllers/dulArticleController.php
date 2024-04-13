<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DulArticle;

class DulArticleController extends Controller
{

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'dul_id' => 'required|integer',
            'artcile_id' => 'required|integer',
        ]);

        DulArticle::create($validatedData);

        return redirect()->back()->with('success', 'L\'association a été créée avec succès.');
    }




    public function show($dulId, $articleId)
    {
        $dulArticle = DulArticle::where('dul_id', $dulId)->where('reference_id', $articleId)->first();
        $dulArticle = $dulArticle->load('dul','articles');
        return redirect()->route('reference.article.index', $articleId)->with('success', 'Articles updated successfully.');

    }





    public function update(Request $request, $dulId, $articleId)
    {
        $dulArticle = DulArticle::where('dul_id', $dulId)->where('reference_id', $articleId)->first();

        $dulArticle->update($request->all());

        return redirect()->back()->with('success', 'L\'association a été mise à jour avec succès.');
    }




    public function destroy($dulId, $articleId)
    {
        DulArticle::where('dul_id', $dulId)->where('reference_id', $articleId)->delete();

        return redirect()->back()->with('success', 'L\'association a été supprimée avec succès.');
    }
}
